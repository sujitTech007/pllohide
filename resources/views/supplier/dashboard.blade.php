@include('supplier.include.header')
<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_bx">
            <h3>Dashboard</h3>
            <p>Welcome back, {{ Auth::user()->name }}!</p>
        </div>
        
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats_card">
                    <div class="stats_icon">
                        <i class="fas fa-file-invoice text-primary"></i>
                    </div>
                    <div class="stats_content">
                        <h4>{{ $quotationsCount }}</h4>
                        <p>Received Quotations</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats_card">
                    <div class="stats_icon">
                        <i class="fas fa-shopping-cart text-success"></i>
                    </div>
                    <div class="stats_content">
                        <h4>{{ $ordersCount }}</h4>
                        <p>Total Orders</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats_card">
                    <div class="stats_icon">
                        <i class="fas fa-comments text-info"></i>
                    </div>
                    <div class="stats_content">
                        <h4>{{ $messagesCount }}</h4>
                        <p>Messages</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="stats_card">
                    <div class="stats_icon">
                        <i class="fas fa-bell text-warning"></i>
                    </div>
                    <div class="stats_content">
                        <h4>{{ $notificationsCount }}</h4>
                        <p>Notifications</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="dashboard_card">
                    <div class="card_header">
                        <h5>Recent Quotations</h5>
                        <a href="{{ route('supplier.received.quotation') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card_body">
                        @forelse($recentQuotations as $quotation)
                            <div class="activity_item">
                                <div class="activity_icon">
                                    <i class="fas fa-file-invoice text-primary"></i>
                                </div>
                                <div class="activity_content">
                                    <h6>{{ $quotation->product_category }}</h6>
                                    <p class="text-muted mb-1">From: {{ $quotation->user->name ?? 'Unknown Designer' }}</p>
                                    <small class="text-muted">{{ $quotation->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="activity_status">
                                    <span class="badge bg-info">{{ $quotation->quote_id }}</span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center p-4">
                                <i class="fas fa-file-invoice fa-3x text-muted mb-3"></i>
                                <h6>No quotations received yet</h6>
                                <p class="text-muted">Designers will send quotation requests here.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="dashboard_card">
                    <div class="card_header">
                        <h5>Recent Orders</h5>
                        <a href="{{ route('supplier.order') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card_body">
                        @forelse($recentOrders as $order)
                            <div class="activity_item">
                                <div class="activity_icon">
                                    <i class="fas fa-shopping-cart text-success"></i>
                                </div>
                                <div class="activity_content">
                                    <h6>Order #{{ $order->id }}</h6>
                                    <p class="text-muted mb-1">From: {{ $order->designer->name ?? 'Unknown Designer' }}</p>
                                    <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                                </div>
                                <div class="activity_status">
                                    @if($order->status == 'approved')
                                        <span class="badge bg-info">Approved</span>
                                    @elseif($order->status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center p-4">
                                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <h6>No orders yet</h6>
                                <p class="text-muted">Your orders will appear here.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-lg-12">
                <div class="dashboard_card">
                    <div class="card_header">
                        <h5>Quick Actions</h5>
                    </div>
                    <div class="card_body">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="{{ route('supplier.received.quotation') }}" class="quick_action_card">
                                    <div class="quick_action_icon">
                                        <i class="fas fa-file-invoice text-primary"></i>
                                    </div>
                                    <h6>View Quotations</h6>
                                    <p class="text-muted">Check received quotations</p>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="{{ route('supplier.message') }}" class="quick_action_card">
                                    <div class="quick_action_icon">
                                        <i class="fas fa-comments text-info"></i>
                                    </div>
                                    <h6>Messages</h6>
                                    <p class="text-muted">View conversations</p>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="{{ route('supplier.order') }}" class="quick_action_card">
                                    <div class="quick_action_icon">
                                        <i class="fas fa-shopping-cart text-success"></i>
                                    </div>
                                    <h6>Orders</h6>
                                    <p class="text-muted">Track your orders</p>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <a href="{{ route('supplier.profile') }}" class="quick_action_card">
                                    <div class="quick_action_icon">
                                        <i class="fas fa-user text-warning"></i>
                                    </div>
                                    <h6>Profile</h6>
                                    <p class="text-muted">Update your profile</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.stats_card {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    transition: transform 0.2s;
}

.stats_card:hover {
    transform: translateY(-2px);
}

.stats_icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    background-color: #f8f9fa;
}

.stats_icon i {
    font-size: 24px;
}

.stats_content h4 {
    font-size: 28px;
    font-weight: bold;
    margin: 0;
    color: #333;
}

.stats_content p {
    margin: 0;
    color: #666;
    font-size: 14px;
}

.dashboard_card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card_header {
    padding: 20px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card_header h5 {
    margin: 0;
    color: #333;
}

.card_body {
    padding: 20px;
}

.activity_item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.activity_item:last-child {
    border-bottom: none;
}

.activity_icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    background-color: #f8f9fa;
}

.activity_content {
    flex-grow: 1;
}

.activity_content h6 {
    margin: 0 0 5px 0;
    color: #333;
}

.activity_status {
    margin-left: 15px;
}

.quick_action_card {
    display: block;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    text-decoration: none;
    color: inherit;
    transition: transform 0.2s;
    text-align: center;
}

.quick_action_card:hover {
    transform: translateY(-2px);
    text-decoration: none;
    color: inherit;
}

.quick_action_icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    background-color: #f8f9fa;
}

.quick_action_icon i {
    font-size: 24px;
}

.quick_action_card h6 {
    margin: 0 0 10px 0;
    color: #333;
}

.quick_action_card p {
    margin: 0;
    color: #666;
    font-size: 14px;
}
</style>

@include('supplier.include.footer')
