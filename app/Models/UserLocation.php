<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'user_locations';

    /**
     * @var array $fillable
     */
    protected $fillable = ['location', 'lat', 'lng', 'user_id','geo_location'];

    protected $hidden = ['created_at', 'updated_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');
    } // end of user function

} // end of UserLocation class
