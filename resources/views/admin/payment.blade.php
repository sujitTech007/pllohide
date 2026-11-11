@include('admin.include.header')
<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_bx">
            <h3>Payments</h3>

        </div>
        <div class="order_card">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="list_order">
                        <h5 class="mb-3">Order Payments</h5>
                        @forelse($payments as $payment)
                        <div class="order-card mt-3 bg-white">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="text-secondary">Payment ID: </span>
                                    <strong>#{{ $payment->id }}</strong>
                                </div>
                                <div class="totalAmount">
                                    <label class="text-secondary fw-bold">Amount</label>
                                    <span class="border rounded fw-bold border-0">$ {{ number_format((float)$payment->amount, 2) }}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="mb-1">
                                    <strong>Order ID:</strong> #{{ $payment->order->id }}
                                    <br><strong>Designer:</strong> {{ $payment->order->designer->name ?? 'Unknown Designer' }}
                                    <br><strong>Vendor:</strong> {{ $payment->order->vendor->name ?? 'Unknown Vendor' }} ({{ ucfirst($payment->order->vendor_role) }})
                                    <br><strong>Payment Status:</strong> {{ ucfirst($payment->status) }}
                                    <br><strong>Date:</strong> {{ $payment->created_at->format('M d, Y H:i') }}
                                </p>
                                <div class="d-flex align-items-center gap-2">
                                    @if($payment->status == 'succeeded')
                                        <button class="status-btn badge bg-success">Completed</button>
                                    @elseif($payment->status == 'pending')
                                        <button class="status-btn badge bg-warning">Pending</button>
                                    @else
                                        <button class="status-btn badge bg-danger">{{ ucfirst($payment->status) }}</button>
                                    @endif
                                </div>
                            </div>
                            @if($payment->stripe_payment_intent)
                            <div class="mt-2">
                                <small class="text-muted">
                                    <strong>Stripe Payment ID:</strong> {{ $payment->stripe_payment_intent }}
                                </small>
                            </div>
                            @endif
                        </div>
                        @empty
                            <div class="text-center p-4">
                                <i class="fas fa-credit-card fa-3x text-muted mb-3"></i>
                                <h6>No order payments found</h6>
                                <p class="text-muted">Order payments will appear here.</p>
                            </div>
                        @endforelse
                        
                        @if($payments->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $payments->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="list_order">
                        <h5 class="mb-3">Subscription Payments</h5>
                        @forelse($subscriptionPayments as $subscription)
                        <div class="order-card mt-3 bg-white">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="text-secondary">Subscription ID: </span>
                                    <strong>#{{ $subscription->id }}</strong>
                                </div>
                                <div class="totalAmount">
                                    <label class="text-secondary fw-bold">Amount</label>
                                    <span class="border rounded fw-bold border-0">$ {{ number_format((float)$subscription->price, 2) }}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="mb-1">
                                    <strong>User:</strong> {{ $subscription->user->name ?? 'Unknown User' }}
                                    <br><strong>Plan:</strong> {{ ucfirst($subscription->plan_name ?? 'Unknown Plan') }}
                                    <br><strong>Status:</strong> {{ $subscription->is_active ? 'Active' : 'Inactive' }}
                                    <br><strong>Start Date:</strong> {{ $subscription->start_date ?: 'N/A' }}
                                    <br><strong>End Date:</strong> {{ $subscription->end_date ?: 'N/A' }}
                                    <br><strong>Payment Date:</strong> {{ $subscription->created_at->format('M d, Y H:i') }}
                                </p>
                                <div class="d-flex align-items-center gap-2">
                                    @if($subscription->is_active)
                                        <button class="status-btn badge bg-success">Active</button>
                                    @else
                                        <button class="status-btn badge bg-secondary">Inactive</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="text-center p-4">
                                <i class="fas fa-crown fa-3x text-muted mb-3"></i>
                                <h6>No subscription payments found</h6>
                                <p class="text-muted">Subscription payments will appear here.</p>
                            </div>
                        @endforelse
                        
                        @if($subscriptionPayments->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $subscriptionPayments->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.include.footer')