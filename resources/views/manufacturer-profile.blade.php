@include('include.header')
<div id="root">




    <div class="inr_bnnr_section"><img class="media_img" src="{{ asset('assets/images/bg01.png') }}" alt="bg"></div>
    <section class="user_profile">
        <div class="container">
            <div class="profile_cover">
                <div class="user_img"><img src="{{ asset($user->profile_image ?? '/assets/images/defaultProfile.png') }}" alt=""></div>
                <div class="cont_prf">
                    <h3>
                        @if($user->role == 1)
                        Designer
                        @elseif($user->role == 2)
                        Supplier
                        @elseif($user->role == 3)
                        Manufacturer
                        @else
                        Unknown
                        @endif
                    </h3>
                    <h4>{{ $company->name ?? ''}}</h4>
                    <p>{{ $user->name}}</p>
                    <div class="Review_btn d-flex align-items-center justify-content-start">
                        <button id="reviewTabButton" class="btn bg-transparent" type="button" data-bs-toggle="tab" data-bs-target="#contact"
                            role="tab" aria-controls="contact" aria-selected="false">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M11.245 4.174C11.4765 3.50808 11.5922 3.17513 11.7634 3.08285C11.9115 3.00298 12.0898 3.00298 12.238 3.08285C12.4091 3.17513 12.5248 3.50808 12.7563 4.174L14.2866 8.57639C14.3525 8.76592 14.3854 8.86068 14.4448 8.93125C14.4972 8.99359 14.5641 9.04218 14.6396 9.07278C14.725 9.10743 14.8253 9.10947 15.0259 9.11356L19.6857 9.20852C20.3906 9.22288 20.743 9.23007 20.8837 9.36432C21.0054 9.48051 21.0605 9.65014 21.0303 9.81569C20.9955 10.007 20.7146 10.2199 20.1528 10.6459L16.4387 13.4616C16.2788 13.5829 16.1989 13.6435 16.1501 13.7217C16.107 13.7909 16.0815 13.8695 16.0757 13.9507C16.0692 14.0427 16.0982 14.1387 16.1563 14.3308L17.506 18.7919C17.7101 19.4667 17.8122 19.8041 17.728 19.9793C17.6551 20.131 17.5108 20.2358 17.344 20.2583C17.1513 20.2842 16.862 20.0829 16.2833 19.6802L12.4576 17.0181C12.2929 16.9035 12.2106 16.8462 12.1211 16.8239C12.042 16.8043 11.9593 16.8043 11.8803 16.8239C11.7908 16.8462 11.7084 16.9035 11.5437 17.0181L7.71805 19.6802C7.13937 20.0829 6.85003 20.2842 6.65733 20.2583C6.49056 20.2358 6.34626 20.131 6.27337 19.9793C6.18915 19.8041 6.29123 19.4667 6.49538 18.7919L7.84503 14.3308C7.90313 14.1387 7.93218 14.0427 7.92564 13.9507C7.91986 13.8695 7.89432 13.7909 7.85123 13.7217C7.80246 13.6435 7.72251 13.5829 7.56262 13.4616L3.84858 10.6459C3.28678 10.2199 3.00588 10.007 2.97101 9.81569C2.94082 9.65014 2.99594 9.48051 3.11767 9.36432C3.25831 9.23007 3.61074 9.22289 4.31559 9.20852L8.9754 9.11356C9.176 9.10947 9.27631 9.10743 9.36177 9.07278C9.43726 9.04218 9.50414 8.99359 9.55657 8.93125C9.61593 8.86068 9.64887 8.76592 9.71475 8.57639L11.245 4.174Z"
                                        stroke="#673821" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg></span> Review
                        </button>
                        @auth
                            @if($isSaved)
                                <form action="{{ route('manufacturer.unsave', $user->id) }}" method="POST" class="ms-2">
                                    @csrf
                                    <button class="btn btn-warning" type="submit">
                                        <span><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <rect width="25" height="25" fill="white"></rect>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M6 4.95975L6.92857 4H18.0714L19 4.95975V22L12.5 18.0188L6 22V4.95975ZM7.85714 5.91949V18.6314L12.5 15.7876L17.1429 18.6314V5.91949H7.85714Z"
                                                    fill="#ffc107"></path>
                                                <path d="M17 6V18.5L12.5 15.5L8 18.5V6H17Z" fill="#ffc107" stroke="#ffc107">
                                                </path>
                                            </svg></span>
                                        Unsave
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('manufacturer.save', $user->id) }}" method="POST" class="ms-2">
                                    @csrf
                                    <button class="btn btn-outline-warning" type="submit">
                                        <span><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                viewBox="0 0 25 25" fill="none">
                                                <rect width="25" height="25" fill="white"></rect>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M6 4.95975L6.92857 4H18.0714L19 4.95975V22L12.5 18.0188L6 22V4.95975ZM7.85714 5.91949V18.6314L12.5 15.7876L17.1429 18.6314V5.91949H7.85714Z"
                                                    fill="#ffc107"></path>
                                                <path d="M17 6V18.5L12.5 15.5L8 18.5V6H17Z" fill="#ffc107" stroke="#ffc107">
                                                </path>
                                            </svg></span>
                                        Save
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-warning ms-2">Save</a>
                        @endauth
                    </div>
                    <div class="btn_grp d-flex align-items-center justify-content">
                        <button class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Send
                            Message</button>
                          
                        @if($user->role == 1)
                        @else
                        <button class="btn" data-bs-toggle="modal"
                            data-bs-target="#exampleModalQuotation">Request for Quotation</button>
                            @endif
                    </div>
                </div>
            </div>



            <div class="tab_prof">
                <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home" type="button" role="tab" aria-controls="home"
                            aria-selected="true">About</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile"
                            aria-selected="false">Portfolio</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab" aria-controls="contact"
                            aria-selected="false">Reviews</button>
                        <!--<button class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModalReviews">Reviews</button>-->
                    </li>

                    <!-- <li class="active"><a href="/SearchManufacturer/1">About</a></li>
                            <li><a href="/SearchManufacturer/Portfolio/1">Portfolio</a></li>
                            <li><a data-bs-toggle="modal" data-bs-target="#exampleModalReviews"
                                    href="/SearchManufacturer/1">Reviews</a></li> -->
                </ul>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card_bx">
                        <div class="About_wrapp">
                            <h3>About</h3>
                            <p>{{ $user->about }}</p>
                        </div>
                    </div>
                    <div class="card_bx mt-5">
                        <div class="Portfolio_wrapp">
                            <h3>Portfolio</h3>
                            <ul>
                                @foreach($portfolios as $portfolio)
                                <li> <a class="lightbox" href="javascript:avoid()"><img src="{{ asset('portfolios/' .$portfolio->image) }}"
                                            alt="">
                                        <h3>{{$portfolio->name}}</h3>
                                    </a>
                                </li>
                                @endforeach

                            </ul>



                        </div>


                    </div>
                </div>
                <div class="tab-pane fade mb-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="card_bx">
                        <h3>Portfolio</h3>
                        <div class="portfolio_details">
                            <div class="row">
                                <div class="col-lg-7 col-md-12 col-sm-12">
                                    @php
    $portfolio = $portfolios->first();
