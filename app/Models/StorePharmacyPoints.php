<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorePharmacyPoints extends Model
{

    protected $table = "store_pharmacy_points";

    protected $fillable = [
        "store_id", "pharmacy_id", "total_points", "transaction"
    ];

    protected $hidden = ['updated_at'];


    public function store()
    {

        return $this->belongsTo(User::class, 'store_id');
    }


    public function pharmacy()
    {

        return $this->belongsTo(User::class, 'pharmacy_id');
    }
}
