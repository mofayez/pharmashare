<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';

    protected $fillable = [
        'notifiable_id', 'notifiable_type', 'read', 'type', 'title', 'description', 'title_en', 'description_en','read_at','read_at_admin'
    ];

    protected $appends = ['notified_at'];


    public function notifiable()
    {

        return $this->morphTo();
    }


    public function getNotifiedAtAttribute()
    {

        return Carbon::parse($this->created_at)->diffForHumans(Carbon::now());
    }
}
