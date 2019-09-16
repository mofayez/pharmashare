<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'statuses';


    /**
     * @var array $fillable
     */
    protected $fillable = ['title', 'type', 'display_name_en', 'display_name_ar'];


} // end of Role Model class
