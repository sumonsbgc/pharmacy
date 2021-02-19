<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReceiptController extends Controller
{
    public function index(){
        $receipts = Receipt::orderBy('updated_at', 'desc')->get();
        return view('admin.receipts.index', compact('receipts'));
    }

    public function create(){
        $customers = Customer::all();
        return view('admin.receipts.create', compact('customers'));
    }

    public function store(Request $request){
        // dd($request->all());
        $valid = Validator::make($request->all(), [
            'customer_id' => 'required',
            'receipt_title' => ['required', 'max:70'],
            'amount' => 'required',
        ]);
        
        if($valid->fails()){
            return back()->withErrors($valid)->withInput();
        }

        $receipt = new Receipt();
        $receipt->create($request->except(['_token', 'save_receipt']));

        // $receipt->customer_id = $request->customer_id;
        // $receipt->receipt_title = $request->receipt_title;
        // $receipt->amount = $request->amount;

        // $receipt->save();

        return redirect()->route('admin.receipts.index')->with(['status' => 'success', 'message' => 'Receipt Record has been created successfully']);
    }

    public function edit(Receipt $receipt){
        $customers = Customer::all();
        return view('admin.receipts.edit', compact('receipt', 'customers'));
    }

    public function update(Request $request, Receipt $receipt){
        $valid = Validator::make($request->all(), [
            'customer_id' => 'required',
            'receipt_title' => ['required', 'max:70'],
            'amount' => 'required',
        ]);
        
        if($valid->fails()){
            return back()->withErrors($valid)->withInput();
        }

        $receipt->update($request->all());

        // $receipt->customer_id = $request->customer_id;
        // $receipt->receipt_title = $request->receipt_title;
        // $receipt->amount = $request->amount;

        // $receipt->save();

        return redirect()->route('admin.receipts.index')->with(['status' => 'success', 'message' => 'Receipt Record has been updated successfully']);

    }
    public function delete(Receipt $receipt){
        if($receipt->delete()){
            return back()->with(['status' => 'success', 'message' => 'Receipt Record has been deleted successfully']);
        }
    }
}
