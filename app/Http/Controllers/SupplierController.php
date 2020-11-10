<?php

namespace App\Http\Controllers;

use App\Product;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $suppliers = Supplier::paginate(15);
        return view('suppliers.index',compact('suppliers'));
    }


    public function create(Request $request)
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        Supplier::create($data);
        return redirect('suppliers/')->with('status','New supplier created');
    }

//    public function show(Customer $customer)
//    {
//        return view('customers.show',[
//            'customer' => $customer,
//        ]);
//    }
//
//    public function edit(Customer $customer)
//    {
//        return view('customers.edit', compact('customer'));
//    }
//
//    public function update(Request $request, Customer $customer)
//    {
//        $data = $request->validate([
//            'name' => 'required',
//            'address' => '',
//        ]);
//        try {
//            $customer->update($data);
//        }catch (\Exception $e) {
//            echo $e;
//            //report($e);;
//        }
//        //return view('customers.show');
//        return redirect('customers/')->with('status','Customer modified');
//    }
//
//    public function destroy(Customer $customer)
//    {
//        try {
//            $customer->contacts()->delete();
//            foreach ($customer->orders as $tmp){
//                $tmp->customer_id = null;
//
//                $tmp->save();
//            }
//            $customer->delete();
//            return \redirect('customers')->with('status','Successfully Deleted');
//        } catch (\Exception $e) {
//            echo $e;
//        }
//    }
}
