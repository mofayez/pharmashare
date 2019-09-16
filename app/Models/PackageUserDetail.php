<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageUserDetail extends Model
{

    protected $table = 'package_user_details';

    protected $fillable = [
        'package_user_id', 'drug_store_id'
    ];

    public function packageUser()
    {

        return $this->belongsTo(PackageUser::class, 'package_user_id');
    }


    public function drugStore()
    {

        return $this->belongsTo(DrugStore::class, 'drug_store_id');
    }
}
