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

} // end of Drug model class
