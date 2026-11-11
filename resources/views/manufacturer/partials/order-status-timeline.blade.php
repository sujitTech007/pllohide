<div class="history-tl-container">
    <ul class="tl">
        <!-- Pending Step -->
        <li class="tl-item {{ $order->order_status == 'pending' ? 'active' : '' }}">
            <div class="timestamp">{{ $order->created_at->format('d M Y') }}</div>
            <div class="item-title">Pending</div>
        </li>
        <!-- Order Confirmed -->
        <li class="tl-item {{ in_array($order->order_status,['confirmed','shipped','out_for_delivery','delivered']) ? 'active' : '' }}">
            <div class="timestamp">{{ $order->confirmed_at?->format('d M Y') }}</div>
            <div class="item-title">Order Confirmed</div>
        </li>
        <!-- Shipped -->
        <li class="tl-item {{ in_array($order->order_status,['shipped','out_for_delivery','delivered']) ? 'active' : '' }}">
            <div class="timestamp">{{ $order->shipped_at?->format('d M Y') }}</div>
            <div class="item-title">Shipped</div>
        </li>
        <!-- Out for Delivery -->
        <li class="tl-item {{ in_array($order->order_status,['out_for_delivery','delivered']) ? 'active' : '' }}">
            <div class="timestamp">{{ $order->out_for_delivery_at?->format('d M Y') }}</div>
            <div class="item-title">Out for Delivery</div>
        </li>
        <!-- Delivered -->
        <li class="tl-item {{ $order->order_status=='delivered' ? 'active' : '' }}">
            <div class="timestamp">{{ $order->delivered_at?->format('d M Y') }}</div>
            <div class="item-title">Delivered</div>
        </li>
    </ul>
</div>
<div class="update-button d-flex align-items-center justify-content-center mt-5 ms-5">
    <select class="form-select w-50 me-2 order-status-select">
        <option value="pending" {{ $order->order_status=='pending'?'selected':'' }}>Pending</option>
        <option value="confirmed" {{ $order->order_status=='confirmed'?'selected':'' }}>Confirmed</option>
        <option value="shipped" {{ $order->order_status=='shipped'?'selected':'' }}>Shipped</option>
        <option value="out_for_delivery" {{ $order->order_status=='out_for_delivery'?'selected':'' }}>Out for Delivery</option>
        <option value="delivered" {{ $order->order_status=='delivered'?'selected':'' }}>Delivered</option>
    </select>
    <button class="btn btn-primary update-order-status-btn" data-order-id="{{ $order->id }}">Update Status</button>
</div>
