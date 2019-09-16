<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreRating extends Model
{

    protected $table = 'store_ratings';

    protected $fillable = [
        'store_id', 'pharmacy_id', 'rating', 'pros', 'cons', 'suggestions' ,'comment'
    ];

    public function pharmacy()
    {

        return $this->belongsTo(User::class, 'pharmacy_id');
    }

    public function store()
    {

        return $this->belongsTo(User::class, 'store_id');
    }
}
