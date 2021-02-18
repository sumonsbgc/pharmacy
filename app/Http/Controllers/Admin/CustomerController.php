<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::orderBy('updated_at', 'desc')->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function create(){
        return view('admin.customers.create');
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => ['nullable', 'string', 'max:70'],
            'email' => ['nullable', 'max:70'],
            'mobile' => ['nullable', 'max:15'],            
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $customer = new Customer();

        $customer->user_id = Auth::user()->id;        
        $customer->name = $request->name ?? '';
        $customer->email = $request->email ?? '';
        $customer->mobile = $request->mobile ?? '';
        $customer->address = $request->address ?? '';

        $customer->save();

        return redirect()->route('admin.customers.index')->with(['status' => 'success', 'message' => 'Customer Record has been created successfully']);        
    }

    public function edit(Customer $customer){
        return view('admin.customers.edit', compact('customer'));
    }
    
    public function update(Request $request, Customer $customer){

        $valid = Validator::make($request->all(), [
            'name' => ['nullable', 'string', 'max:70'],
            'email' => ['nullable', 'max:70'],
            'mobile' => ['nullable', 'max:15']
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $customer->user_id = Auth::user()->id;        
        $customer->name = $request->name ?? '';
        $customer->email = $request->email ?? '';
        $customer->mobile = $request->mobile ?? '';
        $customer->address = $request->address ?? '';

        $customer->save();

        return redirect()->route('admin.customers.index')->with(['status' => 'success', 'message' => 'Customer Record has been updated successfully']);

    }

    public function delete(Customer $customer){
        $customer->delete();
        return redirect()->back()->with(['status' => 'success', 'message' => 'Customer Record has been deleted successfully']);
    }
}
