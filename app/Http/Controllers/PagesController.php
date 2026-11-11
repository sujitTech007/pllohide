<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\PostComment;
use App\Models\Post;
use App\Models\Portfolio;
use App\Models\Review;
use App\Models\SavedProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Otp;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;


class PagesController extends Controller
{
    public function registration()
    {
        return view('registration');
    }

    public function signUp(Request $request)
    {
        $role = session('selected_role');
        // Fallback: accept role via query string if session missing (numeric or string)
        if (!in_array($role, ['1','2','3'])) {
            $queryRole = $request->query('role');
            $stringToNumeric = [
                'designer' => '1',
                'supplier' => '2',
                'manufacturer' => '3',
            ];
            if (in_array($queryRole, ['1','2','3'])) {
                session(['selected_role' => $queryRole]);
                $role = $queryRole;
            } elseif (isset($stringToNumeric[$queryRole])) {
                session(['selected_role' => $stringToNumeric[$queryRole]]);
                $role = $stringToNumeric[$queryRole];
            }
        }
        if (!in_array($role, ['1','2','3'])) {
            return redirect()->route('choose.account');
        }
        return view('sign-up');
    }

        // public function signUpSubmit(Request $request)
        // {
        //     $role = session('selected_role');
        //     if (!in_array($role, ['1','2','3'])) {
        //         return redirect()->route('choose.account');
        //     }

        //     $validated = $request->validate([
        //         'name' => 'required|string|min:2|max:100',
        //         'email' => 'nullable|email|max:255',
        //         'phone' => 'required|string|min:8|max:20',
        //         'country_code' => 'required',
        //     ]);

        //     // Store numeric roles in DB (1,2,3)
        //     $user = User::where('phone', $validated['phone'])
        //         ->where('role', $role)
        //         ->first();

        //     if (!$user) {
        //         $user = User::create([
        //             'name' => $validated['name'],
        //             'email' => $validated['email'] ?? null,
        //             'phone' => $validated['phone'],
        //             'country_code' => $validated['country_code'],
        //             'role' => $role,
        //             'password' => null,
        //         ]);
        //     } else {
        //         $user->update([
        //             'name' => $validated['name'],
        //             'email' => $validated['email'] ?? $user->email,
        //         ]);
        //     }

        //     // After registration, send to login with success message
        //     session(['pending_otp_user_id' => $user->id]);
        //     // session(['dev_static_otp' => '1234']);

        //    Auth::login($user);

        //     if ($user->role == 1) {

        //         // Designer role – redirect to payment page
        //         return redirect()->route('subscribe.designer')->with('status', 'Registration successful. Please complete the payment to continue.');
        //     } else {
        //         // Other roles – redirect to login page
        //         return redirect()->route('register.update', ['role' => $role])
        //                         ->with('status', 'Registration successful. Update your profile.');
        //     }

        //     return redirect()->route('login', ['role' => session('selected_role')])->with('status', 'Registration successful. Please login to continue.');
        // }


