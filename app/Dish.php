<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    protected $guarded = [];
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
    public function order_list()
    {
        return $this->hasMany('App\OrderList');
    }
}
