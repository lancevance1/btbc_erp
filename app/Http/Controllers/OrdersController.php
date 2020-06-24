<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
//        $data = $this->validate($request,[
//            'Order_Number' => 'required',
//
//            'Run_Number' => 'required',
//        ]);
        $data = request()->validate([
            'Order_Number' => 'required',

            'Run_Number' => 'required',
        ]);
//        dd(request()->all());
//       dd(request()->all());
        \App\Order::create($data);
    }
}
