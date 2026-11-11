@include('manufacturer.include.header')

<div class="content-wrapper">

    <div class="dashboard_inner">

        <div class="heading_bx d-block">

            <h3>Payment Details</h3>

            <p class="fs-6 mt-3">View all payments received for your orders</p>

        </div>

        

        <div class="order_card p-0">

            <div class="row">

                <div class="col-lg-6">

                    <div class="list_order">

                        @forelse($orderPayments as $payment)

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

                                    <br><strong>Payment Status:</strong> {{ ucfirst($payment->status) }}

                                    <br><strong>Date:</strong> {{ $payment->created_at->format('M d, Y H:i') }}

                                </p>

                                <div class="d-flex align-items-center gap-2">

                                    @if($payment->status == 'succeeded')

                                        <span class="badge bg-success">Received</span>

                                    @elseif($payment->status == 'pending')

                                        <span class="badge bg-warning">Pending</span>

                                    @else

                                        <span class="badge bg-danger">{{ ucfirst($payment->status) }}</span>

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

                                <h6>No payments received yet</h6>

                                <p class="text-muted">Payments for your orders will appear here.</p>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<style>

.order-card {

    border: 1px solid #e0e0e0;

    border-radius: 8px;

    padding: 20px;

    margin-bottom: 15px;

    transition: box-shadow 0.2s;

}



.order-card:hover {

    box-shadow: 0 4px 8px rgba(0,0,0,0.1);

}



.totalAmount span {

    background-color: #f8f9fa;

    padding: 8px 12px;

    border-radius: 4px;

    color: #28a745;

    font-weight: bold;

}



.badge {

    font-size: 0.8em;

    padding: 6px 12px;

}

</style>



@include('manufacturer.include.footer')

