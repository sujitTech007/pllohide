<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderPayment;
use Illuminate\Support\Facades\Auth;

class EarningController extends Controller
{
    public function showEarnings()
    {
        $user = Auth::user();
        $orders = Order::where('vendor_id', $user->id)
                      ->where('status', 'paid')
                      ->with('orderPayments')
                      ->get();

        $totalEarnings = $orders->sum('amount');
        
        $payments = OrderPayment::whereIn('order_id', $orders->pluck('id'))
                               ->where('status', 'succeeded')
                               ->get();

        return view('supplier.earnings', [
            'orders' => $orders,
            'totalEarnings' => $totalEarnings,
            'payments' => $payments
        ]);
    }
}