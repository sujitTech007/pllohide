@include('admin.include.header')
<div class="content-wrapper">
    <div class="dashboard_inner earningPage">
        <div class="heading_bx">
            <h3>Earnings Overview</h3>
        </div>

        <!-- Earnings Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-primary">Total Supplier Earnings</h4>
                        <h2>CAD {{ number_format($totalSupplierEarnings, 2) }}</h2>
                        <p>From {{ $supplierEarnings->count() }} completed orders</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-success">Total Manufacturer Earnings</h4>
                        <h2>CAD {{ number_format($totalManufacturerEarnings, 2) }}</h2>
                        <p>From {{ $manufacturerEarnings->count() }} completed orders</p>
                    </div>
                </div>
            </div>
        </div>





        <div class="dashboard_inner">
            <div class="heading_bx">
                <h3>Supplier Earnings</h3>
            </div>
        <div class="task_frm form_table">
            <div class="tabel_scoller">
                <table class="table">
                    <thead>
                        <tr>
                             <th>Order ID</th>
                                <th>Supplier</th>
                                <th>Designer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($supplierEarnings as $order)
                            <tr>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->vendor->name ?? 'N/A' }}</td>
                                <td>{{ $order->designer->name ?? 'N/A' }}</td>
                                <td>CAD {{ number_format($order->amount, 2) }}</td>
                                <td>
                                    <span class="badge {{ $order->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>


        
        <!-- <div class="card mb-4">
            <div class="card-header">
                <h4>Supplier Earnings</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Supplier</th>
                                <th>Designer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($supplierEarnings as $order)
                            <tr>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->vendor->name ?? 'N/A' }}</td>
                                <td>{{ $order->designer->name ?? 'N/A' }}</td>
                                <td>CAD {{ number_format($order->amount, 2) }}</td>
                                <td>
                                    <span class="badge {{ $order->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->



         <!-- Manufacturer Earnings Section -->
        <div class="dashboard_inner">
            <div class="heading_bx">
                <h3>Manufacturer Earnings</h3>
            </div>
        <div class="task_frm form_table">
            <div class="tabel_scoller">
                <table class="table">
                    <thead>
                        <tr>
                             <th>Order ID</th>
                                <th>Manufacturer</th>
                                <th>Designer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach($manufacturerEarnings as $order)
                            <tr>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->vendor->name ?? 'N/A' }}</td>
                                <td>{{ $order->designer->name ?? 'N/A' }}</td>
                                <td>CAD {{ number_format($order->amount, 2) }}</td>
                                <td>
                                    <span class="badge {{ $order->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>

    

       
        <!-- <div class="card mb-4">
            <div class="card-header">
                <h4>Manufacturer Earnings</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Manufacturer</th>
                                <th>Designer</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($manufacturerEarnings as $order)
                            <tr>
                                <td>{{ $order->order_id }}</td>
                                <td>{{ $order->vendor->name ?? 'N/A' }}</td>
                                <td>{{ $order->designer->name ?? 'N/A' }}</td>
                                <td>CAD {{ number_format($order->amount, 2) }}</td>
                                <td>
                                    <span class="badge {{ $order->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->

        <!-- Payments History Section -->
        <div class="card border-0">
              <div class="dashboard_inner">
            <div class="heading_bx">
                <h3>Recent Payments</h3>
            </div>
</div>
           
            <div class="card-body">
                <ul class="nav nav-tabs" id="paymentsTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="supplier-tab" data-bs-toggle="tab" data-bs-target="#supplier-payments" type="button" role="tab">
                            Supplier Payments
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="manufacturer-tab" data-bs-toggle="tab" data-bs-target="#manufacturer-payments" type="button" role="tab">
                            Manufacturer Payments
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="paymentsTabContent">
                    <!-- Supplier Payments Tab -->
                    <div class="tab-pane fade show active" id="supplier-payments" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Payment ID</th>
                                        <th>Order ID</th>
                                        <th>Supplier</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($supplierPayments as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->order->order_id }}</td>
                                        <td>{{ $payment->order->vendor->name ?? 'N/A' }}</td>
                                        <td>CAD {{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ $payment->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Manufacturer Payments Tab -->
                    <div class="tab-pane fade" id="manufacturer-payments" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Payment ID</th>
                                        <th>Order ID</th>
                                        <th>Manufacturer</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($manufacturerPayments as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->order->order_id }}</td>
                                        <td>{{ $payment->order->vendor->name ?? 'N/A' }}</td>
                                        <td>CAD {{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ $payment->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.include.footer')