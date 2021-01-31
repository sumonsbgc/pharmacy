<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return $this->belongsToMany(Sale::class);
    }
}