        public function signUpSubmit(Request $request)
{
    $role = session('selected_role');
    if (!in_array($role, ['1', '2', '3'])) {
        return redirect()->route('choose.account');
    }

    $validated = $request->validate([
    'name' => 'required|string|max:100',

    'email' => [
        'required',
        'string',
        'email:rfc,dns',
        'max:255',
        Rule::unique('users', 'email'),
    ],

    'phone' => [
        'required',
        'regex:/^[0-9]{8,20}$/',
    ],
    
    'password' => [
        'required',
        'string',
        'min:8',
        'confirmed',
    ],

    'country_code' => 'required',
], [
    'email.required' => 'Please enter your email address.',
    'email.email' => 'Please enter a valid email address.',
    'email.unique' => 'This email address is already registered.',

    'phone.required' => 'Please enter your phone number.',
    'phone.regex' => 'Phone number must contain only digits and be between 8 and 20 digits.',
    
    'password.required' => 'Please enter your password.',
    'password.min' => 'Password must be at least 8 characters.',
    'password.confirmed' => 'Password and confirm password do not match.',
]);

    // 🔹 Check for duplicate phone
    $duplicatePhone = User::where('phone', $validated['phone'])
        // ->where('role', $role)
        ->exists();

    if ($duplicatePhone) {
    return back()
        ->withInput()
        ->with('error', 'Given phone number already exists for this role.');
}



    // 🔹 Check for duplicate email (only if provided)
    
        $duplicateEmail = User::where('email', $validated['email'])
            // ->where('role', $role)
            ->exists();

      if ($duplicateEmail) {
        return back()
            ->withInput()
            ->with('error', 'Given email already exists for this role.');
    }
    

    // 🔹 Create user
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'] ?? null,
        'phone' => $validated['phone'],
        'country_code' => $validated['country_code'],
        'role' => $role,
        // 'password' => null,
        'password' => Hash::make($validated['password']),
    ]);

    // 🔹 Save OTP info or log in
    session(['pending_otp_user_id' => $user->id]);
    Auth::login($user);

    // 🔹 Redirect by role
    if ($user->role == 1) {
        // Designer role – redirect to payment page
        // Designer role � this is a new user payment flow
        session(['pending_registration_payment' => true]);
        return redirect()->route('subscribe.designer')
            ->with('success', 'Registration successful. Please complete the payment to continue.');
    } else {
        // Other roles – redirect to profile update
        return redirect()->route('register.update', ['role' => $role])
            ->with('success', 'Registration successful. Update your profile.');
    }
}



    public function chooseAccount()
    {
        return view('choose-account');
    }

    public function chooseAccountSubmit(Request $request)
    {
        $request->validate([
            'role' => 'required',
        ]);
        session(['selected_role' => $request->role]);
        if($request->role == 1 ){
        return redirect()->route('sign-up', ['role' => 'designer']);
        }elseif($request->role == 2){
        return redirect()->route('sign-up', ['role' => 'supplier']);
        }elseif($request->role == 3){
        return redirect()->route('sign-up', ['role' => 'manufacturer']);
        }
    }

    public function login(Request $request)
    {
        $role = session('selected_role');
        if (!in_array($role, ['1','2','3'])) {
            $queryRole = $request->query('role');
            if (in_array($queryRole, ['1','2','3'])) {
                session(['selected_role' => $queryRole]);
                $role = $queryRole;
            }
        }
        if (!in_array($role, ['1','2','3'])) {
            return redirect()->route('choose.account');
        }
        return view('login');
    }

    // public function loginSubmit(Request $request)
    // {
    //     $request->validate([
    //         'phone' => 'required',
    //     ], [
    //         'phone.required' => 'Please enter your phone number to receive OTP.',
    //     ]);

    //     $role = session('selected_role');
      
    //     if (!in_array($role, ['1','2','3'])) {
    //         return redirect()->route('choose.account');
    //     }
        
    //      $user = User::where('phone', $request->phone)
    //             ->where('country_code', $request->country_code)
    //             ->where('role', $role)
    //             ->first();

    //     if (!$user) {
    //         return redirect()->back()->with('error', 'Invalid country code or phone number.');
    //     }

    //     // if (!$user) {
            
    //     //     return redirect()->back()->with('error', 'Invalid credentials provided.');
    //     // }

    //     // Dev mode: Use static OTP 1234, skip external SMS
    //     session(['pending_otp_user_id' => $user->id]);
    //     session(['dev_static_otp' => '1234']);
    //     return view('otp', ['masked' => $user->phone, 'dev_static' => true]);
    // }


// public function loginSubmit(Request $request)
// {
//     $request->validate([
//         'email' => [
//             'required',
//             'email',
//         ],
//         'password' => [
//             'required',
//         ],
//     ], [
//         'email.required' => 'Please enter your email address.',
//         'email.email' => 'Please enter a valid email address.',
//         'password.required' => 'Please enter your password.',
//     ]);

//     $role = session('selected_role');

//     if (!in_array($role, ['1', '2', '3'])) {
//         return redirect()->route('choose.account');
//     }

//     // Find user by email and role
//     $user = User::where('email', $request->email)
//         ->where('role', $role)
//         ->first();

//     if (!$user) {
//         return redirect()->back()
//             ->withInput($request->only('email'))
//             ->with('error', 'Invalid email or password.');
//     }

//     // Check password
//     if (!Hash::check($request->password, $user->password)) {
//         return redirect()->back()
//             ->withInput($request->only('email'))
//             ->with('error', 'Invalid email or password.');
//     }

//     // Login user
//     Auth::login($user);

//     // Redirect by role
//     // 1 = Designer
//     // 2 = Supplier
//     // 3 = Manufacturer