@endphp
                                    @if($portfolio)
    <div class="big_prof">
        <a data-toggle="lightbox" data-gallery="example-gallery" href="{{ asset('portfolios/' .$portfolio->image) }}">
            <img src="{{ asset('portfolios/' .$portfolio->image) }}" alt="">
            <h3>{{ $portfolio->name }}</h3>
        </a>
    </div>
@endif
                                </div>
                                <div class="col-lg-5 col-md-12 col-sm-12">
                                    <ul class="protf_thumb">
                                        @foreach($portfolios as $portfolio)
                                        <li> <a data-toggle="lightbox" data-gallery="example-gallery" href="{{ asset('portfolios/' .$portfolio->image) }}"><img
                                                    src="{{ asset('portfolios/' .$portfolio->image) }}"
                                                    alt="thumb">
                                                <h3>{{$portfolio->name}}</h3>
                                            </a>
                                        </li>
                                        @endforeach
                                        
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="card_bx mb-5 mt-5">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h3>Reviews</h3>
                            <div class="average-rating">
                                <strong>{{ number_format($averageRating ?? 0, 1) }}</strong>/5
                                <span>({{ $reviews->count() }} review{{ $reviews->count() === 1 ? '' : 's' }})</span>
                            </div>
                        </div>

                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if($reviews->isEmpty())
                        <p class="text-muted">No reviews yet. Be the first to review this manufacturer.</p>
                        @else
                        <div class="review-list mb-4">
                            @foreach($reviews as $review)
                            <div class="review-item mb-4 p-3 border rounded">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h5 class="mb-1">{{ $review->reviewer->name ?? 'Anonymous' }}</h5>
                                        <small class="text-muted">{{ $review->reviewer->role == 1 ? 'Designer' : ($review->reviewer->role == 2 ? 'Supplier' : ($review->reviewer->role == 3 ? 'Manufacturer' : 'User')) }}</small>
                                    </div>
                                    <div class="review-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <span class="review-star active">&#9733;</span>
                                        @else
                                            <span class="review-star">&#9734;</span>
                                        @endif
                                    @endfor
                                </div>
                                </div>
                                <p class="mb-0">{{ $review->comment }}</p>
                                <div class="text-muted mt-2"><small>{{ $review->created_at->diffForHumans() }}</small></div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        @auth
                            @if(auth()->id() === $user->id)
                                <div class="alert alert-info">You cannot review your own profile.</div>
                            @elseif($hasReviewed)
                                <div class="alert alert-info">You have already submitted a review for this profile.</div>
                            @else
                                <form action="{{ route('manufacturer.review.store', $user->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Rating</label>
                                        <div class="rating_wrapp">
                                            <div class="rating">
                                                @for($i = 5; $i >= 1; $i--)
                                                    <input type="radio" id="rating-{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} required>
                                                    <label for="rating-{{ $i }}" title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">&#9733;</label>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Review</label>
                                        <textarea class="form-control" name="comment" rows="4" placeholder="Share your experience" required>{{ old('comment') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                </form>
                            @endif
                        @else
                            <div class="alert alert-info">Please <a href="{{ route('login') }}">login</a> to leave a review.</div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var reviewTabButton = document.getElementById('reviewTabButton');
        var contactTab = document.getElementById('contact-tab');
        var tabSection = document.querySelector('.tab_prof');

        if (reviewTabButton && contactTab) {
            reviewTabButton.addEventListener('click', function () {
                contactTab.click();
                if (tabSection) {
                    tabSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        }
    });
</script>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('chat.mess.send') }}" method="POST">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                <div class="modal-body">
                    <div class="connect_popup">
                        <h3 class="mb-3 connect_popup_title">Contact With {{ ucfirst($user->role == 2 ? 'Supplier' : 'Manufacturer') }}</h3>
                        <p><strong>To:</strong> <span>{{ $user->name }}</span></p>
                        <div class="avtar mb-4">
                            <div class="user_img"><img src="{{ asset($user->profile_image ?? '/assets/images/defaultProfile.png') }}" alt="">
                            </div>
                            <div class="cont_bx">
                                <h3>{{ $company->name ?? $user->name }}</h3>
                                <p>{{ $user->name }}</p>
                            </div>
                        </div>
                        <p><strong>Message:</strong></p>
                        <div class="frm_grp_connect">
                            <textarea class="form-control" name="message" id="message" cols="10" rows="3" placeholder="Hi {{ $user->name }}, " required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btnCancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalReviews" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="connect_popup send_popup text-center"><img
                        src="data:image/png;base64,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"
                        class="m-auto" alt="">
                    <h4>Your request has been sent to our Manufacturer. <span>He will get back to you soon.</span>
                    </h4>

                </div>
            </div>
            <div class="modal-footer border-0 text-center m-auto mb-4">
                <button type="button" class="btn btn-primary">ok</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="exampleModalQuotation" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('quotations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">
                <div class="connect_popup px-5">
                    <h3>Request for Quotation</h3>
                    <p>This information will be shared with the Manufacturer</p>
                    <div class="quot_frm">
                        <div class="frm_grp"><label for="name">Name*</label>
                        <input type="text" name="name" id="name" placeholder="Alex Cooper" class="form-control" required></div>
                        <div class="frm_grp"><label for="email">Email ID*</label>
                        <input type="text" name="email" id="email" placeholder="alexcooper@gmail.com" class="form-control" required></div>
                        <div class="frm_grp"><label for="phone">Phone*</label>
                        <input type="text" name="phone" id="phone" placeholder="8893xxxxxx" class="form-control" required>
                        </div>
                        <div class="frm_grp"><label for="delivery_address">Delivery Address*</label>
                        <input type="text" name="delivery_address" id="delivery_address" placeholder="3645 Landon Street, Ontario" class="form-control" required></div>
                        <div class="frm_grp arrow_select">
                            <label for="product_category">Product Category*</label><select name="product_category" id="product_category" class="form-control" required>
                                <option value="" selected>Choose One</option>
                            <option value="Bag">Bag</option>
                                <option value="Cloth">Cloth</option>
                                <option value="Bed">Bed</option>
                            </select>
                        </div>
                        <div class="frm_grp arrow_select">
                            <label for="leather_category">Leather Category*</label>
                            <select name="leather_category" id="leather_category"  class="form-control" required>
                                <option value="" selected>Choose One</option>
                                <option value="split leather">Split Leather</option>
                                <option value="soft leather">soft Leather</option>
                                <option value="hard leather">hard Leather</option>
                            </select>
                        </div>
                        <div class="frm_grp"><label for="units_of_product">Units of Product*</label>
                        <input type="text" name="units_of_product" id="units_of_product" placeholder="60" class="form-control" required>
                        </div>
                        <div class="frm_grp"><label for="expected_delivery_time">Expected Delivery time*</label><input
                                type="text" name="expected_delivery_time" id="expected_delivery_time"
                                placeholder="Alex Cooper" class="form-control" required></div>
                        <div class="frm_grp"><label for="design_prototype">Design Prototype</label>
                            <div class="frm_upload"><a href="#">Request.pdf</a>
                                <div class="upload_bx"><input type="file" class="form-control" placeholder="Request"
                                        id="Upload" name="design_prototype"><label for="Upload"
                                        class="Verified_btn">Upload</label></div>
                            </div>
                        </div>
                        <div class="frm_grp"><label for="additional_request">Additional Request</label><input
                                type="text" name="additional_request" id="additional_request" class="form-control">
                        </div>
                    </div>

                </div>
            </div>
            <input type="hidden" name="quotation_id" value="{{ $user->id }}">
            <div class="modal-footer border-0">
                <button type="button" class="btn btnCancel" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Footer -->
@include('include.footer')