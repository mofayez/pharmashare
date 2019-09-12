<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{

    protected $table = 'packages';

    protected $fillable = [
        'name', 'min_number_of_drugs', 'max_number_of_drugs', 'price', 'period_in_days'
    ];


    public function packageUser()
    {

        return $this->hasMany(PackageUser::class, 'package_id');
    }
}
