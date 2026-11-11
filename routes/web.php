<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Designer\DesignerController;
use App\Http\Controllers\Designer\ProjectController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Manufacturer\ManufacturerController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ChatController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');

    return 'Application Optimize cleared successfully!';
});

Route::get('/', function () {
    return view('index');
});


Route::get('/testMail', [PagesController::class, 'testMail']);

Route::get('/login', [PagesController::class, 'login'])->name('login');
Route::get('/sign-up', [PagesController::class, 'signUp'])->name('sign-up');
Route::post('/sign-up', [PagesController::class, 'signUpSubmit'])->name('sign-up.submit');
Route::get('/choose-account', [PagesController::class, 'chooseAccount'])->name('choose.account');
Route::post('/choose-account', [PagesController::class, 'chooseAccountSubmit'])->name('choose.account.submit');
Route::post('/login', [PagesController::class, 'loginSubmit'])->name('login.submit');
Route::get('/otp', [PagesController::class, 'otp'])->name('otp');
Route::post('/verify-otp', [PagesController::class, 'verifyOtp'])->name('verify.otp');
Route::get('/article-list', [PagesController::class, 'articleList'])->name('article.list');
Route::get('/article-detail/{id}', [PagesController::class, 'articleDetail'])->name('article.detail');
Route::get('/create-post', [PagesController::class, 'createPost'])->name('create.post');
Route::post('/create-post-store', [PagesController::class, 'postCreateStore'])->name('post.create.store');
Route::post('/create-comment-store/{id}', [PagesController::class, 'postCommentStore'])->name('comments.store');
Route::get('/find-professionals/manufacturer', [PagesController::class, 'findManufacturers'])->name('find.manufacturers');
Route::get('/find-professionals/designer', [PagesController::class, 'findDesigners'])->name('find.designers');
Route::get('/find-professionals/supplier', [PagesController::class, 'findSuppliers'])->name('find.suppliers');
Route::get('/find-professionals', [PagesController::class, 'findProfessionals'])->name('find.professionals');
Route::get('/profile/{id}', [PagesController::class, 'manufacturerProfile'])->name('manufacturer-profile');
Route::get('/survey', [PagesController::class, 'survey'])->name('survey');
Route::post('/survey-store', [SurveyController::class, 'store'])->name('survey.store');
Route::get('/blog', [PagesController::class, 'blog'])->name('blog');
Route::get('/register-update', [PagesController::class, 'registerUpdate'])->name('register.update');
Route::post('/register-update/store/{id}', [PagesController::class, 'registerUpdateStore'])->name('register.update.store');

Route::get('/community', [PagesController::class, 'articleList'])->name('community');
// Route::post('/quotations', [QuotationController::class, 'store'])->name('quotations.store');

