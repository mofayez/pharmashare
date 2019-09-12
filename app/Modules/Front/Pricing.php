<?php
/**
 * Created by PhpStorm.
 * User: muhammad
 * Date: 27/11/18
 * Time: 09:45
 */

namespace App\Modules\Front;


use App\Support\Repository;
use  App\Models\Pricing as PricingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Pricing
{
    /**
     * @var Repository
     */
    private $globalRepository;

    /**
     * @var SliderModel
     */
    private $pricingModel;

    /**
     * Chat constructor.
     */
    public function __construct()
    {
        $this->globalRepository = new Repository();
        $this->pricingModel = new PricingModel();
    }

    public function all()
    {
        $pricings = $this->pricingModel
            ->all();


        return return_msg(true, 'all pricing', compact('pricings'));
    }

    public function find($id)
    {
        $pricing = $this->pricingModel
            ->find($id);


        if ($pricing) {
            return return_msg(true, 'this pricing', compact('pricing'));
        }

        return return_msg(false, 'No found', [
            'validation_errors' => []
        ]);
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {


        $validation = $this->validateCreatePricingRequest($request);

        if ($validation->fails()) {

            return return_msg(false, 'validation errors', [
                'validation_errors' => $validation->getMessageBag()->getMessages(),
            ]);
        }


        DB::beginTransaction();
        try {
            $data = $request->all();

            $pricing = $this->pricingModel->find($data['id']);

            $pricing->title_ar = $data['title_ar'];
            $pricing->title_en = $data['title_en'];
            $pricing->price = $data['price'];
            $pricing->save();


            DB::commit();
            return return_msg(true, 'updated', []);
        } catch (\Exception $ex) {

            DB::rollback();
            return return_msg(false, $ex->getMessage(), [
                'validation_errors' => []
            ]);
        }
    }


    public function delete($id)
    {

        $pricing = $this->pricingModel
            ->find($id);

        if ($pricing) {

            $pricing->delete();

            return return_msg(true, 'pricing deleted', []);
        }

        return return_msg(false, 'No found', [
            'validation_errors' => []
        ]);
    }


    function validateCreatePricingRequest(Request $request)
    {

        return validator($request->all(), [
            'title_ar' => 'required',
            'title_en' => 'required',
            'price' => 'required|numeric',
        ]);
    }


    function uploadFile($file, $disk = null)
    {

        if (!$file) {
            return;
        }

        $file_name = uniqid() . '.' . $file->extension();

        $file->move(storage_path('files/slider'), $file_name);

        return $file_name;
    }


}