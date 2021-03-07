<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'brand_id',
        'category_id',
        'name',
        'slug',
        'sku',
        'barcode',

        'total_quantity',
        'sales_price', //
        
        'thumbnail',
        'status',

        'description',
        'expiry_date'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }

    public function sales(){
        return $this->belongsToMany(Sale::class)->withTimestamps()->withPivot('id', 'quantity', 'sales_price', 'total_amount');
    }

    public function getStockData($filters){
        $query = $this->query()->with('sales', 'purchases');

        if(!empty($filters->product_id) && $filters->product_id[0] !== null){
            $query->whereIn('id', $filters->product_id);
        }

        if(!empty($filters->brand_id) && $filters->brand_id[0] !== null){
            $query->whereIn('brand_id', $filters->brand_id);
        }

        if(!empty($filters->category_id) && $filters->category_id[0] !== null){
            $query->whereIn('category_id', $filters->category_id);
        }

        if(!empty($filters->supplier_id) && $filters->supplier_id[0] !== null){
            $suppliers = Supplier::whereIn('id', $filters->supplier_id)->get();

            $productIdList = $suppliers->map(function($supplier){
                return $supplier->purchases->map(function($purchase){
                    return $purchase->product_id;
                });
            })->collapse()->unique()->all();

            $query->whereIn('id', $productIdList);
        }

        if(!empty($filters->from) && !empty($filters->to)){
            $query->orWhereHas('purchases', function($query) use($filters) {
                $query->whereBetween('purchase_date', [Carbon::create($filters->from), Carbon::create($filters->to)]);
            });
        }

        if(!empty($filters->from) && !empty($filters->to)){
            $query->orWhereHas('sales', function($query) use($filters) {
                $query->whereBetween('product_sale.created_at', [Carbon::create($filters->from), Carbon::create($filters->to)]);
            });            
        }

        return $query->get()->dd();
    }
}
