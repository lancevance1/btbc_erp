<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\Product')
            ->withTimestamps()
            ->withPivot('price');
    }

    protected $fillable = [
        'name',
    ];
}
