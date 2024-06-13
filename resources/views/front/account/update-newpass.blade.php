
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Runner | New Password</title>
    <link rel="icon" href="front/img/mini-logo-3.svg" type="image/x-icon">
    <base href="/" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="front/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="front/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="front/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="front/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/style.css" type="text/css">
    <link rel="stylesheet" href="front/css/bs4Toast.css" type="text/css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jacquarda+Bastarda+9+Charted&family=Jersey+20&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">
    <style>
        .banner{
            background-image: url("front/img/banner-1.jpg");
            background-size: cover;
            background-position: left;
            background-repeat: no-repeat;
            border-radius: 1em 0 0 1em;
        }
    </style>
</head>
<body class="">
<!-- Page Preloder -->
<div id="preloder">
    <span class="loader"><img src="front/img/shop-runner-logo-svg-2.svg" alt=""></span>
    <span class="loader-inner">Loading...</span>
</div>

<!-- /.login-box -->

<section class="vh-100" style="background-image: url('front/img/background-login-2.svg');background-size: cover;
            background-position: left;
            background-repeat: no-repeat;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block banner">

                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-4 text-black">
                                @if(session('notification'))
                                    <div class="bs4ToastWrapper d-flex toast alert col-4 ml-2 mt-4 fade show" role="alert">
                                        <div>
                                            <div class="toast-header">
                                                <strong class="mr-auto">Notification<i class="fa fa-bell"></i></strong>
                                            </div>
                                            <div class="toast-body d-flex">
                                                <p class="text-warning">{{session('notification')}}</p>
                                            </div>
                                        </div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @php
                                    $token = $_GET['token'];
                                    $email = $_GET['email'];
                                @endphp

                                <form method="POST" action="{{url('account/reset-password')}}">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3 pb-1">

                                        <a href="./"><span class="h1 fw-bold mb-0"><img src="front/img/shop-runner-logo-svg-2.svg" width=200 height=50 alt=""></span></a>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Enter your new password</h5>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17">New Password</label>
                                        <input type="hidden" name="email" value="{{$email}}">
                                        <input type="hidden" name="token" value="{{$token}}">
                                        <input name="password" value="{{ old('email')}}" type="text" id="form2Example17" class="form-control form-control-lg" />

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>


                                    <div class="pt-1 mb-4">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Submit</button>
                                    </div>

                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="./account/register"
                                                                                                              style="color: #007bff;">Register here</a></p>
                                    <a href="#!" class="small text-muted">Terms of use.</a>
                                    <a href="#!" class="small text-muted">Privacy policy</a>
                                </form>
                                <div>
                                    <a href="{{url('account/login-facebook')}}">Google</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(session('message'))
    <div id="alertMessage" class="alert alert-success">
        <div class="bs4ToastWrapper d-flex toast alert alert-success col-4 ml-2 mt-4 fade show" role="alert">
            <div>
                <div class="toast-header">
                    <strong class="mr-auto">Notification<i class="fa fa-bell"></i></strong>
                </div>
                <div class="toast-body d-flex">

                    <p> {{ session('message') }}</p>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

@endif
@if(session('success'))
    <div id="alertMessage" class="alert alert-success">
        <div class="bs4ToastWrapper d-flex toast alert alert-success col-4 ml-2 mt-4 fade show" role="alert">
            <div>
                <div class="toast-header">
                    <strong class="mr-auto">Notification<i class="fa fa-bell"></i></strong>
                </div>
                <div class="toast-body d-flex">

                    <p class="text-success"> {{ session('message') }}</p>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

@endif

@if(session('error'))
    <div class="alert alert-success">
        <div class="bs4ToastWrapper d-flex toast alert alert-danger col-4 ml-2 mt-4 fade show" role="alert">
            <div>
                <div class="toast-header">
                    <strong class="mr-auto">Notification<i class="fa fa-bell text-danger"></i></strong>
                </div>
                <div class="toast-body">
                    <p class="text-danger font-weight-bold"> {{ session('error') }}</p>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

@endif

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Js Plugins -->
<script src="front/js/jquery-3.3.1.min.js"></script>
<script src="front/js/bootstrap.min.js"></script>
<script src="front/js/jquery.nice-select.min.js"></script>
<script src="front/js/jquery.nicescroll.min.js"></script>
<script src="front/js/jquery.magnific-popup.min.js"></script>
<script src="front/js/jquery.countdown.min.js"></script>
<script src="front/js/jquery.slicknav.js"></script>
<script src="front/js/mixitup.min.js"></script>
<script src="front/js/owl.carousel.min.js"></script>
<script src="front/js/main.js"></script>
</body>
</html>


