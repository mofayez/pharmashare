<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageAd extends Model
{

    protected $table = 'image_ads';

    protected $fillable = [
        'approved', 'paid_at', 'open', 'image_package_id', 'user_id', 'valid_until', 'link', 'original_image', 'scaled_image',
        'second_image', 'second_image_ratio', 'third_image', 'third_image_ratio', 'created_by_admin', 'image_ad_type_id'
    ];


    public function package()
    {

        return $this->belongsTo(ImagePackage::class, 'image_package_id');
    }

    public function type()
    {

        return $this->belongsTo(ImageAdType::class, 'image_ad_type_id');
    }

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');
    }

    public function isCreatedByAdmin()
    {
        return (bool)$this->created_by_admin;
    }

    public function isApproved()
    {

        return (bool)$this->approved;
    }

    public function isPaid()
    {

        return $this->paid_at !== null;
    }


    public function getOriginalImageAttribute($value)
    {

        if (!$value){
            return null;
        }

        return $value;
//        return asset('storage/imgs/' . $value);
    }

    public function getScaledImageAttribute($value)
    {

        if (!$value){
            return null;
        }

        return $value;
//        return asset('storage/imgs/' . $value);
    }

    public function getSecondImageAttribute($value)
    {

        if (!$value){
            return null;
        }

        return $value;
//        return asset('storage/imgs/' . $value);
    }

    public function getThirdImageAttribute($value)
    {

        if (!$value){
            return null;
        }
        return $value;
//        return asset('storage/imgs/' . $value);
    }
}
