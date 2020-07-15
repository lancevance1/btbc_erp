<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return redirect('dashboard/');
//        $tmp = Order::create(['order number'=>'aaa123']);
//        $prod = Product::create(['code'=>'122']);
//        $tmp->save();
//        $prod->save();
//        $order=Order::find(10);
//        //$order->product()->sync(2);
//
//    $order->product()->syncWithoutDetaching([4=>['quantity'=>'6000']]);
        //$order->product()->updateExistingPivot(2,['quantity'=>'2000']);
//        foreach ($order->product as $product){
//            echo $product->pivot->quantity;
//        }

//        dd($tmp->product());


    }
}
