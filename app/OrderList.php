<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    protected $guarded = [];
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
    public function dish()
    {
        return $this->belongsTo('App\Dish');
    }
}
