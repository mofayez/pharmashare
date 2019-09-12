<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{

    /**
     * @var string $table
     */
    protected $table = 'payment_types';

    /**
     * @var array $fillable
     */
    protected $fillable = ['title', 'display_name_ar', 'display_name_en'];


    public function users()
    {

        return $this->belongsTo(User::class, 'store_payment_types', 'user_id', 'payment_type_id');
    }

} // end of Pau