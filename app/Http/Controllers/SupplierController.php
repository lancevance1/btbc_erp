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

    public function show(Supplier $supplier)
    {
        return view('suppliers.show',[
            'supplier' => $supplier,
        ]);
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }
//
    public function update(Request $request, Supplier $supplier)
    {
        $data = $request->validate([
            'name' => 'required',

        ]);
        try {
            $supplier->update($data);
        }catch (\Exception $e) {
            echo $e;
            //report($e);;
        }
        //return view('customers.show');
        return redirect('suppliers/')->with('status','supplier modified');
    }
//
    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();

            return \redirect('suppliers')->with('status','Successfully Deleted');
        } catch (\Exception $e) {
            echo $e;
        }
    }
}
