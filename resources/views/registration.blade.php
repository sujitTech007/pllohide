@include('include.header')
<div id="root">
    <div>
        <!-- <header class="header_top bg_brd">
                <nav class="navbar navbar-expand-lg">
                    <div class="container"><a class="navbar-brand" href="index.html"><img src="assets/images/logo_w.svg" alt=""></a>
                        
                        <div class="dropdown user_login"><button class="btn dropdown-toggle" type="button"
                                        id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-expanded="false"><span><svg xmlns="http://www.w3.org/2000/svg" width="32"
                                                height="33" viewBox="0 0 32 33" fill="none">
                                                <path
                                                    d="M21.3327 13.8333C21.3327 15.2478 20.7708 16.6044 19.7706 17.6046C18.7704 18.6048 17.4138 19.1667 15.9994 19.1667C14.5849 19.1667 13.2283 18.6048 12.2281 17.6046C11.2279 16.6044 10.666 15.2478 10.666 13.8333C10.666 12.4188 11.2279 11.0623 12.2281 10.0621C13.2283 9.0619 14.5849 8.5 15.9994 8.5C17.4138 8.5 18.7704 9.0619 19.7706 10.0621C20.7708 11.0623 21.3327 12.4188 21.3327 13.8333Z"
                                                    fill="white"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M15.4553 29.8227C8.34401 29.5374 2.66602 23.6814 2.66602 16.5C2.66602 9.13602 8.63535 3.16669 15.9993 3.16669C23.3633 3.16669 29.3327 9.13602 29.3327 16.5C29.3327 23.864 23.3633 29.8334 15.9993 29.8334C15.9385 29.8337 15.8776 29.8337 15.8167 29.8334C15.696 29.8334 15.5753 29.8294 15.4553 29.8227ZM7.44335 24.9134C7.34366 24.6271 7.30973 24.322 7.34407 24.0208C7.37841 23.7196 7.48015 23.43 7.64173 23.1735C7.80332 22.917 8.02059 22.7002 8.27743 22.5392C8.53427 22.3782 8.82408 22.2771 9.12535 22.2434C14.3227 21.668 17.708 21.72 22.88 22.2554C23.1817 22.2868 23.4722 22.3866 23.7295 22.5473C23.9867 22.7079 24.2039 22.9252 24.3645 23.1825C24.5251 23.4398 24.6249 23.7303 24.6562 24.032C24.6876 24.3337 24.6496 24.6385 24.5453 24.9234C26.762 22.6806 28.0033 19.6533 27.9993 16.5C27.9993 9.87269 22.6267 4.50002 15.9993 4.50002C9.37201 4.50002 3.99935 9.87269 3.99935 16.5C3.99935 19.7774 5.31335 22.748 7.44335 24.9134Z"
                                                    fill="white"></path>
                                            </svg></span><span>John Thomas</span></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item active" href="#">Profile</a></li>
                                        <li><a class="dropdown-item" href="#">Logout</a></li>
                                    </ul>
                                </div>
                    </div>
                </nav>
            </header> -->
        <section class="inr_bnnr_section"><img class="media_img" src="assets/images/bn.png"
                alt="">
            <div class="banner_content">
                <h3>Welcome to PlloHide </h3>
                <p>Please provide the following information</p>
            </div>
        </section>
        <section class="regist_wrapp">
            <form class="container" method="POST" action="{{ route('register.update.store', $user->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="card_box">
                    <div class="head">
                        <h3> Personal Information</h3>
                    </div>
                    <div class="inner_bdy">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="add_img"><label for="profile_image_input">
                                        <input type="file" name="profile_image" id="profile_image_input" accept="image/*" onchange="previewImage(this, 'profilePreview')"><img
                                            id="profilePreview"
                                            src="data:image/png;base64,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"
                                            alt=""
                                            style="width: 150px; height: 150px; object-fit: cover; object-position: center center;"></label>
                            </div>
                        </div>
                    </div>
                        <div class="row mt-4">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="frm_grp">
                                    <label for="">Full Name</label>
                                    <input type="text" name="name" id="" class="form-control" placeholder="Enter Fullname" value="{{ $user->name }}" required>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="frm_grp"><label for="">E-mail ID</label><input type="text" name="email"
                                        id="" class="form-control" placeholder="Enter Email" value="{{ $user->email }}" required></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="frm_grp"><label for="">Mobile Number</label><input type="text"
                                        name="phone" id="" class="form-control" placeholder="Enter Mobile Number" value="{{ $user->phone }}" required></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="frm_grp"><label for="">Address</label><input type="text" name="address"
                                        id="" class="form-control" placeholder="Enter Address" value="{{ $user->address }}" required></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="frm_grp arrow_select"><label for="">province</label><select
                                        name="province" class="form-control" id="" required>
                                        <option value="" selected>Choose Province</option>
                                        <option value="ontario">Ontario</option>
                                    </select></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="frm_grp arrow_select"><label for="">Country</label><select
                                        name="country" class="form-control" id="" required>
                                        <option value="" selected>Choose Country</option>
                                        <option value="canada">Canada</option>
                                    </select></div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="frm_grp">
                                    <label for="">Industry License</label>
                                    <div class="frm_upload">
                                        <div class="upload_bx">
                                            <input name="industry_license" accept="image/*" type="file" class="form-control" placeholder="Jonathan Dave"
                                                id="Upload"><label for="Upload" class="upload_btn">Choose
                                                File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- business  -->
                @if($user && $user->role != 1)
                <div class="card_box">
                    <div class="head">
                        <h3> Business Information</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row p-5">
                            <div class="col-md-12">
                                <!-- <div class="profile-pics">
                                    <img alt="Company Logo"
                                        src="{{ @$company?->image ? asset('uploads/companies/'.@$company->image) : 'https://d30y9cdsu7xlg0.cloudfront.net/png/138926-200.png' }}"
                                        id="company-image" height="100">
                                </div> -->

                                <div class="add_img">

                                    <!-- Image -->
                                                                        <label for="company_image_input">
                                        <img id="companyPreview"
                                            src="{{ @$company?->image ? asset('uploads/companies/'.@$company->image) : 'https://d30y9cdsu7xlg0.cloudfront.net/png/138926-200.png' }}"
                                            alt="Company image preview"
                                            style="width: 150px; height: 150px; object-fit: cover; object-position: center center;">
                                    </label>
                                    <input type="file" name="company_image" id="company_image_input" class="d-none" accept="image/*" onchange="previewImage(this, 'companyPreview')">



                            </div>
                            <div class="col-md-6">
                                <div class="frm_grp">
                                    <div class="inptTypes">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" name="company_name" id="company_name" placeholder="Alex Cooper"
                                            class="form-control" value="{{ old('company_name', @$company->name ?? '') }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="frm_grp">
                                    <div class="inptTypes">
                                        <label for="business_experience">Business Experience</label>
                                        <input type="number" name="business_experience" id="business_experience" placeholder="Business Experience"
                                            class="form-control" value="{{ old('business_experience', @$company->business_experience ?? '') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="frm_grp">
                                    <label for="website">Website URL</label>
                                    <input type="text" name="website" id="website" placeholder="https://example.com"
                                        class="form-control" value="{{ old('website', @$company->website ?? '') }}">
                                </div>
                            </div>
                            <!--<div class="col-md-6">-->
                            <!--    <div class="frm_grp">-->
                            <!--        <label for="license">Industry License</label>-->
                            <!--        <div class="frm_upload">-->
                            <!--            @if(!empty(@$company->license))-->
                            <!--            <a href="{{ asset('uploads/licenses/'.@$company->license) }}" target="_blank">View License</a>-->
                            <!--            @endif-->
                            <!--            <div class="upload_bx">-->
                            <!--                <input type="file" class="form-control" id="license" name="license">-->
                            <!--                <label for="license" class="Verified_btn">Upload</label>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="col-md-6">
                                <div class="frm_grp">
                                    <label for="banner_image_input">Banner Image</label>
                                    <input type="file" name="banner_image" id="banner_image_input" class="form-control" accept="image/*" onchange="previewImage(this, 'bannerPreview')">
                                    <img id="bannerPreview"
                                        src="{{ !empty(@$company->banner_image) ? asset('uploads/banners/'.@$company->banner_image) : '' }}"
                                        class="img-thumbnail mt-2" width="150"
                                        style="display: {{ !empty(@$company->banner_image) ? 'block' : 'none' }};">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="frm_grp">
                                    <label for="business_address">Business Address</label>
                                    <textarea name="business_address" class="form-control" rows="3">{{ old('business_address', @$company->address ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- portfolio -->

                <div class="card_box">
                    <div class="head">
                        <h3> Portfolio Information</h3>
                    </div>
                    <div class="col-md-12">
                        <div class="row portfolio-container g-4 p-3">

                            <div class="col-12 imgUp">
                                <div class="card h-100" style="border: none;">

                                    <div class="row g-3">

                                        <!-- LEFT IMAGE (col-4) -->
                                        <div class="col-md-2">

                                            <div class="uploadContainer">

                                                <label class="uploadBox w-100 text-center" style="display: block; position: relative;">
                                                    <div class="imagePreview"></div>
                                                    <span class="btn btnUpload-btn">Upload</span>
                                                    <input type="file" name="portfolio_image[]" class="uploadFile img" accept="image/*" style="position:absolute; inset:0; width:100%; height:100%; opacity:0; cursor:pointer;">
                                                </label>
                                                <div class="imgspan">
                                                    <span>Add Photo/Video</span>

                                                </div>

                                                <button type="button" id="addPortfolio" class="btn btn-outline-secondary  addMoreBtn" style="display: block; margin-top: 10px; position: static;">+ </button>
                                                <!-- <button type="button" id="addPortfolio" class="addMoreBtn" style="display: block; margin-top: 10px; position: static;">+</button> -->

                                            </div>




                                        </div>

                                        <!-- RIGHT INPUTS (col-8) -->
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="frm_grp">
                                                        <label for="">Portfolio Name</label>
                                                        <input type="text" name="portfolio_name[]" class="form-control mb-3"
                                                            placeholder="Portfolio Name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="frm_grp">
                                                        <label for="">Select Catagory </label>
                                                        <select name="category[]" class="form-select mb-3">
                                                            <option value="" selected disabled>Select Category</option>
                                                            <option value="leather">Leather</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="frm_grp">
                                                        <label for="">Product Detail</label>
                                                        <input name="product_detail[]" class="form-control mb-3"
                                                            placeholder="Product Detail" rows="4">
                                                    </div>
                                                </div>
                                            </div>






                                            <input type="hidden" name="portfolio_status[]" value="1">

                                            <!-- Wrap both inside a container -->



                                        </div>

                                    </div>
                                </div>

                            </div>


                        </div>

                    </div>

                    @endif


                    <div class="btn_grp_com d-flex align-items-center justify-content-center mb-5">
                        <button type="reset" class="btn btn-transparent">cancel</button>
                        <button type="submit" class="btn">SUBMIT</button>
                    </div>
            </form>
        </section>
    </div>
</div>


<style>
    .proifleBox h4 {
        padding: 10px 0;
    }

    .updateProfiles .frm_grp {
        margin-bottom: 10px;
    }

    .updateProfiles .frm_grp label {
        font-size: 14px;
    }

    .updateProfiles .frm_grp input,
    .updateProfiles textarea {
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

    .imgUp input {
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

    /* Main upload box */
    .uploadBox {
        display: block;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px 10px;
        background: #f9f9f9;
        cursor: pointer;
        text-align: center;
        position: relative;
    }

    .uploadBox .uploadIcon {
        width: 80px;
        height: 80px;
        margin: 0 auto 10px;
        background: #e5e5e5;
        border-radius: 10px;
        position: relative;
    }

    .uploadBox .uploadIcon::before {
        content: "+";
        position: absolute;
        font-size: 40px;
        color: #bbb;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .uploadBox span {
        display: block;
        color: #555;
        font-size: 14px;
    }

    /* Small + button (right corner fixed look) */
    .addMoreBtn {
        position: absolute;
        right: 10px;
        bottom: 10px;
        background: #fff;
        border: 1px solid #d1a069;
        color: #d1a069;
        padding: 3px 10px;
        font-size: 18px;
        border-radius: 8px;
        cursor: pointer;
    }

    .uploadContainer {
        position: relative;
        width: fit-content;
        float: left;

    }

    .uploadContainer .addMoreBtn {
        display: block;
        margin-top: 10px;
        position: static;
    }

    .imgspan span {
        color: #5B5B5B;
        font-size: 15px;
    }

    .imgspan {
        padding: 10px 23px;
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
        let fileInput = newPortfolio.querySelector('input[type="file"]');
        if (fileInput) fileInput.value = '';
        let portfolioName = newPortfolio.querySelector('input[name="portfolio_name[]"]');
        if (portfolioName) portfolioName.value = '';
        let preview = newPortfolio.querySelector('.imagePreview');
        if (preview) preview.style.backgroundImage = '';
        container.appendChild(newPortfolio);
    });
</script>
<script>
    function previewImage(input, targetId) {
        if (!input.files || !input.files[0]) return;
        var target = document.getElementById(targetId);
        if (!target) return;
        target.src = URL.createObjectURL(input.files[0]);
        target.style.display = 'block';
    }

    $(function() {
        $('#profile-image1').on('click', function() {
            $('#profile-image-upload').click();
        });
    });


    $(".imgAdd").click(function() {
        $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-3 imgUp"><div class="imagePreview"></div><label class="btn btnUpload-btn">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><input class="form-control form-control-lg" type="text" placeholder="Split Leather"><i class="fa fa-times del"></i></div>');
    });
    $(document).on("click", "i.del", function() {
        // 	to remove card
        $(this).parent().remove();
        // to clear image
        $(this).parent().find('.imagePreview').css("background-image", "url('')");
    });
    $(function() {
        $(document).on("change", ".uploadFile", function() {
            var uploadFile = $(this);
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function() { // set image data as background of div
                    //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                    uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
                }
            }

        });
    });
</script>

@include('include.footer')

