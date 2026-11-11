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

 <link rel="stylesheet" href="{{ asset('assets/admin/css/all.min.css?var=1') }}">
         <link rel="stylesheet" href="{{ asset('assets/admin/css/font-awesome.min.css?var=2') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/variables.css?var=2') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/reset.css?var=2') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}?v={{ filemtime(public_path('assets/admin/css/style.css')) }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/dashboard.css') }}?v={{ filemtime(public_path('assets/admin/css/dashboard.css')) }}">

<style>
    .nk-menu-sub {
    display: none;
}

.nk-menu-sub.show {
    display: block;
}
.nk-menu-sub li.active > a {
    background-color: rgba(255,255,255,0.1); /* light white color */
    color: #fff; /* text color if needed */
    border-radius: 4px; /* optional rounding */
}
</style>
</head>

<body>

    <div id="root">

    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1060;">
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

    @if(session('error'))
    <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('error') }}
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
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function (toastEl) {
        var option = { delay: 3000 }; // auto hide after 5s
        var t = new bootstrap.Toast(toastEl, option);
        t.show();
        return t;
    });
});
</script>
    
            <div class="container-fluid page-body-wrapper">
                <div class="flare__grid">
                    <div class="left__sidebar d-inline-block">
                        <div class="page-body-wrapper">
                            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                                <div class="sidebar-head">
                                    <div class="sidebar-brand">
                                        <a class="hide-logo" href="{{ url('/') }}">PlloHide</a>
                                        <a class="logo-link nk-sidebar-logo" href="{{ url('/') }}">
                                            <img src="{{ asset('assets/images/logo_w.svg') }}" class="logo-light logo-img">
                                        </a>
                                    </div>
                                </div>
                                <ul class="nav">
                                    <li class="nav-item {{ request()->routeIs('supplier.dashboard') ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('supplier.dashboard') }}">
                                            <span class="icon-bg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 9.5C16 10.5609 15.5786 11.5783 14.8284 12.3284C14.0783 13.0786 13.0609 13.5 12 13.5C10.9391 13.5 9.92172 13.0786 9.17157 12.3284C8.42143 11.5783 8 10.5609 8 9.5C8 8.43913 8.42143 7.42172 9.17157 6.67157C9.92172 5.92143 10.9391 5.5 12 5.5C13.0609 5.5 14.0783 5.92143 14.8284 6.67157C15.5786 7.42172 16 8.43913 16 9.5ZM14 9.5C14 10.0304 13.7893 10.5391 13.4142 10.9142C13.0391 11.2893 12.5304 11.5 12 11.5C11.4696 11.5 10.9609 11.2893 10.5858 10.9142C10.2107 10.5391 10 10.0304 10 9.5C10 8.96957 10.2107 8.46086 10.5858 8.08579C10.9609 7.71071 11.4696 7.5 12 7.5C12.5304 7.5 13.0391 7.71071 13.4142 8.08579C13.7893 8.46086 14 8.96957 14 9.5Z" fill="#1E1E4E"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.5C5.925 1.5 1 6.425 1 12.5C1 18.575 5.925 23.5 12 23.5C18.075 23.5 23 18.575 23 12.5C23 6.425 18.075 1.5 12 1.5ZM3 12.5C3 14.59 3.713 16.514 4.908 18.042C5.74723 16.9399 6.8299 16.0467 8.07143 15.4323C9.31297 14.8179 10.6797 14.4988 12.065 14.5C13.4323 14.4987 14.7819 14.8095 16.0109 15.4088C17.2399 16.008 18.316 16.8799 19.157 17.958C20.0234 16.8216 20.6068 15.4952 20.8589 14.0886C21.111 12.682 21.0244 11.2355 20.6065 9.86898C20.1886 8.50243 19.4512 7.25505 18.4555 6.23004C17.4598 5.20503 16.2343 4.43186 14.8804 3.97451C13.5265 3.51716 12.0832 3.38877 10.6699 3.59997C9.25652 3.81117 7.91379 4.35589 6.75277 5.18905C5.59175 6.02222 4.64581 7.11987 3.99323 8.3912C3.34065 9.66252 3.00018 11.071 3 12.5ZM12 21.5C9.93395 21.5031 7.93027 20.7923 6.328 19.488C6.97293 18.5647 7.83134 17.8109 8.83019 17.2907C9.82905 16.7705 10.9388 16.4992 12.065 16.5C13.1772 16.4991 14.2735 16.7636 15.2629 17.2714C16.2524 17.7793 17.1064 18.5159 17.754 19.42C16.1393 20.7667 14.1026 21.5029 12 21.5Z" fill="#1E1E4E"></path>
                                                </svg>
                                            </span>
                                            <span class="menu-title">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->routeIs('supplier.profile') ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('supplier.profile') }}">
                                            <span class="icon-bg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 9.5C16 10.5609 15.5786 11.5783 14.8284 12.3284C14.0783 13.0786 13.0609 13.5 12 13.5C10.9391 13.5 9.92172 13.0786 9.17157 12.3284C8.42143 11.5783 8 10.5609 8 9.5C8 8.43913 8.42143 7.42172 9.17157 6.67157C9.92172 5.92143 10.9391 5.5 12 5.5C13.0609 5.5 14.0783 5.92143 14.8284 6.67157C15.5786 7.42172 16 8.43913 16 9.5ZM14 9.5C14 10.0304 13.7893 10.5391 13.4142 10.9142C13.0391 11.2893 12.5304 11.5 12 11.5C11.4696 11.5 10.9609 11.2893 10.5858 10.9142C10.2107 10.5391 10 10.0304 10 9.5C10 8.96957 10.2107 8.46086 10.5858 8.08579C10.9609 7.71071 11.4696 7.5 12 7.5C12.5304 7.5 13.0391 7.71071 13.4142 8.08579C13.7893 8.46086 14 8.96957 14 9.5Z" fill="#1E1E4E"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 1.5C5.925 1.5 1 6.425 1 12.5C1 18.575 5.925 23.5 12 23.5C18.075 23.5 23 18.575 23 12.5C23 6.425 18.075 1.5 12 1.5ZM3 12.5C3 14.59 3.713 16.514 4.908 18.042C5.74723 16.9399 6.8299 16.0467 8.07143 15.4323C9.31297 14.8179 10.6797 14.4988 12.065 14.5C13.4323 14.4987 14.7819 14.8095 16.0109 15.4088C17.2399 16.008 18.316 16.8799 19.157 17.958C20.0234 16.8216 20.6068 15.4952 20.8589 14.0886C21.111 12.682 21.0244 11.2355 20.6065 9.86898C20.1886 8.50243 19.4512 7.25505 18.4555 6.23004C17.4598 5.20503 16.2343 4.43186 14.8804 3.97451C13.5265 3.51716 12.0832 3.38877 10.6699 3.59997C9.25652 3.81117 7.91379 4.35589 6.75277 5.18905C5.59175 6.02222 4.64581 7.11987 3.99323 8.3912C3.34065 9.66252 3.00018 11.071 3 12.5ZM12 21.5C9.93395 21.5031 7.93027 20.7923 6.328 19.488C6.97293 18.5647 7.83134 17.8109 8.83019 17.2907C9.82905 16.7705 10.9388 16.4992 12.065 16.5C13.1772 16.4991 14.2735 16.7636 15.2629 17.2714C16.2524 17.7793 17.1064 18.5159 17.754 19.42C16.1393 20.7667 14.1026 21.5029 12 21.5Z" fill="#1E1E4E"></path>
                                                </svg>
                                            </span>
                                            <span class="menu-title">Profile</span>
                                        </a>
                                    </li>
                                    <!-- <li class="nav-item {{ request()->routeIs('supplier.project') ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('supplier.project') }}">
                                            <span class="icon-bg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                    <path d="M4 20.5C3.45 20.5 2.979 20.304 2.587 19.912C2.195 19.52 1.99934 19.0493 2 18.5V6.5C2 5.95 2.196 5.479 2.588 5.087C2.98 4.695 3.45067 4.49934 4 4.5H10L12 6.5H20C20.55 6.5 21.021 6.696 21.413 7.088C21.805 7.48 22.0007 7.95067 22 8.5H11.175L9.175 6.5H4V18.5L6.4 10.5H23.5L20.925 19.075C20.7917 19.5083 20.5457 19.8543 20.187 20.113C19.8283 20.3717 19.4327 20.5007 19 20.5H4ZM6.1 18.5H19L20.8 12.5H7.9L6.1 18.5Z" fill="white"></path>                                                    
                                                </svg>
                                            </span>
                                            <span class="menu-title">My Projects</span>
                                        </a>
                                    </li> -->
                                     <!-- <li class="nav-item menu_toggle {{ request()->routeIs('supplier.raised.rfq') ? ' active' : '' }}">
                                        <a class="nav-link" href="javascript:void(0);" onclick="showsubMenuDiv()">
                                            <span class="icon-bg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                    <g clip-path="url(#clip0_15840_1924)">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 5.5C4 4.70435 4.31607 3.94129 4.87868 3.37868C5.44129 2.81607 6.20435 2.5 7 2.5H17C17.7956 2.5 18.5587 2.81607 19.1213 3.37868C19.6839 3.94129 20 4.70435 20 5.5V21.5C19.9999 21.6883 19.9466 21.8728 19.8462 22.0322C19.7459 22.1916 19.6025 22.3194 19.4327 22.4009C19.2629 22.4824 19.0736 22.5143 18.8864 22.4929C18.6993 22.4715 18.522 22.3977 18.375 22.28L16.5 20.78L14.625 22.28C14.4329 22.4339 14.1908 22.5115 13.945 22.4981C13.6993 22.4846 13.4671 22.381 13.293 22.207L12 20.914L10.707 22.207C10.533 22.3811 10.3009 22.4849 10.0551 22.4986C9.80938 22.5122 9.56721 22.4348 9.375 22.281L7.5 20.78L5.625 22.28C5.47797 22.3977 5.30069 22.4715 5.11356 22.4929C4.92643 22.5143 4.73707 22.4824 4.56727 22.4009C4.39747 22.3194 4.25414 22.1916 4.15378 22.0322C4.05342 21.8728 4.00012 21.6883 4 21.5V5.5ZM7 4.5C6.73478 4.5 6.48043 4.60536 6.29289 4.79289C6.10536 4.98043 6 5.23478 6 5.5V19.42L6.875 18.72C7.05236 18.578 7.27279 18.5006 7.5 18.5006C7.72721 18.5006 7.94764 18.578 8.125 18.72L9.925 20.16L11.293 18.793C11.4805 18.6055 11.7348 18.5002 12 18.5002C12.2652 18.5002 12.5195 18.6055 12.707 18.793L14.074 20.16L15.875 18.72C16.0524 18.578 16.2728 18.5006 16.5 18.5006C16.7272 18.5006 16.9476 18.578 17.125 18.72L18 19.42V5.5C18 5.23478 17.8946 4.98043 17.7071 4.79289C17.5196 4.60536 17.2652 4.5 17 4.5H7ZM8 9.5C8 9.23478 8.10536 8.98043 8.29289 8.79289C8.48043 8.60536 8.73478 8.5 9 8.5H15C15.2652 8.5 15.5196 8.60536 15.7071 8.79289C15.8946 8.98043 16 9.23478 16 9.5C16 9.76522 15.8946 10.0196 15.7071 10.2071C15.5196 10.3946 15.2652 10.5 15 10.5H9C8.73478 10.5 8.48043 10.3946 8.29289 10.2071C8.10536 10.0196 8 9.76522 8 9.5ZM9 12.5C8.73478 12.5 8.48043 12.6054 8.29289 12.7929C8.10536 12.9804 8 13.2348 8 13.5C8 13.7652 8.10536 14.0196 8.29289 14.2071C8.48043 14.3946 8.73478 14.5 9 14.5H12C12.2652 14.5 12.5196 14.3946 12.7071 14.2071C12.8946 14.0196 13 13.7652 13 13.5C13 13.2348 12.8946 12.9804 12.7071 12.7929C12.5196 12.6054 12.2652 12.5 12 12.5H9Z" fill="white"></path>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_15840_1924">
                                                            <rect width="24" height="24" fill="white" transform="translate(0 0.5)"></rect>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            <span class="menu-title">RFQ</span>
                                        </a>
                                        <ul class="nk-menu-sub" id="subMenu">
                                            <li> <a href="{{ route('supplier.raised.rfq') }}"> -- Raised RFQ</a></li>
                                            <li> <a href="{{ route('supplier.received.quotation') }}">-- Received Quotation</a></li>
                                        </ul>
                                    </li> -->


                                    <li class="nav-item menu_toggle 
    {{ request()->routeIs('supplier.raised.rfq','supplier.received.quotation') ? ' active' : '' }}">
    <a class="nav-link" href="javascript:void(0);" onclick="showsubMenuDiv()">
       <span class="icon-bg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                    <g clip-path="url(#clip0_15840_1924)">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 5.5C4 4.70435 4.31607 3.94129 4.87868 3.37868C5.44129 2.81607 6.20435 2.5 7 2.5H17C17.7956 2.5 18.5587 2.81607 19.1213 3.37868C19.6839 3.94129 20 4.70435 20 5.5V21.5C19.9999 21.6883 19.9466 21.8728 19.8462 22.0322C19.7459 22.1916 19.6025 22.3194 19.4327 22.4009C19.2629 22.4824 19.0736 22.5143 18.8864 22.4929C18.6993 22.4715 18.522 22.3977 18.375 22.28L16.5 20.78L14.625 22.28C14.4329 22.4339 14.1908 22.5115 13.945 22.4981C13.6993 22.4846 13.4671 22.381 13.293 22.207L12 20.914L10.707 22.207C10.533 22.3811 10.3009 22.4849 10.0551 22.4986C9.80938 22.5122 9.56721 22.4348 9.375 22.281L7.5 20.78L5.625 22.28C5.47797 22.3977 5.30069 22.4715 5.11356 22.4929C4.92643 22.5143 4.73707 22.4824 4.56727 22.4009C4.39747 22.3194 4.25414 22.1916 4.15378 22.0322C4.05342 21.8728 4.00012 21.6883 4 21.5V5.5ZM7 4.5C6.73478 4.5 6.48043 4.60536 6.29289 4.79289C6.10536 4.98043 6 5.23478 6 5.5V19.42L6.875 18.72C7.05236 18.578 7.27279 18.5006 7.5 18.5006C7.72721 18.5006 7.94764 18.578 8.125 18.72L9.925 20.16L11.293 18.793C11.4805 18.6055 11.7348 18.5002 12 18.5002C12.2652 18.5002 12.5195 18.6055 12.707 18.793L14.074 20.16L15.875 18.72C16.0524 18.578 16.2728 18.5006 16.5 18.5006C16.7272 18.5006 16.9476 18.578 17.125 18.72L18 19.42V5.5C18 5.23478 17.8946 4.98043 17.7071 4.79289C17.5196 4.60536 17.2652 4.5 17 4.5H7ZM8 9.5C8 9.23478 8.10536 8.98043 8.29289 8.79289C8.48043 8.60536 8.73478 8.5 9 8.5H15C15.2652 8.5 15.5196 8.60536 15.7071 8.79289C15.8946 8.98043 16 9.23478 16 9.5C16 9.76522 15.8946 10.0196 15.7071 10.2071C15.5196 10.3946 15.2652 10.5 15 10.5H9C8.73478 10.5 8.48043 10.3946 8.29289 10.2071C8.10536 10.0196 8 9.76522 8 9.5ZM9 12.5C8.73478 12.5 8.48043 12.6054 8.29289 12.7929C8.10536 12.9804 8 13.2348 8 13.5C8 13.7652 8.10536 14.0196 8.29289 14.2071C8.48043 14.3946 8.73478 14.5 9 14.5H12C12.2652 14.5 12.5196 14.3946 12.7071 14.2071C12.8946 14.0196 13 13.7652 13 13.5C13 13.2348 12.8946 12.9804 12.7071 12.7929C12.5196 12.6054 12.2652 12.5 12 12.5H9Z" fill="white"></path>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_15840_1924">
                                                            <rect width="24" height="24" fill="white" transform="translate(0 0.5)"></rect>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
        <span class="menu-title">RFQ</span>
    </a>

    <ul class="nk-menu-sub" id="subMenu" 
        style="display: {{ request()->routeIs('supplier.raised.rfq','supplier.received.quotation', 'supplier.pending') ? 'block' : 'none' }};">
        <li class="{{ request()->routeIs('supplier.raised.rfq') ? ' active' : '' }}">
            <a href="{{route('supplier.raised.rfq')}}">-- Raised RFQ</a>
        </li>
        <li class="{{ request()->routeIs('supplier.received.quotation') ? ' active' : '' }}">
            <a href="{{route('supplier.received.quotation')}}">-- Received Quotation</a>
        </li>
        <li class="{{ request()->routeIs('supplier.pending') ? ' active' : '' }}">
            <a href="{{route('supplier.pending')}}">-- Pending</a>
        </li>
    </ul>
</li>



                                    <li class="nav-item {{ request()->routeIs('supplier.order') ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('supplier.order') }}">
                                            <span class="icon-bg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                    <path d="M23.1956 11.4688L21.8831 8.1875C21.7718 7.90988 21.5796 7.67209 21.3316 7.50494C21.0835 7.33778 20.791 7.24897 20.4919 7.25H17.25V6.5C17.25 6.30109 17.171 6.11032 17.0303 5.96967C16.8897 5.82902 16.6989 5.75 16.5 5.75H2.25C1.85218 5.75 1.47064 5.90804 1.18934 6.18934C0.908035 6.47064 0.75 6.85218 0.75 7.25V17.75C0.75 18.1478 0.908035 18.5294 1.18934 18.8107C1.47064 19.092 1.85218 19.25 2.25 19.25H3.84375C4.00898 19.8953 4.38428 20.4673 4.91048 20.8757C5.43669 21.2842 6.08387 21.5059 6.75 21.5059C7.41613 21.5059 8.06331 21.2842 8.58952 20.8757C9.11572 20.4673 9.49102 19.8953 9.65625 19.25H14.3437C14.509 19.8953 14.8843 20.4673 15.4105 20.8757C15.9367 21.2842 16.5839 21.5059 17.25 21.5059C17.9161 21.5059 18.5633 21.2842 19.0895 20.8757C19.6157 20.4673 19.991 19.8953 20.1562 19.25H21.75C22.1478 19.25 22.5294 19.092 22.8107 18.8107C23.092 18.5294 23.25 18.1478 23.25 17.75V11.75C23.2503 11.6536 23.2318 11.5581 23.1956 11.4688ZM17.25 8.75H20.4919L21.3919 11H17.25V8.75ZM2.25 7.25H15.75V13.25H2.25V7.25ZM6.75 20C6.45333 20 6.16332 19.912 5.91664 19.7472C5.66997 19.5824 5.47771 19.3481 5.36418 19.074C5.25065 18.7999 5.22094 18.4983 5.27882 18.2074C5.3367 17.9164 5.47956 17.6491 5.68934 17.4393C5.89912 17.2296 6.16639 17.0867 6.45736 17.0288C6.74834 16.9709 7.04994 17.0006 7.32402 17.1142C7.59811 17.2277 7.83238 17.42 7.9972 17.6666C8.16203 17.9133 8.25 18.2033 8.25 18.5C8.25 18.8978 8.09196 19.2794 7.81066 19.5607C7.52935 19.842 7.14782 20 6.75 20ZM14.3437 17.75H9.65625C9.49102 17.1047 9.11572 16.5327 8.58952 16.1243C8.06331 15.7158 7.41613 15.4941 6.75 15.4941C6.08387 15.4941 5.43669 15.7158 4.91048 16.1243C4.38428 16.5327 4.00898 17.1047 3.84375 17.75H2.25V14.75H15.75V15.9041C15.4051 16.1034 15.1032 16.3692 14.8619 16.6861C14.6205 17.0029 14.4444 17.3646 14.3437 17.75ZM17.25 20C16.9533 20 16.6633 19.912 16.4166 19.7472C16.17 19.5824 15.9777 19.3481 15.8642 19.074C15.7506 18.7999 15.7209 18.4983 15.7788 18.2074C15.8367 17.9164 15.9796 17.6491 16.1893 17.4393C16.3991 17.2296 16.6664 17.0867 16.9574 17.0288C17.2483 16.9709 17.5499 17.0006 17.824 17.1142C18.0981 17.2277 18.3324 17.42 18.4972 17.6666C18.662 17.9133 18.75 18.2033 18.75 18.5C18.75 18.8978 18.592 19.2794 18.3107 19.5607C18.0294 19.842 17.6478 20 17.25 20ZM21.75 17.75H20.1562C19.989 17.1063 19.613 16.5362 19.0871 16.129C18.5612 15.7218 17.9151 15.5006 17.25 15.5V12.5H21.75V17.75Z" fill="white"></path>
                                                </svg>
                                            </span>
                                            <span class="menu-title">Orders</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->routeIs('supplier.payment') ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('supplier.payment') }}">
                                            <span class="icon-bg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                    <g clip-path="url(#clip0_15840_1902)">
                                                        <path d="M20 8.5H4V6.5H20V8.5ZM18 2.5H6V4.5H18V2.5ZM10.312 21.6L7.012 18.3L8.412 16.9L10.312 18.8L15.612 13.5L17.012 14.9L10.312 21.6Z" fill="white"></path>
                                                        <path d="M22 10.5H2C1.46957 10.5 0.960859 10.7107 0.585786 11.0858C0.210714 11.4609 0 11.9696 0 12.5L0 22.5C0 23.0304 0.210714 23.5391 0.585786 23.9142C0.960859 24.2893 1.46957 24.5 2 24.5H22C22.5304 24.5 23.0391 24.2893 23.4142 23.9142C23.7893 23.5391 24 23.0304 24 22.5V12.5C24 11.9696 23.7893 11.4609 23.4142 11.0858C23.0391 10.7107 22.5304 10.5 22 10.5ZM22 22.5H2V12.5H22V22.5Z" fill="white"></path>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_15840_1902">
                                                            <rect width="24" height="24" fill="white" transform="translate(0 0.5)"></rect>
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            <span class="menu-title">Payments</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->routeIs('supplier.earning') ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('supplier.earning') }}">
                                            <span class="icon-bg">
                                               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                    <g clip-path="url(#clip0_15840_1902)">
                                                        <path d="M20 8.5H4V6.5H20V8.5ZM18 2.5H6V4.5H18V2.5ZM10.312 21.6L7.012 18.3L8.412 16.9L10.312 18.8L15.612 13.5L17.012 14.9L10.312 21.6Z" fill="white"></path>
                                                        <path d="M22 10.5H2C1.46957 10.5 0.960859 10.7107 0.585786 11.0858C0.210714 11.4609 0 11.9696 0 12.5L0 22.5C0 23.0304 0.210714 23.5391 0.585786 23.9142C0.960859 24.2893 1.46957 24.5 2 24.5H22C22.5304 24.5 23.0391 24.2893 23.4142 23.9142C23.7893 23.5391 24 23.0304 24 22.5V12.5C24 11.9696 23.7893 11.4609 23.4142 11.0858C23.0391 10.7107 22.5304 10.5 22 10.5ZM22 22.5H2V12.5H22V22.5Z" fill="white"></path>
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_15840_1902">
                                                            <rect width="24" height="24" fill="white" transform="translate(0 0.5)"></rect>
                                                        </clipPath>
                                                    </defs>
                                                </svg>  </span>
                                            <span class="menu-title">Earning</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->routeIs('supplier.message') ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('supplier.message') }}">
                                            <span class="icon-bg">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M112 128C85.5 128 64 149.5 64 176C64 191.1 71.1 205.3 83.2 214.4L291.2 370.4C308.3 383.2 331.7 383.2 348.8 370.4L556.8 214.4C568.9 205.3 576 191.1 576 176C576 149.5 554.5 128 528 128L112 128zM64 260L64 448C64 483.3 92.7 512 128 512L512 512C547.3 512 576 483.3 576 448L576 260L377.6 408.8C343.5 434.4 296.5 434.4 262.4 408.8L64 260z"/></svg>
                                            </span>
                                            <span class="menu-title">Messages</span>
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->routeIs('notifications.index') ? ' active' : '' }}">
                                        <a class="nav-link" href="{{ route('notifications.index') }}">
                                            <span class="icon-bg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M5 19C4.71667 19 4.479 18.904 4.287 18.712C4.095 18.52 3.99934 18.2827 4 18C4 17.7167 4.096 17.479 4.288 17.287C4.48 17.095 4.71734 16.9993 5 17H6V10C6 8.61667 6.41667 7.38734 7.25 6.312C8.08334 5.23667 9.16667 4.53267 10.5 4.2V3.5C10.5 3.08334 10.646 2.729 10.938 2.437C11.23 2.145 11.584 1.99934 12 2C12.4167 2 12.771 2.146 13.063 2.438C13.355 2.73 13.5007 3.084 13.5 3.5V4.2C14.8333 4.53334 15.9167 5.23767 16.75 6.313C17.5833 7.38834 18 8.61734 18 10V17H19C19.2833 17 19.521 17.096 19.713 17.288C19.905 17.48 20.0007 17.7173 20 18C20 18.2833 19.904 18.521 19.712 18.713C19.52 18.905 19.2827 19.0007 19 19H5ZM12 22C11.45 22 10.979 21.804 10.587 21.412C10.195 21.02 9.99934 20.5493 10 20H14C14 20.55 13.804 21.021 13.412 21.413C13.02 21.805 12.5493 22.0007 12 22ZM8 17H16V10C16 8.9 15.6083 7.95834 14.825 7.175C14.0417 6.39167 13.1 6 12 6C10.9 6 9.95834 6.39167 9.175 7.175C8.39167 7.95834 8 8.9 8 10V17Z" fill="white"></path>
                                                </svg>
                                            </span>
                                            <span class="menu-title">Notifications</span>
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item {{ request()->routeIs('supplier.logout') ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('supplier.logout') }}">
                                        <span class="icon-bg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M15.325 16.275C15.1417 16.0583 15.05 15.8127 15.05 15.538C15.05 15.2633 15.1417 15.034 15.325 14.85L17.175 13H10C9.71667 13 9.479 12.904 9.287 12.712C9.095 12.52 8.99934 12.2827 9 12C9 11.7167 9.096 11.479 9.288 11.287C9.48 11.095 9.71734 10.9993 10 11H17.175L15.325 9.15C15.125 8.95 15.025 8.71234 15.025 8.437C15.025 8.16167 15.125 7.92434 15.325 7.725C15.5083 7.525 15.7377 7.425 16.013 7.425C16.2883 7.425 16.5173 7.51667 16.7 7.7L20.3 11.3C20.4 11.4 20.471 11.5083 20.513 11.625C20.555 11.7417 20.5757 11.8667 20.575 12C20.575 12.1333 20.5543 12.2583 20.513 12.375C20.4717 12.4917 20.4007 12.6 20.3 12.7L16.7 16.3C16.4833 16.5167 16.2457 16.6127 15.987 16.588C15.7283 16.5633 15.5077 16.459 15.325 16.275ZM5 21C4.45 21 3.979 20.804 3.587 20.412C3.195 20.02 2.99934 19.5493 3 19V5C3 4.45 3.196 3.979 3.588 3.587C3.98 3.195 4.45067 2.99934 5 3H11C11.2833 3 11.521 3.096 11.713 3.288C11.905 3.48 12.0007 3.71734 12 4C12 4.28334 11.904 4.521 11.712 4.713C11.52 4.905 11.2827 5.00067 11 5H5V19H11C11.2833 19 11.521 19.096 11.713 19.288C11.905 19.48 12.0007 19.7173 12 20C12 20.2833 11.904 20.521 11.712 20.713C11.52 20.905 11.2827 21.0007 11 21H5Z" fill="white"></path>
                                            </svg>
                                        </span>
                                        <span class="menu-title">Logout</span>
                                    </a>
                                    </li>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="main-panel ">
                        <div class="header_dash">
                            <div class="head_title">Welcome, {{ auth()->user()->name }}
                                @if(auth()->check() && (int)(auth()->user()->status ?? 0) !== 1)
                                    <span class="badge bg-danger ms-3">Account not approved. Please contact support.</span>
                                @endif
                                @php
                                    $activePurchase = null;
                                    if(auth()->check()){
                                        $activePurchase = \App\Models\SubscriptionPurchase::where('user_id', auth()->id())
                                            ->where('is_active', true)
                                            ->whereDate('end_date', '>=', now()->toDateString())
                                            ->first();
                                    }
                                @endphp
                               
                            </div>
                            <div class="user_hd">
                                <button class="btn notif_btn" onclick="toggleNotificationDropdown()">
                                    <img src="{{ asset('assets/admin/images/notification-bing.png') }}" alt="">
                                    <span id="notification-count" class="notification-badge" style="display: none;">0</span>
                                </button>
                                
                                <!-- Notification Dropdown -->
                                <div id="notification-dropdown" class="notification-dropdown" style="display: none;">
                                    <div class="notification-header">
                                        <h6>Notifications</h6>
                                        <button class="btn btn-sm btn-outline-primary" onclick="markAllAsRead()">Mark All Read</button>
                                    </div>
                                    <div id="notification-list" class="notification-list">
                                        <!-- Notifications will be loaded here -->
                                    </div>
                                    <div class="notification-footer">
                                        <a href="{{ route('notifications.index') }}" class="btn btn-sm btn-primary w-100">View All Notifications</a>
                                    </div>
                                </div>




                                <div class="dropdown">
                                    <button type="button" id="dropdown-basic" data-bs-toggle="dropdown"
                                        aria-expanded="false" class="btn dropdown-toggle btn btn-success">
                                    <img src="{{ auth()->user()->profile_image ? asset(auth()->user()->profile_image) : asset('assets/images/defaultProfile.png') }}" alt="" style=" height:50px; width:50px; border-radius:10px;" >
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('supplier.profile') }}" data-rr-ui-dropdown-item="" class="dropdown-item">My
                                            Profile</a>
                                            <a href="{{ route('supplier.logout') }}" data-rr-ui-dropdown-item=""
                                            class="dropdown-item">Logout</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                
     
    <style>
    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: #dc3545;
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .notification-dropdown {
        position: absolute;
        top: 100%;
        right: 0;
        width: 350px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1000;
        max-height: 400px;
        overflow: hidden;
    }

    .notification-header {
        padding: 15px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .notification-list {
        max-height: 250px;
        overflow-y: auto;
    }

    .notification-item {
        padding: 12px 15px;
        border-bottom: 1px solid #f0f0f0;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .notification-item:hover {
        background-color: #f8f9fa;
    }

    .notification-item.unread {
        background-color: #f0f8ff;
        border-left: 3px solid #007bff;
    }

    .notification-footer {
        padding: 15px;
        border-top: 1px solid #eee;
    }

    .user_hd {
        position: relative;
    }

    .notif_btn {
        position: relative;
    }
    </style>

    <script>
    // Load notification count on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadNotificationCount();
        loadRecentNotifications();
        
        // Auto-refresh notifications every 30 seconds
        setInterval(function() {
            loadNotificationCount();
            loadRecentNotifications();
        }, 30000);
    });

    function loadNotificationCount() {
       fetch(`{{ route('notifications.unread-count') }}`)
       
            .then(response => response.json())
            .then(data => {
                const countElement = document.getElementById('notification-count');
                if (data.count > 0) {
                    countElement.textContent = data.count;
                    countElement.style.display = 'flex';
                } else {
                    countElement.style.display = 'none';
                }
            })
            .catch(error => console.error('Error loading notification count:', error));
    }

    function loadRecentNotifications() {
         fetch(`{{ route('notifications.recent') }}`)
            .then(response => response.json())
            .then(notifications => {
                const notificationList = document.getElementById('notification-list');
                notificationList.innerHTML = '';
                
                if (notifications.length === 0) {
                    notificationList.innerHTML = '<div class="text-center p-3 text-muted">No notifications</div>';
                    return;
                }
                
                notifications.forEach(notification => {
                    const notificationItem = document.createElement('div');
                    notificationItem.className = `notification-item ${notification.is_read ? 'read' : 'unread'}`;
                    notificationItem.onclick = () => markNotificationAsRead(notification.id);
                    
                    const timeAgo = new Date(notification.created_at).toLocaleString();
                    
                    notificationItem.innerHTML = `
                        <div class="d-flex align-items-start">
                            <div class="me-2">
                                ${getNotificationIcon(notification.type)}
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">${notification.title}</h6>
                                <p class="mb-1 text-muted small">${notification.message}</p>
                                <small class="text-muted">${timeAgo}</small>
                            </div>
                        </div>
                    `;
                    
                    notificationList.appendChild(notificationItem);
                });
            })
            .catch(error => console.error('Error loading notifications:', error));
    }

    function getNotificationIcon(type) {
        const icons = {
            'quotation': '<i class="fas fa-file-invoice text-primary"></i>',
            'message': '<i class="fas fa-comment text-info"></i>',
            'registration': '<i class="fas fa-user-plus text-success"></i>',
            'payment': '<i class="fas fa-credit-card text-warning"></i>',
            'plan_purchase': '<i class="fas fa-crown text-purple"></i>'
        };
        return icons[type] || '<i class="fas fa-bell text-secondary"></i>';
    }

    function toggleNotificationDropdown() {
        const dropdown = document.getElementById('notification-dropdown');
        if (dropdown.style.display === 'none') {
            dropdown.style.display = 'block';
            loadRecentNotifications();
        } else {
            dropdown.style.display = 'none';
        }
    }

    function markNotificationAsRead(notificationId) {
        const markAsReadUrl = `{{ route('notifications.mark-read', ':notificationId') }}`.replace(':notificationId', notificationId);
        fetch(markAsReadUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadNotificationCount();
                loadRecentNotifications();
            }
        })
        .catch(error => console.error('Error marking notification as read:', error));
    }

    function markAllAsRead() {
        const markAsReadUrl = `{{ route('notifications.mark-all-read') }}`;
        fetch(markAsReadUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadNotificationCount();
                loadRecentNotifications();
            }
        })
        .catch(error => console.error('Error marking all as read:', error));
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('notification-dropdown');
        const button = document.querySelector('.notif_btn');
        
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });
    </script>