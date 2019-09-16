<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorePointsPackage extends Model
{

    protected $table = "store_points_packages";

    protected $fillable = ["store_id", "points", "price"];


    public function store()
    {

        return $this->belongsTo(User::class, 'store_id');
    }
}
