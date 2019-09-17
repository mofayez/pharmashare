<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'sale_details';


    /**
     * @var array $fillable
     */
    protected $fillable = ['sale_id', 'drug_store_id', 'cost', 'quantity', 'foc_id', 'discount'];


    public function sale()
    {

        return $this->belongsTo(Sale::class, 'sale_id');
    } // end of sale function


    public function drugStore()
    {

        return $this->belongsTo(DrugStore::class, 'drug_store_id')->withTrashed();
    } // end of pharmacy function


    public function foc()
    {

        return $this->belongsTo(FOC::class, 'foc_id');
    }


} // end of Role Model class
