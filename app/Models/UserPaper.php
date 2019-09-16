<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPaper extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'user_papers';

    protected $appends = [
        'trade_license_path', 'passport_license_path', 'pharmacy_license_path'
    ];


    /**
     * @var array $fillable
     */
    protected $fillable = ['user_id', 'trade_license', 'passport_license', 'pharmacy_license'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');
    } // end of user function


    public function getTradeLicensePathAttribute()
    {

        if (!$this->trade_license) {
            return null;
        }
        return $this->trade_license;
//        return asset('storage/files/papers/' . $this->trade_license);
    }

    public function getPassportLicensePathAttribute()
    { 

        if (!$this->passport) {
            return null;
        }
        return $this->passport;

//        return asset('storage/files/papers/' . $this->passport);
    }

    public function getPharmacyLicensePathAttribute()
    {

        if (!$this->pharmacy_license) {
            return null;
        }
        return $this->pharmacy_license;
//        return asset('storage/files/papers/' . $this->pharmacy_license);
    }
}
