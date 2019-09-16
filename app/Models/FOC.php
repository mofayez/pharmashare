<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FOC extends Model
{

    protected $table = 'foc';

    protected $fillable = ['is_activated', 'foc_on', 'drug_store_id', 'foc_quantity', 'foc_discount', 'user_id', 'reward_points'];

    protected $hidden = ['created_at', 'updated_at'];

    public function drugStore()
    {

        return $this->belongsTo(DrugStore::class, 'drug_store_id');
    }
}
