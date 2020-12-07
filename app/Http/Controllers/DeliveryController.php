<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Logbook;
use App\Product;
use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $del = Delivery::orderBy('updated_at', 'DESC')->paginate(15);
        return view('delivery.index',compact('del'));
    }

    public function destroy(Product $product,Delivery $delivery)
    {

        try {

            if($delivery->stock !=null ||$delivery->stock !=0){
                $product->current_inventory-= $delivery->stock;
                $product->save();
            }
            $delivery->delete();



            return Redirect::back()->with('status','Successfully Deleted');
        } catch (\Exception $e) {
            echo $e;
        }
    }
}
