<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Product;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $rules = [
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

    ];

    public function index()
    {
        //to do: pagination

        return ProductResource::collection(Product::all());
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
        //process the request

            Product::create($request->all());
            $response['success'] = true;
            $response['response'] = "successfully created";
        }
        return $response;

//        return response()->json($tmp, 201);
    }

    public function update(Request $request, Product $product)
    {
        $response = array('response' => '', 'success' => false);
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
        } else {
            //process the request

            $product->update($request->all());
            $response['success'] = true;
            $response['response'] = "successfully updated";
        }
        return $response;
    }

    public function destroy( Product $product)
    {
        $response = array('response' => '', 'success' => false);
        try {
            $product->delete();
            $response['success']=true;
            $response['response'] = "successfully delete";
        } catch (\Exception $e) {
            $response['response'] = $e->getMessage();
        }
        return $response;
    }
}
