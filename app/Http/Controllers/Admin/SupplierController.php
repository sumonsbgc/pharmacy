<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index(){
        $suppliers = Supplier::all();
        return view('admin.suppliers.index', compact('suppliers'));
    }
    
    public function create(){
        return view('admin.suppliers.create');
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:70'],
            'company_name' => ['nullable', 'string', 'max:70'],
            'email' => ['nullable', 'max:70', 'unique:suppliers'],
            'mobile' => ['required', 'max:15', 'unique:suppliers'],
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $supplier = new Supplier();

        $supplier->user_id = Auth::user()->id;
        $supplier->name = $request->name;
        $supplier->company_name = $request->company_name;
        $supplier->email = $request->email;
        $supplier->mobile = $request->mobile;
        $supplier->address = $request->address;

        $supplier->save();

        return redirect()->route('admin.suppliers.index')->with(['status' => 'success', 'message' => 'Supplier Record has been created successfully']);
    }

    public function edit($id){
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id){

        $valid = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:70'],
            'company_name' => ['nullable', 'string', 'max:70'],
            'email' => ['nullable', 'max:70'],
            'mobile' => ['required', 'max:15'],
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $supplier = Supplier::findOrFail($id);

        $supplier->user_id = Auth::user()->id;
        $supplier->name = $request->name;
        $supplier->company_name = $request->company_name;
        $supplier->email = $request->email;
        $supplier->mobile = $request->mobile;
        $supplier->address = $request->address;

        $supplier->save();

        return redirect()->route('admin.suppliers.index')->with(['status' => 'success', 'message' => 'Supplier Record has been updated successfully']);
    }
    
    public function delete($id){
        $supplier = Supplier::findOrFail($id);
        if($supplier->delete()){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Supplier Record has been deleted successfully']);
        }
        
        return redirect()->back()->with(['status' => 'error', 'message' => 'Supplier Record has not been deleted successfully']);
    }
}
