<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    public function create(){
        return view('admin.brands.create');
    }

    public function store(Request $request){

        $valid = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:70', 'unique:brands'],
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $brand = new Brand();

        $brand->user_id = Auth::user()->id;
        $brand->name = ucwords($request->name) ?? '';
        $brand->slug = Str::slug($request->name) ?? '';

        if($brand->save()){
            return redirect()->route('admin.brands.index')->with(['status' => 'success', 'message' => 'Brand record has been created successfully']);
        }else{
            return redirect()->route('admin.brands.index')->with(['status' => 'error', 'message' => 'Brand record has not been created successfully']);
        }
    }

    public function edit($id){
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id){

        $valid = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:70']
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $brand = Brand::findOrFail($id);

        $brand->user_id = Auth::user()->id;
        $brand->name = ucwords($request->name) ?? '';
        $brand->slug = Str::slug($request->name) ?? '';

        if($brand->save()){
            return redirect()->route('admin.brands.index')->with(['status' => 'success', 'message' => 'Brand record has been updated successfully']);
        }else{
            return redirect()->route('admin.brands.index')->with(['status' => 'error', 'message' => 'Brand record has not been updated successfully']);
        }
    }

    public function delete($id){
        if(Brand::findOrFail($id)->delete()){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Brand record has been deleted successfully']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'Brand record has not been deleted successfully']);
        }
    }
}
