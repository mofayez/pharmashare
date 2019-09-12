<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $appends = ['translated'];

    public function details()
    {
        return $this->hasMany(SliderTranslation::class, 'slide_id');
    }

    public function translated($locale = null)
    {
        return $this->details()->where('language', $locale ? $locale : app()->getLocale())->first();
    }

    public function getTranslatedAttribute($value = null)
    {
        return $this->translated();
    }

    public function image()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
