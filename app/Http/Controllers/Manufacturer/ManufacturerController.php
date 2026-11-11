<?php

namespace App\Http\Controllers\Manufacturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;
use App\Models\Quotation;
use App\Models\Order;
use App\Models\Chat;
use App\Models\Notification;
use App\Models\OrderPayment;

class ManufacturerController extends Controller
{
    public function manufacturerLogin()
    {
        return view('login');
    }

    public function dash()
    {
        $userId = Auth::id();

        // Get counts for stats cards
        $quotationsCount = Quotation::where('quotation_id', $userId)->count();
        $ordersCount = Order::where('vendor_id', $userId)->where('vendor_role', 'supplier')->count();
        $messagesCount = Chat::where('sender_id', $userId)->orWhere('receiver_id', $userId)->count();
        $notificationsCount = Notification::where('user_id', $userId)->where('is_read', false)->count();

        // Get recent data
        $recentQuotations = Quotation::where('quotation_id', $userId)
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentOrders = Order::where('vendor_id', $userId)
            ->where('vendor_role', 'supplier')
            ->with(['designer'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('manufacturer.dashboard', compact(
            'quotationsCount',
            'ordersCount',
            'messagesCount',
            'notificationsCount',
            'recentQuotations',
            'recentOrders'
        ));
    }


    public function manufacturerDashboard()
    {
        $user = auth()->user();
        $company = Company::where('user_id', $user->id)->first();
        $portfolios = Portfolio::where('user_id', $user->id)->get();
        return view('manufacturer.profile', compact('user', 'company', 'portfolios'));
    }

    public function manufacturerProfile()
    {
        $user = auth()->user();
        $company = Company::where('user_id', $user->id)->first();
        $portfolios = Portfolio::where('user_id', $user->id)->get();
        return view('manufacturer.profile', compact('user', 'company', 'portfolios'));
    }

    public function manufacturerRfq()
    {
        $quotations = Quotation::where('user_id', Auth::id())
            ->whereNotNull('quotation_id') // Has been responded to
            ->with(['quotationUser']) // The supplier/manufacturer who responded
            ->orderByDesc('created_at')
            ->get();
        return view('manufacturer.rfq', compact('quotations'));
    }
    public function manufacturerReceivedQuotation()
    {
        $quotations = Quotation::where('quotation_id', Auth::id())
            ->whereNotNull('quotation_id') // Has been responded to
            ->with(['quotationUser']) // The supplier/manufacturer who responded
            ->orderByDesc('created_at')
            ->get();
        return view('manufacturer.sent-quotation', compact('quotations'));
    }

    public function approveQuotation(Request $request, Quotation $quotation)
    {
        $user = Auth::user();
        if ((int)$user->role !== 3) {
            abort(403);
        }
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);
        $order = Order::create([
            'order_id' => 'PLHD' . str_pad($quotation->id, 4, '0', STR_PAD_LEFT),
            'quotation_id' => $quotation->id,
            'designer_id' => $quotation->user_id,
            'vendor_id' => $user->id,
            'vendor_role' => 'manufacturer',
            'amount' => (float) $request->input('amount'),
            'status' => 'approved',
        ]);

        $quotation = Quotation::find($quotation->id);
        $quotation->status = '1';
        $quotation->save();

        return back()->with('success', 'Quotation approved. Order created: #' . $order->id);
    }
    public function manufacturerOrder()
    {
        $orders = Order::where('vendor_id', Auth::id())
            ->where('vendor_role', 'manufacturer')
            ->with(['designer'])
            ->orderByDesc('created_at')
            ->get();

        return view('manufacturer.orders', compact('orders'));
    }
    public function manufacturerPayment()
    {
        // Get order payments where this manufacturer is the vendor
        $orderPayments = OrderPayment::whereHas('order', function ($query) {
            $query->where('vendor_id', Auth::id())
                ->where('vendor_role', 'manufacturer');
        })->with(['order.designer'])->orderByDesc('created_at')->get();

        return view('manufacturer.payment', compact('orderPayments'));
    }
    public function manufacturerProject()
    {
        return view('manufacturer.my-projects');
    }
    public function manufacturerEarning()
    {
        $user = Auth::user();
        $orders = Order::where('vendor_id', $user->id)
            ->where('vendor_role', 'manufacturer')
            ->where('status', 'paid')
            ->with(['designer'])
            ->get();

        $totalEarnings = $orders->sum('amount');

        $payments = OrderPayment::whereHas('order', function ($query) use ($user) {
            $query->where('vendor_id', $user->id)
                ->where('vendor_role', 'manufacturer');
        })
            ->where('status', 'succeeded')
            ->with('order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('manufacturer.earnings', [
            'orders' => $orders,
            'totalEarnings' => $totalEarnings,
            'payments' => $payments
        ]);
    }
    public function manufacturerMessage()
    {
        $conversations = Chat::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($chat) {
                return $chat->sender_id == Auth::id() ? $chat->receiver_id : $chat->sender_id;
            })
            ->map(function ($chats) {
                $latestChat = $chats->first();
                $otherUser = $latestChat->sender_id == Auth::id() ? $latestChat->receiver : $latestChat->sender;
                $unreadCount = $chats->where('receiver_id', Auth::id())->where('is_read', false)->count();

                return [
                    'user' => $otherUser,
                    'latest_message' => $latestChat,
                    'unread_count' => $unreadCount,
                ];
            });

