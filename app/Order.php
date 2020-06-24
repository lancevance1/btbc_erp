<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function bottle()
    {
        return $this->belongsTo(Product::class);
   }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order number', 'run Number','wine code',
    ];
}
