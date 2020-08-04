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

    public function customers()
    {
        return $this->belongsTo('App\Customer', 'customer_id');

    }

    public function pallets()
    {
        return $this->hasMany('App\Pallet');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number',
        'run_number',
        'wine_code',
        'COA',
        'LIP',
        'customer_id',
        'cartons_direction',
        'bottles_direction',
        'back',
        'front',
        'neck',
        'bottle_print',
        'carton_labels',
        'turbidity',
        'do2',
        'alc_in_tank',
        'alc_on_label',
        'additives',
        'delivered_by',
        'required_by',
        'pack_size',
        'samples_required',
        'cases_required',
        'cont_size',
'stretch_wrap',
'card_board',
'slip_sheet',
'run_length',
        'baf_number',
    ];
}
