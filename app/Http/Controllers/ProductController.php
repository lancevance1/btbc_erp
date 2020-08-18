<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        $products = DB::table('products')
//            ->take(10)
//            ->orderBy('id','DESC')
//            ->get();
        $products = Product::all();
        return view('products.index',compact('products'));
    }

    public function create(Request $request)
    {
        //$data =  $request->session()->get('status');;
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required',
            'cost' => 'required',
            'price' => 'required',
            'type' => 'required',
            'current_inventory' => 'required',
            'description' => '',
            'size' => '',
            'order_quantity' => '',
            'to_be_ordered' => '',
            'current_inventory_value' => 'required',
            'belong_to' => '',

        ]);

        Product::create($data);

        return redirect('products/')->with('status','New dry good created');
    }

    public function show(Product $product)
    {
        return view('products.show',[
            'product' => $product,
        ]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $data = $request->validate([
                'code' => 'required',
                'cost' => 'required',
                'price' => 'required',
                'type' => 'required',
                'current_inventory' => '',
                'description' => '',
                'size' => '',
                'order_quantity' => '',
                'to_be_ordered' => '',
                'current_inventory_value' => '',
                'belong_to' => '',
            ]);
            $product->update($data);
        }catch (\Exception $e) {
            echo $e;
            //report($e);;
        }


        return view('products.show',compact('product'));

    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return \redirect('products')->with('status','Successfully Deleted');
        } catch (\Exception $e) {
            echo $e;
        }
    }


}
