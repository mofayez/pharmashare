<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drug extends Model
{

    use SoftDeletes;

    /**
     * @var string $table
     */
    protected $table = 'drugs';

    /**
     * @var array $fillable
     */
    protected $fillable = [
        'drug_category_id', 'pharmashare_code', 'trade_name', 'form', 'pack_size',
        'active_ingredient', 'strength', 'manufacturer', 'public_price_aed', 'pharmacy_price_aed'
    ];

    protected $dates = ['deleted_at'];

    protected $appends = ['added_by'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function drugCategory()
    {

        return $this->belongsTo(DrugCategory::class, 'drug_category_id');
    } // end of drugCategory function


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drugStores()
    {

        return $this->hasMany(DrugStore::class, 'drug_id');
    } // end of drugStores function


    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAddedByAttribute()
    {

        $user = $this->user;

        if (!$user) {

            return null;
        };

        return [
            'id' => $user->id,
            'username' => $user->username,
            'firstname' => $user->firstname,
            'email' => $user->email,
            'role' => $user->role->title ?? null
        ];
    }


} // end of Drug model class
