<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_name',
        'account_code',
        'expense_amount',
        'narration',
        'transaction_date',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
