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

<div class="container">
    <div class="row">
        <div class="d-flex gap-3 articleListContainer py-5">
            <div class="newArticleListContainer">
                <div class="newArticleListHeaderTextContainer">
                    <div class="newArticleListHeaderText">New Articles</div>
                </div>

                <div class="newArticleCardListContainer">
                    @foreach($posts as $post)
                    <div class="newArticleCard">
                        <div class="articalThumb"><a href="{{ route('article.detail', $post->id) }}"><img class="newArticleImg" src="{{ asset($post->image) }}"
                                    alt="newArticleImg"></a></div>
                        <div class="newArticleContent"><a href="{{ route('article.detail', $post->id) }}">{{ $post->title }}</a></div>
                    </div>
                    @endforeach
                    <a href="{{ route('create.post') }}" class="btn btnPrimary">Create Post</a>
                </div>

            </div>
            <div class="articleContainer">
                <div class="articleCardContainer">


                    @foreach($posts as $post)
                    @php
                    $commentCount = App\Models\PostComment::where('post_id', $post->id)->count();
                    @endphp
                    <div class="articleCard">
                        <div class="articleCardHeader">
                            <div class="d-flex gap-2">
                                <div class="articleCardImgContainer"><img
                                        src="{{ asset($post->user->profile_image) }}"
                                        alt="articleCardImg"></div>
                                <div>
                                    <div class="nameContainer">{{ $post->user->name }}</div>
                                    <div class="timeContainer">{{ $post->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            <div><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 16 16"
                                    height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3">
                                    </path>
                                </svg></div>
                        </div>
                        <div class="articleContent"><a href="{{ route('article.detail', $post->id) }}">{{ $post->title }}</a></div>
                        <div class="articleFooter">
                            <div class="undefined d-flex gap-4 align-items-center">
                                <div class="likesContainer gap-2 d-flex align-items-center"><svg
                                        stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 512 512" height="1em" width="1em"
                                        xmlns="http://www.w3.org/2000/svg"
                                        style="color: rgb(246, 88, 88); width: 24px; height: 24px;">
                                        <path
                                            d="M256 448l-30.164-27.211C118.718 322.442 48 258.61 48 179.095 48 114.221 97.918 64 162.4 64c36.399 0 70.717 16.742 93.6 43.947C278.882 80.742 313.199 64 349.6 64 414.082 64 464 114.221 464 179.095c0 79.516-70.719 143.348-177.836 241.694L256 448z">
                                        </path>
                                    </svg>
                                    <div class="likesCount">12</div>
                                </div>
                                <div class="undefined gap-2 d-flex align-items-center"><svg stroke="currentColor"
                                        fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em"
                                        width="1em" xmlns="http://www.w3.org/2000/svg"
                                        style="width: 24px; height: 24px;">
                                        <path
                                            d="M12 2C6.486 2 2 5.589 2 10c0 2.908 1.898 5.515 5 6.934V22l5.34-4.005C17.697 17.852 22 14.32 22 10c0-4.411-4.486-8-10-8zm0 14h-.333L9 18v-2.417l-.641-.247C5.67 14.301 4 12.256 4 10c0-3.309 3.589-6 8-6s8 2.691 8 6-3.589 6-8 6z">
                                        </path>
                                        <path d="M7 7h10v2H7zm0 4h7v2H7z"></path>
                                    </svg>
                                    <div class="commentsCount">{{ $commentCount }}</div>
                                </div>
                                <div class="undefined gap-2 d-flex align-items-center"><svg stroke="currentColor"
                                        fill="currentColor" stroke-width="0" viewBox="0 0 512 512" height="1em"
                                        width="1em" xmlns="http://www.w3.org/2000/svg"
                                        style="width: 24px; height: 24px;">
                                        <path
                                            d="M448 248L288 96v85.334C138.666 202.667 85.333 309.334 64 416c53.333-74.666 117.333-108.802 224-108.802v87.469L448 248z">
                                        </path>
                                    </svg>
                                    <div class="shareCount">12</div>
                                </div>
                            </div>
                            <div class="undefined d-flex align-items-center">
                                <div class="undefined d-flex align-items-center"
                                    style="transform: translateX(0px);">
                                    <div class="d-flex">
                                        <div class="footerImgWrapper" style="transform: translateX(0px);"><img
                                            src="data:image/png;base64,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"
                                        alt="footerImg0"></div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                 @if ($posts->total() > 6)
             <div class="pre-nxt">
    {{-- Previous Button --}}
    @if ($posts->onFirstPage())
        <button class="prebtn" disabled>
            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"
                style="height: 30px; width: 41px; align-items: center;">
                <path fill="none" d="M0 0h24v24H0z"></path>
                <path d="M17.59 18 19 16.59 14.42 12 19 7.41 17.59 6l-6 6z"></path>
                <path d="m11 18 1.41-1.41L7.83 12l4.58-4.59L11 6l-6 6z"></path>
            </svg> Previous
        </button>
    @else
        <a href="{{ $posts->previousPageUrl() }}">
            <button class="prebtn">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                    height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"
                    style="height: 30px; width: 41px; align-items: center;">
                    <path fill="none" d="M0 0h24v24H0z"></path>
                    <path d="M17.59 18 19 16.59 14.42 12 19 7.41 17.59 6l-6 6z"></path>
                    <path d="m11 18 1.41-1.41L7.83 12l4.58-4.59L11 6l-6 6z"></path>
                </svg> Previous
            </button>
        </a>
    @endif

    {{-- Page Numbers --}}
    <div class="buttons">
        @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
            <a href="{{ $url }}">
                <button class="btn{{ $page }}">{{ $page }}</button>
            </a>
        @endforeach
    </div>

    {{-- Next Button --}}
    @if ($posts->hasMorePages())
        <a href="{{ $posts->nextPageUrl() }}">
            <button class="nxtbtn">
                Next <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                    viewBox="0 0 24 24" height="1em" width="1em"
                    xmlns="http://www.w3.org/2000/svg"
                    style="height: 30px; width: 41px; align-items: center;">
                    <path fill="none" d="M0 0h24v24H0z"></path>
                    <path d="M6.41 6 5 7.41 9.58 12 5 16.59 6.41 18l6-6z"></path>
                    <path d="m13 6-1.41 1.41L16.17 12l-4.58 4.59L13 18l6-6z"></path>
                </svg>
            </button>
        </a>
    @else
        <button class="nxtbtn" disabled>
            Next <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                viewBox="0 0 24 24" height="1em" width="1em"
                xmlns="http://www.w3.org/2000/svg"
                style="height: 30px; width: 41px; align-items: center;">
                <path fill="none" d="M0 0h24v24H0z"></path>
                <path d="M6.41 6 5 7.41 9.58 12 5 16.59 6.41 18l6-6z"></path>
                <path d="m13 6-1.41 1.41L16.17 12l-4.58 4.59L13 18l6-6z"></path>
            </svg>
        </button>
    @endif
</div>
                @endif
            </div>
        </div>
    </div>
</div>
@include('include.footer')