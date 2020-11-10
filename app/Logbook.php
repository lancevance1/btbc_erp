<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    public function products()
    {
        return $this->belongsTo('App\Product','product_id');
    }
}
