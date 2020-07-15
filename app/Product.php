<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function orders()
    {
        return $this->belongsToMany('App\Order')
            ->withTimestamps()
            ->withPivot('quantity');
    }
    protected $fillable = [
        'code','price','description','type','size','cost','current_inventory','order_quantity',
        'to_be_ordered', 'current_inventory_value','belong_to',
    ];

}
