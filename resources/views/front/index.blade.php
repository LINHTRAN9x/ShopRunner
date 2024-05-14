@extends("front.layout.master")

@section('title','Home')

@section("body")
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">

            <div class="hero__items set-bg" data-setbg="front/img/banner-5-1.jpg">
                <div class="container hero__custom">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>@if($locale == 'vi'){{ __('vi.Adidas x ShopRunner Samba Collection') }}@else{{ __('en.Adidas x ShopRunner Samba Collection') }}@endif</h6>
                                <h2 class="text-white">GAZELLE</h2>
                                <p class="text-white">
                                    @if($locale == 'vi'){{ __('vi.Three icons, a thousand stories.') }}@else{{ __('en.Three icons, a thousand stories.') }}@endif
                                </p>
                                <a href="#" class="primary-btn-hero">@if($locale == 'vi'){{ __('vi.Shop now') }}@else{{ __('en.Shop now') }}@endif <span class="arrow_carrot-2right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="front/img/banner-6.jpg">
                <div class="container ">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>@if($locale == 'vi'){{ __('vi.Summer Collection') }}@else{{ __('en.Summer Collection') }}@endif</h6>
                                <h2 class="text-white">INDEPENDENCE SALE</h2>
                                <p class="text-white">
                                    @if($locale == 'vi')
                                        {{ __('vi.Discount up to 20% off + extra 10% off for shop runner members.Final sale prices are displayed at checkout page.Terms & Conditions and Exclusions apply.') }}
                                    @else
                                        {{ __('en.Discount up to 20% off + extra 10% off for shop runner members.Final sale prices are displayed at checkout page.Terms & Conditions and Exclusions apply.') }}
                                    @endif
                                </p>
                                <a href="#" class="primary-btn-hero">@if($locale == 'vi'){{ __('vi.Shop now') }}@else{{ __('en.Shop now') }}@endif <span class="arrow_carrot-2right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items">
                <video autoplay loop muted playsinline class="background-video">
                    <source src="front/img/hero/hero-4.mp4" type="video/mp4">
                    <!-- Bạn có thể thêm nguồn video dự phòng ở đây nếu cần -->
                </video>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>ADIZERO</h6>
                                <h2 class="text-white">FOR THE FAST</h2>
                                <p class="text-white">@if($locale == 'vi'){{ __('vi.Meet our record-breaking running shoe family.') }}@else{{ __('en.Meet our record-breaking running shoe family.') }}@endif</p>
                                <a href="#" class="primary-btn-hero">@if($locale == 'vi'){{ __('vi.Shop now') }}@else{{ __('en.Shop now') }}@endif <span class="arrow_carrot-2right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <script>
        // use a script tag or an external JS file
        document.addEventListener("DOMContentLoaded", (event) => {
            gsap.registerPlugin(ScrollTrigger)
            gsap.to(".scroll-1", {
                scrollTrigger:{
                    trigger: ".scroll-1",
                    toggleActions: "restart pause reverse pause",
                    start: "10px 80%",
                    end: "bottom 100px",
                    scrub:2,
                }, // start animation when ".box" enters the viewport
                x: -300,
                duration:.5,
            });
            gsap.to(".scroll-2", {
                scrollTrigger:{
                    trigger: ".scroll-2",
                    toggleActions: "restart pause reverse pause",
                    start: "10px 80%",
                    end: "bottom 100px",
                    scrub:2,
                }, // start animation when ".box" enters the viewport
                x: 300,
                duration:.5,
            });
            gsap.to(".scroll-3", {
                scrollTrigger:{
                    trigger: ".scroll-3",
                    toggleActions: "restart pause reverse pause",
                    start: "10px 80%",
                    end: "bottom 100px",
                    scrub:2,
                }, // start animation when ".box" enters the viewport
                x: -400,
                duration:.5,
            });
        });

    </script>


    <section class="banner spad spad-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-6">
                    <div class="banner__item scroll-1">
                        <div class="banner__item__pic">
                            <img src="front/img/banner/banner-1.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>@if($locale == 'vi'){{ __('vi.Clothing Collections 2024') }}@else{{ __('en.Clothing Collections 2024') }}@endif</h2>
                            <a href="#">@if($locale == 'vi'){{ __('vi.Shop now') }}@else{{ __('en.Shop now') }}@endif</a>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="banner__item scroll-2 banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="front/img/banner/banner-2.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>@if($locale == 'vi'){{ __('vi.Accessories') }}@else{{ __('en.Accessories') }}@endif</h2>
                            <a href="#">@if($locale == 'vi'){{ __('vi.Shop now') }}@else{{ __('en.Shop now') }}@endif</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 offset-lg-6">
                    <div class="banner__item scroll-3 banner__item--last">
                        <div class="banner__item__pic">
                            <img src="front/img/banner/banner-3.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Shoes Spring 2024</h2>
                            <a href="#">@if($locale == 'vi'){{ __('vi.Shop now') }}@else{{ __('en.Shop now') }}@endif</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <script>
        // use a script tag or an external JS file
        document.addEventListener("DOMContentLoaded", (event) => {
            gsap.registerPlugin(ScrollTrigger)
            gsap.to(".scroll-product-1", {
                scrollTrigger:{
                    trigger: ".scroll-product-1",
                    toggleActions: "restart pause reverse pause",
                    start: "10px 80%",
                    end: "bottom 100px",
                }, // start animation when ".box" enters the viewport
                y: -100,
                duration:.5,
            });
        });

    </script>

    <section class="product spad scroll-product-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter=".best-sellers">@if($locale == 'vi'){{ __('vi.Best Sellers') }}@else{{ __('en.Best Sellers') }}@endif</li>
                        <li data-filter=".new-arrivals">@if($locale == 'vi'){{ __('vi.New Arrivals') }}@else{{ __('en.New Arrivals') }}@endif</li>
                        <li data-filter=".hot-sales">@if($locale == 'vi'){{ __('vi.Hot Sales') }}@else{{ __('en.Hot Sales') }}@endif</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
                @foreach($featuredProducts['0'] as $item)
                        <?php
                        $tags = ['new-arrivals', 'hot-sales','best-sellers'];

                        $randomTag = $tags[array_rand($tags)];
                        ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix {{$randomTag}}">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="front/img/product/{{$item->productImages[0]->path}}">

                            @if($randomTag == 'new-arrivals')
                                <span class="label">New</span>
                            @elseif($randomTag == 'hot-sales')
                                <span class="label">Hot Sale</span>
                            @elseif($randomTag == 'best-sellers')
                                <span class="label">Best Sale</span>
                            @endif

                            <ul class="product__hover">
                                <li><a href="javascript:addFav({{ $item->id }})"><img src="front/img/icon/heart.png" alt=""></a></li>
                                <li><a href="#"><img src="front/img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="front/img/icon/search.png" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$item->name}}</h6>
                            <a href="javascript:addCart({{$item->id}})" class="add-cart">+ @if($locale == 'vi'){{ __('vi.Add To Cart') }}@else{{ __('en.Add To Cart') }}@endif</a>
                            <a href="shop/product/{{$item->id}}" class="quick-view"><i class="fa fa-eye"></i>@if($locale == 'vi'){{ __('vi.Quick view') }}@else{{ __('en.Quick view') }}@endif</a>

                            <div class="rating">
                                @php
                                    $rating = $productRating->where('product_id', $item->id)->first();
                                @endphp

                                @if($rating)
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $rating->rating)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                @else
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                @endif

                            </div>
                            @if($item->discount != null)
                                <h5 class="">${{$item->discount}} <span class="related-discount-span">${{$item->price}}</span></h5>
                            @else
                                <h5>${{$item->price}} <span></span></h5>
                            @endif
                            <div class="product__color__select">
                                @foreach(array_unique(array_column($item->productDetails->toArray(), 'color')) as $productColor)
                                    @php
                                        // Chuyển đổi giá trị màu thành tên màu dựa trên cơ sở dữ liệu.
                                        $colorNumber = "";
                                        switch ($productColor) {
                                            case 'black':
                                                $colorNumber = 'black';
                                                $colorPicker = 1;
                                                break;
                                            case 'darkblue':
                                                $colorNumber = 'darkblue';
                                                $colorPicker = 2;
                                                break;
                                            case 'orange':
                                                $colorNumber = 'orange';
                                                $colorPicker = 3;
                                                break;
                                            case 'grey':
                                                $colorNumber = 'grey';
                                                $colorPicker = 4;
                                                break;
                                            case 'lightblack':
                                                $colorNumber = 'lightblack';
                                                $colorPicker = 5;
                                                break;
                                            case 'pink':
                                                $colorNumber = 'pink';
                                                $colorPicker = 6;
                                                break;
                                            case 'violet':
                                                $colorNumber = 'violet';
                                                $colorPicker = 7;
                                                break;
                                            case 'red':
                                                $colorNumber = 'red';
                                                $colorPicker = 8;
                                                break;
                                            case 'white':
                                                $colorNumber = 'white';
                                                $colorPicker = 9;
                                                break;

                                        }
                                    @endphp

                                    <label class="{{$colorNumber}}" for="pc-{{$colorPicker}}">
                                        <input type="radio" id="pc-{{$colorPicker}}">
                                    </label>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <script>
        // use a script tag or an external JS file
        document.addEventListener("DOMContentLoaded", (event) => {
            gsap.registerPlugin(ScrollTrigger)
            gsap.to(".scroll-categories-1", {
                scrollTrigger:{
                    trigger: ".scroll-categories-1",
                    toggleActions: "restart pause reverse pause",
                    start: "10px 200%",
                    end: "bottom 100px",
                }, // start animation when ".box" enters the viewport
                y: -200,

                duration:1,
            });
        });

    </script>

    <section class="categories spad scroll-categories-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2>Clothings Hot <br /> <span>Shoe Collection</span> <br /> Accessories</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="front/img/product-sale.png" alt="">
                        <div class="hot__deal__sticker">
                            <span>@if($locale == 'vi'){{ __('vi.Sale Of') }}@else{{ __('en.Sale Of') }}@endif</span>
                            <h5>$29.99</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>@if($locale == 'vi'){{ __('vi.Deal Of The Week') }}@else{{ __('en.Deal Of The Week') }}@endif</span>
                        <h2>Multi-pocket Chest Bag Black</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>@if($locale == 'vi'){{ __('vi.Days') }}@else{{ __('en.Days') }}@endif</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>@if($locale == 'vi'){{ __('vi.Hours') }}@else{{ __('en.Hours') }}@endif</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>@if($locale == 'vi'){{ __('vi.Minutes') }}@else{{ __('en.Minutes') }}@endif</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>@if($locale == 'vi'){{ __('vi.Seconds') }}@else{{ __('en.Seconds') }}@endif</p>
                            </div>
                        </div>
                        <a href="./shop" class="primary-btn">@if($locale == 'vi'){{ __('vi.Shop now') }}@else{{ __('en.Shop now') }}@endif</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section End -->

    <!-- Instagram Section Begin -->
    <script>
        // use a script tag or an external JS file
        document.addEventListener("DOMContentLoaded", (event) => {
            gsap.registerPlugin(ScrollTrigger)
            gsap.to(".scroll-instagram-1", {
                scrollTrigger:{
                    trigger: ".scroll-instagram-1",
                    toggleActions: "restart none none reset",
                    start: "10px 200%",
                    end: "bottom 100px",
                }, // start animation when ".box" enters the viewport
                x:303,


                duration:0.5,
            });
            gsap.to(".scroll-instagram-2", {
                scrollTrigger:{
                    trigger: ".scroll-instagram-2",
                    toggleActions: "restart none none reset",
                    start: "10px 200%",
                    end: "bottom 100px",
                }, // start animation when ".box" enters the viewport
                x:103,


                duration:0.5,
            });
        });

    </script>
    <section class="instagram spad">
        <div class="container instagram-spad">
            <div class="row">
                <div class="col-lg-8 scroll-instagram-1">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="front/img/instagram/instagram-1.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="front/img/instagram/instagram-2.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="front/img/instagram/instagram-3.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="front/img/instagram/instagram-4.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="front/img/instagram/instagram-5.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="front/img/instagram/instagram-6.jpg"></div>
                    </div>
                </div>
                <div class="col-lg-4 scroll-instagram-2">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>
                            @if($locale == 'vi'){{ __('vi.Join ShopRunner today and unlock a world of endless shopping possibilities.
                            Experience the convenience, savings, and joy of ShopRunner – because shopping
                            should be as enjoyable as finding the perfect item!') }}@else{{ __('en.Join ShopRunner today and unlock a world of endless shopping possibilities.
                            Experience the convenience, savings, and joy of ShopRunner – because shopping
                            should be as enjoyable as finding the perfect item!') }}@endif
                        </p>
                        <h3>#Shop_Runner</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Instagram Section End -->

    <!-- Latest Blog Section Begin -->
    <script>
        // use a script tag or an external JS file
        document.addEventListener("DOMContentLoaded", (event) => {
            gsap.registerPlugin(ScrollTrigger)
            gsap.to(".scroll-latest-1", {
                scrollTrigger:{
                    trigger: ".scroll-latest-1",
                    toggleActions: "restart none none reset",
                    start: "10px 200%",
                    end: "bottom 200px",

                }, // start animation when ".box" enters the viewport
                y: 150,

                duration:1,
            });
            gsap.to(".scroll-latest-2", {
                scrollTrigger:{
                    trigger: ".scroll-latest-2",
                    toggleActions: "restart none none reset",
                    start: "10px 200%",
                    end: "bottom 200px",

                }, // start animation when ".box" enters the viewport
                y: -150,

                duration:1,
            });
            gsap.to(".scroll-latest-3", {
                scrollTrigger:{
                    trigger: ".scroll-latest-3",
                    toggleActions: "restart none none reset",
                    start: "10px 200%",
                    end: "bottom 200px",

                }, // start animation when ".box" enters the viewport
                y: 150,

                duration:1,
            });
        });

    </script>
    <section class="latest spad">
        <div class="container-latest">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>@if($locale == 'vi'){{ __('vi.Latest News') }}@else{{ __('en.Latest News') }}@endif</span>
                        <h2>@if($locale == 'vi'){{ __('vi.Fashion New Trends') }}@else{{ __('en.Fashion New Trends') }}@endif</h2>
                    </div>
                </div>
            </div>
            <div class="latest-overflow force-overflow scrollbar" id="style-4">
                <div class="col-lg-3 col-md-5 col-sm-6 scroll-latest-1">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="front/img/blog/latest-3.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="front/img/icon/calendar.png" alt=""> @if($locale == 'vi'){{ __('vi.Challenge yourself') }}@else{{ __('en.Challenge yourself') }}@endif</span>
                            <h5>
                                @if($locale == 'vi'){{ __('vi.Find running inspiration with a new challenge.') }}@else{{ __('en.Find running inspiration with a new challenge.') }}@endif
                            </h5>
                            <a href="#">@if($locale == 'vi'){{ __('vi.Read More') }}@else{{ __('en.Read More') }}@endif</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-6 scroll-latest-2">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="front/img/blog/latest-4.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="front/img/icon/calendar.png" alt=""> SNKRS</span>
                            <h5>
                                @if($locale == 'vi'){{ __('vi.Your Ultimate sneaker community.') }}@else{{ __('en.Your Ultimate sneaker community.') }}@endif
                            </h5>
                            <a href="#">@if($locale == 'vi'){{ __('vi.Read More') }}@else{{ __('en.Read More') }}@endif</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-6 scroll-latest-3">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="front/img/blog/latest-5.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="front/img/icon/calendar.png" alt=""> @if($locale == 'vi'){{ __('vi.Member days') }}@else{{ __('en.Member days') }}@endif</span>
                            <h5>
                                @if($locale == 'vi'){{ __('vi.A celebration of You.') }}@else{{ __('en.A celebration of You.') }}@endif
                            </h5>
                            <a href="#">@if($locale == 'vi'){{ __('vi.Read More') }}@else{{ __('en.Read More') }}@endif</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-6 scroll-latest-2">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="front/img/blog/latest-1.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="front/img/icon/calendar.png" alt=""> @if($locale == 'vi'){{ __('vi.Race to win') }}@else{{ __('en.Race to win') }}@endif</span>
                            <h5>
                                @if($locale == 'vi'){{ __('vi.You’re looking to set new records, your own and the world’s.') }}@else{{ __('en.You’re looking to set new records, your own and the world’s.') }}@endif
                            </h5>
                            <a href="#">@if($locale == 'vi'){{ __('vi.Read More') }}@else{{ __('en.Read More') }}@endif</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="front/img/blog/latest-2.jpg"></div>
                        <div class="blog__item__text">
                            <span><img src="front/img/icon/calendar.png" alt=""> @if($locale == 'vi'){{ __('vi.Train with shop runner') }}@else{{ __('en.Train with shop runner') }}@endif</span>
                            <h5>
                                @if($locale == 'vi'){{ __('vi.Optimize your running with a plan adapted for your level.') }}@else{{ __('en.Optimize your running with a plan adapted for your level.') }}@endif
                            </h5>
                            <a href="#">@if($locale == 'vi'){{ __('vi.Read More') }}@else{{ __('en.Read More') }}@endif</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Blog Section End -->

@endsection
