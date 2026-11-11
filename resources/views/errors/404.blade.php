
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>404 - Page Not Found | Pllohide</title>

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- 404 Page -->
    <section class="min-vh-100 d-flex align-items-center bg-light">

        <div class="container py-5">

            <!-- Top Center Image -->
            <div class="row justify-content-center text-center mb-4">

                <div class="col-12 col-md-8 col-lg-6">

                   <img src="{{ asset('public/assets/images/404-error.png') }}"
                         alt="Wateryze water treatment illustration"
                         class="img-fluid" style="height: 360px;">

                </div>

            </div>

            <!-- Bottom Center Content -->
            <div class="row justify-content-center text-center">

                <div class="col-12 col-lg-8">

                    <!-- <h1 class="fw-bold text-primary mb-0">
                        404
                    </h1>

                    <h2 class="fw-bold text-dark mb-4">
                        Page Not Found
                    </h2> -->

                    <a href="javascript:history.back();"
                       class="btn btn-primary btn-sm rounded-pill px-3 py-2">
                        &larr; Go Back
                    </a>

                </div>

            </div>

        </div>

    </section>

</body>

</html>