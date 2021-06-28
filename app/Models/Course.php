<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Plank\Mediable\Mediable;

class Course extends Model
{
    use Mediable;
    use Translatable;

    protected $appends = ['image_url', 'banner_url'];

    public $translatedAttributes = ['title', 'languages', 'requirements' ,'slug', 'description'];

    protected $fillable = ['status', 'banner', 'photo', 'duration'];

    public function getImageUrlAttribute()
    {
        if($this->photo) {
            return 'images/course/photo/' .$this->photo;
        } else {
            return null;
        }
    }

    public function getBannerUrlAttribute()
    {
        if($this->banner) {
            return 'images/course/banner/' .$this->banner;
        } else {
            return null;
        }
    }

    public function booking()
    {
        $this->hasMany(Booking::class);
    }
}
