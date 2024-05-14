<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop Runner | Registration Page</title>
    <link rel="icon" href="front/img/mini-logo.svg" type="image/x-icon">
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
            background-image: url("front/img/banner-2.jpg");
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

<section class="vh-100" style="background-image: url('front/img/background-register.svg');background-size: cover;
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
              <div class="card-body p-4 p-lg-5 text-black">

                  @if(session('notification'))
                      <div class="bs4ToastWrapper d-flex toast alert col-4 ml-2 mt-4 fade show" role="alert">
                          <div>
                              <div class="toast-header">
                                  <strong class="mr-auto">Notification<i class="fa fa-bell text-danger"></i></strong>
                              </div>
                              <div class="toast-body d-flex">
                                  <p class="text-danger">{{session('notification')}}</p>
                              </div>
                          </div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                  @endif
                <form method="post" action="">
                @csrf
                  <div class="d-flex align-items-center mb-3 pb-1">

                    <a href="./"><span class="h1 fw-bold mb-0"><img src="front/img/shop-runner-logo-svg-2.svg" width=200 height=50 alt=""></span></a>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register a new membership</h5>
                <div class="row">
                    <div data-mdb-input-init class="form-outline mb-2 col">
                    <label class="form-label" for="form2Example17">Name</label>
                        <input name="name" type="name" id="form2Example17" class="form-control form-control-lg" />

                        @error('name')
                        <span class="text-danger " style="font-size:60%;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                    <div data-mdb-input-init class="form-outline mb-2 col">
                  <label class="form-label" for="form2Example17">Email address</label>
                    <input name="email" type="email" id="form2Example17" class="form-control form-control-lg" />

                    @error('email')
                    <span class="text-danger" style="font-size:60%;" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                  </div>
                </div>
                  <div class="row">
                        <div data-mdb-input-init class="form-outline mb-2 col">
                    <label class="form-label" for="form2Example27">Password</label>
                        <input name="password" value="{{ old('password')}}" required type="password" id="password" class="form-control form-control-lg" />

                        @error('password')
                        <span class="text-danger" style="font-size:60%;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                    <div data-mdb-input-init class="form-outline mb-2 col">
                  <label class="form-label" for="form2Example27">Retype Password</label>
                    <input name="password_confirmation" value="{{ old('password_confirmation')}}" required autocomplete="new-password" type="password" id="password_confirmation" class="form-control form-control-lg" />
                    @error('password_confirmation')
                        <span class="text-danger" style="font-size:0%;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                    @enderror
                  </div>
                  </div>







                  <div class="pt-1 mb-4">
                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit">Register</button>
                  </div>

                  <a class="small text-muted" href="#!">Forgot password?</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">You have an account? <a href="./account/login"
                      style="color: #007bff;">Sign in here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
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
