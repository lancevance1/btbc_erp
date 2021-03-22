<?php

namespace App\Exports;

use App\Order;
use http\Env\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderExport implements FromCollection
{


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {


        return Order::all();
    }
}
