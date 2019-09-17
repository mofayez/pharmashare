<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrugStore extends Model
{

    use SoftDeletes;


    /**
     * @var string $table
     */
    protected $table = 'drug_stores';

    protected $dates = ['deleted_at'];

    protected $appends = ['isFeatured', 'FOC'];

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'drug_id', 'user_id', 'min_amount', 'amount', 'expiration_date', 'price', 'remarks',
        'offered_price_or_bonus', 'available_quantity_in_packs', 'minimum_order_value_or_quantity',
        'store_remarks'
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function drug()
    {

        return $this->belongsTo(Drug::class, 'drug_id')->withTrashed();
    } // end of drug function


    public function details()
    {

        return $this->hasMany(DrugStoreDetail::class, 'drug_store_id')->withTrashed();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storeUser()
    {

        return $this->belongsTo(User::class, 'user_id');
    } // end of function


    public function hasStock($amount = 0)
    {

        return $this->available_quantity_in_packs > $amount;
    } // end of hasStock function

    public function outOfStock()
    {

        return $this->available_quantity_in_packs === 0;
    } // end of outOfStock function

    public function packageUserDetail()
    {

        return $this->hasOne(PackageUserDetail::class, 'drug_store_id');
    }

    public function getIsFeaturedAttribute()
    {

        return $this->isFeatured();
    }

    public function isFeatured()
    {

        return $this->packageUserDetail !== null;
    }

    public function getFOCAttribute()
    {


        $foc = $this->foc()
            ->orderBy('foc_quantity')
            ->where('foc_on', 'drug_store')
            ->where('is_activated', 1)
            ->get();


        if (count($foc) === 0) {

            return FOC::orderBy('foc_quantity')
                ->where('user_id', $this->user_id)
                ->where('foc_on', 'all')
                ->where('is_activated', 1)
                ->get();
        }

        return $foc;
    }

    public function all_foc()
    {


        $foc = $this->foc()
            ->orderBy('foc_quantity')
            ->where('foc_on', 'drug_store')
            ->get();


        if (count($foc) === 0) {

            return FOC::orderBy('foc_quantity')
                ->where('user_id', $this->user_id)
                ->where('foc_on', 'all')
                ->get();
        }

        return $foc;
    }

    public function foc()
    {

        return $this->hasMany(FOC::class, 'drug_store_id');
    }

} // end of DrugStore model class
