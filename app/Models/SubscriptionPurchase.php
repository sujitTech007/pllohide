<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPurchase extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
       'stripe_id',
        'price',
         'start_date',
          'end_date',
           'is_active',
            'payment_status',
    ];
    
      public function user()
    {
        return $this->belongsTo(User::class);
    }
}
