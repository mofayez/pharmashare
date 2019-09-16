<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnApprovedDrug extends Model
{

    protected $table = 'un_approved_drugs';

    protected $fillable = [
        'drug_category_id', 'user_store_id', 'pharmashare_code', 'offered_price_or_bonus', 'strength',
        'trade_name', 'form', 'pack_size', 'available_quantity_in_packs', 'active_ingredient', 'manufacturer',
        'minimum_order_value_or_quantity', 'store_remarks'
    ];


    public function store()
    {

        return $this->belongsTo(User::class, 'user_store_id');
    }
}
