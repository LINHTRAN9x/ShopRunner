<!DOCTYPE html>
<html lang="zxx">

<head>
    <base href="{{asset('/')}}">
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="front/img/mini-logo-3.svg" type="image/x-icon">
    <title>@yield('title') | Shop Runner</title>


    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jacquarda+Bastarda+9+Charted&family=Jersey+20&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="front/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="front/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="front/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="front/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/style.css" type="text/css">
</head>

<body>
<div id="custom-alert" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid black; z-index: 1000;">
    <p id="custom-alert-message"></p>
    <button onclick="hideCustomAlert()">OK</button>
</div>
<div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 999;"></div>

<div id="alertMessage">
</div>

<!-- Page Preloder -->
<div id="preloder">
    <span class="loader"><img src="front/img/shop-runner-logo-svg-2.svg" alt=""></span>
    <span class="loader-inner">Loading...</span>
</div>

<!-- Offcanvas Menu Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="offcanvas__option">
        <div class="offcanvas__links">
            <a href="#">FAQs</a>
        </div>

        <div class="header__top__hover">
                            <span>
                                @if($locale == 'en')
                                    <img src="https://cdn-icons-png.flaticon.com/512/5111/5111640.png" width="25" alt="">
                                @elseif($locale == 'vi')
                                    <img src="front/img/icon/vn-icon.png" width="25" alt="">
                                @else
                                    <img src="front/img/icon/vn-icon.png" width="25" alt="">
                                @endif
                                <i class="arrow_carrot-down"></i>
                            </span>
            <ul>
                <li>
                    <a href="{{ route('change-language', ['locale' => 'vi']) }}">
                        <img src="https://w7.pngwing.com/pngs/28/915/png-transparent-ensign-flag-nation-vietnam-flags-icon.png" width="25" alt="">
                    </a>
                </li>
                <li>
                    <a href="{{ route('change-language', ['locale' => 'en']) }}">
                        <img src="https://cdn-icons-png.flaticon.com/512/5111/5111640.png" width="25" alt="">
                    </a>
                </li>
            </ul>
        </div>
        <div class="header__top__hover">
            @if(Auth::check())
                <span><a class="text-dark font-weight-bold" href="#"><img style="border-radius: 50%" src="front/img/user/{{Auth::user()->avatar}}" width="25" alt=""> {{ Auth::user()->name }}</a> <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li><a href="./account/my-order"><button type="submit" class="btn logout-btn">My Orders</button></a></li>
                    <li><button type="submit" class="btn logout-btn">Settings</button></li>
                    <li><button type="submit" class="btn logout-btn">News</button></li>
                    <li>

                        <a href="./account/logout"> <button type="submit" class="btn logout-btn">Logout</button></a>

                    </li>
                </ul>
            @else
                <a href="./account/login"><i class="fa fa-user"></i>
                    @if($locale == 'vi')
                        {{ __('vi.Become a member') }}
                    @else
                        {{ __('en.Become a member') }}
                    @endif
                </a>
            @endif
        </div>

    </div>
    <div class="offcanvas__nav__option">
        <a class="search-switch"><img class="cart-icon" src="front/img/icon/search.png" alt=""></a>
        <a href="./favourite"><img src="front/img/icon/heart.png" alt=""><span class="favourite-count">{{$favouriteCount}}</span></a>
        <a href="./cart"><img class="cart-icon" src="front/img/icon/cart.png" alt=""> <span class="cart-count">{{Cart::count()}}</span></a>
        <div class="price">${{Cart::total()}}</div>
    </div>
    <div id="mobile-menu-wrap">

    </div>
    <div class="offcanvas__text">
        <p>Free shipping, 30-day return or refund guarantee.</p>
    </div>
