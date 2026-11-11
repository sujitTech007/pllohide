<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>PlloHide | Premium Leather Hides & Leather Products</title>

    <meta name="description" content="Discover premium quality leather hides and leather products at PlloHide. Explore our collection of high-quality leather products designed for durability, style, and performance.">

    <meta name="keywords" content="PlloHide, leather hides, leather products, premium leather, leather supplier, quality leather">

    <meta name="robots" content="index, follow">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://pllohide.ca/">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon.png') }}">

    
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css?var=2') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css?var=2') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/variables.css?var=2') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css?var=1') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css?var=2') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css?var=2') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ filemtime(public_path('assets/css/style.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}?v={{ filemtime(public_path('assets/css/dashboard.css')) }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css?var=2') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}?v={{ filemtime(public_path('assets/css/responsive.css')) }}">
    <style>
.toast-container {
position: fixed;
top: 1rem;
right: 1rem;
z-index: 9999;
}

</style>
</head>

<body>
<div class="toast-container fade show">
      @if(session('success'))
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body">
              {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      @endif
      @if($errors->any())
        <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body">
              @foreach($errors->all() as $error)
                {{ $error }}<br>
              @endforeach
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      @endif

      @if(session('success') || $errors->any())
<script>
    setTimeout(() => {
        document.querySelectorAll('.toast').forEach(toastEl => {
            let bsToast = bootstrap.Toast.getOrCreateInstance(toastEl);
            bsToast.hide(); // will fade out because of "fade" class
        });
    }, 3000);
</script>
@endif
    </div>

    <header class="header">
        <div class="container">
            <div class="row">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg shadow-sm bg-white container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="PlloHide Logo" height="57">
                    </a>
                    
                    <div class="loginBtn">
                        @auth
                            @php
                                $role = (string) (auth()->user()->role ?? '');
                                $dashboardRoute = match($role){
                                    '1', 'designer' => route('designer.dashboard'),
                                    '2', 'supplier' => route('supplier.dashboard'),
                                    '3', 'manufacturer' => route('manufacturer.dashboard'),
                                    default => route('login'),
                                };
                            @endphp
                            <span class="me-2">{{ auth()->user()->name ?? 'User' }}</span>
                            <a href="{{ $dashboardRoute }}" class="btn login-btn">Dashboard</a>
                        @else
                            <a href="{{ route('choose.account') }}" class="btn login-btn">Login</a>
                        @endauth
                        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    </div>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                        @auth
                        <div class="me-auto navbar-nav">

                                <div class="user_login dropdown">
                                    <button type="button" data-bs-toggle="dropdown" id="dropdown-basic"
                                        aria-expanded="false" class="btn dropdown-toggle btn-primary">
                                        <span>Find
                                            Professionals</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a data-rr-ui-dropdown-item="" class="dropdown-item"
                                            href="{{ route('find.manufacturers') }}">Find Manufacturers</a><a
                                            data-rr-ui-dropdown-item="" class="dropdown-item"
                                            href="{{ route('find.designers') }}">Find Designers</a><a
                                            data-rr-ui-dropdown-item="" class="dropdown-item"
                                            href="{{ route('find.suppliers') }}">Find Suppliers</a>
                                    </div>
                                </div><a role="button" class="nav-link"
                                    tabindex="0" href="{{ route('community') }}">Community</a>
                            </div>
                            <div class="btn_grp">
                                <div class="search_bar">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <span class="icon"><i class="fa fa-search"></i></span>
                                </div>
                                <div class="user_login dropdown">
                                    <button type="button" data-bs-toggle="dropdown" id="dropdown-basic" aria-expanded="false" class="btn dropdown-toggle btn btn-primary">
                                        <i class="fa fa-user-circle-o"></i>
                                        <span>{{auth()->user()->name}} </span>
                                    </button>
                                    <div aria-labelledby="dropdown-basic" data-bs-popper="static" class="dropdown-menu">
                                          @if(auth()->user()->role == '1')
                                        <a href="{{ route('designer.profile')}}" class="dropdown-item">My Profile</a>
                                        @elseif(auth()->user()->role == '2')
                                        <a href="{{ route('supplier.profile')}}" class="dropdown-item">My Profile</a>
                                        @elseif(auth()->user()->role == '3')
                                        <a href="{{ route('manufacturer.profile')}}" class="dropdown-item">My
                                            Profile</a>
                                        @endif

                                        @if(auth()->user()->role == '1')
                                        <a href="{{ route('designer.logout')}}" class="dropdown-item">Logout</a>
                                        @elseif(auth()->user()->role == '2')
                                        <a href="{{ route('supplier.logout')}}" class="dropdown-item">Logout</a>
                                        @elseif(auth()->user()->role == '3')
                                        <a href="{{ route('manufacturer.logout')}}" class="dropdown-item">Logout</a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @else
                        <ul class="navbar-nav d-flex justify-content-center w-100 gap-3 px-4">
    <li class="nav-item">
        <a class="nav-link" href="https://pllohide.ca/#aboutSection">About Us</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="https://pllohide.ca/#howitWorks">How It Works</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="https://pllohide.ca/#ourFeatures">Our Features</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="https://pllohide.ca/#Community">Community</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="https://pllohide.ca/#subscriptionPlan">Pricing</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="https://pllohide.ca/#faqs">FAQ</a>
    </li>
</ul>
                        @endauth
                        @auth
                            @php
                                $role = (string) (auth()->user()->role ?? '');
                                $dashboardRoute = match($role){
                                    '1', 'designer' => route('designer.dashboard'),
                                    '2', 'supplier' => route('supplier.dashboard'),
                                    '3', 'manufacturer' => route('manufacturer.dashboard'),
                                    default => route('login'),
                                };
                            @endphp
                            <!-- <a href="{{ $dashboardRoute }}" class="btn login-btn btn-mobile-hide">Dashboard</a> -->
                        @else
                            <a href="{{ route('choose.account') }}" class="btn login-btn btn-mobile-hide">Login</a>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>
    </header>

    
    <script>
        setTimeout(function(){
            var s = document.getElementById('flash-success');
            if(s){ s.style.transition = 'opacity .4s'; s.style.opacity = '0'; setTimeout(function(){ s.remove(); }, 400); }
            var e = document.getElementById('flash-error');
            if(e){ e.style.transition = 'opacity .4s'; e.style.opacity = '0'; setTimeout(function(){ e.remove(); }, 400); }
        }, 4000);
    </script>
   