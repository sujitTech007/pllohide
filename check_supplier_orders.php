<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$user = App\Models\User::find(90);
if ($user) {
    echo "USER: id={$user->id} role={$user->role} name={$user->name}\n";
} else {
    echo "USER: not found\n";
}
$orders = App\Models\Order::where('designer_id', 90)->where('vendor_role', 'manufacturer')->where('status', 'approved')->get();
echo "approved_orders_for_designer_90=".count($orders)."\n";
foreach ($orders as $o) {
    echo "order={$o->id} order_id={$o->order_id} vendor_id={$o->vendor_id} amount={$o->amount} status={$o->status}\n";
}
