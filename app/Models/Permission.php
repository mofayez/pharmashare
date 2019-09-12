<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'permissions';


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {

        return $this->belongsTo(Role::class, 'role_id');
    } // end of role function

} // end of Permission Model class
