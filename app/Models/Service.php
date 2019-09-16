<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $appends = ['translated'];

    public function details()
    {
        return $this->hasMany(ServiceTranslation::class, 'service_id');
    }

    public function translated($locale = null)
    {
        return $this->details()->where('language', $locale ? $locale : app()->getLocale())->first();
    }

    public function getTranslatedAttribute($value = null)
    {
        return $this->translated();
    }

}
