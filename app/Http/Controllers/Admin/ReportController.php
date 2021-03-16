<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Supplier;

class ReportController extends Controller
{
    public function __construct()
    {
        
    }

    public function stock(Request $request){
        $data['products'] = Product::get();
        $data['suppliers'] = Supplier::get();
        $data['brands'] = Brand::get();
        $data['categories'] = Category::get();
        
        if($request->isMethod('POST') && $request->get('search') === 'Search'){
            $data['stocks'] = (new Product())->getStockData($request);
            
            $data['from'] = $request->from;
            $data['to'] = $request->to;
            $data['product_id'] = $request->product_id;
            $data['supplier_id'] = $request->supplier_id;
            $data['brand_id'] = $request->brand_id;
            $data['category_id'] = $request->category_id;

        }else{
            $data['stocks'] = Product::with('category', 'brand', 'purchases', 'sales')->orderBy('total_quantity', 'asc')->get();
        }

        return view('admin.reports.stocks', $data);
    }

    public function expense(Request $request){
        $data['allExpenses'] = Expense::orderBy('transaction_date', 'desc')->get();

        if($request->isMethod('post') && $request->get('search') === 'Search'){
            $data['expenses'] = Expense::orWhere('account_id', $request->account_id)->orWhereBetween('transaction_date',[$request->from, $request->to])->get();
            $data['from'] = $request->from;
            $data['to'] = $request->to;

        }elseif($request->isMethod('get') || $request->get('clear') === 'Clear'){
            $data['expenses'] = Expense::orderBy('transaction_date', 'desc')->get();
        }

        return view('admin.reports.expenses', $data);
    }
    
    public function purchase(Request $request){

        $data['products'] = Product::get();
        $data['suppliers'] = Supplier::get();
        $data['brands'] = Brand::get();
        $data['categories'] = Category::get();

        if($request->isMethod('post') && $request->get('search') === 'Search'){
            $data['purchases'] = (new Purchase())->getFilterData($request);
        
            $data['from'] = $request->from;
            $data['to'] = $request->to;
            $data['product_id'] = $request->product_id;
            $data['supplier_id'] = $request->supplier_id;
            $data['oldStatus'] = $request->status;
            $data['brand_id'] = $request->brand_id;
            $data['category_id'] = $request->category_id;

        }elseif($request->isMethod('get') || $request->get('clear') === 'Clear'){
            $data['purchases'] = Purchase::orderBy('purchase_date', 'desc')->get();
        }

        return view('admin.reports.purchases', $data);
    }

    public function sales(Request $request){

        $data['products'] = Product::get();
        $data['customers'] = Customer::get();
        $data['brands'] = Brand::get();
        $data['categories'] = Category::get();

        if($request->isMethod('post') && $request->get('search') === 'Search'){
            $data['sales'] = (new Sale())->getFilterData($request);
        
            $data['from'] = $request->from;
            $data['to'] = $request->to;
            $data['product_id'] = $request->product_id;
            $data['customer_id'] = $request->customer_id;
            $data['oldStatus'] = $request->status;
            $data['brand_id'] = $request->brand_id;
            $data['category_id'] = $request->category_id;

        }elseif($request->isMethod('get') || $request->get('clear') === 'Clear'){
            $data['sales'] = Sale::orderBy('updated_at', 'desc')->get();
        }

        return view('admin.reports.sales', $data);
    }
}
