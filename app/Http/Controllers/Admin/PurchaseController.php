<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    public function index(){
        $purchases = Purchase::all();
        return view('admin.purchases.index', compact('purchases'));
    }
    
    public function create(){
        $products = Product::all();
        $suppliers = Supplier::all();
        
        return view('admin.purchases.create', compact('products', 'suppliers'));
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'product_id' => ['required', 'integer'],
            'supplier_id' => ['required', 'integer'],
            'transaction_type' => ['required'],
            'unit' => ['nullable', 'max:50', 'string'],
            'total_quantity' => ['required'],
            'total_amount' => ['required'],
            'unit_price' => ['required'],
            'paid_amount' => ['nullable'],
            'due_amount' => ['nullable'],
            'due_paid_date' => ['nullable', 'date'],
            'description' => ['nullable'],
            'purchase_date' => ['required', 'date'],
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $purchase = new Purchase();
        $purchase->user_id = Auth::user()->id;
        $purchase->product_id = $request->product_id;        
        $purchase->supplier_id = $request->supplier_id;
                
        $purchase->transaction_type = $request->transaction_type;
        $purchase->unit = $request->unit;
        $purchase->total_quantity = $request->total_quantity;

        $purchase->total_amount = $request->total_amount;
        $purchase->unit_price = $request->unit_price ?? $request->total_amount / $request->total_quantity;
        $purchase->paid_amount = $request->paid_amount;
        $purchase->due_amount = $request->due_amount;

        $purchase->due_paid_date = Carbon::create($request->due_paid_date)->format('Y-m-d');
        $purchase->description = $request->description;
        $purchase->purchase_date = Carbon::create($request->purchase_date)->format('Y-m-d');

        if($purchase->save()){
            $product = Product::findOrFail($request->product_id);
            $product->total_quantity = $product->total_quantity + $purchase->total_quantity;
            $product->save();
        }

        return redirect()->route('admin.purchases.index')->with(['status' => 'success', 'message' => 'Purchase Record has been created successfully']);
    }

    public function edit($id){
        $purchase = Purchase::findOrFail($id);
        $products = Product::all();
        $suppliers = Supplier::all();

        return view('admin.purchases.edit', compact('purchase', 'products', 'suppliers'));
    }

    public function update(Request $request, $id){
        $valid = Validator::make($request->all(), [
            'product_id' => ['required', 'integer'],
            'supplier_id' => ['required', 'integer'],
            'transaction_type' => ['required'],
            'unit' => ['nullable', 'max:50', 'string'],
            'total_quantity' => ['required'],
            'total_amount' => ['required'],
            'unit_price' => ['required'],
            'paid_amount' => ['nullable'],
            'due_amount' => ['nullable'],
            'due_paid_date' => ['nullable', 'date'],
            'description' => ['nullable'],
            'purchase_date' => ['required', 'date'],
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $purchase = Purchase::findOrFail($id);

        $purchase->user_id = Auth::user()->id;
        $purchase->product_id = $request->product_id;        
        $purchase->supplier_id = $request->supplier_id;
                
        $purchase->transaction_type = $request->transaction_type;
        $purchase->unit = $request->unit;
        $purchase->total_quantity = $request->total_quantity;

        $purchase->total_amount = $request->total_amount;
        $purchase->unit_price = $request->unit_price ?? $request->total_amount / $request->total_quantity;
        $purchase->paid_amount = $request->paid_amount;
        $purchase->due_amount = $request->due_amount;

        $purchase->due_paid_date = Carbon::create($request->due_paid_date)->format('Y-m-d');
        $purchase->description = $request->description;
        $purchase->purchase_date = Carbon::create($request->purchase_date)->format('Y-m-d');

        if($purchase->save()){
            $product = Product::findOrFail($request->product_id);
            $product->total_quantity = $product->total_quantity + $purchase->total_quantity;
            $product->save();
        }

        return redirect()->route('admin.purchases.index')->with(['status' => 'success', 'message' => 'Purchase Record has been updated successfully']);
    }

    public function delete($id){

        if(5 !== Auth::user()->id){
            return redirect()->back()->with(['status' => 'error', 'message' => 'You can\'t delete this purchase.']);
        }

        $purchase = Purchase::findOrFail($id);
        
        if($purchase->delete()){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Purchase Record has been deleted successfully']);
        }

        return redirect()->back()->with(['status' => 'error', 'message' => 'Purchase Record has not been deleted successfully']);
    }

}
