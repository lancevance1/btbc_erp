<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pallet extends Model
{
    protected $fillable = [
        'cartons_per_layer','layers_per_pallet','order_id,'
    ];

    public function orders()
    {
        return $this->belongsTo('App\Orders', 'order_id');

    }
}
