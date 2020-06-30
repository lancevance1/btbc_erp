<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        //$data =  $request->session()->get('status');;
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'order_number' => 'required',
            'run_number' => 'required',
            'wine_code' => 'required',
        ]);

        Order::create($data);
//        $success = false;
//        DB::beginTransaction();
//        try {
//            $order = new Order();
//            $data = $request->validate([
//            'order_number' => 'required',
//            'run_number' => 'required',
//            'wine_code' => 'required',
//        ]);
//
//                $order->order_number = $data['order_number'];
//                $order->wine_code = $data['wine_code'];
//                $order->run_number = $data['run_number'];
//
//            if ($order->save()){
//                $success = true;
//            }
//
//        } catch (\Exception $e) {
//            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
//        }
//
//        if ($success) {
//
//            DB::commit();
//            return Redirect::back()->with('status','Post saved');
//        } else {
//            DB::rollback();
//            return Redirect::back()->with('status','Something went wrong');
//        }

        return redirect('dashboard/'. auth()->user()->id)->with('status','New order created');
    }

    public function show(Order $order)
    {
        return view('orders.show',[
            'order' => $order,
        ]);
    }
}
