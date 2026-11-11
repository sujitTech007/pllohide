@include('supplier.include.header')

<div class="content-wrapper">

    <div class="dashboard_inner">
        <div class="heading_bx">
            <h3>Personal Information</h3>
        </div>
        <div class="Profile_info">
            <div class="cover_prof"><img src="{{ auth()->user()->banner ? asset(auth()->user()->banner) : asset('assets/images/cover01.png') }}" alt="">
                <div class="cover_details">
                    <div class="user"><img src="{{ auth()->user()->profile_image ? asset(auth()->user()->profile_image) : asset('assets/images/defaultProfile.png') }}" alt="">
                    </div>
                    <h3>{{ auth()->user()->name ?? 'User' }}</h3>
                    @php
                    $roleMap = [
                    '1' => 'Designer',
                    '2' => 'Supplier',
                    '3' => 'Manufacturer',
                    ];
                    $roleText = $roleMap[(string)(auth()->user()->role ?? '')] ?? ucfirst((string)(auth()->user()->role ?? ''));
                    @endphp
                    <p>{{ $roleText }}</p>
                    <p class="mt-3"><span><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                height="20" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M20.6201 8.45C19.5701 3.83 15.5401 1.75 12.0001 1.75C12.0001 1.75 12.0001 1.75 11.9901 1.75C8.4601 1.75 4.4201 3.82 3.3701 8.44C2.2001 13.6 5.3601 17.97 8.2201 20.72C9.2801 21.74 10.6401 22.25 12.0001 22.25C13.3601 22.25 14.7201 21.74 15.7701 20.72C18.6301 17.97 21.7901 13.61 20.6201 8.45ZM12.0001 13.46C10.2601 13.46 8.8501 12.05 8.8501 10.31C8.8501 8.57 10.2601 7.16 12.0001 7.16C13.7401 7.16 15.1501 8.57 15.1501 10.31C15.1501 12.05 13.7401 13.46 12.0001 13.46Z"
                                    fill="#292D32"></path>
                            </svg></span><small>Toronto, CA</small></p>
                </div>
            </div>
            <div class="Contact_info">
                <ul>
                    <li><span><svg xmlns="http://www.w3.org/2000/svg" width="18" height="15"
                                viewBox="0 0 18 15" fill="none">
                                <path
                                    d="M17.65 1.765C17.65 0.79425 16.8557 0 15.885 0H1.765C0.79425 0 0 0.79425 0 1.765V12.355C0 13.3257 0.79425 14.12 1.765 14.12H15.885C16.8557 14.12 17.65 13.3257 17.65 12.355V1.765ZM15.885 1.765L8.825 6.1775L1.765 1.765H15.885ZM15.885 12.355H1.765V3.53L8.825 7.9425L15.885 3.53V12.355Z"
                                    fill="#333BA4"></path>
                            </svg></span><span>{{ auth()->user()->email ?? '—' }}</span></li>
                    <li><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M12 12C12.55 12 13.021 11.804 13.413 11.412C13.805 11.02 14.0007 10.5493 14 10C14 9.45 13.804 8.979 13.412 8.587C13.02 8.195 12.5493 7.99933 12 8C11.45 8 10.979 8.196 10.587 8.588C10.195 8.98 9.99933 9.45067 10 10C10 10.55 10.196 11.021 10.588 11.413C10.98 11.805 11.4507 12.0007 12 12ZM12 19.35C14.0333 17.4833 15.5417 15.7873 16.525 14.262C17.5083 12.7367 18 11.3827 18 10.2C18 8.38333 17.4207 6.896 16.262 5.738C15.1033 4.58 13.6827 4.00067 12 4C10.3167 4 8.89567 4.57933 7.737 5.738C6.57833 6.89667 5.99933 8.384 6 10.2C6 11.3833 6.49167 12.7377 7.475 14.263C8.45833 15.7883 9.96667 17.484 12 19.35ZM12 22C9.31667 19.7167 7.31267 17.596 5.988 15.638C4.66333 13.68 4.00067 11.8673 4 10.2C4 7.7 4.80433 5.70833 6.413 4.225C8.02167 2.74167 9.884 2 12 2C14.1167 2 15.9793 2.74167 17.588 4.225C19.1967 5.70833 20.0007 7.7 20 10.2C20 11.8667 19.3373 13.6793 18.012 15.638C16.6867 17.5967 14.6827 19.7173 12 22Z"
                                    fill="#333BA4"></path>
                            </svg></span><span>{{ auth()->user()->phone ?? '—' }}</span></li>
                </ul>
            </div>
        </div>
        <div class="heading_bx mt-3">
            <h3>business Information</h3>
        </div>
        <div class="Profile_info">
            <div class="cover_prof"><img src="{{ asset('assets/images/cover02.png') }}" alt="">
                <div class="cover_details">
                    <div class="user"><img
                            src="{{ @$company?->image ? asset(@$company->image) : asset('assets/images/defaultProfile.png') }}"
                            alt=""></div>
                    <h3>{{ @@$company->name }}</h3>
                    <p class="mt-3"><span><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                height="20" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M20.6201 8.45C19.5701 3.83 15.5401 1.75 12.0001 1.75C12.0001 1.75 12.0001 1.75 11.9901 1.75C8.4601 1.75 4.4201 3.82 3.3701 8.44C2.2001 13.6 5.3601 17.97 8.2201 20.72C9.2801 21.74 10.6401 22.25 12.0001 22.25C13.3601 22.25 14.7201 21.74 15.7701 20.72C18.6301 17.97 21.7901 13.61 20.6201 8.45ZM12.0001 13.46C10.2601 13.46 8.8501 12.05 8.8501 10.31C8.8501 8.57 10.2601 7.16 12.0001 7.16C13.7401 7.16 15.1501 8.57 15.1501 10.31C15.1501 12.05 13.7401 13.46 12.0001 13.46Z"
                                    fill="#292D32"></path>
                            </svg></span><small>{{ @@$company->address }}</small></p>
                </div>
            </div>
            <div class="Contact_info">
                <ul>
                    <li><span><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                viewBox="0 0 25 25" fill="none">
                                <path
                                    d="M22.9181 12.5921C22.9196 14.64 22.3174 16.6429 21.1868 18.3505C20.0563 20.0581 18.4475 21.3945 16.5615 22.1928C14.6756 22.991 12.5962 23.2157 10.5833 22.8387C8.57041 22.4617 6.71327 21.4998 5.24405 20.0732C3.77482 18.6465 2.7587 16.8184 2.32269 14.8175C1.88669 12.8165 2.05014 10.7314 2.79263 8.82286C3.53511 6.91429 4.82369 5.2669 6.49727 4.08662C8.17086 2.90635 10.1552 2.24555 12.2023 2.18683C12.3993 2.16136 12.5987 2.16136 12.7957 2.18683C15.5053 2.26219 18.0786 3.39125 19.9688 5.33404C21.859 7.27684 22.9171 9.8815 22.9181 12.5921ZM9.01413 20.8395C9.23693 20.9333 9.46281 21.018 9.69176 21.0934C8.32703 18.7249 7.6134 16.0375 7.62334 13.3039H3.5707C3.70292 14.9375 4.28022 16.5035 5.23988 17.832C6.19955 19.1605 7.50489 20.2007 9.01413 20.8395ZM4.2457 9.10789C3.87658 9.97923 3.64958 10.9041 3.57334 11.8474H7.62334C7.61511 9.1303 8.31824 6.45842 9.66281 4.09736C9.44439 4.17017 9.22816 4.25175 9.01413 4.3421C6.86675 5.25219 5.15698 6.96101 4.2457 9.10789ZM15.9168 11.8474C15.8844 10.8266 15.7695 9.81014 15.5733 8.80789C15.3815 7.7825 15.0665 6.78405 14.6352 5.8342C14.047 4.58157 13.3075 3.76446 12.6654 3.64078C12.5545 3.63912 12.4435 3.63912 12.3325 3.64078C11.6904 3.76446 10.951 4.58157 10.3628 5.83552C9.93197 6.78542 9.61742 7.78388 9.42597 8.8092C9.22986 9.81102 9.11501 10.827 9.08255 11.8474H15.9168ZM14.6352 19.3158C15.0665 18.3659 15.3815 17.3675 15.5733 16.3421C15.769 15.3402 15.8834 14.3242 15.9154 13.3039H9.08386C9.1163 14.3247 9.23115 15.3412 9.42728 16.3434C9.6188 17.3683 9.93335 18.3663 10.3641 19.3158C11.0049 20.6789 11.8233 21.5263 12.501 21.5263C13.1786 21.5263 13.997 20.6789 14.6365 19.3158H14.6352ZM20.7562 16.0763C21.1295 15.1947 21.3574 14.2584 21.4312 13.3039H17.376C17.3865 16.0384 16.6728 18.7268 15.3075 21.096C15.5365 21.0206 15.7632 20.9355 15.9878 20.8408C18.1349 19.931 19.8447 18.2227 20.7562 16.0763ZM15.9878 4.3421C15.7735 4.25165 15.5558 4.16957 15.3352 4.09604C16.6799 6.45706 17.383 9.12897 17.3747 11.846H21.4286C21.2912 10.2183 20.7118 8.65905 19.7529 7.33658C18.7941 6.01411 17.4922 4.97869 15.9878 4.3421Z"
                                    fill="#333BA4"></path>
                            </svg></span><span>{{ @$company->website }}</span></li>
                    <li><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M12 12C12.55 12 13.021 11.804 13.413 11.412C13.805 11.02 14.0007 10.5493 14 10C14 9.45 13.804 8.979 13.412 8.587C13.02 8.195 12.5493 7.99933 12 8C11.45 8 10.979 8.196 10.587 8.588C10.195 8.98 9.99933 9.45067 10 10C10 10.55 10.196 11.021 10.588 11.413C10.98 11.805 11.4507 12.0007 12 12ZM12 19.35C14.0333 17.4833 15.5417 15.7873 16.525 14.262C17.5083 12.7367 18 11.3827 18 10.2C18 8.38333 17.4207 6.896 16.262 5.738C15.1033 4.58 13.6827 4.00067 12 4C10.3167 4 8.89567 4.57933 7.737 5.738C6.57833 6.89667 5.99933 8.384 6 10.2C6 11.3833 6.49167 12.7377 7.475 14.263C8.45833 15.7883 9.96667 17.484 12 19.35ZM12 22C9.31667 19.7167 7.31267 17.596 5.988 15.638C4.66333 13.68 4.00067 11.8673 4 10.2C4 7.7 4.80433 5.70833 6.413 4.225C8.02167 2.74167 9.884 2 12 2C14.1167 2 15.9793 2.74167 17.588 4.225C19.1967 5.70833 20.0007 7.7 20 10.2C20 11.8667 19.3373 13.6793 18.012 15.638C16.6867 17.5967 14.6827 19.7173 12 22Z"
                                    fill="#333BA4"></path>
                            </svg></span><span>{{ @$company->address }}</span></li>
                    <li>
                        <div><span><svg xmlns="http://www.w3.org/2000/svg" width="32"
                                    height="32" viewBox="0 0 32 32" fill="none">
                                    <path
                                        d="M15 5C13.906 5 13 5.906 13 7V8H4V26H28V8H19V7C19 5.906 18.094 5 17 5H15ZM15 7H17V9H15V7ZM6 10H13V11H19V10H26V24H6V10ZM16 12C13.8 12 12 13.8 12 16C12.001 16.533 12.1091 17.0603 12.3178 17.5508C12.5265 18.0412 12.8316 18.4847 13.215 18.855C12.5345 19.3116 11.9766 19.9284 11.5904 20.6512C11.2042 21.3739 11.0014 22.1805 11 23H13C13 21.332 14.332 20 16 20C17.668 20 19 21.332 19 23H21C20.9986 22.1805 20.7958 21.3739 20.4096 20.6512C20.0234 19.9284 19.4655 19.3116 18.785 18.855C19.1684 18.4847 19.4735 18.0412 19.6822 17.5508C19.8909 17.0603 19.999 16.533 20 16C20 13.8 18.2 12 16 12ZM16 14C17.117 14 18 14.883 18 16C18 17.117 17.117 18 16 18C14.883 18 14 17.117 14 16C14 14.883 14.883 14 16 14Z"
                                        fill="#333BA4"></path>
                                </svg></span><span><a target="_blank">Industry
                                    license.jpg</a></span></div><label for="Choose"
                            class="Choose_file"><input type="file" name="" id="Choose"
                                class="form-control"><span>Choose File</span></label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="heading_bx mt-3">
            <h3>Portfolio</h3>
        </div>
        <div class="Portfolio_wrapp">
            <ul>
                   @foreach($portfolios as $portfolio)
                <li>
                    <img src="{{ asset('portfolios/'. $portfolio->image) }}" alt="">
                    <h3>{{ $portfolio->name}}</h3>
                </li>
                @endforeach
            </ul>
                
            </ul>
        </div>
        <div class="btn_grp_com d-flex align-items-center justify-content-center">
            <!-- <button class="btn Delete_bg">Delete Account</button> -->
            <button class="btn bg_btn" data-bs-toggle="modal"
                data-bs-target="#exampleModal">EDIT ACCOUNT</button>
            <!-- <button class="btn">Save</button> -->
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('supplier.profile.update', $user->id ) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-content">
        <div class="modal-header pb-2">
            <h4 class="fs-5">Update Profile</h4>
            <button type="button" class="btn-close fs-6" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="connect_popup updateProfiles px-1">

                <!-- PERSONAL INFORMATION -->
                <div class="proifleBox">
                    <h4 class="fs-5">Personal Information</h4>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-pics">
                                    <!--<img alt="User Pic"-->
                                    <!--     src="{{ $user->profile_image ? asset('uploads/profile/'.$user->profile_image) : 'https://d30y9cdsu7xlg0.cloudfront.net/png/138926-200.png' }}"-->
                                    <!--     id="profile-image1" height="100">-->
                                    <!--<input type="file" name="profile_image" class="hidden" onchange="previewFile()">-->
                                   <div class="edit-profile-pics" style="width: 100px;height: 100px;border: 1px solid #e2e2e2;"><img id="profile-image1" class="w-100 h-100 object-fit-cover mb-3" src="{{ $user->profile_image ? asset($user->profile_image) : asset('assets/images/defaultProfile.png') }}"></div>
                                    
                                    <input type="file"
                                           name="profile_image"
                                           accept="image/*"
                                           onchange="previewImage(this,'profile-image1')" style="font-size: 12px;">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="frm_grp col-md-12">
                                    <div class="inptTypes">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" placeholder="Alex Cooper"
                                               class="form-control" value="{{ old('name',$user->name) }}">
                                    </div>
                                </div>
                                <div class="frm_grp col-md-6">
                                    <label for="email">Email ID</label>
                                    <input type="text" name="email" id="email" placeholder="alexcooper@gmail.com"
                                           class="form-control" value="{{ old('email',$user->email) }}">
                                </div>
                                <div class="frm_grp col-md-6">
                                    <label for="mobileNumber">Mobile Number</label>
                                    <input type="text" name="phone" id="mobileNumber"
                                           placeholder="8893xxxxxx" class="form-control" value="{{ old('phone',$user->phone) }}">
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="frm_grp col-md-12">
                                    <label for="about">About</label>
                                    <textarea name="about" placeholder="About yourself" class="form-control">{{ old('about',$user->about) }}</textarea>
                                </div>
                            <div class="col-md-12">
                                <div class="inputType w-100">
                                    <label for="address" class="w-100">Address</label>
                                    <textarea name="address" placeholder="3645 Landon Street, Ontario" class="w-100 form-control">{{ old('address',$user->address) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mt-5 mb-4">
                <!-- BUSINESS INFORMATION -->
                <div class="proifleBox">
                    <h4 class="fs-5">Business Information</h4>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-pics">
                                    <!--<img alt="Company Logo"-->
                                    <!--    src="{{ @$company?->image ? asset('uploads/companies/'.@$company->image) : 'https://d30y9cdsu7xlg0.cloudfront.net/png/138926-200.png' }}"-->
                                    <!--    id="company-image" height="100">-->
                                    <!--<input type="file" name="company_image" class="hidden" onchange="previewFile()">-->
                                   <div class="edit-profile-pics" style="width: 100px;height: 100px;border: 1px solid #e2e2e2;"> <img id="company-image"
                                         src="{{ @$company?->image ? asset(@$company->image) : asset('assets/images/defaultProfile.png') }}" class="w-100 h-100 object-fit-cover mb-3"></div>
                                    
                                    <input type="file"
                                           name="company_image"
                                           accept="image/*"
                                           onchange="previewImage(this,'company-image')" style="font-size: 12px;">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="frm_grp col-md-6">
                                    <div class="inptTypes">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" name="company_name" id="company_name" placeholder="Alex Cooper"
                                               class="form-control" value="{{ old('company_name', @$company->name ?? '') }}">
                                    </div>
                                </div>
                                <div class="frm_grp col-md-6">
                                    <div class="inptTypes">
                                        <label for="business_experience">Business Experience</label>
                                        <input type="number" name="business_experience" id="business_experience" placeholder="Business Experience"
                                               class="form-control" value="{{ old('business_experience', @$company->business_experience ?? '') }}">
                                    </div>
                                </div>
                                <div class="frm_grp col-md-6">
                                    <label for="website">Website URL</label>
                                    <input type="text" name="website" id="website" placeholder="https://example.com"
                                           class="form-control" value="{{ old('website', @$company->website ?? '') }}">
                                </div>
                                <div class="frm_grp col-md-6">
                                    <label for="license">Industry License</label>
                                    <div class="frm_upload">
                                        @if(!empty(@$company->license))
                                            <a href="{{ asset('uploads/licenses/'.@$company->license) }}" target="_blank">View License</a>
                                        @endif
                                        <div class="upload_bx">
                                            <input type="file" class="form-control" id="license" name="license">
                                            <label for="license" class="Verified_btn">Upload</label>
                                        </div>
                                    </div>
                                </div>

                                </div>
                                <div class="frm_grp">
                                    <label for="banner_image">Banner Image</label>
                                    <!--<input type="file" name="banner_image" class="form-control">-->
                                    <!--@if(!empty(@$company->banner_image))-->
                                    <!--    <img src="{{ asset('uploads/banners/'.@$company->banner_image) }}" class="img-thumbnail mt-2" width="150">-->
                                    <!--@endif-->
                                    <img id="banner-preview"
     src="{{ !empty(@$company->banner_image) ? asset(@$company->banner_image) : asset('assets/images/cover01.png') }}"
     class="img-thumbnail mb-2"
     width="100%">

<input type="file"
       name="banner_image"
       class="form-control"
       accept="image/*"
       onchange="previewImage(this,'banner-preview')">
                                </div>
                                <div class="frm_grp">
                                    <label for="business_address">Business Address</label>
                                    <textarea name="business_address" class="form-control" rows="3">{{ old('business_address', @$company->address ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<hr class="mt-5 mb-4">
                <!-- PORTFOLIO INFORMATION -->
                <div class="proifleBox">
                    <h4 class="fs-5">Portfolio Information</h4>
                    <div class="col-md-12">
    <div class="row portfolio-container g-4">
        <!-- New Portfolio Upload Card -->
        <div class="col-md-12 imgUp">
            <div class="card h-100 shadow-sm">
                <!-- Image Preview -->
                <div class="imagePreview rounded-top" style="height:150px; background-color:#f8f9fa; background-size:cover; background-position:center;"></div>

                <div class="card-body d-flex flex-column">
                    <!-- Upload Button -->
                    <label class="btn btn-primary btn-sm mb-2 w-100 text-center">
                        Upload Image
                        <input type="file" name="portfolio_image[]" class="uploadFile img" style="display:none;">
                    </label>
                    </div>

                    <div class="row mt-3">
                        <!-- Portfolio Name -->
                            <div class="col-md-6">
                                <input type="text" name="portfolio_name[]" class="form-control mb-2" placeholder="Portfolio Name">
                            </div>
                            <div class="col-md-6">
                                <select name="category[]" class="form-select mb-2">
                                <option value="" selected disabled>Select Category</option>
                                <option value="leather">Leather</option>
                            
                            </select>
                            </div>
                            <div class="col-md-12">
                                <textarea name="product_detail[]" class="form-control mb-2" placeholder="Product Detail" rows="3"></textarea>
                            </div>
                        

                    <!-- Category Dropdown -->
                    

                    <!-- Product Detail -->
                    
                    </div>

                    <!-- Hidden Status -->
                    <input type="hidden" name="portfolio_status[]" value="1">
                </div>
            </div>
    

    <!-- Add More Button -->
    <div class="mt-3">
        <button type="button" id="addPortfolio" class="btn btn-outline-secondary">+ Add More</button>
    </div>

    <!-- Display Existing Portfolios -->
    @if($portfolios->count())
    <div class="row mt-4 g-3">
        @foreach($portfolios as $portfolio)
        <div class="col-sm-2 text-center">
            <div class="card shadow-sm">
                <img src="{{ asset('portfolios/'. $portfolio->image) }}" class="card-img-top img-thumbnail" style="height:100px; object-fit:cover;">
                <div class="card-body p-2">
                    <p class="small mb-0">{{ $portfolio->name }}</p>
                    @if($portfolio->category)<p class="small mb-0 text-muted" style="font-size-12px">{{ $portfolio->category }}</p>@endif
                    @if($portfolio->product_detail)<p class="small mb-0" style="font-size-12px">{{ $portfolio->product_detail }}</p>@endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
                </div>

            </div>
        </div>
        <div class="modal-footer border-0 d-flex justify-content-center mt-3">
            <button type="button" class="btn btnCancel" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>

    </div>
    </div>


    <style>

.proifleBox h4{
    padding:10px 0;
}
        .updateProfiles .frm_grp {
    margin-bottom: 10px;
}
.updateProfiles .frm_grp label{
    font-size: 14px;
}
.updateProfiles .frm_grp input, .updateProfiles textarea{
    width: 100%;
    font-size: 13px;
    color: #a3a3a3;
    border-radius: 5px;
    border: 1px solid #ebedf4;
    padding: 5px;
}
        .imagePreview {
            width: 100%;
            height: 150px;
            background-position: center center;
            
            background-color: #f2f2f2;
            background-size: cover;
            background-repeat: no-repeat;
            display: inline-block;

        }

        .btnUpload-btn {
            display: block;
            border-radius: 0px;
            margin-top: -5px;
            font-size: 14px;
            background: #4b84ef;
            font-weight: 500;
            letter-spacing: 1px;
        }

        .imgUp {
            margin-bottom: 15px;
        }

        .imgUp input{
            width: 100%;
            font-size: 14px;
        }
        .del {
            position: absolute;
            top: 0px;
            right: 15px;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            background-color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
        }

        .imgAdd {
            width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #331c10;
    color: #fff;
    box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);
    text-align: center;
    line-height: 30px;
    margin-top: 0px;
    cursor: pointer;
    font-size: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('addPortfolio').addEventListener('click', function() {
    let container = document.querySelector('.portfolio-container');
    let newPortfolio = container.children[0].cloneNode(true);

    // Clear values for new row
    newPortfolio.querySelector('input[type="file"]').value = '';
    newPortfolio.querySelector('input[name="portfolio_name[]"]').value = '';

    container.appendChild(newPortfolio);
});

    </script>
    <script>
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const target = document.getElementById(previewId);
                    if (target) {
                        target.src = e.target.result;
                    }
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        document.addEventListener('change', function(event) {
            const input = event.target;
            if (input.matches('.uploadFile') && input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const preview = input.closest('.card').querySelector('.imagePreview');
                    if (preview) {
                        preview.style.backgroundImage = 'url(' + e.target.result + ')';
                    }
                }

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>

@include('supplier.include.footer')