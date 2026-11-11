<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlloHide</title>
     <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css?var=2') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/variables.css?var=2') }}">
<link rel="stylesheet" href="{{ asset('assets/css/reset.css?var=2') }}">
<link rel="stylesheet" href="{{ asset('assets/css/header.css?var=2') }}">
<link rel="stylesheet" href="{{ asset('assets/css/home.css?var=2') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v={{ filemtime(public_path('assets/css/style.css')) }}">
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}?v={{ filemtime(public_path('assets/css/dashboard.css')) }}">
<link rel="stylesheet" href="{{ asset('assets/css/footer.css?var=2') }}">
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}?v={{ filemtime(public_path('assets/css/responsive.css')) }}">

</head>

<body>

    <div class="signup_page">
        <div class="bg_inner"><img src="{{ asset('assets/images/bg.png') }}" class="media_img">
            <div class="card_success">
                <form method="POST" action="{{ route('choose.account.submit') }}">
                    @csrf
                <div class="bg_inner bg_account">
                    <h5>Choose your account</h5>
                    <div class="list_account d-flex align-items-center justify-content-center">
                        <label class="mx-3" for="Designer"><input type="radio" name="role" value="1" id="Designer" required onchange="this.form.submit()"><span>
                                <div class="card_acc"> <img src="{{ asset('assets/images/Designer.png') }}" alt=""> </div>
                                <p>Designer</p>
                            </span></label><label class="mx-3" for="Supplier"><input type="radio" name="role" value="2"
                                id="Supplier" onchange="this.form.submit()"><span>
                                <div class="card_acc"> <img src="{{ asset('assets/images/Supplier.png') }}" alt=""> </div>
                                <p>Supplier</p>
                            </span></label><label class="mx-3" for="Manufacturer"><input type="radio" name="role" value="3"
                                id="Manufacturer" onchange="this.form.submit()"><span>
                                <div class="card_acc"> <img src="{{ asset('assets/images/Manufacturer.png') }}" alt=""> </div>
                                <p>Manufacturer</p>
                            </span></label>
                    </div>
                </div>
                
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // As a safety net, submit on any change of role
        document.addEventListener('DOMContentLoaded', function(){
            var form = document.querySelector('form[action="{{ route('choose.account.submit') }}"]');
            if (!form) return;
            var radios = form.querySelectorAll('input[name="role"]');
            radios.forEach(function(r){
                r.addEventListener('change', function(){ form.submit(); });
            });
        });
    </script>
</body>

</html>