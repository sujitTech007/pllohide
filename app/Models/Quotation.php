<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Quotation extends Model
{
    use HasFactory;
    protected $fillable = [
        'quote_id',
        'user_id',
        'manufacturer_id',
        'name',
        'email',
        'phone',
        'delivery_address',
        'product_category',
        'leather_category',
        'units_of_product',
        'expected_delivery_time',
        'design_prototype',
        'additional_request',
        'status',
    ];

    public function quotationUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'quotation_id');
    }
}
