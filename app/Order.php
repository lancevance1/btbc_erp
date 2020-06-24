<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function product()
    {
        return $this->belongsToMany('App\Product')
            ->withTimestamps()
            ->withPivot('quantity');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number', 'run_number','wine_code',
    ];
}
