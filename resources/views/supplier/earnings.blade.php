@include('supplier.include.header')
<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_bx">
            <h3>Earnings</h3>
            <div class="total-earnings">
                <h4>Total Earnings: <span>CAD {{ number_format($totalEarnings, 2) }}</span></h4>
            </div>
        </div>
        <div class="order_card">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="list_order">
                        @foreach($orders as $order)
                        <div class="order-card {{ !$loop->first ? 'mt-4' : '' }} {{ $loop->odd ? 'bg-white' : '' }}">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="text-secondary">Order ID: </span>
                                    <strong>{{ $order->order_id }}</strong>
                                </div>
                                <div class="totalAmount">
                                    <label class="text-secondary fw-bold">Amount</label>
                                    <span class="border rounded fw-bold border-0">CAD
                                        {{ number_format($order->amount, 2) }}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="mb-1">
                                    <strong>Order Date:</strong> {{ $order->created_at->format('M d, Y') }}
                                    <br><strong>Status:</strong> {{ ucfirst($order->status) }}
                                </p>
                                <button class="status-btn {{ $order->status == 'paid' ? 'bg-success' : 'btn-ongoing' }}">
                                    {{ ucfirst($order->status) }}
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 d-flex justify-content-end">
                    <div class="earnings_summary">
                        <div class="card">
                            <div class="card-header">
                                <h4>Earnings Summary</h4>
                            </div>
                            <div class="card-body">
                                <div class="total-stats">
                                    <h3>Total Completed Orders: <span>{{ $orders->where('status', 'paid')->count() }}</span></h3>
                                    <h3>Total Amount Earned: <span>CAD {{ number_format($totalEarnings, 2) }}</span></h3>
                                </div>
                                
                                <div class="payment-history mt-4">
                                    <h4>Recent Payments</h4>
                                    @foreach($payments->take(5) as $payment)
                                    <div class="payment-item">
                                        <div class="d-flex justify-content-between align-items-center flex-wrap flex-column gap-3">
                                            <div>
                                                <p class="mb-0"><strong>Order ID:</strong> {{ $payment->order->order_id }}</p>
                                                <small>{{ $payment->created_at->format('M d, Y') }}</small>
                                            </div>
                                            <div class="amount">
                                                <span>CAD {{ number_format($payment->amount, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('supplier.include.footer')