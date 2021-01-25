<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;


class SaleController extends Controller
{
    public function create(){        
        $products = Product::all();
        $customers = Customer::all();

        return view('admin.sales.create', compact('products', 'customers'));
    }

    public function store(Request $request){
        dd($request->all());
    }
}
