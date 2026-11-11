<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$approved = App\Models\Order::where('vendor_role', 'manufacturer')->where('status', 'approved')->count();
echo "approved_manufacturer_orders={$approved}\n";
$purchaseOrders = App\Models\Order::where('vendor_role', 'manufacturer')->where('status', 'approved')->take(5)->get();
foreach ($purchaseOrders as $o) {
    echo "order={$o->id}, order_id={$o->order_id}, designer_id={$o->designer_id}, vendor_id={$o->vendor_id}, amount={$o->amount}\n";
}