</div>
<!-- Offcanvas Menu End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>
                            @if($locale == 'vi')
                            {{ __('vi.Free shipping, 30-day return or refund guarantee.') }}
                            @else
                                {{ __('en.Free shipping, 30-day return or refund guarantee.') }}
                            @endif
                        </p>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">

                            <a href="#">FAQs</a>
                        </div>
                        <div class="header__top__hover">
                            <span>
                                @if($locale == 'en')
                                    <img src="https://cdn-icons-png.flaticon.com/512/5111/5111640.png" width="25" alt="">
                                    @elseif($locale == 'vi')
                                    <img src="front/img/icon/vn-icon.png" width="25" alt="">
                                    @else
                                    <img src="front/img/icon/vn-icon.png" width="25" alt="">
                                    @endif
                                <i class="arrow_carrot-down"></i>
                            </span>
                            <ul>
                                <li>
                                    <a href="{{ route('change-language', ['locale' => 'vi']) }}">
                                        <img src="https://w7.pngwing.com/pngs/28/915/png-transparent-ensign-flag-nation-vietnam-flags-icon.png" width="25" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('change-language', ['locale' => 'en']) }}">
                                        <img src="https://cdn-icons-png.flaticon.com/512/5111/5111640.png" width="25" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="header__top__hover">
                            @if(Auth::check())
                                <span><a href="#"><img style="border-radius: 50%;background: #ffffff" src="{{ Auth::user()->avatar == null ? 'front/img/user/default-avatar.png' : 'front/img/user/' . Auth::user()->avatar }}" width="25" alt=""> {{ Auth::user()->name }}</a> <i class="arrow_carrot-down"></i></span>
                                <ul>
                                    <li><a href="./account/my-order"><button type="submit" class="btn logout-btn">My Orders</button></a></li>
                                    <li><button type="submit" class="btn logout-btn">Settings</button></li>
                                    <li><button type="submit" class="btn logout-btn">News</button></li>
                                    <li>

                                        <a href="./account/logout"> <button type="submit" class="btn logout-btn">Logout</button></a>

                                    </li>
                                </ul>
                            @else
                                    <a href="./account/login"><i class="fa fa-user"></i>
                                        @if($locale == 'vi')
                                            {{ __('vi.Become a member') }}
                                        @else
                                            {{ __('en.Become a member') }}
                                        @endif
                                    </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="./"><img src="front/img/shop-runner-logo-svg-2.svg" width=200 height=50 alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="{{(request()->segment(1) == '') ? 'active' : ''}}"><a href="./">@if($locale == 'vi'){{ __('vi.Home') }}@else{{ __('en.Home') }}@endif</a></li>
                        <li class="{{(request()->segment(1) == 'shop') ? 'active' : ''}}"><a href="./shop">@if($locale == 'vi'){{ __('vi.Shop') }}@else{{ __('en.Shop') }}@endif</a></li>
                        <li class="{{(request()->segment(1) == 'categories') ? 'active' : ''}}"><a href="#">@if($locale == 'vi'){{ __('vi.Categories') }}@else{{ __('en.Categories') }}@endif</a>
                            <ul class="dropdown d-flex">
                                <div class="dropdown-items ">
                                    <li class="dropdown-background"><a href="./about.html">MAN</a></li>
                                    <li><a href="./shop-details.html">New Arrivals</a></li>
                                    <li><a href="./shopping-cart.html">Sportswear</a></li>
                                    <li><a href="./checkout.html">Tracksuits</a></li>
                                    <li><a href="./blog-details.html">Outdoor</a></li>
                                </div>
                                <div class="dropdown-items">
                                    <li class="dropdown-background"><a href="./">WOMEN</a></li>
                                    <li><a href="./shop-de">New Arrivals</a></li>
                                    <li><a href="./shop">Sportswear</a></li>
                                    <li><a href="./ch">Tracksuits</a></li>
                                    <li><a href="./blog-d">Outdoor</a></li>
                                </div>
                                <div class="dropdown-items">
                                    <li class="dropdown-background"><a href="./">ACCESSORIES</a></li>
                                    <li><a href="./shop-de">Shop Details</a></li>
                                    <li><a href="./shop">Shopping Cart</a></li>
                                    <li><a href="./ch">Check Out</a></li>
                                    <li><a href="./blog-d">Blog Details</a></li>
                                </div>
                                <div class="dropdown-items">
                                    <li class="dropdown-background"><a href="./">SHOES</a></li>
                                    <li><a href="./shop-de">Shop Details</a></li>
                                    <li><a href="./shop">Shopping Cart</a></li>
                                    <li><a href="./ch">Check Out</a></li>
                                    <li><a href="./blog-d">Blog Details</a></li>
                                </div>

                            </ul>
                        </li>
                        <li class="{{(request()->segment(1) == 'blog') ? 'active' : ''}}"><a href="./blog">Blog</a></li>
                        <li class="{{(request()->segment(1) == 'contacts') ? 'active' : ''}}"><a href="./contacts">@if($locale == 'vi'){{ __('vi.Contacts') }}@else{{ __('en.Contacts') }}@endif</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a class="search-switch"><img class="cart-icon" src="front/img/icon/search.png" alt=""></a>
                    <a href="./favourite"><img src="front/img/icon/heart.png" alt=""><span class="favourite-count">{{$favouriteCount}}</span></a>
                    <a href="./cart"><img class="cart-icon" src="front/img/icon/cart.png" alt=""> <span class="cart-count">{{Cart::count()}}</span></a>
                    <div class="price">${{Cart::total()}}</div>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->


