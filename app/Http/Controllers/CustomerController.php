<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        $customers = DB::table('customers')
//            ->take(10)
//            ->orderBy('id','DESC')
//            ->get();
        $customers = Customer::take(10)
            ->orderBy('created_at', 'DESC')
            ->paginate(15);
        //dd($customers->first()->contacts);
        return view('customers.index',compact('customers'));
    }

    public function create(Request $request)
    {
        //$data =  $request->session()->get('status');;
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => '',


        ]);

        $customer = Customer::create($data);
        //dd($customer);

        //$customer->contacts()->save($tmp);

        return redirect('customers/')->with('status','New customer created');
    }

    public function show(Customer $customer)
    {
        return view('customers.show',[
            'customer' => $customer,
        ]);
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => '',
        ]);
        try {

            $customer->update($data);
        }catch (\Exception $e) {
            echo $e;
            //report($e);;
        }


        //return view('customers.show');
return redirect('customers/')->with('status','Customer modified');
    }

    public function destroy(Customer $customer)
    {
        try {
            $customer->contacts()->delete();
            $customer->delete();
            return \redirect('customers')->with('status','Successfully Deleted');
        } catch (\Exception $e) {
            echo $e;
        }
    }
}
