<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderPayment;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id','designer_id','vendor_id','vendor_role','amount','status','order_id','order_status','confirmed_at','shipped_at','out_for_delivery_at','delivered_at'
    ];

    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    public function orderPayments()
    {
        return $this->hasMany(OrderPayment::class, 'order_id');
    }
}

