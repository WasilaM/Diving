<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Plank\Mediable\Mediable;

class Trip extends Model
{
    use Mediable;
    use Translatable;

    protected $appends = ['image_url', 'banner_url'];

    public $translatedAttributes = ['title', 'languages', 'slug', 'description'];

    protected $fillable = ['status', 'banner', 'photo', 'date'];

    public function getImageUrlAttribute()
    {
        if($this->photo) {
            return 'images/trip/photo/' .$this->photo;
        } else {
            return null;
        }
    }

    public function getBannerUrlAttribute()
    {
        if($this->banner) {
            return 'images/trip/banner/' .$this->banner;
        } else {
            return null;
        }
    }

    public function booking()
    {
        $this->hasMany(Booking::class);
    }
}
