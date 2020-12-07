<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Exports\OrderExport;
use App\Product;
use App\Purchase;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class OrderController extends Controller
{

    private $rules;

    public function __construct()
    {
        $this->middleware('auth');
        $this->rules = [
            'order_number' => 'required',
            'run_number' => 'required',
            'customer_id' => 'required',
            'COA' => 'required',
            'LIP' => 'required',
            'cartons_direction' => 'required',
            'bottles_direction' => 'required',
            'back' => '',
            'front' => '',
            'neck' => '',
            'bottle_print' => '',
            'carton_labels' => '',
            'turbidity' => '',
            'do2' => '',
            'alc_in_tank' => '',
            'alc_on_label' => '',
            'additives' => '',
            'delivered_by' => '',
            'required_by' => '',
            'pack_size' => 'required',
            'samples_required' => 'required',
            'cases_required' => 'required',

            'cont_size' => '',
            'stretch_wrap' => '',
            'card_board' => '',
            'slip_sheet' => '',
            'run_length' => '',
            'baf_number' => '',



        ];
    }




    public function index()
    {

        $total_orders = Order::whereNull('deleted_at')->count();

        $orders = Order::whereNull('deleted_at')->where('isPurchase',0)->orderBy('updated_at', 'DESC')->paginate(15);
//        foreach ($orders as $tmp){
//            $tmp->customer_id = 2;
//            $tmp->save();
//        }

$purchases = Purchase::orderBy('updated_at', 'DESC')->paginate(15);

        $orders_purchase = Order::whereNull('deleted_at')->where('isPurchase',1)->orderBy('updated_at', 'DESC')->paginate(15);
        $orders_soft_deleted = Order::onlyTrashed()->get();
        return view('orders.index', compact('orders', 'total_orders', 'orders_soft_deleted','orders_purchase','purchases'));
    }

    public function create(Request $request)
    {
        // get dynamic options
        $wines = Product::where('type', 'wine')
            ->orderBy('code')
            ->get();
        $bottles = Product::where('type', 'bottle')
            ->orderBy('code')
            ->get();
        $corks = Product::where('type', 'cork')
            ->orderBy('code')
            ->get();
        $capsules = Product::where('type', 'capsule')
            ->orderBy('code')
            ->get();
        $screwCaps = Product::where('type', 'screw cap')
            ->orderBy('code')
            ->get();
        $cartons = Product::where('type', 'carton')
            ->orderBy('code')
            ->get();
        $dividers = Product::where('type', 'divider')
            ->orderBy('code')
            ->get();
        $pallets = Product::where('type', 'pallet')
            ->orderBy('code')
            ->get();

        $customers = Customer::all();
        return view('orders.create', compact('wines', 'bottles', 'corks', 'capsules', 'screwCaps', 'cartons', 'dividers', 'pallets', 'customers'));
    }

    public function store(Request $request)
    {
        $str = '';

        $tmp = $this->mergeRule($request);

        //process the request
        $data = $request->validate($tmp);
        //dd($data);
        try {
            $order = Order::create($data);
//            $order->customer_id = $data['customer'];
//            $order->push();
            $order->baf_number = strtoupper($data['baf_number']);
            $order->save();
            $order->products()->attach($data['wine'], ['quantity' => $data['quantity_wine'], 'quantity_external' => $data['quantity_wine_external']]);
            $order->products()->attach($data['bottle'], ['quantity' => $data['quantity_bottle'], 'quantity_external' => $data['quantity_bottle_external']]);
            $order->products()->attach($data['cork'], ['quantity' => $data['quantity_cork'], 'quantity_external' => $data['quantity_cork_external']]);
            $order->products()->attach($data['capsule'], ['quantity' => $data['quantity_capsule'], 'quantity_external' => $data['quantity_capsule_external']]);
            $order->products()->attach($data['screw_cap'], ['quantity' => $data['quantity_screw_cap'], 'quantity_external' => $data['quantity_screw_cap_external']]);
            $order->products()->attach($data['carton'], ['quantity' => $data['quantity_carton'], 'quantity_external' => $data['quantity_carton_external']]);
            $order->products()->attach($data['divider'], ['quantity' => $data['quantity_divider'], 'quantity_external' => $data['quantity_divider_external']]);
            $order->products()->attach($data['pallet']);

        } catch (\Exception $e) {
            $str = $e->getMessage();
            //echo $e;
        }

        if ($str == '') {
            return redirect('orders/')->with('status', 'New order created');
        } else {
            return redirect('orders/')->with('error', $str);
        }

    }

    public function show(Order $order)
    {
        // get dynamic options

        $wines = $order->products->where('type', 'wine');
        $bottles = $order->products->where('type', 'bottle');
        $corks = $order->products->where('type', 'cork');
        $capsules = $order->products->where('type', 'capsule');
        $screwCaps = $order->products->where('type', 'screw cap');
        $cartons = $order->products->where('type', 'carton');
        $dividers = $order->products->where('type', 'divider');
        $pallets = $order->products->where('type', 'pallet');
        //dd($pallets);
        $customers = $order->customers;

        return view('orders.show', compact('wines', 'order', 'bottles', 'corks', 'capsules', 'screwCaps', 'cartons', 'dividers', 'pallets', 'customers'));
    }

    public function edit(Order $order)
    {
        // get dynamic options
        $wines = Product::where('type', 'wine')
            ->orderBy('created_at', 'DESC')
            ->get();
        $bottles = Product::where('type', 'bottle')
            ->orderBy('created_at', 'DESC')
            ->get();
        $corks = Product::where('type', 'cork')
            ->orderBy('created_at', 'DESC')
            ->get();
        $capsules = Product::where('type', 'capsule')
            ->orderBy('created_at', 'DESC')
            ->get();
        $screwCaps = Product::where('type', 'screw cap')
            ->orderBy('created_at', 'DESC')
            ->get();
        $cartons = Product::where('type', 'carton')
            ->orderBy('created_at', 'DESC')
            ->get();
        $dividers = Product::where('type', 'divider')
            ->orderBy('created_at', 'DESC')
            ->get();
        $pallets = Product::where('type', 'pallet')
            ->orderBy('created_at', 'DESC')
            ->get();

        $customers = Customer::all();
        $current_customer = $order->customers;
//        dd($current_customer->id);

        $current_wine = $order->products->where('type', 'wine')->first();
        $current_bottle = $order->products->where('type', 'bottle')->first();
        $current_cork = $order->products->where('type', 'cork')->first();
//        dd($current_cork->id);
        $current_capsule = $order->products->where('type', 'capsule')->first();
//        dd($current_capsule->id);
        $current_screw_cap = $order->products->where('type', 'screw cap')->first();
        $current_carton = $order->products->where('type', 'carton')->first();
        $current_divider = $order->products->where('type', 'divider')->first();
        $current_pallet = $order->products->where('type', 'pallet')->first();

        return view('orders.edit', compact('order', 'wines', 'bottles',
                'corks', 'capsules', 'screwCaps', 'cartons', 'dividers', 'pallets', 'customers', 'current_wine',
                'current_bottle', 'current_cork', 'current_capsule', 'current_screw_cap',
                'current_carton', 'current_divider', 'current_pallet', 'current_customer')

        );
    }

    public function update(Request $request, Order $order)
    {

        //$validator = Validator::make($request->all(), $this->rules);
$tmp = $this->mergeRule($request);

        //process the request
        $data = $request->validate($tmp);
        //dd($data);
        $order->update($data);
        $order->baf_number = strtoupper($data['baf_number']);
        $order->save();
        $arr = array();
        $arr1 = array();
        //dd($data);
        isset($data['wine']) ? array_push($arr, $data['wine']) : null;

        isset($data['bottle']) ? array_push($arr, $data['bottle']) : null;
        //dd($data_bottle);
        isset($data['cork']) ? array_push($arr, $data['cork']) : null;
        isset($data['capsule']) ? array_push($arr, $data['capsule']) : null;
        isset($data['screw_cap']) ? array_push($arr, $data['screw_cap']) : null;
        isset($data['carton']) ? array_push($arr, $data['carton']) : null;
        isset($data['divider']) ? array_push($arr, $data['divider']) : null;
        isset($data['pallet']) ? array_push($arr, $data['pallet']) : null;
        //dd($data['bottle']);
//dd($arr);
        $order->products()->sync($arr);
        if (isset($data['wine'])) {
            $order->products()->updateExistingPivot($data['wine'], ['quantity' => $data['quantity_wine'], 'quantity_external' => $data['quantity_wine_external']]);
        }
        if (isset($data['bottle'])) {
            $order->products()->updateExistingPivot($data['bottle'], ['quantity' => $data['quantity_bottle'], 'quantity_external' => $data['quantity_bottle_external']]);
        }
        if (isset($data['cork'])) {
            $order->products()->updateExistingPivot($data['cork'], ['quantity' => $data['quantity_cork'], 'quantity_external' => $data['quantity_cork_external']]);
        }
        if (isset($data['capsule'])) {
            $order->products()->updateExistingPivot($data['capsule'], ['quantity' => $data['quantity_capsule'], 'quantity_external' => $data['quantity_capsule_external']]);
        }
        if (isset($data['screw_cap'])) {
            $order->products()->updateExistingPivot($data['screw_cap'], ['quantity' => $data['quantity_screw_cap'], 'quantity_external' => $data['quantity_screw_cap_external']]);
        }
        if (isset($data['carton'])) {
            $order->products()->updateExistingPivot($data['carton'], ['quantity' => $data['quantity_carton'], 'quantity_external' => $data['quantity_carton_external']]);
        }
        if (isset($data['divider'])) {
            $order->products()->updateExistingPivot($data['divider'], ['quantity' => $data['quantity_divider'], 'quantity_external' => $data['quantity_divider_external']]);
        }//                $response['success'] = true;
//                $response['response'] = "successfully updated";


        return redirect('orders/')->with('status', 'order updated');



    }

    /**
     * softly delete records in orders table
     *
     * @param Order $order
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Order $order)
    {

        try {
            $order->delete();
            return \redirect('orders/')->with('status', 'Successfully Deleted');
        } catch (\Exception $e) {
            echo $e;
            return redirect('orders/')->with('error', 'Order delete failed');
        }
    }

    /**
     * reverse deleted records
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function reverse(Request $request)
    {
        //dd($request->id);
        try {
            $tmp = Order::onlyTrashed()->where('id', $request->id)->restore();
            return redirect('orders/')->with('status', 'Order restored');
        } catch (\Exception $e) {
            return redirect('orders/')->with('error', 'Order restore failed');
        }

    }

    /**
     * permanently delete records in orders table
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function forceDestroy(Request $request)
    {
        //dd($request);
        try {
            Order::onlyTrashed()->where('id', $request->id)->forceDelete();
            return \redirect('orders/')->with('status', 'Permanently Deleted');
        } catch (\Exception $e) {
            echo $e;
            return \redirect('orders/')->with('error', 'Order permanently delete failed');
        }
    }

    /**
     * export data from database to Excel
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function export(Request $request)
    {

        try {
        $log = '';
        //return Excel::download(new OrderExport(), 'order.xlsx');

        //get data
        $orders = Order::withoutTrashed()->where('id', $request->id)->get();


        //load spreadsheet
        $spreadsheet = IOFactory::load("template.xlsx");
        $sheet = $spreadsheet->getActiveSheet();

        $order = $orders->first();
        $wine = $order->products->where('type', 'wine')->first();
        $bottle = $order->products->where('type', 'bottle')->first();
        $cork = $order->products->where('type', 'cork')->first();
        $capsule = $order->products->where('type', 'capsule')->first();
        $screw_cap = $order->products->where('type', 'screw cap')->first();
        $carton = $order->products->where('type', 'carton')->first();
        $divider = $order->products->where('type', 'divider')->first();
        $pallet = $order->products->where('type', 'pallet')->first();


        // manipulate cells
            $contacts =[];
            if(isset($order->customers)){  $contacts = $order->customers->contacts;
                $sheet->setCellValue('C6', $order->customers->name);
                $sheet->setCellValue('C8', $order->customers->address);}

        $specs = $order->pallets;
        $str = 'C';
        $str1 = 'I';

        //dd($specs);
        for ($i = 0; $i < sizeof($contacts); $i++) {
            $cell_name = $str . '7';
            $cell_email = $str . '9';
            $cell_phone = $str1 . '8';
            $cell_fax = $str1 . '9';
            //dd($contacts[$i]->name);
            $sheet->setCellValue($cell_name, $contacts[$i]->name);
            $sheet->setCellValue($cell_email, $contacts[$i]->email);
            $sheet->setCellValue($cell_phone, $contacts[$i]->phone);
            $sheet->setCellValue($cell_fax, $contacts[$i]->fax);
            $str++;
            $str++;
            $str1++;
            $str1++;
            //dd($str);
        }

        $str = 'C';
        for ($i = 0; $i < sizeof($specs); $i++) {
            $cell_cartons_per_layer = $str . '49';
            $cell_layers_per_pallet = $str . '50';
            $cell_cartons_per_pallet = $str . '51';
            $sheet->setCellValue($cell_cartons_per_layer, $specs[$i]->cartons_per_layer);
            $sheet->setCellValue($cell_layers_per_pallet, $specs[$i]->layers_per_pallet);
            $sheet->setCellValue($cell_cartons_per_pallet, $specs[$i]->cartons_per_layer * $specs[$i]->layers_per_pallet);
            $str++;
        }



        $sheet->setCellValue('H5', $order->run_number);
        $sheet->setCellValue('I11', $order->order_number);

        $sheet->setCellValue('C14', $order->cases_required);
        $sheet->setCellValue('C15', $order->samples_required);
        $sheet->setCellValue('C22', $order->do2);
        $sheet->setCellValue('C23', $order->additives);
        $sheet->setCellValue('H14', $order->pack_size);
        $sheet->setCellValue('F19', $order->alc_on_label);
        $sheet->setCellValue('F20', $order->alc_in_tank);
        $sheet->setCellValue('F21', $order->turbidity);
        $sheet->setCellValue('I15', date_format(date_create($order->required_by), "d/m/Y"));
        $sheet->setCellValue('I16', date_format(date_create($order->delivered_by), "d/m/Y"));
        $sheet->setCellValue('C40', $order->carton_labels);
        $sheet->setCellValue('C41', $order->bottle_print);
        $sheet->setCellValue('D42', $order->neck);
        $sheet->setCellValue('D43', $order->front);
        $sheet->setCellValue('D44', $order->back);
        $sheet->setCellValue('F15', $order->run_length);
        $sheet->setCellValue('C52', $order->slip_sheets);
        $sheet->setCellValue('C53', $order->card_board);
        $sheet->setCellValue('C54', $order->stretch_wrap);
        $sheet->setCellValue('C55', $order->cont_size);
        $sheet->setCellValue('J4', $order->baf_number);

        if ($order->bottles_direction === 'upright') {
            $sheet->setCellValue('I48', 'X');
        } elseif ($order->bottles_direction === 'inverted') {
            $sheet->setCellValue('I49', 'X');
        } else {
            $sheet->setCellValue('I50', 'X');
        }

        if ($order->bottles_direction === 'upright') {
            $sheet->setCellValue('I52', 'X');
        } else {
            $sheet->setCellValue('I53', 'X');
        }

        if ($order->coa) {
            $sheet->setCellValue('F17', 'YES');
        } else {
            $sheet->setCellValue('F17', 'NO');
        }
        if ($order->lip) {
            $sheet->setCellValue('F18', 'YES');
        } else {
            $sheet->setCellValue('F18', 'NO');
        }

        if ($order->slip_sheet) {
            $sheet->setCellValue('C52', 'YES');
        } else {
            $sheet->setCellValue('C52', 'NO');
        }

        if ($order->card_board) {
            $sheet->setCellValue('C53', 'YES');
        } else {
            $sheet->setCellValue('C53', 'NO');
        }

        if ($order->carton_labels) {
            $sheet->setCellValue('C40', 'YES');
        } else {
            $sheet->setCellValue('C40', 'NO');
        }

        if (isset($wine)) {
            $sheet->setCellValue('C11', $wine->code);
            $sheet->setCellValue('C20', $wine->code);
            $sheet->setCellValue('C21', $wine->description);
        }

        if (isset($bottle)) {
            $sheet->setCellValue('C30', $bottle->code);
            $sheet->setCellValue('D30', $bottle->description);
            $sheet->setCellValue('H30', $bottle->pivot->quantity);
            $sheet->setCellValue('I30', $bottle->pivot->quantity_external);
        }
        if (isset($cork)) {
            $sheet->setCellValue('C31', $cork->code);
            $sheet->setCellValue('D31', $cork->description);
            $sheet->setCellValue('H31', $cork->pivot->quantity);
            $sheet->setCellValue('I31', $cork->pivot->quantity_external);
        }

        if (isset($capsule)) {
            $sheet->setCellValue('C32', $capsule->code);
            $sheet->setCellValue('D32', $capsule->description);
            $sheet->setCellValue('H32', $capsule->pivot->quantity);
            $sheet->setCellValue('I32', $capsule->pivot->quantity_external);
        }

        if (isset($screw_cap)) {
            $sheet->setCellValue('C33', $screw_cap->code);
            $sheet->setCellValue('D33', $screw_cap->description);
            $sheet->setCellValue('H33', $screw_cap->pivot->quantity);
            $sheet->setCellValue('I33', $screw_cap->pivot->quantity_external);
        }

        if (isset($carton)) {
            $sheet->setCellValue('C35', $carton->code);
            $sheet->setCellValue('D35', $carton->description);
            $sheet->setCellValue('H35', $carton->pivot->quantity);
            $sheet->setCellValue('I35', $carton->pivot->quantity_external);
        }

        if (isset($divider)) {
            $sheet->setCellValue('C36', $divider->code);
            $sheet->setCellValue('D36', $divider->description);
            $sheet->setCellValue('H36', $divider->pivot->quantity);
            $sheet->setCellValue('I36', $divider->pivot->quantity_external);
        }

        if (isset($pallet)) {
            $sheet->setCellValue('C48', $pallet->code);
        }


        //$sheet->setCellValue('', $pallet->descrition);

        //dd($bottle->pivot->quantity);


        //$sheet->setCellValue('I37', $bottle->pivot->quantity);

        // create a file name
        $fileName = 'BAF_' . 'BAXXX' . '_' . $order->run_number . '_' . $order->order_number . '_' . $order->wine_code . '.xlsx';

        // create a new spreadsheet
        $writer = new Xlsx($spreadsheet);

            $writer->save($fileName);
        } catch (\Exception $e) {
            $log = $e->getMessage();
        }


        if ($log == null) {
            return redirect('orders/')->with('status', 'Excel created');
        } else {
            return redirect('orders/')->with('error', $log);
        }

    }

    public function generatePurchase(Request $request)
    {
        $orders = Order::whereNull('deleted_at')->orderBy('updated_at', 'DESC')->paginate(15);
//        dd($orders[1]);
        $data = $request->all();
//        dd(sizeof($data));
        if(sizeof($data) >1){
            $purchase = Purchase::create();


        while ($value = current($data)) {
            if ($value == 'on') {

                $order = Order::find(key($data));
//                dd($purchase->id);
                $order->purchase_id=$purchase->id;
                $order->isPurchase = true;
                $order->save();
            }
            next($data);
        }

        $purchases = Purchase::orderBy('updated_at', 'DESC')->paginate(15);
        foreach ($purchases as $purchase) {

            foreach ($purchase->orders as $order) {

                foreach ($order->products as $prod) {

                    $prod->order_quantity += $prod->pivot->quantity;

                    $prod->to_be_ordered =$prod->order_quantity-$prod->current_inventory-$prod->ordered;
                    if($prod->to_be_ordered<0){
                        $prod->to_be_ordered=0;
                    }
                    $prod->save();
                }
            }
        }


        return redirect('orders/')->with('status', 'purchase created');
        }else{
            return redirect('orders/')->with('status', 'pls select orders');
        }


    }

    public function restorePurchase(Request $request){
//        $purchase = Purchase::all();
//        foreach ($purchase as $tmp){
//            $tmp->delete();
//        }
//dd($request->id);
$purchase = Purchase::find($request->id);


            foreach ($purchase->orders as $order) {

                foreach ($order->products as $prod) {

                    foreach ($prod->logbooks as $logbook){

                        if($logbook != null){
//                            dd($logbook);
                            $logbook->delete();

                        }

                    }

                    $prod->order_quantity =0;
                    $prod->ordered = 0;
                    $prod->save();


                }
            }


//        $orders = Order::whereNull('deleted_at')->where('isPurchase',1)->orderBy('updated_at', 'DESC')->paginate(15);
        foreach ($purchase->orders as $tmp){
            $tmp->isPurchase=false;
//            $purchase = Purchase::find($tmp->purchase_id);
            if($purchase != null){
                $purchase->delete();
            }

            $tmp->purchase_id=null;
            $tmp->save();
        }


        return redirect('orders/')->with('status', 'purchase restored');
    }


    public function mergeRule($request)
    {
        $tmp=[
            'wine' => 'required',
            'bottle' => Rule::requiredIf($request->quantity_bottle!=null or $request->quantity_bottle_external!=null ),
            'cork' => Rule::requiredIf($request->quantity_cork!=null or $request->quantity_cork_external!=null ),
            'capsule' => Rule::requiredIf($request->quantity_capsule!=null or $request->quantity_capsule_external!=null ),
            'screw_cap' =>Rule::requiredIf($request->quantity_screw_cap!=null or $request->quantity_screw_cap_external!=null ),
            'carton' => Rule::requiredIf($request->quantity_carton!=null or $request->quantity_carton_external!=null ),
            'divider' => Rule::requiredIf($request->quantity_divider!=null or $request->quantity_divider_external!=null ),
            'pallet' => 'required',

            'quantity_wine' => Rule::requiredIf($request->wine!=null and $request->quantity_wine_external==null ),
            'quantity_bottle' => Rule::requiredIf($request->bottle!=null and $request->quantity_bottle_external==null ),
            'quantity_cork' => Rule::requiredIf($request->cork!=null and $request->quantity_cork_external==null ),
            'quantity_capsule' => Rule::requiredIf($request->capsule!=null and $request->quantity_capsule_external==null ),
            'quantity_screw_cap' => Rule::requiredIf($request->srew_cap!=null and $request->quantity_screw_cap_external==null ),
            'quantity_carton' => Rule::requiredIf($request->carton!=null and $request->quantity_carton_external==null ),
            'quantity_divider' => Rule::requiredIf($request->divider!=null and $request->quantity_divider_external==null ),

            'quantity_wine_external' => Rule::requiredIf($request->wine!=null and $request->quantity_wine==null ),
            'quantity_bottle_external' => Rule::requiredIf($request->bottle!=null and $request->quantity_bottle==null ),
            'quantity_cork_external' => Rule::requiredIf($request->cork!=null and $request->quantity_cork==null ),
            'quantity_capsule_external' => Rule::requiredIf($request->capsule!=null and $request->quantity_capsule==null ),
            'quantity_screw_cap_external' => Rule::requiredIf($request->screw_cap!=null and $request->quantity_screw_cap==null ),
            'quantity_carton_external' => Rule::requiredIf($request->carton!=null and $request->quantity_carton==null ),
            'quantity_divider_external' => Rule::requiredIf($request->divider!=null and $request->quantity_divider==null ),
        ];
        $tmp = array_merge ($tmp,$this->rules);
        return $tmp;
    }
}
