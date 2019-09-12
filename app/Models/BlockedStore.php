<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockedStore extends Model
{
    protected $table = 'blocked_stores';

    protected $fillable = ['store_id', 'pharmacy_id'];


    public function pharmacy()
    {

        return $this->belongsTo(User::class, 'pharmacy_id');
    }


    public function store()
    {

        return $this->belongsTo(User::class, 'store_id');
    }
}
