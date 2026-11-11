<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\company;
use App\Models\Post;
use App\Models\Chat;
use App\Models\Survey;
use App\Models\Quotation;
use App\Models\Order;
use App\Models\Notification;
use App\Models\OrderPayment;
use App\Models\SubscriptionPurchase;

class AdminController extends Controller
{
    
    public function adminLogin()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard'); // or your dashboard route
        }
        return view('admin.login');
    }

    public function adminLoginSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
    
        return back()->withErrors([
            'email' => 'Invalid credentials provided.',
        ]);
    }
    
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
    public function adminDashboard()
    {
        // Get comprehensive stats for admin dashboard
        $totalUsers = User::count();
        $totalDesigners = User::where('role', 1)->count();
        $totalSuppliers = User::where('role', 2)->count();
        $totalManufacturers = User::where('role', 3)->count();
        
        $totalQuotations = Quotation::count();
        $totalOrders = Order::count();
        $totalPayments = OrderPayment::count();
        $totalNotifications = Notification::count();
        
        // Recent activity
        $recentUsers = User::orderBy('created_at', 'desc')->limit(5)->get();
        $recentQuotations = Quotation::with(['user'])->orderBy('created_at', 'desc')->limit(5)->get();
        $recentOrders = Order::with(['user'])->orderBy('created_at', 'desc')->limit(5)->get();
        $recentPayments = OrderPayment::with(['order.user'])->orderBy('created_at', 'desc')->limit(5)->get();
        
        // Monthly stats for charts
        $monthlyUsers = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get();
            
        $monthlyOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get();
            
        $monthlyRevenue = OrderPayment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->whereYear('created_at', date('Y'))
            ->where('status', 'succeeded')
            ->groupBy('month')
            ->get();
        
        return view('admin.dashboard', compact(
            'totalUsers', 'totalDesigners', 'totalSuppliers', 'totalManufacturers',
            'totalQuotations', 'totalOrders', 'totalPayments', 'totalNotifications',
            'recentUsers', 'recentQuotations', 'recentOrders', 'recentPayments',
            'monthlyUsers', 'monthlyOrders', 'monthlyRevenue'
        ));
    }
    
    
    
    public function adminDesigner()
    {
        $designers = User::where('role', 1)->orderBy('id', 'desc')->paginate(10);
        return view('admin.designer', compact('designers'));
    }
    
    public function designerUpdate(Request $request, User $designer)
    {
        
       
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);
    
        $designer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
    
        return back()->with('success', 'Designer updated successfully.');
    }
    
    
    public function supplierUpdate(Request $request, User $supplier)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'phone'   => 'required',
        'address' => 'required',
    ]);

    $supplier->update([
        'name'    => $request->name,
        'email'   => $request->email,
        'phone'   => $request->phone,
        'address' => $request->address,
    ]);

    return back()->with('success', 'Supplier updated successfully.');
}

