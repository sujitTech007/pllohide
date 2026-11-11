<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_user_id',
        'type',
        'title',
        'message',
        'data',
        'is_read'
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    // Scopes
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Static methods for creating notifications
    public static function createQuotationNotification($quotation, $supplierId = null, $manufacturerId = null)
    {
        $designer = User::find($quotation->user_id);
        
        if ($supplierId) {
            self::create([
                'user_id' => $supplierId,
                'from_user_id' => $quotation->user_id,
                'type' => 'quotation',
                'title' => 'New Quotation Request',
                'message' => "You have received a new quotation request from {$designer->name}",
                'data' => ['quotation_id' => $quotation->id, 'designer_id' => $quotation->user_id]
            ]);
        }

        if ($manufacturerId) {
            self::create([
                'user_id' => $manufacturerId,
                'from_user_id' => $quotation->user_id,
                'type' => 'quotation',
                'title' => 'New Quotation Request',
                'message' => "You have received a new quotation request from {$designer->name}",
                'data' => ['quotation_id' => $quotation->id, 'designer_id' => $quotation->user_id]
            ]);
        }

        // Notify admin
        $admin = User::where('role', 0)->first();
        if ($admin) {
            self::create([
                'user_id' => $admin->id,
                'from_user_id' => $quotation->user_id,
                'type' => 'quotation',
                'title' => 'New Quotation Request',
                'message' => "New quotation request created by {$designer->name}",
                'data' => ['quotation_id' => $quotation->id, 'designer_id' => $quotation->user_id]
            ]);
        }
    }

    public static function createMessageNotification($chat)
    {
        self::create([
            'user_id' => $chat->receiver_id,
            'from_user_id' => $chat->sender_id,
            'type' => 'message',
            'title' => 'New Message',
            'message' => "You have received a new message from {$chat->sender->name}",
            'data' => ['chat_id' => $chat->id, 'sender_id' => $chat->sender_id]
        ]);
    }

    public static function createRegistrationNotification($user)
    {
        $admin = User::where('role', 0)->first();
        if ($admin) {
            $roleName = $user->role == 1 ? 'Designer' : ($user->role == 2 ? 'Supplier' : 'Manufacturer');
            self::create([
                'user_id' => $admin->id,
                'from_user_id' => $user->id,
                'type' => 'registration',
                'title' => 'New User Registration',
                'message' => "New {$roleName} registered: {$user->name}",
                'data' => ['user_id' => $user->id, 'role' => $user->role]
            ]);
        }
    }

    public static function createPaymentNotification($order, $userId)
    {
        self::create([
            'user_id' => $userId,
            'type' => 'payment',
            'title' => 'Payment Successful',
            'message' => "Your payment for order #{$order->id} has been processed successfully",
            'data' => ['order_id' => $order->id, 'amount' => $order->amount]
        ]);

        // Notify admin
        $admin = User::where('role', 0)->first();
        if ($admin) {
            $user = User::find($userId);
            self::create([
                'user_id' => $admin->id,
                'from_user_id' => $userId,
                'type' => 'payment',
                'title' => 'Payment Received',
                'message' => "Payment received from {$user->name} for order #{$order->id}",
                'data' => ['order_id' => $order->id, 'amount' => $order->amount, 'user_id' => $userId]
            ]);
        }
    }

    public static function createPlanPurchaseNotification($subscription, $userId)
    {
        self::create([
            'user_id' => $userId,
            'type' => 'plan_purchase',
            'title' => 'Plan Purchased',
            'message' => "You have successfully purchased a subscription plan",
            'data' => ['subscription_id' => $subscription->id, 'plan_name' => $subscription->plan_name ?? 'Premium Plan']
        ]);

        // Notify admin
        $admin = User::where('role', 0)->first();
        if ($admin) {
            $user = User::find($userId);
            self::create([
                'user_id' => $admin->id,
                'from_user_id' => $userId,
                'type' => 'plan_purchase',
                'title' => 'Plan Purchase',
                'message' => "{$user->name} has purchased a subscription plan",
                'data' => ['subscription_id' => $subscription->id, 'user_id' => $userId]
            ]);
        }
    }
}