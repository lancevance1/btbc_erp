<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function orders()
    {
        return $this->belongsToMany('App\Order')
            ->withTimestamps()
            ->withPivot('quantity','quantity_external');
    }

    public function suppliers()
    {
        return $this->belongsToMany('App\Supplier')
            ->withTimestamps()
            ->withPivot('price','isChosen');;
    }
    public function logbooks()
    {
        return $this->belongsToMany('App\Logbook')
            ->withTimestamps()
            ->withPivot('change');
    }

    public function deliveries()
    {
        return $this->hasMany('App\Delivery');
    }

    protected $fillable = [
        'code','price','description','type','size','current_inventory','order_quantity',
        'to_be_ordered', 'current_inventory_value','belong_to',
    ];

}
