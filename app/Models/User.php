<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activated', 'username', 'firstname', 'lastname', 'prefix', 'phone', 'full_address',
        'role_id', 'email', 'password', 'status_id', 'payment_type_id', 'account_progress'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {

        return $this->hasMany(Post::class, 'user_id');
    } // end of posts function


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {

        return $this->morphOne(File::class, 'fileable');
    } // end of posts function

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function file()
    {

        return $this->morphOne(File::class, 'fileable');
    } // end of posts function


    public function paymentTypes()
    {

        return $this->belongsToMany(PaymentType::class, 'store_payment_types', 'user_id', 'payment_type_id');
    } // end of paymentType function


    public function role()
    {

        return $this->belongsTo(Role::class, 'role_id');
    } // end of role function


    public function papers()
    {

        return $this->hasOne(UserPaper::class, 'user_id');
    } // end of papers function

    public function location()
    {

        return $this->hasOne(UserLocation::class, 'user_id');
    } // end of papers function

    public function accountProgress()
    {

        $progress = 60;
        if ($this->location) {

            $progress += 20;
        }
        if ($this->papers) {

            $progress += 20;
        }

        return $progress;
    }// end of accountProgress function


    public function blockedPharmacies()
    {
        return $this->hasMany(BlockedPharmacy::class, 'store_id');
    }

    public function blockedStores()
    {
        return $this->hasMany(BlockedStore::class, 'pharmacy_id');
    }


    public function blockedPharmaciesIds()
    {

        return $this->blockedPharmacies->pluck('pharmacy_id')->values()->all();
    }


    public function blockedStoresIds()
    {

        return $this->blockedStores->pluck('store_id')->values()->all();
    }


    public function storeSettings()
    {
        return $this->hasOne(StoreSettings::class);
    }


    public function ratings()
    {

        return $this->hasMany(StoreRating::class, 'store_id');
    }


    public function averageRating()
    {
        $ratings = $this->ratings;

        if (count($ratings) === 0) {

            return 0;
        }

        $avg_rating = ($ratings->sum('rating') * 5) / (5 * count($ratings));

        return $avg_rating;
    }


    public function jobs()
    {

        return $this->hasMany(Job::class, 'user_id');
    }


    public function packages()
    {

        return $this->hasMany(PackageUser::class, 'user_id');
    }


    public function salesPharmacy()
    { 
        return $this->hasMany(Sale::class,'pharmacy_id', 'id');
    }
    public function drug_store()
    { 
        return $this->hasMany(DrugStore::class,'user_id');
    }


} // end of User model class
