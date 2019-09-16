<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageAdType extends Model
{

    protected $table = 'image_ad_types';

    protected $fillable = [
        'title', 'name', 'display_for'
    ];
}
