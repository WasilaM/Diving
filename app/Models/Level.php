<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Level extends Model
{
    use Translatable;

    public $translatedAttributes = ['title'];

    protected $fillable = ['status'];
}
