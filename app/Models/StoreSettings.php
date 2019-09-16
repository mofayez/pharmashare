<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreSettings extends Model
{

    protected $table = 'store_settings';

    protected $fillable = ['user_id', 'min_order_price'];


    public function store()
    {

        return $this->belongsTo(User::class, 'user_id');
    }
}
