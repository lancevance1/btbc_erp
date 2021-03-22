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
        return redirect('orders/');
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


    public function testsearch(Request $request)
    {
        //dd($request->all());
        $searchTerm = $request->input('q');
        //dd($searchTerm);

        if($searchTerm != ""){
            $orders = Order::where ( 'order_number', 'LIKE', '%' . $searchTerm . '%' )
                ->orWhere('baf_number', 'like', '%' .$searchTerm. '%')
                ->orWhere('run_number', 'like', '%' .$searchTerm. '%')->get();
            $products = Product::where ( 'code', 'LIKE', '%' . $searchTerm . '%' )
                ->orWhere('type', 'like', '%' .$searchTerm. '%')
                ->get();
            $count = count ( $orders )+count ( $products );
            if (count ( $orders ) > 0 || count ( $products ) > 0)
                return view('search', compact('orders','products','count'));
            else
                return view('search', compact('orders','products','count'))->with ( 'status','No Details found. Try to search again !' );
        }
        return view('search',compact('orders','products','count'))->with ( 'status','No Details found. Try to search again !' );
    }
}
