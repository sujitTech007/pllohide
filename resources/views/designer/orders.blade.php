@include('designer.include.header')
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
                        <div class="order-card mt-3 bg-white order-select" data-order-id="{{ $order->id }}">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <span class="text-secondary">Order ID: </span>
                                        <strong><a href="{{ route('designer.order.details', $order->id) }}">#{{ $order->id }}</a></strong>
                                    </div>
                                <div class="totalAmount">
                                    <label class="text-secondary fw-bold">Amount</label>
                                    <span class="border rounded fw-bold border-0">$ {{ number_format((float)$order->amount,2) }}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <p class="mb-1"><strong>Vendor:</strong> {{ ucfirst($order->vendor_role) }}
                                    <br><strong>Status:</strong> {{ ucfirst($order->status) }}
                                </p>
                                <div class="d-flex align-items-center gap-2">
                                    @if($order->status === 'approved')
                                        <span class="badge bg-info">Quotation Approved</span>
                                        <form action="{{ route('order.pay', $order) }}" method="POST">
                                            @csrf
                                            <button class="status-btn btn-ongoing">Pay Now</button>
                                        </form>
                                    @elseif($order->status === 'paid')
                                        <button class="status-btn badge bg-success text-success bg-opacity-25">Paid</button>
                                    @else
                                        <button class="status-btn badge bg-secondary">{{ ucfirst($order->status) }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                            <p class="text-center mt-4">No orders yet.</p>
                        @endforelse
                    </div>
                </div>
                 <div class="col-lg-6 col-md-12 col-sm-12">
                        <div id="order-details">
                            <div class="text-center p-4 text-muted">Select an order to view details and update status.</div>
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


 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
                // Show timeline for first order by default
                var firstOrder = $('.order-select').first();
                if (firstOrder.length) {
                    firstOrder.click();
                }


            // Load order timeline and details on click
            $(document).on('click', '.order-select', function() {
                var orderId = $(this).data('order-id');

                $('.order-select').removeClass('selected');
                $(this).addClass('selected');

                $.ajax({
                    url: '{{ route("supplier.order.status") }}',
                    method: 'GET',
                    data: {
                        order_id: orderId
                    },
                    success: function(response) {
                        // Expect response to contain HTML for timeline and status update UI
                        $('#order-details').html(response.html);
                    },
                    error: function() {
                        $('#order-details').html('<div class="text-danger p-4">Failed to load order details.</div>');
                    }
                });
            });

            // Update status for dynamically loaded button
            $(document).on('click', '.update-order-status-btn', function() {
                var orderId = $(this).data('order-id');
                var newStatus = $(this).siblings('.order-status-select').val(); // get value from sibling select

                $.ajax({
                    url: '{{ route("supplier.order.updateStatus") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        order_id: orderId,
                        status: newStatus
                    },
                    success: function(response) {
                        // alert('Order status updated!');
                        // Update left side status
                        $('.order-select[data-order-id="' + orderId + '"] .order-status-text').text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1));

                        // Reload timeline for this order
                        $('.order-select[data-order-id="' + orderId + '"]').click();
                    }
                });
            });

        });
    </script>



@include('designer.include.footer')