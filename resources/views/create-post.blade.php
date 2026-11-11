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
                <div class="newPostContainer mt-5">
                    <div class="newPostContainerHeader">
                        <div class="newPostHeaderText">Create new post</div>
                        <div class="newPostHeaderIcon"><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3">
                                </path>
                            </svg></div>
                    </div>
                    <div class="postContainer createPost">
                        <form action="{{ route('post.create.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="postTitle mb-3">
                            <input class="postTitle" name="image" type="file" placeholder="Image" required>
                        </div>
                        <div class="postTitle">
                            <input class="postTitle" name="title" type="text" placeholder="Title" required>
                        </div>
                        <textarea class="postTextContainer" name="description" placeholder="Write something here..." required></textarea>
                        <div class="postFooterContainer mt-4">
                            <!-- <div class="postFooterIconContainer"><svg stroke="currentColor"
                                    fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                                    class="postFooterIcon" height="1em" width="1em"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="7.499" cy="9.5" r="1.5"></circle>
                                    <path d="m10.499 14-1.5-2-3 4h12l-4.5-6z"></path>
                                    <path
                                        d="M19.999 4h-16c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2zm-16 14V6h16l.002 12H3.999z">
                                    </path>
                                </svg><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                    viewBox="0 0 576 512" class="postFooterIcon" height="1em"
                                    width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M336.2 64H47.8C21.4 64 0 85.4 0 111.8v288.4C0 426.6 21.4 448 47.8 448h288.4c26.4 0 47.8-21.4 47.8-47.8V111.8c0-26.4-21.4-47.8-47.8-47.8zm189.4 37.7L416 177.3v157.4l109.6 75.5c21.2 14.6 50.4-.3 50.4-25.8V127.5c0-25.4-29.1-40.4-50.4-25.8z">
                                    </path>
                                </svg><svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                    viewBox="0 0 640 512" class="postFooterIcon" height="1em"
                                    width="1em" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z">
                                    </path>
                                </svg></div>
                            <div> -->
                                <button class="postButton">Post</button>
                            </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('include.footer')