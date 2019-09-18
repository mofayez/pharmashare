<?php


namespace App\Modules\Drug;


use App\Models\StorePharmacyPoints;
use App\Models\StorePointsPackage;
use App\Models\User;
use Carbon\Carbon;

class FOCPoints
{


    protected $storePointsPackage;

    public function __construct()
    {

        $this->storePointsPackage = new StorePointsPackage;
    }


    public function savePointsPackages(array $data)
    {

        $this->storePointsPackage->where('store_id', $data['store_id'])->delete();

        if (count($data['points']) === 0) {

            return return_msg(true, 'ok');
        }

        $points_data = $this->preparePointsData($data);

        $this->storePointsPackage->insert($points_data);

        return return_msg(true, 'ok');
    }


    public function allPointsPackagesByStoreId($store_id)
    {

        $packages = $this->storePointsPackage->where('store_id', $store_id)->get();

        return return_msg(true, 'ok', compact('packages'));
    }

    public function preparePointsData($data)
    {

        $points_data = [];
        foreach ($data['points'] ?? [] as $key => $point) {
            $points_data[] = [
                'store_id' => $data['store_id'],
                'points' => $data['points'][$key],
                'price' => $data['price'][$key],
            ];
        }

        return $points_data;
    }


    public function updatePointsPackage(array $data)
    {

        $package = $this->find($data['package_id']);
        if (!$package) {

            return return_msg(false, 'not_found');
        }

        $package->update([
            'store_id' => $data['store_id'],
            'points' => $data['points'],
            'price' => $data['price'],
        ]);

        return return_msg(true, 'ok');
    }


    public function find($package_id)
    {

        return $this->storePointsPackage->find($package_id);
    }


    public function getSuitablePackages($store_id, $points)
    {

        $foc = $this->storePointsPackage
            ->with('drugStore')
            ->where('points', '<=', $points)
            ->where('store_id', $store_id)
            ->get();

        return return_msg(true, 'ok', compact('foc'));
    }


    public function getPharmaciesPoints(array $data)
    {

        $pharmacy_id = $data['pharmacy_id'] ?? null;
        $store_id = $data['store_id'] ?? null;
        $pharmacy_name = $data['pharmacy_name'] ?? null;
        $from_date = $data['from_date'] ?? null;
        $to_date = $data['to_date'] ?? null;
        if ($from_date) {
            $from_date = Carbon::parse($data['from_date'])->toDateString();
        }
        if ($to_date) {
            $to_date = Carbon::parse($data['to_date'])->toDateString();
        }

        if ($pharmacy_id) {

            $pharmacy = User::with('points', 'salesPharmacy')
                ->whereHas('role', function ($query) use ($store_id, $pharmacy_name) {
                    $query->where('title', 'pharmacy');
                    if ($pharmacy_name) {
                        $query->where('username', 'LIKE', "%{$pharmacy_name}%")
                            ->orWhere('firstname', 'LIKE', "%{$pharmacy_name}%")
                            ->orWhere('lastname', 'LIKE', "%{$pharmacy_name}%");
                    }
                })
                ->whereHas('points', function ($query) use ($from_date, $to_date) {
                    if ($from_date && $to_date) {
                        $query->whereDate('created_at', '>=', $from_date)
                            ->whereDate('created_at', '<=', $to_date);
                    }
                })
//                ->whereHas('salesPharmacy', function ($query) use ($store_id) {
//                    $query->where('store_id', $store_id)->orderBy('created_at', 'desc');
//                })
                ->where('id', $pharmacy_id)
                ->get(['id', 'username', 'firstname', 'lastname', 'email', 'prefix', 'phone', 'full_address'])
                ->first();

            if (!$pharmacy) {
                return return_msg(true, 'ok');
            }


            $pharmacy->total_points = $pharmacy->points->where('transaction', 'in')->sum('total_points')
                - $pharmacy->points->where('transaction', 'out')->sum('total_points');

            $pharmacy->last_sale = $pharmacy->salesPharmacy->first() ?? null;
            $pharmacy->sales_count = $pharmacy->salesPharmacy->count() ?? 0;
            $pharmacy->makeHidden(['points', 'salesPharmacy']);

            return return_msg(true, 'ok', compact('pharmacy'));
        }

        $pharmacies = User::with('points', 'salesPharmacy')
            ->whereHas('role', function ($query) use ($store_id, $pharmacy_name) {
                $query->where('title', 'pharmacy');
                if ($pharmacy_name) {
                    $query->where('username', 'LIKE', "%{$pharmacy_name}%")
                        ->orWhere('firstname', 'LIKE', "%{$pharmacy_name}%")
                        ->orWhere('lastname', 'LIKE', "%{$pharmacy_name}%");
                }
            })
            ->whereHas('points', function ($query) use ($from_date, $to_date) {

                $query->where('transaction', 'in');

                if ($from_date && $to_date) {
                    $query->whereDate('created_at', '>=', $from_date)
                        ->whereDate('created_at', '<=', $to_date);
                }
            })
            ->whereHas('salesPharmacy', function ($query) use ($store_id) {

                if ($store_id) {

                    $query->where('store_id', $store_id)->orderBy('created_at', 'desc');
                }
            })
            ->get(['id', 'username', 'firstname', 'lastname', 'email', 'prefix', 'phone', 'full_address']);

        $pharmacies->map(function ($pharmacy) {

            $pharmacy->total_points = $pharmacy->points->where('transaction', 'in')->sum('total_points')
                - $pharmacy->points->where('transaction', 'out')->sum('total_points');
            $pharmacy->last_sale = $pharmacy->salesPharmacy->first() ?? null;
            $pharmacy->sales_count = $pharmacy->salesPharmacy->count() ?? 0;
            $pharmacy->makeHidden(['points', 'salesPharmacy']);
        });

        return return_msg(true, 'ok', compact('pharmacies'));
    }

