@include('admin.include.header')
<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_bx">
            <h3>Orders</h3>
            <div class="search_bar"><label for="">Search</label><input type="text"
                    class="form-control" placeholder="Search"><span><svg
                        xmlns="http://www.w3.org/2000/svg" width="22" height="23"
                        viewBox="0 0 22 23" fill="none">

                        <path
                            d="M16.994 16.1715L21 20.1765L19.6765 21.5L15.6715 17.494C14.1813 18.6887 12.3278 19.3384 10.4178 19.3357C5.77119 19.3357 2 15.5645 2 10.9178C2 6.27119 5.77119 2.5 10.4178 2.5C15.0645 2.5 18.8357 6.27119 18.8357 10.9178C18.8384 12.8278 18.1887 14.6813 16.994 16.1715ZM15.1178 15.4775C16.3048 14.2568 16.9677 12.6205 16.965 10.9178C16.965 7.30004 14.0347 4.37063 10.4178 4.37063C6.80004 4.37063 3.87063 7.30004 3.87063 10.9178C3.87063 14.5347 6.80004 17.465 10.4178 17.465C12.1205 17.4677 13.7568 16.8048 14.9775 15.6178L15.1178 15.4775Z"
                            fill="#828282"></path>

                        <defs>
                            <clipPath id="clip0_15840_2832">
                                <rect width="22" height="22" fill="white"
                                    transform="translate(0 0.5)"></rect>
                            </clipPath>
                        </defs>
                    </svg></span></div>
        </div>
        <div class="order_card">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="list_order">
                        @forelse($orders as $order)
                        <div class="order-card mt-3 bg-white">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="text-secondary">Order ID: </span>
                                    <strong>#{{ $order->id }}</strong>
                                </div>
                                <div class="totalAmount">
                                    <label class="text-secondary fw-bold">Amount</label>
                                    <span class="border rounded fw-bold border-0">$ {{ number_format((float)$order->amount, 2) }}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="mb-1">
                                    <strong>Designer:</strong> {{ $order->designer->name ?? 'Unknown Designer' }}
                                    <br><strong>Vendor:</strong> {{ $order->vendor->name ?? 'Unknown Vendor' }} ({{ ucfirst($order->vendor_role) }})
                                    <br><strong>Status:</strong> {{ ucfirst($order->status) }}
                                    <br><strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}
                                </p>
                                <div class="d-flex align-items-center gap-2">
                                    @if($order->status == 'approved')
                                        <button class="status-btn badge bg-info">Approved</button>
                                    @elseif($order->status == 'paid')
                                        <button class="status-btn badge bg-success">Paid</button>
                                    @else
                                        <button class="status-btn badge bg-secondary">{{ ucfirst($order->status) }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="text-center p-4">
                                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <h6>No orders found</h6>
                                <p class="text-muted">Orders will appear here when users create them.</p>
                            </div>
                        @endforelse
                        
                        @if($orders->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $orders->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.include.footer')