<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DrugStoreFavourites extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'drugs_store_favourites';


    /**
     * @var array $fillable
     */
    protected $fillable = [
        'store_id', 'drug_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function drug()
    {

        return $this->belongsTo(Drug::class, 'drug_id')->withTrashed();
    } // end of drug function


} // end of Role Model class
