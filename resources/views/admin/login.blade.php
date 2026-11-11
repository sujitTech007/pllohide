<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlloHide</title>
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">


</head>

<body>

    <div class="signup_page">
        <div class="bg_inner"><img src="assets/images/bg.png" alt="" class="media_img">
            <div class="card_success">
                <div class="bg_inner bg_Create">
                    <h5 class="text-left mb-3">Admin Login</h5>
                    <form action="{{ route('admin.login.submit') }}" method="POST">
                        @csrf
                        <div class="form">
                            <div class="frm_grp">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="frm_grp">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                            </div>

                            <div class="btn_grp text-center"><button class="btn">LOGIN</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>