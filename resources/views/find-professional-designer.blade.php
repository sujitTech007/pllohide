@include('include.header')

<section class="mainBanner">
    <div class="hero-banner">
        <img src="{{ asset('assets/images/family.png') }}" alt="">
    </div>
    <div class="hero-content">
        <h1 class="fw-bold display-5 text-white">REDEFINING LEATHER<br>CRAFTSMANSHIP</h1>
        <p class="lead text-white">YOUR JOURNEY BEGINS WITH PLLOHIDE</p>
    </div>
</section>

<div class="main">
    <div class="container">
        <div class="row">
            <div class="filters">
                <div class="button-lable">


                    <div class="dropdown">
                        <label for="dropbtn1" class="dropbtn-lable">Location</label>



                        <select class="form-select mt-2" aria-label="Default select example">
                            <option selected>Search city, State or Zip</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>

                    </div>


                    <div class="dropdown mt-4">
                        <label for="dropbtn2" class="dropbtn-lable">Distance</label>
                        <select class="form-select mt-2" aria-label="Default select example">
                            <option selected>50 MI</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="accordion accordion-flush w-100 mt-4" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    Project Type
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                        <label class="form-check-label" for="checkDefault">
                                            1
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                        <label class="form-check-label" for="checkChecked">
                                            2
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                        <label class="form-check-label" for="checkChecked">
                                            3
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mt-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    Rating
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                        <label class="form-check-label" for="checkDefault">
                                            1
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                        <label class="form-check-label" for="checkChecked">
                                            2
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                        <label class="form-check-label" for="checkChecked">
                                            3
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mt-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    Experience
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                        <label class="form-check-label" for="checkDefault">
                                            1
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                        <label class="form-check-label" for="checkChecked">
                                            2
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkChecked" checked>
                                        <label class="form-check-label" for="checkChecked">
                                            3
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
            <div class="main-page mb-5">
                <div class="filter-applied"><button class="category w-auto d-flex align-items-center p-2">Designers <svg
                            stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em"
                            width="1em" xmlns="http://www.w3.org/2000/svg" style="height: 18px; width: 18px;">
                            <path
                                d="M256 48C140.559 48 48 140.559 48 256c0 115.436 92.559 208 208 208 115.435 0 208-92.564 208-208 0-115.441-92.564-208-208-208zm104.002 282.881l-29.12 29.117L256 285.117l-74.881 74.881-29.121-29.117L226.881 256l-74.883-74.881 29.121-29.116L256 226.881l74.881-74.878 29.12 29.116L285.119 256l74.883 74.881z">
                            </path>
                        </svg></button>
                    <form id="searchForm" style="position: relative;">
                        <span style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#A3A3A3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="17" y1="17" x2="21" y2="21"></line>
                            </svg>
                        </span>

                        <input class="searchbyname" type="text" placeholder="Search by Name or Keyword" value=""
                            style="padding-left: 40px;">
                    </form>
                </div>
                <div class="profiles">
                    @foreach($designers as $designer)
                    <div class="profile3">
                        <div class="picture3 picturePicture"><a href="{{ route('manufacturer-profile', $designer->id ) }}"><img src="{{ asset($designer->profile_image ?? '/assets/images/defaultProfile.png') }}" alt=""></a> </div>
                        <div class="info">
                            <div class="name-email">
                                <div class="profile-preview">
                                    <div class="profile-pic"></div>
                                    <div class="name-rating">
                                        <div class="name"><a href="{{ route('manufacturer-profile', $designer->id ) }}">{{ $designer->name}}</a></div>
                                        <div class="ratingstars mt-1">
                                            <div class="score">5.0</div>
                                            <div class="stars"><svg stroke="currentColor" fill="currentColor"
                                                    stroke-width="0" viewBox="0 0 24 24" height="1em" width="1em"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    style="color: gold; margin-right: 2px;">
                                                    <g fill="none">
                                                        <path d="M0 0h24v24H0V0z"></path>
                                                        <path d="M0 0h24v24H0V0z"></path>
                                                    </g>
                                                    <path
                                                        d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z">
                                                    </path>
                                                </svg><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                    viewBox="0 0 24 24" height="1em" width="1em"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    style="color: gold; margin-right: 2px;">
                                                    <g fill="none">
                                                        <path d="M0 0h24v24H0V0z"></path>
                                                        <path d="M0 0h24v24H0V0z"></path>
                                                    </g>
                                                    <path
                                                        d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z">
                                                    </path>
                                                </svg><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                    viewBox="0 0 24 24" height="1em" width="1em"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    style="color: gold; margin-right: 2px;">
                                                    <g fill="none">
                                                        <path d="M0 0h24v24H0V0z"></path>
                                                        <path d="M0 0h24v24H0V0z"></path>
                                                    </g>
                                                    <path
                                                        d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z">
                                                    </path>
                                                </svg><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                    viewBox="0 0 24 24" height="1em" width="1em"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    style="color: gold; margin-right: 2px;">
                                                    <g fill="none">
                                                        <path d="M0 0h24v24H0V0z"></path>
                                                        <path d="M0 0h24v24H0V0z"></path>
                                                    </g>
                                                    <path
                                                        d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z">
                                                    </path>
                                                </svg><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                                    viewBox="0 0 24 24" height="1em" width="1em"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    style="color: gold; margin-right: 2px;">
                                                    <g fill="none">
                                                        <path d="M0 0h24v24H0V0z"></path>
                                                        <path d="M0 0h24v24H0V0z"></path>
                                                    </g>
                                                    <path
                                                        d="M12 17.27 18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21 12 17.27z">
                                                    </path>
                                                </svg></div>
                                            <div class="reviews">75 reviews</div>
                                        </div>
                                    </div>
                                </div><button class="message d-flex align-items-center w-auto p-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-envelope me-1" aria-hidden="true"></i>Send Message </button>
                            </div>
                            <div class="location">
                                <div class="years"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 24 24" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"
                                        style="color: rgb(0, 117, 98); height: 15px; width: 12px;">
                                        <path fill="none" d="M0 0h24v24H0zm10 5h4v2h-4zm0 0h4v2h-4z"></path>
                                        <path
                                            d="M10 16v-1H3.01L3 19c0 1.11.89 2 2 2h14c1.11 0 2-.89 2-2v-4h-7v1h-4zm10-9h-4.01V5l-2-2h-4l-2 2v2H4c-1.1 0-2 .9-2 2v3c0 1.11.89 2 2 2h6v-2h4v2h6c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zm-6 0h-4V5h4v2z">
                                        </path>
                                    </svg>15 years in business </div>
                                <div class="address w-auto d-flex align-items-center"> <i class="fa fa-map-marker me-1 fs-5" aria-hidden="true"></i>{{ $designer->address }}</div>
                            </div>
                            <div class="about">{{ $designer->about }}<a
                                    href="{{ route('manufacturer-profile', $designer->id ) }}" style="color: rgb(153, 75, 0);">Read More &gt;</a></div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if ($designers->hasPages())
                <div class="pagination-wrapper mt-4 d-flex justify-content-center">
                    {{ $designers->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h3 class="connect_popup_title fs-5">Contact With {{ ucfirst($designer->role == 2 ? 'Supplier' : 'designer') }}</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('chat.mess.send') }}" method="POST">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $designer->id }}">
                <div class="modal-body">
                    <div class="connect_popup">
                        
                        <p><strong>To:</strong> <span>{{ $designer->name }}</span></p>
                        <div class="avtar mb-4">
                            <div class="designer_img avtar-send-messsage"><img src="{{ asset($designer->profile_image ?? '/assets/images/defaultProfile.png') }}" alt="{{ $company->name ?? $designer->name }}"  class="h-100 w-100 object-fit-cover">
                            </div>
                            <div class="cont_bx">
                                <h3>{{ $company->name ?? $designer->name }}</h3>
                                <p>{{ $designer->name }}</p>
                            </div>
                        </div>
                        <p><strong>Message:</strong></p>
                        <div class="frm_grp_connect">
                            <textarea class="form-control" name="message" id="message" cols="10" rows="3" placeholder="Hi {{ $designer->name }}, " required></textarea>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('.searchbyname');
        const profiles = document.querySelectorAll('.profiles .profile3');

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();

            profiles.forEach(profile => {
                const name = profile.querySelector('.name')?.textContent.toLowerCase() || '';
                const about = profile.querySelector('.about')?.textContent.toLowerCase() || '';
                const address = profile.querySelector('.address')?.textContent.toLowerCase() || '';

                // check if any of these fields contain the query text
                if (name.includes(query) || about.includes(query) || address.includes(query)) {
                    profile.style.display = '';
                } else {
                    profile.style.display = 'none';
                }
            });
        });
    });
</script>
@include('include.footer')