//     switch ((string) $user->role) {

//         case '1':
//             return redirect()
//                 ->route('designer.profile')
//                 ->with('status', 'Logged in successfully.');

//         case '2':
//             return redirect()
//                 ->route('supplier.profile')
//                 ->with('status', 'Logged in successfully.');

//         case '3':
//             return redirect()
//                 ->route('manufacturer.profile')
//                 ->with('status', 'Logged in successfully.');

//         default:
//             return redirect()->route('login');
//     }
// }

public function loginSubmit(Request $request)
{
    $request->validate([
        'email' => [
            'required',
            'email',
        ],
        'password' => [
            'required',
        ],
    ], [
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Please enter your password.',
    ]);

    $role = session('selected_role');

    if (!in_array($role, ['1', '2', '3'])) {
        return redirect()->route('choose.account');
    }

    // Find user according to email + selected role
    $user = User::where('email', $request->email)
        ->where('role', $role)
        ->first();

    if (!$user) {
        return redirect()->back()
            ->withInput($request->only('email'))
            ->with('error', 'Invalid email or password.');
    }

    // Check password
    if (!$user->password || !Hash::check($request->password, $user->password)) {
        return redirect()->back()
            ->withInput($request->only('email'))
            ->with('error', 'Invalid email or password.');
    }

    $otp = random_int(1000, 9999);

    // Remove previous OTP
    Otp::where('user_id', $user->id)->delete();
    
    // Save new OTP
    Otp::create([
        'user_id' => $user->id,
        'otp' => $otp,
        'expires_at' => now()->addMinutes(5),
        'is_verified' => false,
    ]);
    
    // Store user ID temporarily
    session([
        'pending_otp_user_id' => $user->id,
    ]);
    
//   Mail::to($request->email)->send(new SendOtpMail($otp));
    
    return redirect()
        ->route('otp')
        ->with('success', 'A verification code has been sent to your email address.');
}


    // public function verifyOtp(Request $request)
    // {
    //     // If OTP came as array from multi-input fields, combine it
    //     if (is_array($request->input('otp'))) {
    //         $combined = implode('', array_map(function($d){ return trim((string)$d); }, $request->input('otp')));
    //         $request->merge(['otp' => $combined]);
    //     }

       

    //     $request->validate([
    //         'otp' => 'required|string|size:4',
    //     ], [
    //         'otp.required' => 'Please enter the OTP sent to your phone.',
    //     ]);

    //     $userId = session('pending_otp_user_id');
    //     $user = $userId ? User::find($userId) : null;
    //     if (!$user) {
    //         return back()->withErrors(['otp' => 'Session expired. Please login again.']);
    //     }

    //     // Dev mode: validate static OTP
    //     if ($request->otp !== '1234') {
    //         return back()->withErrors(['otp' => 'Invalid OTP']);
    //     }

    //     // Only allow login if approved
    //     // if ((int)($user->status ?? 0) !== 1) {
    //     //     return redirect()->route('login')->with('error', 'Your account is not approved yet. Please contact support.');
            
    //     // }
    //     Auth::login($user);
    //     session()->forget('pending_otp_user_id');

    //     // Redirect by role (numeric values: 1=designer,2=supplier,3=manufacturer)
    //     switch ((string) $user->role) {
    //         case '1':
    //             return redirect()->route('designer.profile')->with('status', 'Logged in successfully.');
    //         case '2':
    //             return redirect()->route('supplier.profile')->with('status', 'Logged in successfully.');
    //         case '3':
    //             return redirect()->route('manufacturer.profile')->with('status', 'Logged in successfully.');
    //         default:
    //             return redirect()->route('login');
    //     }

        
    // }
   
   
   
   public function verifyOtp(Request $request)
{
    // If OTP comes from 4 separate input fields
    if (is_array($request->input('otp'))) {
        $combined = implode('', array_map(function ($d) {
            return trim((string) $d);
        }, $request->input('otp')));

        $request->merge([
            'otp' => $combined
        ]);
    }

    $request->validate([
        'otp' => [
            'required',
            'string',
            'size:4',
            'regex:/^[0-9]{4}$/',
        ],
    ], [
        'otp.required' => 'Please enter the OTP sent to your email.',
        'otp.size' => 'OTP must be 4 digits.',
        'otp.regex' => 'OTP must contain only numbers.',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Get Pending User
    |--------------------------------------------------------------------------
    */

    $userId = session('pending_otp_user_id');

    if (!$userId) {
        return redirect()
            ->route('login')
            ->with('error', 'Session expired. Please login again.');
    }

    $user = User::find($userId);

    if (!$user) {
        session()->forget('pending_otp_user_id');

        return redirect()
            ->route('login')
            ->with('error', 'User not found. Please login again.');
    }

  

    // $otpRecord = Otp::where('user_id', $user->id)
    //     ->where('otp', $request->otp)
    //     ->where('is_verified', false)
    //     ->latest()
    //     ->first();
  
    // if (!$otpRecord) {
    //     return back()->withErrors([
    //         'otp' => 'Invalid OTP. Please enter the correct OTP.'
    //     ]);
    // }


    // if (now()->greaterThan($otpRecord->expires_at)) {

    //     $otpRecord->delete();

    //     return redirect()
    //         ->route('login')
    //         ->with('error', 'OTP has expired. Please login again.');
    // }

    /*
    |--------------------------------------------------------------------------
    | OTP Verified
    |--------------------------------------------------------------------------
    */
    
    $otpRecord = Otp::where('user_id', $user->id)
        // ->where('otp', $request->otp)
        ->where('is_verified', false)
        ->latest()
        ->first();

    $otpRecord->update([
        'is_verified' => true,
    ]);

    /*
    |--------------------------------------------------------------------------
    | Login User
    |--------------------------------------------------------------------------
    */

    Auth::login($user);

    /*
    |--------------------------------------------------------------------------
    | Remove Pending OTP Session
    |--------------------------------------------------------------------------
    */

    session()->forget('pending_otp_user_id');

    /*
    |--------------------------------------------------------------------------
    | Role Based Redirect
    |--------------------------------------------------------------------------
    */

    switch ((string) $user->role) {

        // Designer
        case '1':
            return redirect()
                ->route('designer.profile')
                ->with('status', 'Logged in successfully.');

        // Supplier
        case '2':
            return redirect()
                ->route('supplier.profile')
                ->with('status', 'Logged in successfully.');

        // Manufacturer
        case '3':
            return redirect()
                ->route('manufacturer.profile')
                ->with('status', 'Logged in successfully.');

        default:

            Auth::logout();

            return redirect()
                ->route('login')
                ->with('error', 'Invalid user role.');
    }
}


public function otp()
{
    $userId = session('pending_otp_user_id');

    if (!$userId) {
        return redirect()
            ->route('login')
            ->with('error', 'Please login first.');
    }

    $user = User::find($userId);

    if (!$user) {
        session()->forget('pending_otp_user_id');

        return redirect()
            ->route('login')
            ->with('error', 'Please login again.');
    }

    return view('otp', [
        'masked' => $user->email,
    ]);
}



    public function registerUpdate()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        return view('registration', compact('user'));
    }

    public function registerUpdateStore(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('login');
        }
     
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
            'profile_image' => 'nullable',
            'province' => 'required',
            'country' => 'required',
            // 'industry_license' => 'required',
        ]);


        $data = $request->only(['name', 'email', 'phone', 'address', 'province', 'country']);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_profile.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile'), $filename);
            $data['profile_image'] = 'uploads/profile/' . $filename;
        }

        // Handle industry license upload
        if ($request->hasFile('industry_license')) {
            $file = $request->file('industry_license');
            $filename = time() . '_license.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/license'), $filename);
            $data['industry_license'] = 'uploads/license/' . $filename;
        }

        $user->update($data);
        
        if($user->role != 1){

         $company = Company::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_role'    => $user->role ?? null,
                'name'         => $request->company_name,
                'website'      => $request->website,
                'address'      => $request->business_address,
                'business_experience'      => $request->business_experience,
                'license'      => $request->license,
            ]
        );

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
        }
        

        // return redirect()->back()->with('status', 'Profile updated successfully.');
        switch ((string) $user->role) {
            case '1':
                return redirect()->route('designer.profile')->with('success', 'Completed account successfully.');
            case '2':
                return redirect()->route('supplier.profile')->with('success', 'Completed account successfully.');
            case '3':
                return redirect()->route('manufacturer.profile')->with('success', 'Completed account successfully.');
            default:
                return redirect()->route('login');
        }

    }

    public function findProfessionals()
    {
        $manufacturers = User::where('role', '3')->get();
        return view('find-professionals', compact('manufacturers'));
    }
    public function findManufacturers()
    {
        $manufacturers = User::where('role', '3')->paginate(4);
        return view('find-professionals', compact('manufacturers'));
    }
    public function findDesigners()
    {
        $designers = User::where('role', '1')->paginate(4);
        return view('find-professional-designer', compact('designers'));
    }
    public function findSuppliers()
    {
        $suppliers = User::where('role', '2')->with('company')->paginate(4);
      
        return view('find-professional-supplier', compact('suppliers'));
    }
    public function manufacturerProfile($id)
    {
        $user = User::find($id);
        $company = Company::where('user_id', $user->id)->first();
        $portfolios = Portfolio::where('user_id', $user->id)->get();
        $reviews = Review::where('user_id', $user->id)->with('reviewer')->orderByDesc('created_at')->get();
        $averageRating = $reviews->avg('rating');
        $isSaved = false;
        $hasReviewed = false;

        if (Auth::check()) {
            $isSaved = SavedProfile::where('user_id', Auth::id())->where('manufacturer_id', $user->id)->exists();
            $hasReviewed = Review::where('user_id', $user->id)->where('reviewer_id', Auth::id())->exists();
        }

        return view('manufacturer-profile', compact('user','company','portfolios','reviews','averageRating','isSaved','hasReviewed'));
    }

    public function storeReview(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to leave a review.');
        }

        if ((int) Auth::id() === (int) $id) {
            return redirect()->route('manufacturer-profile', $id)->with('error', 'You cannot review your own profile.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        if (Review::where('user_id', $id)->where('reviewer_id', Auth::id())->exists()) {
            return redirect()->route('manufacturer-profile', $id)->with('error', 'You have already submitted a review for this profile.');
        }

        Review::create([
            'user_id' => $id,
            'reviewer_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('manufacturer-profile', $id)->with('success', 'Review submitted successfully.');
    }

    public function saveManufacturer(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to save this profile.');
        }

        if (Auth::id() === (int) $id) {
            return redirect()->route('manufacturer-profile', $id)->with('error', 'You cannot save your own profile.');
        }

        SavedProfile::firstOrCreate([
            'user_id' => Auth::id(),
            'manufacturer_id' => $id,
        ]);

        return redirect()->route('manufacturer-profile', $id)->with('success', 'Profile saved successfully.');
    }

    public function unsaveManufacturer(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to manage saved profiles.');
        }

        if (Auth::id() === (int) $id) {
            return redirect()->route('manufacturer-profile', $id)->with('error', 'You cannot unsave your own profile.');
        }

        SavedProfile::where('user_id', Auth::id())
            ->where('manufacturer_id', $id)
            ->delete();

        return redirect()->route('manufacturer-profile', $id)->with('success', 'Profile unsaved successfully.');
    }

    public function survey()
    {
        return view('survey');
    }

    public function blog()
    {
        return view('blog');
    }

     public function articleList()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('article-list', compact('posts'));
    }
    public function createPost()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('create-post', compact('posts'));
    }
    public function articleDetail($id)
    {
        $commentCount = PostComment::where('post_id', $id)->count();
        $comments = PostComment::where('post_id', $id)->with('user')->orderBy('created_at', 'desc')->get();
        $posts = Post::orderBy('created_at', 'desc')->get();
        $post = Post::findOrFail($id);
        return view('article-detail', compact('post', 'posts', 'commentCount', 'comments'));
    }

    public function postCreateStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

         if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_post.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/post'), $filename);
            $postImagePath = 'uploads/post/' . $filename;
        }

        // Assuming you have a Post model to handle blog posts
        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'image' => $postImagePath ?? null,
        ]);
        return redirect()->back()->with('success', 'Post created successfully.');

        // return redirect()->route('article.list')->with('status', 'Post created successfully.');
    }

    public function postCommentStore(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string',
        ]);

        // Assuming you have a Post model to handle blog posts
        PostComment::create([
            'user_id' => Auth::id(),
            'post_id' => $id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment created successfully.');
        // return redirect()->route('article.detail', ['id' => $id])->with('status', 'Comment created successfully.');
    }

    public function testMail()
    {
        Mail::to('web.lokesh@gmail.com')->send(new SendOtpMail('1234'));
    }

}
