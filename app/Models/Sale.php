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
}







