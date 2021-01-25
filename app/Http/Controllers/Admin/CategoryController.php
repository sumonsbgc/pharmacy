<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{    
    public function index(){
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }
    public function create(){
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request){

        $valid = Validator::make($request->all(), [
            'name' => ['required', 'unique:categories', 'max:70'],
            'parent_category' => ['nullable', 'integer'],
        ]);

        if($valid->fails()){
            return redirect()->back()->withInput()->withErrors($valid);
        }

        $category = new Category();
        $category->user_id = Auth::user()->id;
        $category->name = ucwords($request->get('name'));
        $category->slug = Str::slug($category->name);
        $category->parent_id = !empty($request->get('parent_category')) ? $request->get('parent_category') : 0;

        $category->save();

        return redirect()->route('admin.categories.index')->with(['status' => 'success', 'message' => 'Category Record has been created successfully.']);
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        $categories = Category::all();

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id){
        $valid = Validator::make($request->all(), [
            'name' => ['required', 'max:70'],
            'parent_category' => ['nullable', 'integer'],
        ]);

        if($valid->fails()){
            return redirect()->back()->withInput()->withErrors($valid);
        }

        $category = Category::findOrFail($id);

        $category->user_id = Auth::user()->id;
        $category->name = ucwords($request->get('name'));
        $category->slug = Str::slug($category->name);
        $category->parent_id = !empty($request->get('parent_category')) ? $request->get('parent_category') : 0;

        $category->save();

        return redirect()->route('admin.categories.index')->with(['status' => 'success', 'message' => 'Category Record has been updated successfully.']);
    }

    public function delete($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with(['status' => 'success', 'message' => 'Category Record has been deleted successfully.']);
    }
}
