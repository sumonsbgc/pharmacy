<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        $trashedProducts = Product::onlyTrashed()->get();
        return view('admin.products.index', compact('products', 'trashedProducts'));
    }

    public function create(){
        $brands = Brand::all();
        $categories = Category::all();
        return view('admin.products.create', compact('brands', 'categories'));
    }

    public function getProduct($product_id){        
        // $product_id = explode(',', $product_id); // string to array
        $product = Product::findOrFail($product_id); // Select * From `products` Where `id` IN (1,2,3)
        return response()->json(['status' => 'success', 'product' => $product]);
    }

    public function store(Request $request){

        $valid = Validator::make($request->all(), [
            'name' => ['required', 'unique:products', 'max:100'],
            'brand' => ['required'],
            'category' => ['required'],
            'sku' => ['nullable', 'max:70'],
            'barcode' => ['nullable', 'max:50'],
            'total_quantity' => ['required'],
            'sales_price' => ['required'],
            'status' => ['required'],
        ]);

        if($valid->fails()){
            return redirect()->back()->withInput()->withErrors($valid);
        }

        $product = new Product();

        $product->user_id = Auth::user()->id;
        $product->brand_id = $request->brand;
        $product->category_id = $request->category;
        $product->name = ucwords($request->name);        
        $product->slug = Str::slug($request->name);

        $product->sku = $request->sku ?? null;
        $product->barcode = $request->barcode ?? null;

        $product->total_quantity = $request->total_quantity;
        $product->sales_price = $request->sales_price;
        $product->status = $request->status;

        $product->description = $request->description ?? '';

        $product->save();

        return redirect()->route('admin.products.index')->with(['status' => 'success', 'message' => 'Product record has been created successfully.']);
    }

    public function edit($id){
        $brands = Brand::all();
        $categories = Category::all();

        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product', 'brands', 'categories'));
    }

    public function update(Request $request, $id){

        $valid = Validator::make($request->all(), [
            'name' => ['required', 'max:100'],
            'brand' => ['required'],
            'category' => ['required'],
            'sku' => ['nullable', 'max:70'],
            'barcode' => ['nullable', 'max:50'],
            'total_quantity' => ['required'],
            'sales_price' => ['required'],
            'status' => ['required'],
        ]);

        if($valid->fails()){
            return redirect()->back()->withInput()->withErrors($valid);
        }

        $product = Product::findOrFail($id);

        $product->user_id = Auth::user()->id;
        $product->brand_id = $request->brand;
        $product->category_id = $request->category;
        $product->name = ucwords($request->name);        
        $product->slug = Str::slug($request->name);

        $product->sku = $request->sku ?? null;
        $product->barcode = $request->barcode ?? null;

        $product->total_quantity = $request->total_quantity;
        $product->sales_price = $request->sales_price;
        $product->status = $request->status;

        $product->description = $request->description ?? '';

        $product->save();

        return redirect()->route('admin.products.index')->with(['status' => 'success', 'message' => 'Product record has been updated successfully.']);
    }

    public function restore($id){
        $product = Product::onlyTrashed()->findOrFail($id);

        if($product->restore()){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Product record has been restored successfully.']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'Product record has not been restored successfully.']);
        }

    }

    public function delete($id){
        // $product = Product::withTrashed()->findOrFail($id);
        $product = Product::findOrFail($id);
        if($product->forceDelete()){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Product record has been deleted successfully.']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'Product record has not been deleted successfully.']);
        }
    }

    public function trashRemove($id){
        $product = Product::withTrashed()->findOrFail($id);

        if($product->forceDelete()){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Product record has been removed successfully.']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'Product record has not been removed successfully.']);
        }
    }

    public function trash($id){
        $product = Product::findOrFail($id);
        if($product->delete()){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Product record has been deleted successfully.']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'Product record has not been deleted successfully.']);
        }
    }
}
