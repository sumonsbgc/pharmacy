<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    public function index(){
        $sales = Sale::with('products','customer')->get();
        return view('admin.sales.index', compact('sales'));
    }
    public function create(){        
        $products = Product::all();
        $customers = Customer::all();

        return view('admin.sales.create', compact('products', 'customers'));
    }

    public function store(Request $request){
        // dd($request->all());
        $valid = Validator::make($request->all(), [
            'product_id'       => ['required'],
            'customer_id'      => ['required_without:is_new_customer'],
            'customer_name'    => ['required_if:is_new_customer,on'],
            'customer_mobile'  => ['required_if:is_new_customer,on'],
            'quantity'         => ['required'],
            'sales_price'      => ['required'],
            'total_amount'     => ['required'],
            'transaction_type' => ['required'],
            'paid_amount'      => ['required'],
            'due_amount'       => ['required_if:transaction_type,Due'],
            'pay_back_date'    => ['nullable'],
            'transaction_id'   => ['required_if:transaction_type,Mobile Banking'],
        ]);

        if($valid->fails()){
            return back()->withErrors($valid)->withInput();
        }

        if(isset($request->is_new_customer)){
            $customer = new Customer();
            $customer->name = $request->customer_name;
            $customer->mobile = $request->customer_mobile;
            $customer->address = $request->customer_address;
            $customer->save();
        }

        DB::beginTransaction();
        $sale = new Sale();        
        $sale->user_id = Auth::user()->id;        
        $sale->customer_id = $request->customer_id ?? $customer->id;        
        $sale->sales_type = $request->transaction_type;
        $sale->gross_amount = $request->gross_amount;
        $sale->discount_amount = $request->total_discount;
        $sale->net_amount = $request->net_amount;
        $sale->paid_amount = $request->paid_amount;
        $sale->due_amount = $request->due_amount;
        $sale->pay_back_date = $request->pay_back_date;
        $sale->transaction_id = $request->transaction_id;
        $sale->save();

        foreach($request->product_id as $key => $value){
            $sale->products()->attach($value,
            [
                'quantity' => $request->quantity[$key], 
                'sales_price' => $request->sales_price[$key], 
                'total_amount' => $request->total_amount[$key],
            ]);
        }

        DB::commit();


        return redirect()->route('admin.sales.index')->with(['status' => 'success', 'message' => 'Sales Record has been created successfully']);
    }

    
}
