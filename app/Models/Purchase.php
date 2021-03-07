<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'product_id',
        'supplier_id',
        'transaction_type',
        
        'unit',
        'total_quantity',
        'total_amount',
        'unit_price',

        'paid_amount',
        'due_amount',
        'due_paid_date',
        
        'description',
        'purchase_date',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function product(){
        return $this->belongsTo(Product::class); // Gmax 500mg
    }

    public function getFilterData($request){
        // dd($request->all());
        $query = $this->query(); // SELECT * FROM `purchases` WHERE product_id = 1 AND WHERE `purchase_date` = from AND WHERE AND 

        if(!empty($request->product_id)){
            $query->where('product_id', $request->product_id);
        }

        if(!empty($request->from) && !empty($request->to)){
            $query->whereBetween('purchase_date', [$request->from, $request->to]);
        }elseif(!empty($request->from)){
            $query->where('purchase_date', $request->from);
        }
        
        if(!empty($request->supplier_id)){
            $query->where('supplier_id', $request->supplier_id);
        }
        
        if(!empty($request->status)){
            $query->where('transaction_type', $request->status);
        }

        if(!empty($request->brand_id)){
            $productIdList = [];
            $brand = Brand::findOrFail($request->brand_id);
            $productIdList = $brand->products->map(function($product){
                return $product->id;
            });

            if(is_array($productIdList->all())){
                $query->whereIn('product_id', $productIdList->all());
            }
        }

        if(!empty($request->category_id)){
            $productIdList = [];

            $category = Category::findOrFail($request->category_id);
            $productIdList = $category->products->map(function($product) {
                return $product->id;
            });
            
            if(is_array($productIdList->all())){
                $query->whereIn('product_id', $productIdList->all());
            }
        }

        return $query->get();
    }
}