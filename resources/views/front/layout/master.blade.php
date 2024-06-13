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


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/css/chat.min.css">
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
<div id="custom-alert" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border: 1px solid black; z-index: 10002;">
    <p id="custom-alert-message"></p>
    <button onclick="hideCustomAlert()">OK</button>
</div>
<div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 10001;"></div>

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
            <div class="row align-items-center">
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
{{--                        <label class="switch">--}}
{{--                            <input type="checkbox">--}}
{{--                            <span class="slider"></span>--}}

{{--                        </label>--}}

                        <div class="notifications">
                            <p class="notifications-bell"><i class='fa fa-bell' style='color:#fff'></i></p>
                            <div class="notifications-menu">
                                <h4 class="font-weight-bold float-left mb-3">Notifications</h4>
                                <div class="notifications-items ">
                                    <div class="item border font-weight-bold">
                                        <img src="https://nupet.vn/wp-content/uploads/2023/11/anh-meo-hai-huoc-nupet-3.jpg" alt="" width="50px">
                                        <div class="u9">
                                            <p class="font-weight-bold text-uppercase">Order completed</p>
                                            <p class="text-black-50">Order #192 has been completed!</p>
                                            <span class="text-black-50">10/4/2024 :: 12:25</span>
                                        </div>
                                    </div>
                                    <div class="item border font-weight-bold text-black-50">
                                        <img src="https://nupet.vn/wp-content/uploads/2023/11/anh-meo-hai-huoc-nupet-3.jpg" alt="" width="50px">
                                        <div class="u9">
                                            <p class="font-weight-bold text-uppercase">You have an order on the way</p>
                                            <p class="text-black-50">Shipper said: order #231 is still in transit</p>
                                            <span class="text-black-50">10/4/2024 :: 12:25</span>
                                        </div>
                                    </div>
                                    <div class="item border font-weight-bold text-black-50">
                                        <img src="https://nupet.vn/wp-content/uploads/2023/11/anh-meo-hai-huoc-nupet-3.jpg" alt="" width="50px">
                                        <div class="u9">
                                            <p class="font-weight-bold text-uppercase">Order completed</p>
                                            <p class="text-black-50">Order #192 has been completed!dwawd dwadwa dwadw wdwadwdwadwd dwada dawd dwad</p>
                                            <span class="text-black-50">10/4/2024 :: 12:25</span>
                                        </div>
                                    </div>
                                    <div class="item border font-weight-bold text-black-50">
                                        <img src="https://nupet.vn/wp-content/uploads/2023/11/anh-meo-hai-huoc-nupet-3.jpg" alt="" width="50px">
                                        <div class="u9">
                                            <p class="font-weight-bold text-uppercase">Order completed</p>
                                            <p class="text-black-50">Order #192 has been completed!</p>
                                            <span class="text-black-50">10/4/2024 :: 12:25</span>
                                        </div>
                                    </div>
                                    <a class="text-center" href="#">View all</a>
                                </div>
                            </div>
                        </div>

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
                                    <img src="https://cdn-icons-png.flaticon.com/512/5111/5111640.png" width="25" alt="">
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
                                <span><a href="#"><img style="border-radius: 50%;background: #ffffff" src="{{ Auth::user()->avatar == null ? 'front/img/user/default-avatar.png' : 'front/img/user/' . Auth::user()->avatar }}" width="25" height="25" alt=""> {{ Auth::user()->name }}</a> <i class="arrow_carrot-down"></i></span>
                                <ul>
                                    <li><a href="./account/my-order"><button type="submit" class="btn logout-btn">My Orders</button></a></li>
                                    <li><a href="./account/profile"><button type="submit" class="btn logout-btn">Profile</button></a></li>
                                    <li><button type="submit" class="btn logout-btn">News</button></li>
                                    <li>

                                        <a href="./account/logout"> <button type="submit" class="btn logout-btn">Logout</button></a>

                                    </li>
                                </ul>
                            @else
                                    <a href="./account/login" class="comic-button"><i class="fa fa-user"></i>
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
                    <p>Shop Runner brings to the sports-loving community products for runners & triathletes including:
                        Specialized running clothes, Accessories (Hat, Water vest, Corn bundle, Towel, Belt, Water bottle etc.) and Nutrition.</p>
                    <a href="#"><img src="front/img/payment.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>CONTACT INFO</h6>
                    <ul>
                        <li><a href="#">Address: Detech Building 8a Tôn Thất Thuyết, Mỹ Đình, Cầu Giấy, Hà Nội</a></li>
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
                <a href="#" onclick="document.body.scrollTop=0;document.documentElement.scrollTop=0;event.preventDefault()">
                <button class="back-to-top-btn">
                    <div class="text">
                        <span>Back</span>
                        <span>to</span>
                        <span>top</span>
                    </div>
                    <div class="clone">
                        <span>Back</span>
                        <span>to</span>
                        <span>top</span>
                    </div>
                    <svg
                        stroke-width="2"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        fill="none"
                        class="h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg"
                        width="20px"
                    >
                        <path
                            d="M14 5l7 7m0 0l-7 7m7-7H3"
                            stroke-linejoin="round"
                            stroke-linecap="round"
                        ></path>
                    </svg>
                </button>
                </a>
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
<div class="support">
    <a href="#" id="support-link">@if($locale == 'vi'){{ __('vi.Support') }}@else{{ __('en.Support') }}@endif</a>