        return view('manufacturer.messages', compact('conversations'));
    }
    public function manufacturerNotification()
    {
        $notifications = Auth::user()->notifications()
            ->with(['fromUser'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('manufacturer.notifications', compact('notifications'));
    }
    public function manufacturerLogout()
    {
        Auth::logout();
        return redirect()->route('manufacturer.login');
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();

        // ✅ Validate data
        // $request->validate([
        //     // Personal Info
        //     'name'       => 'required|string|max:255',
        //     'email'      => 'required|email|unique:users,email,' . $user->id,
        //     'phone'      => 'nullable|string|max:20',
        //     'about'      => 'nullable|string|max:1000',

        //     // Business Info
        //     'company_name'     => 'required|string|max:255',
        //     'website'          => 'nullable|url|max:255',
        //     'address'          => 'nullable|string|max:500',
        //     'license'          => 'nullable|string|max:255',
        //     'company_image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'banner_image'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',

        //     // Portfolio Info (multiple entries)
        //     'portfolio_name.*'  => 'nullable|string|max:255',
        //     'portfolio_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'portfolio_status.*'=> 'nullable|in:0,1',
        // ]);

        /** --------------------
         * 1. Save Personal Info
         * ------------------- */
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_profile.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile'), $filename);
            $profileImagePath = 'uploads/profile/' . $filename;
        } else {
            $profileImagePath = $user->profile_image; // keep existing image if none uploaded
        }


        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'about' => $request->about,
            'profile_image' => $profileImagePath,
        ]);

        /** --------------------
         * 2. Save Business Info
         * ------------------- */
        $company = Company::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_role'    => $user->role ?? null,
                'name'         => $request->company_name,
                'website'      => $request->website,
                'business_experience'      => $request->business_experience,
                'address'      => $request->business_address,
                'license'      => $request->license,
            ]
        );

        // Company Logo Upload
        if ($request->hasFile('company_image')) {
            $file = $request->file('company_image');
            $filename = time() . '_profile.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/company'), $filename);
            $company->image = 'uploads/company/' . $filename;
        }

        // Banner
        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $filename = time() . '_banner.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/company-banner'), $filename);
            $company->banner_image = 'uploads/company-banner/' . $filename;
        }

        $company->save();

        /** --------------------
         * 3. Save Portfolio Info
         * ------------------- */

        $portfolioImages = $request->file('portfolio_image', []);
        foreach ($request->portfolio_name as $index => $name) {
            if ($name) {
                $portfolio = new Portfolio();
                $portfolio->user_id   = $user->id;
                $portfolio->user_role = $user->role ?? null;
                $portfolio->name      = $name;
                $portfolio->category      = $request->category[$index] ?? null;
                $portfolio->product_detail = $request->product_detail[$index] ?? null;
                $portfolio->status    = $request->portfolio_status[$index] ?? 1;

                if (isset($portfolioImages[$index]) && $portfolioImages[$index]->isValid()) {
                    $file = $portfolioImages[$index];
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('portfolios'), $fileName);
                    $portfolio->image = $fileName;
                }

                $portfolio->save();
            }
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }





    public function getOrderStatus(Request $request)
    {
        $order = Order::find($request->order_id);
        if (!$order) {
            return response()->json(['html' => '<div class="text-danger p-4">Order not found.</div>']);
        }
        $html = view('supplier.partials.order-status-timeline', compact('order'))->render();
        return response()->json(['html' => $html]);
    }

    // Update order status
    public function updateOrderStatus(Request $request)
    {
        $order = Order::find($request->order_id);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found']);
        }

        $order->order_status = $request->status;

        // Set timestamps for each status checkpoint
        switch ($request->status) {
            case 'pending':
                // Optional: reset all other timestamps
                $order->confirmed_at = null;
                $order->shipped_at = null;
                $order->out_for_delivery_at = null;
                $order->delivered_at = null;
                break;

            case 'confirmed':
                $order->confirmed_at = $order->confirmed_at ?? now();
                break;

            case 'shipped':
                $order->confirmed_at = $order->confirmed_at ?? now();
                $order->shipped_at = now();
                break;

            case 'out_for_delivery':
                $order->confirmed_at = $order->confirmed_at ?? now();
                $order->shipped_at = $order->shipped_at ?? now();
                $order->out_for_delivery_at = now();
                break;

            case 'delivered':
                $order->confirmed_at = $order->confirmed_at ?? now();
                $order->shipped_at = $order->shipped_at ?? now();
                $order->out_for_delivery_at = $order->out_for_delivery_at ?? now();
                $order->delivered_at = now();
                break;
        }

        $order->save();

        return response()->json(['success' => true]);
    }
}
