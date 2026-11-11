<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubscriptionPurchase;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Order;
use App\Models\OrderPayment;
use App\Models\Notification;

class SubscriptionController extends Controller
{
    /**
     * Start subscription checkout for designers only.
     * Requires: auth and role:designer (role = 1)
     */
    public function designer(Request $request)
    {
        // At this point, middleware already ensured user is logged in and role = designer (1)
        $user = Auth::user();

        // Create a pending subscription purchase record
        $purchase = SubscriptionPurchase::create([
            'user_id' => $user->id,
            'stripe_id' => null,
            'price' => 299.00, // monthly price
            'start_date' => now()->toDateString(),
            'end_date' => now()->addMonth()->toDateString(),
            'is_active' => false,
            'payment_status' => 'pending',
        ]);

        // Create Stripe PaymentIntent for Elements flow
        Stripe::setApiKey(config('services.stripe.secret'));
        $intent = PaymentIntent::create([
            'amount' => 29900,
            'currency' => 'usd',
            'metadata' => [
                'purchase_id' => (string)$purchase->id,
                'user_id' => (string)$user->id,
            ],
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);

        $purchase->update([
            'stripe_id' => $intent->id,
        ]);

        // Redirect to payment view with client secret
        return redirect()->route('payment.view', [
            'purchase' => $purchase->id,
            'client_secret' => $intent->client_secret,
        ]);
    }

    public function paymentView(Request $request)
    {
        $purchaseId = (int) $request->query('purchase');
        $clientSecret = (string) $request->query('client_secret');
        $publishableKey = config('services.stripe.key');

        $purchase = null;
        $orderPayment = null;
        $amount = 0;

        if ($purchaseId) {
            $purchase = SubscriptionPurchase::findOrFail($purchaseId);
            if ($purchase->payment_status === 'paid') {
                return redirect()->route('payment.successfull');
            }
            $amount = (float) ($purchase->price ?? 299.00);
        } else {
            // Order payment flow
            $orderId = (int) session('order_payment_id');
            if ($orderId) {
                $order = Order::findOrFail($orderId);

                if ($order->status === 'paid') {
                    return redirect()->route('order.payment.successfull');
                }

                $amount = (float) ($order->amount ?? 0);
                Stripe::setApiKey(config('services.stripe.secret'));

                $orderPayment = OrderPayment::where('order_id', $order->id)
                    ->where('status', 'pending')
                    ->latest('id')
                    ->with('order.vendor')
                    ->first();

                if ($orderPayment) {
                    try {
                        $intent = PaymentIntent::retrieve($orderPayment->stripe_payment_intent);
                        if ($intent && isset($intent->status)) {
                            if ($intent->status === 'succeeded') {
                                $orderPayment->update(['status' => 'succeeded']);
                                if ($order->status !== 'paid') {
                                    $order->update(['status' => 'paid']);
                                }
                                return redirect()->route('order.payment.successfull');
                            }

                            if ($intent->status === 'canceled') {
                                $orderPayment->update(['status' => 'failed']);
                                $orderPayment = null;
                            } else {
                                $clientSecret = $intent->client_secret;
                            }
                        }
                    } catch (\Throwable $e) {
                        $orderPayment = null;
                    }
                }

                if (!$orderPayment) {
                    $intent = PaymentIntent::create([
                        'amount' => (int) round($amount * 100),
                        'currency' => 'usd',
                        'metadata' => [
                            'order_id' => (string)$order->id,
                            'user_id' => (string)Auth::id(),
                        ],
                        'automatic_payment_methods' => [ 'enabled' => true ],
                    ]);
                    $clientSecret = $intent->client_secret;

                    $orderPayment = OrderPayment::create([
                        'order_id' => $order->id,
                        'user_id' => Auth::id(),
                        'stripe_payment_intent' => $intent->id,
                        'amount' => $amount,
                        'currency' => 'usd',
                        'status' => 'pending',
                    ]);
                }
            }
        }

        $amountFormatted = number_format($amount, 2);
        return view('payment-view', [
            'purchase' => $purchase,
            'orderPayment' => $orderPayment,
            'clientSecret' => $clientSecret,
            'amount' => $amountFormatted,
            'publishableKey' => $publishableKey,
        ]);
    }

    public function markPaid(Request $request)
    {
        $request->validate([
            'payment_intent' => 'required|string',
            'purchase_id' => 'nullable|integer',
            'order_payment_id' => 'nullable|integer',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));
        $intent = PaymentIntent::retrieve($request->input('payment_intent'));

        if (!$intent) {
            return back()->with('error', 'Unable to retrieve payment details from Stripe.');
        }

        if ($request->filled('purchase_id')) {
            $purchase = SubscriptionPurchase::findOrFail((int)$request->input('purchase_id'));
            if ($intent->status === 'succeeded') {
                $purchase->update([
                    'payment_status' => 'paid',
                    'is_active' => true,
                ]);
                Notification::createPlanPurchaseNotification($purchase, $purchase->user_id);
                
                $isNewRegistrationPayment = session()->pull('pending_registration_payment', false);
                if ($isNewRegistrationPayment) {
                    return redirect()->route('payment.successfull')
                        ->with('pending_registration_payment', true);
                }
                
                return redirect()->route('payment.successfull');
            }
            $purchase->update(['payment_status' => 'failed', 'is_active' => false]);
            return back()->with('error', 'Payment was not successful.');
        }

        $orderPayment = null;
        if ($request->filled('order_payment_id')) {
            $orderPayment = OrderPayment::find($request->input('order_payment_id'));
        }
        if (!$orderPayment) {
            $orderPayment = OrderPayment::where('stripe_payment_intent', $intent->id)->first();
        }

        if (!$orderPayment) {
            return back()->with('error', 'Order payment record not found.');
        }

        if ($intent->status === 'succeeded') {
            $orderPayment->update(['status' => 'succeeded']);
            $order = Order::find($orderPayment->order_id);
            if ($order) {
                $order->update(['status' => 'paid']);
                Notification::createPaymentNotification($order, $order->designer_id);
            }
            return redirect()->route('order.payment.successfull');
        }

        $orderPayment->update(['status' => 'failed']);
        return back()->with('error', 'Payment was not successful.');
    }

    public function successPage()
    {
        return view('payment-successfull');
    }
    
    public function orderSuccessPage()
    {
        return view('order-payment-successfull');
    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $endpointSecret = config('services.stripe.webhook');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                $endpointSecret
            );
        } catch (\Throwable $e) {
            return response('Invalid', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            /** @var \Stripe\Checkout\Session $session */
            $session = $event->data->object;
            $purchase = SubscriptionPurchase::where('stripe_id', $session->id)->first();
            if ($purchase) {
                $purchase->update([
                    'payment_status' => 'paid',
                    'is_active' => true,
                ]);
            }
        } elseif ($event->type === 'payment_intent.payment_failed') {
            $pi = $event->data->object;
            if (!empty($pi->metadata->purchase_id)) {
                $purchase = SubscriptionPurchase::find((int)$pi->metadata->purchase_id);
                if ($purchase) {
                    $purchase->update([
                        'payment_status' => 'failed',
                        'is_active' => false,
                    ]);
                }
            }
        }

        return response('OK', 200);
    }
}