    public function getPointsPrice(array $data)
    {

        $total_points_with_pharmacy = $data['total_points_with_pharmacy'];
        $store_id = $data['store_id'];


        $available_points_packages = StorePointsPackage::where('store_id', $store_id)
            ->where('points', '<=', $total_points_with_pharmacy)
            ->get(['id', 'store_id', 'price', 'points']);

        return $available_points_packages;

    }

    public function redeemPoints(array $data)
    {

        $points_package_id = $data['points_package_id'];

        $pharmacy_points = $this->getPharmacyPoints($data)['data']['total_points_with_pharmacy'];
        $package = StorePointsPackage::find($points_package_id);

        if ($pharmacy_points < $package->points) {
            return return_msg(false, 'validation_errors', [
                'validation_errors' => [
                    'invalid_points' => true
                ]
            ]);
        }

//        $price = $package->price;
        

//        session()->push()
//        StorePharmacyPoints::create([
//            'store_id' => $data['store_id'],
//            'pharmacy_id' => $data['pharmacy_id'],
//            'total_points' => $package->points,
//            'transaction' => 'out'
//        ]);

        return return_msg(true, 'ok', compact('price'));
    }

    public function getPharmacyPoints(array $data)
    {

        $pharmacy_id = $data['pharmacy_id'];
        $store_id = $data['store_id'];


        $total_in_points_with_pharmacy = StorePharmacyPoints::where('pharmacy_id', $pharmacy_id)
            ->where('store_id', $store_id)
            ->where('transaction', 'in')
            ->sum('total_points');

        $total_out_points_with_pharmacy = StorePharmacyPoints::where('pharmacy_id', $pharmacy_id)
            ->where('store_id', $store_id)
            ->where('transaction', 'out')
            ->sum('total_points');

        $total_points_with_pharmacy = $total_in_points_with_pharmacy - $total_out_points_with_pharmacy;
        if ($total_points_with_pharmacy < 0) {
            $total_points_with_pharmacy = 0;
        }

        return return_msg(true, 'ok', compact('total_points_with_pharmacy'));

    }

}