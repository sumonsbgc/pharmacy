<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    public function index(){
        $attributes = Attribute::all();
        return view('admin.attributes.index', compact('attributes'));
    }
    public function create(){
        return view('admin.attributes.create');
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => ['required', 'max:70', 'unique:attributes']
        ]);
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $attribute = new Attribute();
        $attribute->name = ucwords($request->name) ?? '';
        $attribute->slug = Str::slug($request->name) ?? '';
        $attribute->save();

        return redirect()->route('admin.attributes.index')->with(['status' => 'success', 'message' => 'Attribute record has been created successfully.']);
    }
    public function edit($id){
        $attribute = Attribute::findOrFail($id);
        return view('admin.attribute_value.edit', compact('attribute'));
    }

    public function update(Request $request, $id){
        $valid = Validator::make($request->all(), [
            'name' => ['required', 'max:70']
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $attribute = Attribute::findOrFail($id);
        $attribute->name = ucwords($request->name) ?? '';
        $attribute->slug = Str::slug($request->name) ?? '';
        $attribute->save();

        return redirect()->route('admin.attributes.index')->with(['status' => 'success', 'message' => 'Attribute record has been updated successfully.']);

    }
    public function delete($id){
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();
        return redirect()->route('admin.attributes.index')->with(['status' => 'success', 'message' => 'Attribute record has been deleted successfully.']);
    }
}
