<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdsControl extends Model
{


    /**
     * @var string $table
     */
    protected $table = 'ads_control';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'id', 'title', 'name_ar', 'name_en', 'status'
    ];


} // end of AdsControl model class