</div>
<div class="support_menu">
    <a href="{{url('/tinker')}}">BOTMAN</a>
    <div class="mb-5" id="chat">
        <form action="{{url('/botman')}}" method="post" id="message-form">
            @csrf
            <div class="card-chat">
                <div class="chat-header">Chat</div>
                <div class="chat-window">
                    <ul class="message-list">
                        <div class="admin-message">✋ Hi, I'm botman.@if($locale == 'vi'){{ __('vi.The support person will reply soon when online, how can I help you in the meantime?') }}@else{{ __('en.The support person will reply soon when online, how can I help you in the meantime?') }}@endif</div>
                    </ul>
                    <div class="loading">
                        <div class="dot-wave">
                            <div class="dot-wave__dot"></div>
                            <div class="dot-wave__dot"></div>
                            <div class="dot-wave__dot"></div>
                            <div class="dot-wave__dot"></div>
                        </div>
                    </div>
                </div>
                <div class="chat-input">
                    <input name="message" type="text" class="message-input" placeholder="Type your message here">
                    <button type="submit" class="send-button">Send</button>
                </div>
            </div>
        </form>
    </div>
    <a href="#">
        <button class="gg-button">
            <svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" viewBox="0 0 256 262">
                <path fill="#4285F4" d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027"></path>
                <path fill="#34A853" d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1"></path>
                <path fill="#FBBC05" d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782"></path>
                <path fill="#EB4335" d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251"></path>
            </svg>
            Continue with Google
        </button></a>
    <a href="#">
        <button class="fb-button">
            <svg stroke="#ffffff" xml:space="preserve" viewBox="-143 145 512 512" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1" version="1.1" fill="#ffffff"><g stroke-width="0" id="SVGRepo_bgCarrier"></g><g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g><g id="SVGRepo_iconCarrier"> <path d="M329,145h-432c-22.1,0-40,17.9-40,40v432c0,22.1,17.9,40,40,40h432c22.1,0,40-17.9,40-40V185C369,162.9,351.1,145,329,145z M169.5,357.6l-2.9,38.3h-39.3v133H77.7v-133H51.2v-38.3h26.5v-25.7c0-11.3,0.3-28.8,8.5-39.7c8.7-11.5,20.6-19.3,41.1-19.3 c33.4,0,47.4,4.8,47.4,4.8l-6.6,39.2c0,0-11-3.2-21.3-3.2c-10.3,0-19.5,3.7-19.5,14v29.9H169.5z"></path> </g></svg>
            Chat with Facebook
        </button>
    </a>
    <a href="#">
        <button class="zl-button">
            <svg class="zl-svg" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48">
                <path fill="#2962ff" d="M15,36V6.827l-1.211-0.811C8.64,8.083,5,13.112,5,19v10c0,7.732,6.268,14,14,14h10	c4.722,0,8.883-2.348,11.417-5.931V36H15z"></path><path fill="#eee" d="M29,5H19c-1.845,0-3.601,0.366-5.214,1.014C10.453,9.25,8,14.528,8,19	c0,6.771,0.936,10.735,3.712,14.607c0.216,0.301,0.357,0.653,0.376,1.022c0.043,0.835-0.129,2.365-1.634,3.742	c-0.162,0.148-0.059,0.419,0.16,0.428c0.942,0.041,2.843-0.014,4.797-0.877c0.557-0.246,1.191-0.203,1.729,0.083	C20.453,39.764,24.333,40,28,40c4.676,0,9.339-1.04,12.417-2.916C42.038,34.799,43,32.014,43,29V19C43,11.268,36.732,5,29,5z"></path><path fill="#2962ff" d="M36.75,27C34.683,27,33,25.317,33,23.25s1.683-3.75,3.75-3.75s3.75,1.683,3.75,3.75	S38.817,27,36.75,27z M36.75,21c-1.24,0-2.25,1.01-2.25,2.25s1.01,2.25,2.25,2.25S39,24.49,39,23.25S37.99,21,36.75,21z"></path><path fill="#2962ff" d="M31.5,27h-1c-0.276,0-0.5-0.224-0.5-0.5V18h1.5V27z"></path><path fill="#2962ff" d="M27,19.75v0.519c-0.629-0.476-1.403-0.769-2.25-0.769c-2.067,0-3.75,1.683-3.75,3.75	S22.683,27,24.75,27c0.847,0,1.621-0.293,2.25-0.769V26.5c0,0.276,0.224,0.5,0.5,0.5h1v-7.25H27z M24.75,25.5	c-1.24,0-2.25-1.01-2.25-2.25S23.51,21,24.75,21S27,22.01,27,23.25S25.99,25.5,24.75,25.5z"></path><path fill="#2962ff" d="M21.25,18h-8v1.5h5.321L13,26h0.026c-0.163,0.211-0.276,0.463-0.276,0.75V27h7.5	c0.276,0,0.5-0.224,0.5-0.5v-1h-5.321L21,19h-0.026c0.163-0.211,0.276-0.463,0.276-0.75V18z"></path>
            </svg>
            Chat with ZALO
        </button>
    </a>


    <div class="support_menu_close">Click outside to close the tab</div>
</div>
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
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAIwTPctnSM2PWcbK6cMdlZaSgEYIKp5U&callback=initMap" async defer></script>
</body>

</html>
