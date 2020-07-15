<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
    public function show()
    {
        //Order::withTrashed()->restore();
        //$tmp = User::findOrFail($user);
        $total_orders = DB::table('orders')->whereNull('deleted_at')->count();
        $orders = DB::table('orders')
            ->whereNull('deleted_at')->take(10)
            ->orderBy('created_at','DESC')
            ->get();



        //dd($orders);
        return view('dashboard.index', [
            'orders' => $orders,
            'total_orders' => $total_orders,
        ]);
    }
}
