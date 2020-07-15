<?php

namespace App\Http\Controllers;

use App\Product;
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



    public function index()
    {
        $total_orders = Order::whereNull('deleted_at')->count();

        $orders = Order::whereNull('deleted_at')
            ->take(10)
            ->orderBy('created_at', 'DESC')
            ->get();
        $orders_soft_deleted = Order::onlyTrashed()->get();
        return view('orders.index', compact('orders', 'total_orders','orders_soft_deleted'));
    }

    public function create(Request $request)
    {
        // get dynamic options
        $bottles = Product::where('type', 'bottle')
            ->orderBy('created_at', 'DESC')
            ->get();
        $corks = Product::where('type', 'cork')
            ->orderBy('created_at', 'DESC')
            ->get();
        $capsules = Product::where('type', 'capsule')
            ->orderBy('created_at', 'DESC')
            ->get();
        $screwCaps = Product::where('type', 'screw cap')
            ->orderBy('created_at', 'DESC')
            ->get();
        $cartons = Product::where('type', 'carton')
            ->orderBy('created_at', 'DESC')
            ->get();
        $dividers = Product::where('type', 'divider')
            ->orderBy('created_at', 'DESC')
            ->get();
        $pallets = Product::where('type', 'pallet')
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('orders.create', compact('bottles', 'corks', 'capsules', 'screwCaps', 'cartons', 'dividers', 'pallets'));
    }

    public function store(Request $request)
    {
        $str = '';
        $data = $request->validate([
            'order_number' => 'required',
            'run_number' => 'required',
            'wine_code' => 'required',
            'bottle' => 'required',
            'cork' => 'required',
            'capsule' => 'required',
            'screw_cap' => 'required',
            'carton' => 'required',
            'divider' => 'required',
            'pallet' => 'required',
            'quantity_bottle' => 'required',
            'quantity_cork' => 'required',
            'quantity_capsule' => 'required',
            'quantity_screw_cap' => 'required',
            'quantity_carton' => 'required',
            'quantity_divider' => 'required',
            'quantity_pallet' => 'required',
        ]);
        //dd($data);
        try {
            $order = Order::create($data);
            $order->products()->attach($data['bottle'], ['quantity' => $data['quantity_bottle']]);
            $order->products()->attach($data['cork'], ['quantity' => $data['quantity_cork']]);
            $order->products()->attach($data['capsule'], ['quantity' => $data['quantity_capsule']]);
            $order->products()->attach($data['screw_cap'], ['quantity' => $data['quantity_screw_cap']]);
            $order->products()->attach($data['carton'], ['quantity' => $data['quantity_carton']]);
            $order->products()->attach($data['divider'], ['quantity' => $data['quantity_divider']]);
            $order->products()->attach($data['pallet'], ['quantity' => $data['quantity_pallet']]);
        } catch (\Exception $e) {
            $str = $e->getMessage();
            //echo $e;
        }


//        $success = false;
//        DB::beginTransaction();
//        try {
//            $order = new Order();
//            $data = $request->validate([
//            'order_number' => 'required',
//            'run_number' => 'required',
//            'wine_code' => 'required',
//                'bottle' => 'required',
//                'cork' => 'required',
//                'capsule' => 'required',
//                'screw_cap' => 'required',
//                'carton' => 'required',
//                'divider' => 'required',
//                'pallet' => 'required',
//
//        ]);
//
//                $order->order_number = $data['order_number'];
//                $order->wine_code = $data['wine_code'];
//                $order->run_number = $data['run_number'];
//
//            //dd($data);
//
//            if ($order->save()){
//                //$tmp = Product::find(2);
//                $order->products()->attach($data['bottle']);
//                $order->products()->attach($data['cork']);
//                $order->products()->attach($data['capsule']);
//                $order->products()->attach($data['screw_cap']);
//                $order->products()->attach($data['carton']);
//                $order->products()->attach($data['divider']);
//                $order->products()->attach($data['pallet']);
////                $order->products->pivot->
//
//                $success = true;
//            }
//
//        } catch (\Exception $e) {
//            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
//            //echo $e;
//        }
//
//        if ($success) {
//
//            DB::commit();
//            return \redirect('orders/')->with('status','Post saved');
//        } else {
//            DB::rollback();
//            return \redirect('orders/')->with('status','Something went wrong');
//        }
        if ($str == '') {
            return redirect('orders/')->with('status', 'New order created');
        } else {
            return redirect('orders/')->with('status', $str);
        }

    }

    public function show(Order $order)
    {
        return view('orders.show', [
            'order' => $order,
        ]);
    }

    public function edit(Order $order)
    {
        // get dynamic options
        $bottles = Product::where('type', 'bottle')
            ->orderBy('created_at', 'DESC')
            ->get();
        $corks = Product::where('type', 'cork')
            ->orderBy('created_at', 'DESC')
            ->get();
        $capsules = Product::where('type', 'capsule')
            ->orderBy('created_at', 'DESC')
            ->get();
        $screwCaps = Product::where('type', 'screw cap')
            ->orderBy('created_at', 'DESC')
            ->get();
        $cartons = Product::where('type', 'carton')
            ->orderBy('created_at', 'DESC')
            ->get();
        $dividers = Product::where('type', 'divider')
            ->orderBy('created_at', 'DESC')
            ->get();
        $pallets = Product::where('type', 'pallet')
            ->orderBy('created_at', 'DESC')
            ->get();

        $current_bottle = $order->products->where('type', 'bottle')->first();
        $current_cork = $order->products->where('type', 'cork')->first();
        $current_capsule = $order->products->where('type', 'capsule')->first();
        $current_screw_cap = $order->products->where('type', 'screw cap')->first();
        $current_carton = $order->products->where('type', 'carton')->first();
        $current_divider = $order->products->where('type', 'divider')->first();
        $current_pallet = $order->products->where('type', 'pallet')->first();

        return view('orders.edit', compact('order', 'bottles',
                'corks', 'capsules', 'screwCaps', 'cartons', 'dividers', 'pallets',
                'current_bottle', 'current_cork', 'current_capsule', 'current_screw_cap',
                'current_carton', 'current_divider', 'current_pallet')

        );
    }

    public function update(Request $request, Order $order)
    {

        $data = $request->validate([
            'order_number' => 'required',
            'run_number' => 'required',
            'wine_code' => 'required',
            'bottle' => 'required',
            'cork' => 'required',
            'capsule' => 'required',
            'screw_cap' => 'required',
            'carton' => 'required',
            'divider' => 'required',
            'pallet' => 'required',
            'quantity_bottle' => 'required',
            'quantity_cork' => 'required',
            'quantity_capsule' => 'required',
            'quantity_screw_cap' => 'required',
            'quantity_carton' => 'required',
            'quantity_divider' => 'required',
            'quantity_pallet' => 'required',
        ]);
        try {
            $order->update($data);
            //dd($data);
            $order->products()->sync([$data['bottle'], $data['cork'], $data['capsule'], $data['screw_cap'], $data['carton'], $data['divider'], $data['pallet']]);
            $order->products()->updateExistingPivot($data['bottle'], ['quantity' => $data['quantity_bottle']]);
            $order->products()->updateExistingPivot($data['cork'], ['quantity' => $data['quantity_cork']]);
            $order->products()->updateExistingPivot($data['capsule'], ['quantity' => $data['quantity_capsule']]);
            $order->products()->updateExistingPivot($data['screw_cap'], ['quantity' => $data['quantity_screw_cap']]);
            $order->products()->updateExistingPivot($data['carton'], ['quantity' => $data['quantity_carton']]);
            $order->products()->updateExistingPivot($data['divider'], ['quantity' => $data['quantity_divider']]);
            $order->products()->updateExistingPivot($data['pallet'], ['quantity' => $data['quantity_pallet']]);
        } catch (\Exception $e) {
            echo $e;
        }


        return view('orders.show', [
            'order' => $order,
        ]);

    }

    public function destroy(Order $order)
    {

        try {
            $order->delete();
            return \redirect('orders/')->with('status', 'Successfully Deleted');
        } catch (\Exception $e) {
            echo $e;
        }
    }

    public function reverse(Request $request)
    {
        //dd($request->id);
        $tmp = Order::onlyTrashed()->where('id',$request->id)->restore();
        return redirect('orders/')->with('status', 'Order restored');
    }
}
