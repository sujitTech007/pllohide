<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SubscriptionPurchase;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Chat;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Quotation;
use App\Models\Notification;
use App\Models\OrderPayment;

class DesignerController extends Controller
{
    public function designerLogin()
    {
        return view('login');
    }

    public function designerLoginSubmit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Dummy authentication logic (replace with real authentication)
        if ($request->email === 'designer@example.com' && $request->password === 'password') {
            // Store user information in session
            $request->session()->put('designer_logged_in', true);
            return redirect()->route('designer.dashboard');
        } else {
            return back()->withErrors(['Invalid credentials'])->withInput();
        }

        return back()->withErrors(['Invalid credentials'])->withInput();
    }
    public function designerLogout(Request $request)
    {
        // Clear the session
        Auth::logout();
        return redirect()->route('designer.login');
    }
    public function designerDashboard()
    {
        $userId = Auth::id();
        
        // Get counts for stats cards
        $quotationsCount = Quotation::where('user_id', $userId)->count();
        $ordersCount = Order::where('designer_id', $userId)->count();
        $messagesCount = Chat::where('sender_id', $userId)->orWhere('receiver_id', $userId)->count();
        $notificationsCount = Notification::where('user_id', $userId)->where('is_read', false)->count();
        
        // Get recent data
        $recentQuotations = Quotation::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        $recentOrders = Order::where('designer_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('designer.dashboard', compact(
            'quotationsCount',
            'ordersCount', 
            'messagesCount',
            'notificationsCount',
            'recentQuotations',
            'recentOrders'
        ));
    }
    public function designerProfile()
    {
        $user = auth()->user();
        $portfolios = Portfolio::where('user_id', $user->id)->get();
        return view('designer.profile', compact('user', 'portfolios'));
    }
    public function designerSupplier()
    {
        return view('designer.supplier');
    }
    public function designerManufacturer()
    {
        return view('designer.manufacturer');
    }
    public function designerRaisedRfq()
    {
        return view('designer.rfq');
    }
    public function designerReceivedQuotation()
    {
        // Get quotations that have been responded to by suppliers/manufacturers
        $quotations = Quotation::where('quotation_id', Auth::id())
            ->whereNotNull('quotation_id') // Has been responded to
            ->with(['quotationUser']) // The supplier/manufacturer who responded
            ->orderByDesc('created_at')
            ->get();
            
        return view('designer.received-quotation', compact('quotations'));
    }
    public function designerOrders()

    {
        $orders = Order::where('designer_id', Auth::id())->orderByDesc('id')->get();
        return view('designer.orders', compact('orders'));
    }
    
    public function designerOrderDetails($id)
    {
        $order = Order::where('designer_id', Auth::id())
            ->where('id', $id)
            ->with(['user'])
            ->first();
            
        return view('designer.order-details', compact('order'));
    }
    public function designerPayment()
    {
        $user = Auth::user();
        $purchase = null;
        $isActive = false;
        $daysLeft = 0;
        $statusText = 'No subscription';

        if ($user) {
            $purchase = SubscriptionPurchase::where('user_id', $user->id)
                ->orderByDesc('end_date')
                ->first();

            if ($purchase) {
                $today = Carbon::today();
                $end = $purchase->end_date ? Carbon::parse($purchase->end_date) : null;
                $isActive = (bool)$purchase->is_active && $end && $today->lte($end);
                if ($end && $today->lte($end)) {
                    $daysLeft = $today->diffInDays($end);
                }
                $statusText = $isActive ? 'Active' : 'Expired';
            }
        }

        // Get order payments made by this designer
        $orderPayments = OrderPayment::whereHas('order', function($query) {
            $query->where('designer_id', Auth::id());
        })->with(['order.vendor'])->orderByDesc('created_at')->get();

        return view('designer.payment', compact('purchase', 'isActive', 'daysLeft', 'statusText', 'orderPayments'));
    }
    public function designerNotification()
    {
        $notifications = Auth::user()->notifications()
            ->with(['fromUser'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('designer.notifications', compact('notifications'));
    }
    public function designerMessage()
    {
        $conversations = Chat::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($chat) {
                return $chat->sender_id == Auth::id() ? $chat->receiver_id : $chat->sender_id;
            })
            ->map(function($chats) {
                $latestChat = $chats->first();
                $otherUser = $latestChat->sender_id == Auth::id() ? $latestChat->receiver : $latestChat->sender;
                $unreadCount = $chats->where('receiver_id', Auth::id())->where('is_read', false)->count();
                
                return [
                    'user' => $otherUser,
                    'latest_message' => $latestChat,
                    'unread_count' => $unreadCount,
                ];
            });

        return view('designer.messages', compact('conversations'));
    }
    public function project()
    {
        $projects = Project::where('designer_id', Auth::id())->orderByDesc('id')->get();
        return view('designer.my-projects', compact('projects'));
    }

    // Route aliases used in routes/web.php
    public function rfq()
    {
          // Get quotations that have been responded to by suppliers/manufacturers
        $quotations = Quotation::where('user_id', Auth::id())
            ->whereNotNull('quotation_id') // Has been responded to
            ->with(['quotationUser']) // The supplier/manufacturer who responded
            ->orderByDesc('created_at')
            ->get();
        return view('designer.rfq', compact('quotations'));
    }

    public function message()
    {
        $conversations = Chat::where('sender_id', Auth::id())
        ->orWhere('receiver_id', Auth::id())
        ->with(['sender', 'receiver'])
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy(function($chat) {
            return $chat->sender_id == Auth::id() ? $chat->receiver_id : $chat->sender_id;
        })
        ->map(function($chats) {
            $latestChat = $chats->first();
            $otherUser = $latestChat->sender_id == Auth::id() ? $latestChat->receiver : $latestChat->sender;
            $unreadCount = $chats->where('receiver_id', Auth::id())->where('is_read', false)->count();
            
            return [
                'user' => $otherUser,
                'latest_message' => $latestChat,
                'unread_count' => $unreadCount,
            ];
        });

    return view('designer.messages', compact('conversations'));

    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'    => 'required',
            'phone'   => 'nullable',
            'address' => 'nullable',
            // 'profile_image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            // 'banner'           => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
            // 'industry_license' => 'nullable|mimes:jpg,jpeg,png,pdf|max:4096',
        ]);

        $data = $request->only(['name', 'phone', 'address','profile_image','banner','industry_license']);

        // Profile Image
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_profile.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile'), $filename);
            $data['profile_image'] = 'uploads/profile/' . $filename;
        }

        // Banner
        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = time() . '_banner.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/banner'), $filename);
            $data['banner'] = 'uploads/banner/' . $filename;
        }

        // Industry License
        if ($request->hasFile('industry_license')) {
            $file = $request->file('industry_license');
            $filename = time() . '_license.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/license'), $filename);
            $data['industry_license'] = 'uploads/license/' . $filename;
        }

        $user->update($data);
        
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

        return back()->with('success', 'Profile updated successfully.');
    }
}
