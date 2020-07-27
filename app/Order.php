<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public function products()
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
        'order_number', 'run_number','wine_code','COA','LIP',
    ];
}
