<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'roles';


    /**
     * @var array $fillable
     */
    protected $fillable = ['role', 'permission'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {

        return $this->hasMany(Permission::class, 'role_id');
    } // end of permissions function

} // end of Role Model class
