<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrugStoreDetail extends Model
{

    use SoftDeletes;

    /**
     * @var string $table
     */
    protected $table = 'drug_store_details';

    /**
     * @var array $fillable
     */
    protected $fillable = ['drug_store_id', 'amount', 'expiration_date', 'price'];

    protected $dates = ['deleted_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function drugStore()
    {

        return $this->belongsTo(DrugStore::class, 'drug_store_id');
    }
}
