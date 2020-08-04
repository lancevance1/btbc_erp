<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Customer $customer)
    {
        //dd($customer);
        $contacts = $customer->contacts;
//        dd($contacts);
//        $contacts = DB::table('contacts')
//            ->take(10)
//            ->orderBy('id','DESC')
//            ->get();
        return view('contacts.index',compact('contacts','customer'));
    }

    public function create(Customer $customer)
    {
        //$data =  $request->session()->get('status');;
        return view('contacts.create',compact('customer'));
    }

    public function store(Request $request, Customer $customer)
    {
        //dd($customer);
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required_without:email',
            'email' => 'required_without:phone',
            'fax' => '',


        ]);

        $contact = Contact::create($data);
        $contact->customer_id = $customer->id;
        $contact->push();
        //dd($customer->contacts);
        return redirect('customers/')->with('status','New contact created');
    }

    public function show(Customer $customer,Contact $contact)
    {
        return view('contacts.show',[
            'contact' => $contact,
            'customer' => $customer,
        ]);
    }

    public function edit(Customer $customer,Contact $contact)
    {
        return view('contacts.edit', compact('customer','contact'));
    }

    public function update(Request $request, Customer $customer,Contact $contact)
    {

        $data = $request->validate([
            'name' => 'required',
            'phone' => 'required_without:email',
            'email' => 'required_without:phone',
            'fax' => '',
        ]);
        try {

            $contact->update($data);
        }catch (\Exception $e) {
            echo $e;
            //report($e);;
        }


        //return view('contacts.show',compact('contact'));
        return redirect('customers/')->with('status','Contact modified');

    }

    public function destroy(Customer $customer, Contact $contact)
    {
        try {
            $contact->delete();
            return \redirect('customers')->with('status','Successfully Deleted');
        } catch (\Exception $e) {
            echo $e;
        }
    }
}