// Chat routes
Route::middleware('auth')->group(function () {
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chat/mess-send', [ChatController::class, 'sendQuote'])->name('chat.mess.send');
    Route::get('/chat/messages/{userId?}', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/mark-read/{userId}', [ChatController::class, 'markAsRead'])->name('chat.mark.read');
    Route::post('/profile/{id}/review', [PagesController::class, 'storeReview'])->name('manufacturer.review.store');
    Route::post('/profile/{id}/save', [PagesController::class, 'saveManufacturer'])->name('manufacturer.save');
    Route::post('/profile/{id}/unsave', [PagesController::class, 'unsaveManufacturer'])->name('manufacturer.unsave');
    
    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
    Route::get('/notifications/recent', [NotificationController::class, 'getRecentNotifications'])->name('notifications.recent');
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::delete('/notifications/{id}', [NotificationController::class, 'delete'])->name('notifications.delete');
    Route::delete('/notifications', [NotificationController::class, 'clearAll'])->name('notifications.clear-all');
});

// Designer/supplier order payment
use App\Models\Order;
Route::post('/orders/{order}/pay', function(Order $order){
    if (Auth::id() !== $order->designer_id) {
        return redirect()->back()->with('error', 'Unauthorized to pay this order.');
    }
    if ($order->status !== 'approved') {
        return redirect()->back()->with('error', 'Order is not payable.');
    }
    session(['order_payment_id' => $order->id]);
    return redirect()->route('payment.view');
})->middleware(['auth'])->name('order.pay');

// Subscription routes
// Route::middleware(['auth','role:designer'])->group(function () {
Route::middleware('auth')->group(function () {
    Route::match(['get', 'post'], '/subscribe/designer', [SubscriptionController::class, 'designer'])->name('subscribe.designer');
Route::post('/quotations', [QuotationController::class, 'store'])->name('quotations.store');
    // Route::[get, post]('/subscribe/designer', [SubscriptionController::class, 'designer'])->name('subscribe.designer');
    Route::get('/payment-view', [SubscriptionController::class, 'paymentView'])->name('payment.view');
    Route::post('/subscribe/mark-paid', [SubscriptionController::class, 'markPaid'])->name('subscribe.markPaid');
    Route::get('/payment-successfull', [SubscriptionController::class, 'successPage'])->name('payment.successfull');
    Route::get('order/payment-successfull', [SubscriptionController::class, 'orderSuccessPage'])->name('order.payment.successfull');
});

// (Webhook not used)


// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'adminLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'adminLoginSubmit'])->name('login.submit');
    
    Route::middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/logout', [AdminController::class, 'adminLogout'])->name('logout');
    Route::get('/designer', [AdminController::class, 'adminDesigner'])->name('designer');
    Route::get('/supplier', [AdminController::class, 'adminSupplier'])->name('supplier');
    Route::get('/survey', [AdminController::class, 'adminSurvey'])->name('survey');
    Route::get('/post', [AdminController::class, 'adminPost'])->name('post');
    Route::get('/manufacturer', [AdminController::class, 'adminManufacturer'])->name('manufacturer');
    Route::get('/raised-rfq', [AdminController::class, 'adminRaisedRfq'])->name('raised.rfq');
    Route::get('/received-quotation', [AdminController::class, 'adminReceivedQuotation'])->name('received.quotation');
    Route::get('/orders', [AdminController::class, 'adminOrders'])->name('orders');
    Route::get('/payment', [AdminController::class, 'adminPayment'])->name('payment');
    Route::get('/earnings', [AdminController::class, 'adminEarnings'])->name('earnings');
    Route::get('/chat', [AdminController::class, 'adminChat'])->name('chat');
    Route::get('/notification', [AdminController::class, 'adminNotification'])->name('notification');
    Route::get('/profile', [AdminController::class, 'adminProfile'])->name('profile');
    Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [AdminController::class, 'updatePassword'])->name('password.update');
    Route::post('/users/{user}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('users.toggle-status');
    Route::put('/designers/{designer}', [AdminController::class, 'designerUpdate'])->name('designers.update');
    Route::put('/suppliers/{supplier}', [AdminController::class, 'supplierUpdate'])->name('suppliers.update');
    Route::put('/manufacturers/{manufacturer}', [AdminController::class, 'manufacturerUpdate'])->name('manufacturers.update');
    Route::delete('/posts/{post}', [AdminController::class, 'postDestroy'])->name('posts.destroy');
    });
});

