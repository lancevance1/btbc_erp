<?php

namespace App\Http\Controllers;

use App\Logbook;
use App\Product;
use App\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $arr_stat = array();
        $purchases = Purchase::orderBy('updated_at', 'DESC')->paginate(15);
        $products = Product::where('order_quantity','<>', 0)->orderBy('updated_at', 'DESC')->paginate(15);
//        dd($products);

//        dd($purchases);


        return view('purchases.index',compact('purchases','products'));

    }

    public function destroy(Purchase $purchase)
    {
        try {
            foreach ($purchase->orders as $tmp){
                $tmp->purchase_id = null;
                $tmp->isPurchase=false;
                $tmp->save();
            }

            $purchase->delete();
            return \redirect('purchases')->with('status','Successfully Deleted');
        } catch (\Exception $e) {
            echo $e;
        }
    }

    public function export()
    {


        return \redirect('purchases')->with('status','Successfully exported');
    }

    public function updateOrdered(Request $request)
    {
//        dd($product);
//        dd($request->all());
        $request->validate([
            'to_be_ordered' => '',
    ]);

        $prod = Product::find($request->id);
        $prod->to_be_ordered=$request->to_be_ordered;
        $prod->save();
        return redirect('purchases')->with('status','Saved');
    }

    public function submitOrders(Request $request)
    {
//dd($request->id);

        $prod = Product::find($request->id);
        if($prod->to_be_ordered>0){
            $log = Logbook::create();
            $log->product_id = $prod->id;
            $log->change = $prod->to_be_ordered;
            $log->save();


            $prod->ordered += $prod->to_be_ordered;
            $prod->to_be_ordered = 0;
            $prod->save();
            return redirect('purchases')->with('status','Submitted');
        }



        return redirect('purchases')->with('error','We don\'t need submit it');




    }



}
