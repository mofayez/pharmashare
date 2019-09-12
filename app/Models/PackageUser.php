<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageUser extends Model
{

    protected $table = "package_user";

    protected $fillable = ['paid_at', 'package_id', 'user_id', 'user_id', 'status_id', 'valid_until'];

    public function user()
    {
        
        return $this->belongsTo(User::class, 'user_id');
    }

    public function package()
    {

        return $this->belongsTo(Package::class, 'package_id');
    }

    public function details()
    {

        return $this->hasMany(PackageUserDetail::class, 'package_user_id');
    }

    public function status()
    {

        return $this->belongsTo(Status::class, 'status_id');
    }

    public function isPaid()
    {

        return $this->paid_at !== null;
    }
}