// Designer Routes
Route::middleware('auth')->prefix('designer')->name('designer.')->group(function () {
    Route::get('/', [DesignerController::class, 'designerLogin'])->name('login');
    Route::post('/login', [DesignerController::class, 'designerLoginSubmit'])->name('login.submit');
    Route::get('/logout', [DesignerController::class, 'designerLogout'])->name('logout');
    Route::get('/dashboard', [DesignerController::class, 'designerDashboard'])->name('dashboard');
    Route::get('/designer', [DesignerController::class, 'designerProfile'])->name('designer');
    Route::get('/supplier', [DesignerController::class, 'designerSupplier'])->name('supplier');
    Route::get('/manufacturer', [DesignerController::class, 'designerManufacturer'])->name('manufacturer');
    Route::get('/rfq', [DesignerController::class, 'rfq'])->name('rfq');
    Route::get('/raised-rfq', [DesignerController::class, 'designerRaisedRfq'])->name('raised.rfq');
    Route::get('/received-quotation', [DesignerController::class, 'designerReceivedQuotation'])->name('received.quotation');
    Route::get('/orders', [DesignerController::class, 'designerOrders'])->name('orders');
    Route::get('/orders/{id}', [DesignerController::class, 'designerOrderDetails'])->name('order.details');
    Route::get('/payment', [DesignerController::class, 'designerPayment'])->name('payment');
    Route::get('/message', [DesignerController::class, 'message'])->name('message');
    Route::get('/project', [DesignerController::class, 'project'])->name('project');
    Route::get('/notification', [DesignerController::class, 'designerNotification'])->name('notification');
    Route::get('/profile', [DesignerController::class, 'designerProfile'])->name('profile');
    Route::post('/profile', [DesignerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/logout', [DesignerController::class, 'designerLogout'])->name('logout');

    Route::post('/project-store', [ProjectController::class, 'store'])->name('projects.store');
    Route::post('/projects/{id}/status', [ProjectController::class, 'updateStatus'])->name('projects.updateStatus');
    Route::post('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::post('/quotations/destroy/{id}', [ProjectController::class, 'destroyQuotation'])->name('quotations.destroy');
    


    
});

// Supplier Routes
Route::middleware('auth')->prefix('supplier')->name('supplier.')->group(function () {
    Route::get('/', [SupplierController::class, 'supplierLogin'])->name('login');
    Route::get('/dashboard', [SupplierController::class, 'supplierProfile'])->middleware(['auth','role:supplier'])->name('dashboard');
    Route::get('/profile', [SupplierController::class, 'supplierProfile'])->middleware(['auth','role:supplier'])->name('profile');
    Route::post('/profile-update', [SupplierController::class, 'profileUpdate'])->middleware(['auth','role:supplier'])->name('profile.update');
    Route::get('/dashboard', [SupplierController::class, 'supplierDashboard'])->middleware(['auth','role:supplier'])->name('dashboard');
    Route::get('/profile', [SupplierController::class, 'supplierProfile'])->middleware(['auth','role:supplier'])->name('profile');
    Route::get('/order', [SupplierController::class, 'supplierOrder'])->middleware(['auth','role:supplier'])->name('order');
    Route::get('/payment', [SupplierController::class, 'supplierPayment'])->middleware(['auth','role:supplier'])->name('payment');
    Route::get('/project', [SupplierController::class, 'supplierProject'])->middleware(['auth','role:supplier'])->name('project');
    Route::get('/raised-rfq', [SupplierController::class, 'supplierRfq'])->middleware(['auth','role:supplier'])->name('raised.rfq');
    Route::get('/pending', [SupplierController::class, 'pending'])->middleware(['auth','role:supplier'])->name('pending');
    Route::get('/received-quotation', [SupplierController::class, 'supplierReceivedQuotation'])->middleware(['auth','role:supplier'])->name('received.quotation');
    Route::post('/quotations/{quotation}/approve', [SupplierController::class, 'approveQuotation'])->middleware(['auth','role:supplier'])->name('quotation.approve');
    Route::get('/earning', [SupplierController::class, 'supplierEarning'])->middleware(['auth','role:supplier'])->name('earning');
    Route::get('/message', [SupplierController::class, 'supplierMessage'])->middleware(['auth','role:supplier'])->name('message');
    Route::get('/notification', [SupplierController::class, 'supplierNotification'])->middleware(['auth','role:supplier'])->name('notification');
    Route::get('/logout', [SupplierController::class, 'supplierLogout'])->middleware(['auth','role:supplier'])->name('logout');

    Route::get('/order/status', [SupplierController::class, 'getOrderStatus'])->name('order.status');
Route::post('/order/update-status', [SupplierController::class, 'updateOrderStatus'])->name('order.updateStatus');


});

// Manufacturer Routes
Route::middleware('auth')->prefix('manufacturer')->name('manufacturer.')->group(function () {
    Route::get('/', [ManufacturerController::class, 'manufacturerLogin'])->name('login');
    Route::get('/dashboard', [ManufacturerController::class, 'manufacturerDashboard'])->middleware(['auth','role:manufacturer'])->name('dashboard');
    Route::get('/dash', [ManufacturerController::class, 'dash'])->middleware(['auth','role:manufacturer'])->name('dash');
    Route::get('/profile', [ManufacturerController::class, 'manufacturerProfile'])->middleware(['auth','role:manufacturer'])->name('profile');
    Route::post('/profile-update', [ManufacturerController::class, 'profileUpdate'])->middleware(['auth','role:manufacturer'])->name('profile.update');
    Route::get('/order', [ManufacturerController::class, 'manufacturerOrder'])->middleware(['auth','role:manufacturer'])->name('order');
    Route::get('/payment', [ManufacturerController::class, 'manufacturerPayment'])->middleware(['auth','role:manufacturer'])->name('payment');
    Route::get('/project', [ManufacturerController::class, 'manufacturerProject'])->middleware(['auth','role:manufacturer'])->name('project');
    Route::get('/raised-rfq', [ManufacturerController::class, 'manufacturerRfq'])->middleware(['auth','role:manufacturer'])->name('raised.rfq');
    Route::get('/received-quotation', [ManufacturerController::class, 'manufacturerReceivedQuotation'])->middleware(['auth','role:manufacturer'])->name('received.quotation');
    Route::post('/quotations/{quotation}/approve', [ManufacturerController::class, 'approveQuotation'])->middleware(['auth','role:manufacturer'])->name('quotation.approve');
    Route::get('/earning', [ManufacturerController::class, 'manufacturerEarning'])->middleware(['auth','role:manufacturer'])->name('earning');
    Route::get('/message', [ManufacturerController::class, 'manufacturerMessage'])->middleware(['auth','role:manufacturer'])->name('message');
    Route::get('/notification', [ManufacturerController::class, 'manufacturerNotification'])->middleware(['auth','role:manufacturer'])->name('notification');
    Route::get('/logout', [ManufacturerController::class, 'manufacturerLogout'])->middleware(['auth','role:manufacturer'])->name('logout');

    Route::get('/order/status', [ManufacturerController::class, 'getOrderStatus'])->name('order.status');
    Route::post('/order/update-status', [ManufacturerController::class, 'updateOrderStatus'])->name('order.updateStatus');


});
