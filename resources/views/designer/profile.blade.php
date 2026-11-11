@include('designer.include.header')
<div class="content-wrapper">

    <div class="dashboard_inner">
        <div class="heading_bx">
            <h3>Personal Information</h3>
        </div>
        <div class="Profile_info">
            <div class="cover_prof"> <img src="{{ auth()->user()->banner ? asset(auth()->user()->banner) : asset('assets/images/cover01.png') }}" alt="">
                <div class="cover_details">
                    <div class="user"> <img src="{{ auth()->user()->profile_image ? asset(auth()->user()->profile_image) : asset('assets/images/defaultProfile.png') }}" alt="">
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
                            </svg></span><small>{{ auth()->user()->address ?? '—' }}</small></p>
                </div>
            </div>
            <div class="Contact_info">
                <ul>
                    <li>
                        <span><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                        <span>{{ auth()->user()->email ?? '—' }}</span>
                    </li>
                    <li>
                        <span><i class="fa fa-mobile" aria-hidden="true"></i></span>
                        <span>{{ auth()->user()->phone ?? '—' }}</span>
                    </li>
                    <li>
                        <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <span>{{ auth()->user()->address ?? '—' }}</span>
                    </li>
                    <li>
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <div class="cols d-flex align-items-center justify-content-between gap-3">
                            <span><i class="fa fa-file-image-o" aria-hidden="true"></i></span>
                            <span>
                                @if(auth()->user()->industry_license)
                                    <a href="{{ asset(auth()->user()->industry_license) }}" target="_blank">
                                        {{ basename(auth()->user()->industry_license) }}
                                    </a>
                                @else
                                    No License Uploaded
                                @endif
                            </span>
                        </div>

                        <div class="cols d-flex  justify-content-end">
                            @if(auth()->user()->industry_license)
                                <a href="{{ asset(  auth()->user()->industry_license) }}" 
                                class="btn btn-sm btn-primary" 
                                download>
                                Download
                                </a>
                            @else
                                <label class="Choose_file">
                                
                                    <span>......</span>
                                </label>
                            @endif
                        </div>
                    </div>
                </li>
                </ul>
            </div>
        </div>


        <div class="btn_grp_com d-flex align-items-center justify-content-center">
            <!-- <button class="btn Delete_bg">Delete Account</button> -->
            <button class="btn bg_btn" data-bs-toggle="modal" data-bs-target="#updateAccount">EDIT ACCOUNT</button>
            <!-- <button class="btn">Save</button> -->
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="updateAccount" tabindex="-1" aria-labelledby="updateAccountLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h3 class="fs-5">Update Account</h3>
                <button type="button" class="btn-close fs-6" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('designer.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="connect_popup px-5">
                        

                        <div class="quot_frm">
                            <div class="frm_grp">
                                <label for="profile_image">Profile Image</label>
                                <img id="profilePreview" src="{{ asset( auth()->user()->profile_image) }}" alt="Profile" style="width:50px;height:50px;object-fit:cover;">
                                <input type="file" name="profile_image" id="profileImage" class="form-control" accept="image/*">
                                
                            </div>

                            <div class="frm_grp">
                                <label for="banner">Banner Image</label>
                                <img id="bannerPreview" src="{{ asset( auth()->user()->banner) }}" alt="Banner" style="width:50px;height:50px;object-fit:cover;">
                                <input type="file" name="banner" id="banner" class="form-control">
                            </div>

                            <div class="frm_grp">
                                <label for="industry_license">Industry License</label>
                                <img id="industryPreview" src="{{ asset( auth()->user()->industry_license) }}" alt="Industry License" style="width:50px;height:50px;object-fit:cover;">
                                <input type="file" name="industry_license" id="industry_license" class="form-control">
                            </div>

                            <div class="frm_grp"><label for="name">Name</label><input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" value="{{ auth()->user()->name ?? '—' }}"></div>
                            <div class="frm_grp"><label for="email">Email ID</label><input type="text" name="email" id="email" placeholder="Enter Email" class="form-control" value="{{ auth()->user()->email ?? '—' }}" readonly></div>
                            <div class="frm_grp"><label for="phone">Number</label><input type="text" name="phone" id="phone" placeholder="Enter Phone Number" class="form-control" value="{{ auth()->user()->phone ?? '—' }}"></div>
                            <div class="frm_grp"><label for="address">Address</label><input type="text" name="address" id="address" placeholder="Enter Address" class="form-control" value="{{ auth()->user()->address ?? '—' }}"></div>
                        </div>

                    </div>
                    
                    <!-- Portfolio  Section Start -->
                    
                    <div class="proifleBox">
                            <div class="modal-header pb-0 mt-5 mb-5 popup_header">
                                <h4 class="fs-5">Portfolio Information</h4>
                            </div>
                            <div class="col-12 imgUp">
                                <div class="card h-100" style="border: none;">


                                    <div class="row portfolio-container g-4 formdiv single-item">

                                        <!-- Left Image Upload -->
                                        <div class="col-sm-3 imgUp">

    <div class="add_img">
        <label>
            <img
                 src="data:image/png;base64,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"
                                                            
                class="preview-img"
                alt=""
                style="width:150px;height:150px;object-fit:cover;object-position:center;">
        </label>
    </div>

    <input type="file"
           name="portfolio_image[]"
           class="hidden popupupoad"
           accept="image/*"
           onchange="previewFile(this)">

</div>

                                        <!-- Right Side Form -->
                                        <div class="col-sm-9 right-fields">
                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <input type="text" name="portfolio_name[]" class="form-control mb-2" placeholder="Portfolio Name">
                                                </div>

                                                <div class="col-sm-6">
                                                    <select name="category[]" class="form-select mb-2">
                                                        <option value="" selected disabled>Select Category</option>
                                                        <option value="leather">Leather</option>
                                                    </select>
                                                </div>

                                                <div class="col-sm-12">
                                                    <textarea name="product_detail[]" class="form-control mb-2" placeholder="Product Detail" rows="3"></textarea>
                                                    <input type="hidden" name="portfolio_status[]" value="1">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add More Button -->
                                    <div class="mt-3">
                                        <button type="button" id="addPortfolio" class="btn btn-outline-secondary formdiv">+ Add More</button>
                                    </div>
                                </div>
                                <!-- Existing Portfolios -->
                                @if($portfolios->count())
                                <div class="row mt-4 g-3 formdiv">
                                    @foreach($portfolios as $portfolio)
                                    <div class="col-sm-3 text-center">
                                        <div class="card shadow-sm">
                                            <img src="{{ asset('portfolios/'. $portfolio->image) }}" class="card-img-top img-thumbnail"
                                                style="height:150px; object-fit:cover;">
                                            <div class="card-body p-2">
                                                <p class="small mb-0">{{ $portfolio->name }}</p>
                                                @if($portfolio->category)
                                                <p class="small mb-0 text-muted">{{ $portfolio->category }}</p>
                                                @endif
                                                @if($portfolio->product_detail)
                                                <p class="small mb-0">{{ $portfolio->product_detail }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        
                        
                    <!-- Portfolio  Section End -->

                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btnCancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .popup-modal {
    padding: 0 !important;
}
    .popupupoad {
    padding: 10px 0;
}
    .popup_header {
    background: #673821;
    padding: 11px 10px 6px !important;
    /* margin: 0px 0; */
    border-radius: 0;
}
.popup_header h4 {
    color: #fff;
  
}
    .formdiv {
        padding: 0px 45px;
    }

    button#addPortfolio {
        padding: 10px 40px;
        margin: 0px 45px;
    }

    .proifleBox h4 {
        padding: 10px 45px;
    }

    .updateProfiles .frm_grp {
        margin-bottom: 10px;
    }

    .updateProfiles .frm_grp label {
        font-size: 14px;
        color: #212121;
        font-weight: 500;
    }


    .updateProfiles .frm_grp input,
    .updateProfiles textarea {
        width: 100%;
        font-size: 13px;
        color: #a3a3a3;
        border-radius: 5px;
        border: 2px solid #ebedf4;
        padding: 5px;
        background: #FFFFFF;
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
    function previewFile() {
        var preview = document.querySelector('img');
        var file = document.querySelector('input[type=file]').files[0];
        var reader = new FileReader();

        reader.addEventListener("load", function() {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
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
<script>
    $("#addPortfolio").click(function() {
        let clone = $(".single-item").first().clone();

        // Clear image preview
        clone.find(".imagePreview")
            .css("background-image", "none")
            .css("background-color", "#f8f9fa");

        // Clear file input
        clone.find('input[type="file"]').val("");

        // Clear text, textarea, select
        clone.find("input[type='text']").val("");
        clone.find("textarea").val("");
        clone.find("select").prop("selectedIndex", 0);

        // Insert after last item
        $(".single-item").last().after(clone);
    });
</script>

<script>
document.getElementById('profileImage').addEventListener('change', function () {

    if (this.files && this.files[0]) {
        document.getElementById('profilePreview').src =
            URL.createObjectURL(this.files[0]);
    }

});
</script>
<script>
document.getElementById('banner').addEventListener('change', function () {

    if (this.files && this.files[0]) {
        document.getElementById('bannerPreview').src =
            URL.createObjectURL(this.files[0]);
    }

});
</script>
<script>
document.getElementById('industry_license').addEventListener('change', function () {

    if (this.files && this.files[0]) {
        document.getElementById('industryPreview').src =
            URL.createObjectURL(this.files[0]);
    }

});
</script>

<script>
function previewFile(input) {

    if (input.files && input.files[0]) {

        let reader = new FileReader();

        reader.onload = function(e) {

            input.closest('.imgUp')
                 .querySelector('.preview-img')
                 .src = e.target.result;

        }

        reader.readAsDataURL(input.files[0]);
    }

}
</script>

<script>
function previewFile(input) {

    if (input.files && input.files[0]) {

        input.closest('.imgUp')
             .querySelector('.preview-img')
             .src = URL.createObjectURL(input.files[0]);

    }

}
</script>


@include('designer.include.footer')