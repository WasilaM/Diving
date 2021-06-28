<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name', 'data'];

    public function setDataAttribute($data)
    {
        return $this->attributes['data'] = serialize($data);
    }

    public function getDataAttribute($data)
    {
        return $this->data = unserialize($data);
    }
}
