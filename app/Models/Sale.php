<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'product_id',
        'customer_id',
        'quantity',
        'sales_price',
        'total_amount',

        'sales_type',
        'paid_amount',
        'due_amount',

        'pay_back_date',
        'transaction_id',
        'note',
    ];

    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot('id', 'quantity', 'sales_price', 'total_amount');
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function invoice(){
        return $this->hasOne(Invoice::class);
    }

    public function getFilterData($request){

        $query = $this->query(); 

        if(!empty($request->product_id) && !is_array($request->product_id)){
            $query->with('products', function($query) use($request) {
                $query->where('product_sale.product_id', $request->product_id);
            });
        }elseif(!empty($request->product_id) && is_array($request->product_id)){
            $query->with('products', function($query) use($request) {
                $query->whereIn('product_sale.product_id', $request->product_id);
            });
        }

        if(!empty($request->category_id) && !empty($request->brand_id) ){

            $category = Category::findOrFail($request->category_id); // Category
            $brand = Brand::findOrFail($request->brand_id); // Brand
            
            $cateProductIdList = $category->products->map(function($product) {
                return $product->id;
            });

            $brandProductIdList = $brand->products->map(function($product) {
                return $product->id;
            });

            if($cateProductIdList->isNotEmpty() && $brandProductIdList->isNotEmpty()){
                $productIdList = $cateProductIdList->intersect($brandProductIdList); // 2
            }elseif($cateProductIdList->isNotEmpty()){
                $productIdList = $cateProductIdList->all(); // 2
            }elseif($brandProductIdList->isNotEmpty()){
                $productIdList = $brandProductIdList->all();
            }
            
            $productIdList = $productIdList->all() ?? [];

        }elseif(!empty($request->category_id)){
            $category = Category::findOrFail($request->category_id);
            $productIdList = $category->products->map(function($product) {
                return $product->id;
            })->all();

        }elseif(!empty($request->brand_id)){
            $brand = Brand::findOrFail($request->brand_id);
            $productIdList = $brand->products->map(function($product) {
                return $product->id;
            })->all();
        }

        if(!empty($productIdList) && is_array($productIdList)){
            $query->with('products', function($query) use($productIdList) {
                $query->whereIn('product_sale.product_id', $productIdList); // 2
            });
        }

        if(!empty($request->customer_id)){
            $query->where('customer_id', $request->customer_id);
        }

        if(!empty($request->status)){
            $query->where('sales_type', $request->status);
        }

        if(!empty($request->from) && !empty($request->to)){
            $query->whereBetween('created_at', [$request->from, $request->to]);
        }elseif(!empty($request->from)){
            $query->where('created_at', $request->from);
        }

        return $query->get();
    }
}