{{--Body section--}}
@yield('body')

<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="./"><img src="front/img/shop-runner-logo-svg-white-2.svg" width=200 height=68 alt=""></a>
                    </div>
                    <p>Shop Runner đem đến cộng đồng yêu thể thao các sản phẩm dành cho vận động viên chạy bộ
                        & ba môn phối hợp gồm: Quần áo chạy bộ chuyên dụng, Phụ kiện (Mũ, Vest nước, Bó bắp, Khăn, Belt, Bình nước v.v...)
                        và Dinh dưỡng.</p>
                    <a href="#"><img src="front/img/payment.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>THÔNG TIN LIÊN HỆ</h6>
                    <ul>
                        <li><a href="#">Địa chỉ: Detech Building 8a Tôn Thất Thuyết, Mỹ Đình, Cầu Giấy, Hà Nội</a></li>
                        <li><a href="#">Hotline: 096 848 9910</a></li>
                        <li><a href="#">Email: runnershop.vn@gmail.com</a></li>
                        <li><a href="#">Sale</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>NewLetter</h6>
                    <div class="footer__newslatter">
                        <p>Be the first to know about new arrivals, look books, sales & promos!</p>
                        <form action="#">
                            <input type="text" placeholder="Your email">
                            <button type="submit"><span class="icon_mail_alt"></span></button>
                        </form>
                    </div>

                </div>
                <img src="front/img/bo-cong-thuong.png" width="135" alt="">
                <p>
                    <a href="#"><img style="margin: 0" src="front/img/icon/facebook.svg" width="30" alt=""></a>
                    <a href="#"><img style="margin: 0" src="front/img/icon/instagram.svg" width="30" alt=""></a>
                    <a href="#"><img style="margin: 0" src="front/img/icon/x-white.svg" width="30" alt=""></a>
                    <a href="#"><img style="margin: 0" src="front/img/icon/youtube.svg" width="30" alt=""></a>
                    <a href="#"><img  style="margin: 0" src="front/img/icon/in.svg" width="30" alt=""></a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer__copyright__text">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <p>Copyright © by shop runner
                        <script>
                            document.write(new Date().getFullYear());
                        </script> 2020
                        All rights reserved<i class="fa fa-heart-o"
                                              aria-hidden="true"></i>
                    </p>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>

        <form action="shop" class="search-model-form">
            <input name="search" value="{{ request('search') }}" type="text" id="search-input" placeholder="Search here.....">
        </form>

    </div>
</div>
<!-- Search End -->

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
<script src="front/js/gsap.min.js"></script>
<script src="front/js/ScrollTrigger.min.js"></script>
<script src="js/bs4-toast.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAIwTPctnSM2PWcbK6cMdlZaSgEYIKp5U&callback=initMap" async defer></script>
</body>

</html>
