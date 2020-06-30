<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index($user)
    {

        $tmp = User::findOrFail($user);
        $total_orders = DB::table('orders')->count();
        $orders = DB::table('orders')->take(10)
            ->orderBy('created_at','DESC')
            ->get();
        //dd($orders);
        return view('dashboard.index', [
            'user' => $tmp,
            'orders' => $orders,
            'total_orders' => $total_orders,
        ]);
    }
}
