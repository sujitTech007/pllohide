@include('designer.include.header')
<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_bx">
            <h3>Order Details</h3>
            <a href="{{ route('designer.orders') }}" class="btn btn-outline-primary">← Back to Orders</a>
        </div>
        
        @if($order)
        <div class="order_card">
            <div class="row">
                <div class="col-lg-8">
                    <div class="order-details-card">
                        <div class="card-header">
                            <h5>Order Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Order ID:</strong> #{{ $order->id }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Status:</strong> 
                                    @if($order->status == 'approved')
                                        <span class="badge bg-info">Approved</span>
                                    @elseif($order->status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Vendor Type:</strong> {{ ucfirst($order->vendor_role) }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Amount:</strong> ${{ number_format((float)$order->amount, 2) }}
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Last Updated:</strong> {{ $order->updated_at->format('M d, Y H:i') }}
                                </div>
                            </div>
                            
                            @if($order->vendor)
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <strong>Vendor Details:</strong>
                                    <div class="vendor-info mt-2 p-3 bg-light rounded">
                                        <p class="mb-1"><strong>Name:</strong> {{ $order->vendor->name }}</p>
                                        <p class="mb-1"><strong>Email:</strong> {{ $order->vendor->email }}</p>
                                        @if($order->vendor->phone)
                                        <p class="mb-0"><strong>Phone:</strong> {{ $order->vendor->phone }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="order-actions-card">
                        <div class="card-header">
                            <h5>Actions</h5>
                        </div>
                        <div class="card-body">
                            @if($order->status == 'approved')
                                <form action="{{ route('order.pay', $order) }}" method="POST" class="mb-3">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100">Pay Now</button>
                                </form>
                            @endif
                            
                            <a href="" class="btn btn-outline-primary w-100 mb-2">
                                <i class="fas fa-comments"></i> Contact Vendor
                            </a>
                            
                            <button class="btn btn-outline-secondary w-100" onclick="window.print()">
                                <i class="fas fa-print"></i> Print Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-warning">
            <h5>Order Not Found</h5>
            <p>The order you're looking for doesn't exist or you don't have permission to view it.</p>
            <a href="{{ route('designer.orders') }}" class="btn btn-primary">Back to Orders</a>
        </div>
        @endif
    </div>
</div>

<style>
.order-details-card, .order-actions-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.card-header {
    padding: 15px 20px;
    border-bottom: 1px solid #eee;
    background-color: #f8f9fa;
    border-radius: 8px 8px 0 0;
}

.card-header h5 {
    margin: 0;
    color: #333;
}

.card-body {
    padding: 20px;
}

.vendor-info {
    border-left: 4px solid #007bff;
}

@media print {
    .order-actions-card, .heading_bx .btn {
        display: none !important;
    }
}
</style>

@include('designer.include.footer')