public function manufacturerUpdate(Request $request, User $manufacturer)
{
    $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email',
        'phone'   => 'required',
        'address' => 'required',
    ]);

    $manufacturer->update([
        'name'    => $request->name,
        'email'   => $request->email,
        'phone'   => $request->phone,
        'address' => $request->address,
    ]);

    return back()->with('success', 'Manufacturer updated successfully.');
}


    public function adminSupplier()
    {
        $suppliers = User::where('role', 2)->orderBy('id', 'desc')->paginate(10);
        return view('admin.supplier', compact('suppliers'));
    }
    public function adminManufacturer()
    {
        $manufacturers = User::where('role', 3)->orderBy('id', 'desc')->paginate(10);
        return view('admin.manufacturer', compact('manufacturers'));
    }
    public function adminRaisedRfq()
    {
        $quotations = Quotation::with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.rfq', compact('quotations'));
    }
    public function adminReceivedQuotation()
    {
        $quotations = Quotation::whereNotNull('quotation_id')
            ->with(['user', 'quotationUser'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.received-quotation', compact('quotations'));
    }
    public function adminOrders()
    {
        $orders = Order::with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.orders', compact('orders'));
    }

    public function adminSurvey()
    {
        $surveys = Survey::orderBy('created_at', 'desc')->paginate(15);
            
        return view('admin.survey', compact('surveys'));
    }

    public function adminPost()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.post', compact('posts'));
    }
    
    public function postDestroy($id)
    {
        $post = Post::findOrFail($id);
        // Delete post
        $post->delete();
    
        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
    public function adminPayment()
    {
        $payments = OrderPayment::with(['order.user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $subscriptionPayments = SubscriptionPurchase::with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.payment', compact('payments', 'subscriptionPayments'));
    }
    public function adminNotification()
    {
        $notifications = Notification::with(['user', 'fromUser'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('admin.notifications', compact('notifications'));
    }
    public function adminProfile()
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $admin = Auth::guard('admin')->user();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->route('admin.profile')
                ->with('error', 'Current password is incorrect');
        }

        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->route('admin.profile')
            ->with('success', 'Password changed successfully');
    }

    public function adminEarnings()
    {
        // Get suppliers (role 2) and their orders
        $suppliers = User::where('role', 2)->get();
        $supplierIds = $suppliers->pluck('id')->toArray();
        
        // Get supplier earnings with relationships
        $supplierEarnings = Order::whereIn('vendor_id', $supplierIds)
            ->where('status', 'paid')
            ->with([
                'designer:id,name,email',
                'vendor:id,name,email,role'
            ])
            ->get();
        
        $totalSupplierEarnings = $supplierEarnings->sum('amount');
        
        $supplierPayments = OrderPayment::whereHas('order', function($query) use ($supplierIds) {
            $query->whereIn('vendor_id', $supplierIds);
        })
        ->where('status', 'succeeded')
        ->with([
            'order.designer:id,name,email',
            'order.vendor:id,name,email,role'
        ])
        ->get();

        // Get manufacturers (role 3) and their orders
        $manufacturers = User::where('role', 3)->get();
        $manufacturerIds = $manufacturers->pluck('id')->toArray();
        
        // Get manufacturer earnings with relationships
        $manufacturerEarnings = Order::whereIn('vendor_id', $manufacturerIds)
            ->where('status', 'paid')
            ->with([
                'designer:id,name,email',
                'vendor:id,name,email,role'
            ])
            ->get();
        
        $totalManufacturerEarnings = $manufacturerEarnings->sum('amount');
        
        $manufacturerPayments = OrderPayment::whereHas('order', function($query) use ($manufacturerIds) {
            $query->whereIn('vendor_id', $manufacturerIds);
        })
        ->where('status', 'succeeded')
        ->with([
            'order.designer:id,name,email',
            'order.vendor:id,name,email,role'
        ])
        ->get();

        // Calculate summaries
        $supplierSummary = $suppliers->map(function($supplier) use ($supplierEarnings) {
            return [
                'id' => $supplier->id,
                'name' => $supplier->name,
                'email' => $supplier->email,
                'total_orders' => $supplierEarnings->where('vendor_id', $supplier->id)->count(),
                'total_earnings' => $supplierEarnings->where('vendor_id', $supplier->id)->sum('amount')
            ];
        });

        $manufacturerSummary = $manufacturers->map(function($manufacturer) use ($manufacturerEarnings) {
            return [
                'id' => $manufacturer->id,
                'name' => $manufacturer->name,
                'email' => $manufacturer->email,
                'total_orders' => $manufacturerEarnings->where('vendor_id', $manufacturer->id)->count(),
                'total_earnings' => $manufacturerEarnings->where('vendor_id', $manufacturer->id)->sum('amount')
            ];
        });

        return view('admin.earnings', compact(
            'supplierEarnings',
            'totalSupplierEarnings',
            'supplierPayments',
            'manufacturerEarnings',
            'totalManufacturerEarnings',
            'manufacturerPayments',
            'supplierSummary',
            'manufacturerSummary'
        ));
    }
    public function toggleUserStatus(Request $request, User $user)
    {
        $user->status = $user->status ? 0 : 1;
        $user->save();
        return back()->with('status', 'User status updated.');
    }
    
    public function adminChat()
    {
        $chats = Chat::with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($chat) {
                return $chat->sender_id < $chat->receiver_id ? 
                    $chat->sender_id . '-' . $chat->receiver_id : 
                    $chat->receiver_id . '-' . $chat->sender_id;
            });
        
        return view('admin.chat', compact('chats'));
    }
    
}
