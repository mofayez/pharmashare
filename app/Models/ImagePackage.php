<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagePackage extends Model
{

    protected $table = 'image_packages';

    protected $fillable = [
        'image_ad_type_id', 'name', 'price', 'period_in_days'
    ];


    public function ads()
    {

        return $this->hasMany(ImageAd::class, 'image_package_id');
    }
}
