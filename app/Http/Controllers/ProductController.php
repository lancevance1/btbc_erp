<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Product;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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
        $products = Product::paginate(15);

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

            'price' => 'required',
            'type' => 'required',
            'current_inventory' => 'required',
            'description' => '',
            'size' => '',
            'order_quantity' => '',
            'to_be_ordered' => '',

            'belong_to' => '',

        ]);

        Product::create($data);

        return redirect('products/')->with('status','New dry good created');
    }

    public function show(Product $product)
    {
//        $suppliers = Supplier::orderBy('updated_at')
//        ->get();
        $price=null;
        foreach ($product->suppliers as $tmp){
//            dd($tmp->pivot);
            if($tmp->pivot->isChosen == true){
                $price = $tmp->pivot->price;
                break;
            }
        }
//        dd($price);
        $current_inventory_value = $product->cost * $product->current_inventory;
        return view('products.show',[
            'product' => $product,
            'current_inventory_value'=>$current_inventory_value,
            'cost' =>$price,

        ]);
    }

    public function edit(Product $product)
    {
        $suppliers = Supplier::orderBy('updated_at')
            ->get();
        return view('products.edit', compact('product','suppliers'));
    }

    public function update(Request $request, Product $product)
    {


            $data = $request->validate([
                'code' => 'required',
                'supplier' => 'required',
                'price' => 'required',
                'type' => 'required',
                'current_inventory' => '',
                'description' => '',
                'size' => '',
                'order_quantity' => '',
                'to_be_ordered' => '',
                'current_inventory_value' => '',
                'belong_to' => '',
                'cost' => 'required',

            ]);
                //dd($data);
            if($data['current_inventory']!=0||$data['current_inventory']!=null){
                $tmp = $data['current_inventory']-$product->current_inventory;

                $del = Delivery::create();
                $del->product_id = $product->id;
                $del->stock =$tmp;


                $del->save();
            }
            $product->update($data);
            $product->suppliers()->syncWithoutDetaching([$data['supplier']]);
            $product->suppliers()->updateExistingPivot($data['supplier'], ['price' => $data['cost']]);

            foreach ($product->suppliers as $tmp){
//dd($tmp->id);
                if($tmp->id == $data['supplier']){
                    $tmp->pivot->isChosen = true;
                }else{
                    $tmp->pivot->isChosen = false;
                }
                $tmp->pivot->save();
            }
//        }catch (\Exception $e) {
//            echo $e;
//            //report($e);;
//        }




//        return view('products.show',compact('product'));
return redirect('products/'.$product->id)->with('status','dry good updated');
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


    public function changeSupplier(Request $request,Product $product)
    {
        $data = $request->validate([
            'supplier' => '',

        ]);

//        dd($data);
//       dd($request->id);
$product = Product::find($request->id);

        foreach ($product->suppliers as $tmp){
//dd($tmp->id);
            if($tmp->id == $data['supplier']){
                $tmp->pivot->isChosen = true;
            }else{
                $tmp->pivot->isChosen = false;
            }
            $tmp->pivot->save();
        }

        return Redirect::back()->with('status','Supplier has been changed');
    }


}
