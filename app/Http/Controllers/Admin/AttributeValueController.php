<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Validator;

class AttributeValueController extends Controller
{
    public function index(){
        $values = AttributeValue::all();
        return view('admin.attribute_values.index', compact('values'));
    }

    public function create($attribute_id){
        $attribute = Attribute::findOrFail($attribute_id);
        return view('admin.attribute_values.create', compact('attribute'));
    }

    public function store(Request $request){

        $valid = Validator::make($request->all(), [
            'value' => ['required', 'max:70'],
            'attribute_id' => ['required', 'integer']
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $attr_value = new AttributeValue();
        
        $attr_value->attribute_id = $request->attribute_id ?? '';
        $attr_value->value = ucwords($request->value) ?? '';

        $attr_value->save();

        return redirect()->route('admin.attribute_values.index')->with(['status' => 'success', 'message' => 'Attribute Value has been created successfully.']);
    }

    public function edit($id){
        $value = AttributeValue::findOrFail($id);
        return view('admin.attribute_values.edit', compact('value'));
    }

    public function update(Request $request, $id){
        $valid = Validator::make($request->all(), [
            'value' => ['required', 'max:70'],
            'attribute_id' => ['required', 'integer']
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $attr_value = AttributeValue::findOrFail($id);
                
        $attr_value->attribute_id = $request->attribute_id ?? '';
        $attr_value->value = ucwords($request->value) ?? '';

        $attr_value->save();

        return redirect()->route('admin.attribute_values.index')->with(['status' => 'success', 'message' => 'Attribute Value has been updated successfully.']);
    }

    public function delete($id){
        $attr_value = AttributeValue::findOrFail($id);        
        $attr_value->delete();

        return redirect()->route('admin.attribute_values.index')->with(['status' => 'success', 'message' => 'Attribute Value record has been deleted successfully.']);
    }
}
