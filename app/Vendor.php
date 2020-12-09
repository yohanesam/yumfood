<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $guarded = [];  

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
    public function dish()
    {
        return $this->hasMany('App\Dish');
    }
    public function order()
    {
        return $this->hasMany('App\Order');
    }
}
