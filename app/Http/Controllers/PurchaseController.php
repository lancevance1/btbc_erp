<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Logbook;
use App\Product;
use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
foreach ($products as $prod) {
    //$prod->to_be_ordered = $prod->order_quantity - $prod->current_inventory-$prod->ordered;


        $sum = 0;

        foreach ($prod->deliveries as $tmp) {
            $sum += $tmp->change;

        }
        $prod->ordered = $sum;
//        $prod->to_be_ordered = 0;


    $prod->save();

}
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
//            $log = Logbook::create();
//            $prod->logbooks()->syncWithoutDetaching($log->id);
//            $prod->logbooks()->updateExistingPivot($log->id, ['change' => $prod->to_be_ordered]);

            $del = Delivery::create();
            $del->product_id = $prod->id;
            $del->change = $prod->to_be_ordered;
            $del->save();

            $sum = 0;
//            dd($prod->logbooks);
            foreach ($prod->deliveries as $tmp){
                $sum+= $tmp->change;

            }

            $prod->ordered = $sum;
            $prod->to_be_ordered = 0;
            $prod->save();
            return redirect('purchases')->with('status','Submitted');
        }



        return redirect('purchases')->with('error','We don\'t need submit it');




    }

    public function inStock(Request $request)
    {
//        dd($request->id);
        $del = Delivery::find($request->id);
        $del->stock = $del->change;
//     dd($del->product->id);

            $del->product->current_inventory += $del->change;
        $del->product->to_be_ordered = $del->product->order_quantity-$del->product->ordered-$del->product->current_inventory;;
        if($del->product->to_be_ordered<0){
            $del->product->to_be_ordered=0;
        }
        $del->product->save();



//        dd($tmp);

        $del->change = 0;
        $del->save();
        return Redirect::back()->with('status','Delivered');
    }



}
