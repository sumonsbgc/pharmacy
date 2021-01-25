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

}