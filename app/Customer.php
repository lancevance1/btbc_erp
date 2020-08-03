<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address',
    ];
}
