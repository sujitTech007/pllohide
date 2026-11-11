@include('admin.include.header')
<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_bx">
            <h3>Dashboard</h3>
            <p>Welcome back, Admin! Here's your system overview.</p>
        </div>
        <div class="dasp_grap">
            <div class="dash_chat_list">
                <div class="card_box">
                    <div class="cont_grp">
                        <h3>{{ $totalDesigners }}</h3>
                        <p>Total Designers</p>
                    </div>
                    <div class="card_prog">
                        <div class="percent"><svg>
                                <circle cx="39" cy="38" r="33"></circle>
                                <circle cx="39" cy="38" r="33"></circle>
                            </svg>
                            <div class="number">
                                <h3>{{ $totalDesigners > 0 ? round(($totalDesigners / $totalUsers) * 100) : 0 }}<span>%</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card_box">
                    <div class="cont_grp">
                        <h3>{{ $totalSuppliers }}</h3>
                        <p>Total Suppliers</p>
                    </div>
                    <div class="card_prog">
                        <div class="percent"><svg>
                                <circle cx="39" cy="38" r="33"></circle>
                                <circle cx="39" cy="38" r="33"></circle>
                            </svg>
                            <div class="number">
                                <h3>{{ $totalSuppliers > 0 ? round(($totalSuppliers / $totalUsers) * 100) : 0 }}<span>%</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card_box">
                    <div class="cont_grp">
                        <h3>{{ $totalManufacturers }}</h3>
                        <p>Total Manufacturers</p>
                    </div>
                    <div class="card_prog">
                        <div class="percent"><svg>
                                <circle cx="39" cy="38" r="33"></circle>
                                <circle cx="39" cy="38" r="33"></circle>
                            </svg>
                            <div class="number">
                                <h3>{{ $totalManufacturers > 0 ? round(($totalManufacturers / $totalUsers) * 100) : 0 }}<span>%</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card_box">
                    <div class="cont_grp">
                        <h3>{{ $totalQuotations }}</h3>
                        <p>Total Quotations</p>
                    </div>
                    <div class="card_prog">
                        <div class="percent"><svg>
                                <circle cx="39" cy="38" r="33"></circle>
                                <circle cx="39" cy="38" r="33"></circle>
                            </svg>
                            <div class="number">
                                <h3>{{ $totalQuotations > 0 ? round(($totalQuotations / max($totalUsers, 1)) * 100) : 0 }}<span>%</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card_box">
                    <div class="cont_grp">
                        <h3>{{ $totalOrders }}</h3>
                        <p>Total Orders</p>
                    </div>
                    <div class="card_prog">
                        <div class="percent"><svg>
                                <circle cx="39" cy="38" r="33"></circle>
                                <circle cx="39" cy="38" r="33"></circle>
                            </svg>
                            <div class="number">
                                <h3>{{ $totalOrders > 0 ? round(($totalOrders / max($totalQuotations, 1)) * 100) : 0 }}<span>%</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card_box">
                    <div class="cont_grp">
                        <h3>{{ $totalPayments }}</h3>
                        <p>Total Payments</p>
                    </div>
                    <div class="card_prog">
                        <div class="percent"><svg>
                                <circle cx="39" cy="38" r="33"></circle>
                                <circle cx="39" cy="38" r="33"></circle>
                            </svg>
                            <div class="number">
                                <h3>{{ $totalPayments > 0 ? round(($totalPayments / max($totalOrders, 1)) * 100) : 0 }}<span>%</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="grp_card">
                        <!-- <div class="hd_title">
                            <h3>Recent Activity</h3>
                        </div> -->
                        <div class="grp_data">
                            <div class="recent-activity p-0">
                                <h5>Recent Orders</h5>
                                @forelse($recentOrders as $order)
                                <div class="activity-item">
                                    <div class="activity-icon">
                                        <i class="fas fa-shopping-cart text-primary"></i>
                                    </div>
                                    <div class="activity-content">
                                        <h6>Order #{{ $order->id }}</h6>
                                        <p class="text-muted mb-1">
                                            Designer: {{ $order->designer->name ?? 'Unknown' }} → 
                                            {{ ucfirst($order->vendor_role) }}: {{ $order->vendor->name ?? 'Unknown' }}
                                        </p>
                                        <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="activity-status">
                                        <span class="badge bg-info p-2">${{ number_format($order->amount, 2) }}</span>
                                    </div>
                                </div>
                                @empty
                                <p class="text-center text-muted">No recent orders</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="Sub_sect">
                        <h3>System Overview</h3>
                        <div class="stats-overview pt-0 ">
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-users text-primary"></i>
                                </div>
                                <div class="stat-content">
                                    <h4>{{ $totalUsers }}</h4>
                                    <p>Total Users</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-file-invoice text-success"></i>
                                </div>
                                <div class="stat-content">
                                    <h4>{{ $totalQuotations }}</h4>
                                    <p>Total Quotations</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-shopping-cart text-info"></i>
                                </div>
                                <div class="stat-content">
                                    <h4>{{ $totalOrders }}</h4>
                                    <p>Total Orders</p>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-credit-card text-warning"></i>
                                </div>
                                <div class="stat-content">
                                    <h4>{{ $totalPayments }}</h4>
                                    <p>Total Payments</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.recent-activity {
    padding: 20px;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    background-color: #f8f9fa;
}

.activity-content {
    flex-grow: 1;
}

.activity-content h6 {
    margin: 0 0 5px 0;
    color: #333;
}

.activity-status {
    margin-left: 15px;
}

.stats-overview {
    padding: 20px;
}

.stat-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.stat-item:last-child {
    border-bottom: none;
}

.stat-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    background-color: #f8f9fa;
}

.stat-icon i {
    font-size: 18px;
}

.stat-content h4 {
    margin: 0 0 5px 0;
    color: #333;
    font-size: 24px;
    font-weight: bold;
}

.stat-content p {
    margin: 0;
    color: #666;
    font-size: 14px;
}
</style>

@include('admin.include.footer')