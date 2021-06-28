<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Album extends Model
{
    use Translatable;
    protected $appends = ['image_url', 'banner_url'];

    public $translatedAttributes = ['title', 'slug', 'description'];

    protected $fillable = ['status', 'banner', 'photo'];

    public function getImageUrlAttribute()
    {
        if($this->photo) {
            return 'images/album/photo/'.$this->photo;
        } else {
            return null;
        }
    }

    public function getBannerUrlAttribute()
    {
        if($this->banner) {
            return 'images/album/banner/' .$this->banner;
        } else {
            return null;
        }
    }
}
