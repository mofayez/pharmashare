<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DrugCategory extends Model
{

    use SoftDeletes;

    /**
     * @var string $table
     */
    protected $table = 'drug_categories';

    /**
     * @var array $fillable
     */
    protected $fillable = ['title', 'display_name_ar', 'display_name_en'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drugs()
    {

        return $this->hasMany(Drug::class, 'drug_category_id');
    } // end of drugs function

}// end of DrugCategory model class
