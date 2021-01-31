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
        return $this->belongsToMany(Product::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}




// One To One  => hasOne() => belongsTo()

// One To Many => hasMany() => belongsTo()

// Many To Many => belongsToMany() => belongsToMany()




