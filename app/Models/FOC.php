<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FOC extends Model
{

    protected $table = 'foc';

    protected $fillable = ['drug_store_id', 'foc_quantity', 'foc_discount'];


    public function drugStore()
    {

        return $this->belongsTo(DrugStore::class, 'drug_store_id');
    }
}
