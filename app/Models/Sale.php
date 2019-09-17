<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'sales';


    /**
     * @var array $fillable
     */
    protected $fillable = [
        'store_id', 'pharmacy_id', 'payment_type_id', 'shipment', 'sale_number', 'total_cost', 'status_id',
    ];


    protected $appends = ['reward_points'];


    protected $hidden = ['updated_at'];

    public function status()
    {

        return $this->belongsTo(Status::class, 'status_id');
    }


    public function pharmacy()
    { 
        return $this->belongsTo(User::class, 'pharmacy_id');
    }


    public function store()
    {

        return $this->belongsTo(User::class, 'store_id');
    }


    public function details()
    {

        return $this->hasMany(SaleDetail::class, 'sale_id');
    }


    public function paymentType()
    {

        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }


    public function points()
    {

        return $this->hasMany(StorePharmacyPoints::class, 'sale_id');
    }

    public function getRewardPointsAttribute()
    {

        return [
            'in' => $this->points->where('transaction', 'in')->sum('total_points'),
            'out' => $this->points->where('transaction', 'out')->sum('total_points')
        ];
    }

} // end of Role Model class
