<?php

namespace App\Http\Controllers;

use App\Order;
use App\Pallet;
use Illuminate\Http\Request;

class PalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Order $order)
    {

        $pallets = $order->pallets;

        return view('pallets.index',compact('pallets'));
    }

    public function create(Order $order)
    {

        return view('pallets.create',compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        //dd($customer);
        try {
            $data = $request->validate([
                'cartons_per_layer' => 'required',
                'layers_per_pallet' => 'required',


            ]);

            $pallet = Pallet::create($data);
            $pallet->order_id = $order->id;
            $pallet->push();

        }catch (\Exception $e){
            echo $e;
    }

        //dd($customer->contacts);
        return redirect('orders/')->with('status','New pallet specs created');
    }

    public function show(Order $order,Pallet $pallet)
    {
        return view('pallets.show',compact('order','pallet'));
    }

    public function edit(Order $order,Pallet $pallet)
    {
        return view('pallets.edit', compact('order','pallet'));
    }

    public function update(Request $request, Order $order,Pallet $pallet)
    {
        try {
        $data = $request->validate([
            'cartons_per_layer' => 'required',
            'layers_per_pallet' => 'required',

        ]);


            $pallet->update($data);
        }catch (\Exception $e) {
            echo $e;
            //report($e);;
        }


        //return view('contacts.show',compact('contact'));
        return redirect('orders/')->with('status','Pallets specs modified');

    }

    public function destroy(Order $order,Pallet $pallet)
    {
        try {
            $pallet->delete();
            return \redirect('orders')->with('status','Successfully Deleted');
        } catch (\Exception $e) {
            echo $e;
        }
    }
}
