<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{


    /**
     * @var string $table
     */
    protected $table = "comments";


    /**
     * @var array $fillable
     */
    protected $fillable = ["post_id", "user_id", "parent_id", "comment"];

    protected $appends = ['commented_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {

        return $this->belongsTo(Post::class, 'post_id');
    } // end of function


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {

        return $this->hasMany(Comment::class, 'parent_id');
    } // end of function


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');
    } // end of function


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

    public function getCommentedAtAttribute()
    {

        return Carbon::parse($this->created_at)->diffForHumans(Carbon::now());
    } // end od function


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    } // end of function

} // end of Comment class