<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class OrderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id','user_id','stripe_payment_intent','amount','currency','status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


