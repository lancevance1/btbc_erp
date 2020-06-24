<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Input\Input;

class OrderController extends Controller
{
    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $success = false;
        try {
        $data = $request->validate([
            'order_number' => 'required',
            'run_number' => 'required',
            'wine_code' => 'required',
        ]);

        Order::create($data);
            $success = true;
        } catch (\Exception $e) {
            // maybe log this exception, but basically it's just here so we can rollback if we get a surprise
        }

        if ($success) {

            DB::commit();
            return Redirect::back()->with('Post saved');
        } else {
            DB::rollback();
            return Redirect::back()->with('Something went wrong');
        }
    }
}
