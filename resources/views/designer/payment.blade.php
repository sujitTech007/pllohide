@include('designer.include.header')
                        <div class="content-wrapper">
                            <div class="dashboard_inner">
                                <div class="heading_bx">
                                    <h3>Payments</h3>
                                    @if(isset($purchase))
                                        <div class="alert {{ $isActive ? 'alert-success' : 'alert-danger' }} mt-2">
                                            <strong>Status:</strong> {{ $statusText }}
                                            @if($isActive)
                                                <span class="ms-3"><strong>Days left:</strong> {{ $daysLeft }}</span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="alert alert-warning mt-2">No subscription found.</div>
                                    @endif
                                    
                                </div>
                                <div class="order_card">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 col-sm-12">
                                            <div class="list_order">
                                                <h5 class="mb-3">Order Payments</h5>
                                                @forelse($orderPayments as $payment)
                                                <div class="order-card mt-3 bg-white">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <div>
                                                            <span class="text-secondary">Order ID: </span>
                                                            <strong>#{{ $payment->order->order_id ?? $payment->order->id }}</strong>
                                                        </div>
                                                        <div class="totalAmount">
                                                            <label class="text-secondary fw-bold">Amount</label>
                                                            <span class="border rounded fw-bold border-0">$ {{ number_format((float)$payment->amount, 2) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <p class="mb-1">
                                                            <strong>Vendor:</strong> {{ $payment->order->vendor->name ?? ucfirst($payment->order->vendor_role) }}
                                                            <br><strong>Payment Status:</strong> {{ ucfirst($payment->status) }}
                                                            <br><strong>Date:</strong> {{ $payment->created_at->format('M d, Y') }}
                                                        </p>
                                                        <div class="d-flex align-items-center gap-2">
                                                            @if($payment->status == 'succeeded')
                                                                <button class="status-btn badge bg-success">Paid</button>
                                                            @elseif($payment->status == 'pending')
                                                                <button class="status-btn badge bg-warning">Pending</button>
                                                            @else
                                                                <button class="status-btn badge bg-danger">{{ ucfirst($payment->status) }}</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @empty
                                                    <div class="text-center p-4">
                                                        <i class="fas fa-credit-card fa-3x text-muted mb-3"></i>
                                                        <h6>No order payments yet</h6>
                                                        <p class="text-muted">Your order payments will appear here.</p>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 d-flex justify-content-end">
                                              <div class="paymentBox-card">
    @if(isset($purchase))
        <p class="text-center mb-2">Invoice No: <strong>{{ $purchase->id }}</strong></p>
        <h5 class="text-center fw-bold mb-3">Total Paid: $ {{ number_format((float)($purchase->price ?? 0), 2) }}</h5>
        <div class="payment-header">Payment Details</div>
        <div class="d-flex justify-content-between mb-2">
          <span>Start Date</span>
          <strong>{{ $purchase->start_date ?: '-' }}</strong>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>End Date</span>
          <strong>{{ $purchase->end_date ?: '-' }}</strong>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>Payment Status</span>
          <strong>{{ ucfirst($purchase->payment_status) }}</strong>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>Subscription</span>
          <strong>{{ $isActive ? 'Active' : 'Expired' }}</strong>
        </div>
       {{-- @if(!$isActive)
            <form action="{{ route('subscribe.designer') }}" method="POST" class="mt-3 text-center">
                @csrf
                <button type="submit" class="btn btn-primary">Renew Plan ($299)</button>
            </form>
        @endif--}}
    @else
        <!-- <p class="text-center mb-2">No past payments</p>
        <form action="{{ route('subscribe.designer') }}" method="POST" class="mt-3 text-center">
            @csrf
            <button type="submit" class="btn btn-primary">Purchase Plan ($299)</button>
        </form> -->
    @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

@include('designer.include.footer')