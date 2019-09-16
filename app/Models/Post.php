<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    /**
     * @var string $table
     */
    protected $table = "posts";


    /**
     * @var array $fillable
     */
    protected $fillable = [
        "user_id", "is_approved", "lat", "long", "city_id", "public", "post", "post_type", "link"
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');
    } // end od user function


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function files()
    {

        return $this->morphMany(File::class, 'fileable');
    } // end of function


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {

        return $this->hasMany(Comment::class, 'post_id');
    }


    /**
     * created at accessor - return Carbon date...
     *
     * @param $timestamp
     * @return Carbon
     */
    public function getCreatedAtAttribute($timestamp)
    {

        return Carbon::parse($timestamp);
    } // end od function


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    } // end of function


} // end of Post class
