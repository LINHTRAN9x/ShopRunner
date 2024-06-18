@extends("front.layout.master")
@section('title','Checkout')
@section('body')
<body>


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="./ ">Home</a>
                        <a href="./shop">Shop</a>
                        <a href="./cart">Shopping Cart</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">

            <form action="" method="post">
                @csrf
                <div class="row">
                    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id ?? ''}}">
                    <div class="col-lg-8 col-md-6">

                        <h6 class="checkout__title">Billing Details</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Fist Name<span>*</span></p>
                                    <input value="{{old('first_name')}}{{Auth::user()->name ?? ''}}" type="text" name="first_name">
                                    @error("first_name")
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Last Name<span>*</span></p>
                                    <input value="{{old('last_name')}}" type="text" name="last_name">
                                    @error("last_name")
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Country<span>*</span></p>
                            <input value="{{old('country')}} {{Auth::user()->country ?? ''}}" type="text" name="country">
                            @error("country")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input value="{{old('street_address')}} {{Auth::user()->street_address ?? ''}}" type="text" placeholder="Street Address" class="checkout__input__add" name="street_address">
                            @error("street_address")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="checkout__input">
                            <p>Town/City<span>*</span></p>
                            <input value="{{old('town_city')}} {{Auth::user()->town_city ?? ''}}" type="text" name="town_city">
                            @error("town_city")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="checkout__input">
                            <p>Postcode / ZIP<span>*</span></p>
                            <input value="{{old('postcode_zip')}} {{Auth::user()->postcode_zip ?? ''}}" type="text" name="postcode_zip">
                            @error("postcode_zip")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input value="{{old('phone')}} {{Auth::user()->phone ?? ''}}" type="text" name="phone">
                                    @error("phone")
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input value="{{old('email')}} {{Auth::user()->email ?? ''}}" type="text" name="email">
                                    @error("email")
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Order notes<span></span></p>
                            <input type="text"
                                   placeholder="Notes about your order, e.g. special notes for delivery." name="note">
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="free_ship">
                                Free Shipping <i class="fa fa-truck"></i> [{{  \Carbon\Carbon::now()->addDay(4)->format('d-m-Y')  }}]
                                <input class="shipping_method" name="shipping_method"  value="free" type="radio" id="free_ship">
                                <span class="checkmark"></span>
                                @error("shipping_method")
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </label>
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="standard">
                                Standard (+10$) <i class="fa fa-truck"></i> [{{  \Carbon\Carbon::now()->addDay(2)->format('d-m-Y')  }}]
                                <input class="shipping_method" name="shipping_method"  value="standard" type="radio" id="standard">
                                <span class="checkmark"></span>
                                @error("shipping_method")
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </label>
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="express">
                                Express (+20$) <i class="fa fa-truck"></i> [{{  \Carbon\Carbon::now()->addDay(1)->format('d-m-Y')  }}]
                                <input class="shipping_method" name="shipping_method"  value="express" type="radio" id="express">
                                <span class="checkmark"></span>
                                @error("shipping_method")
                                <p class="text-danger">{{$message}}</p>
                                @enderror
                            </label>
                        </div>
                    </div>

            </form>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <div class="cart__discount1">
                                <div class="form-discount">
                                    <form action="{{url('checkout/check_coupon')}}" method="POST">
                                        @csrf
                                        <input type="text" name="coupon"  placeholder="Coupon code">
                                        <button class="btn-discount" type="submit" name="check_coupon">Apply</button>
                                    </form>
                                </div>

                            </div>
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product <span>Total</span></div>
                            <ul class="checkout__total__products">
                                @foreach($carts as $cart)
                                <li>{{ $loop->iteration }}.{{$cart->name}} x {{$cart->qty}} <span>$ {{$cart->price * $cart->qty}}</span></li>
                                @endforeach
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Subtotal <span>${{$subTotal}}</span></li>
                                <li>Shipping <span class="shipping-cost">$0</span></li>
                                <li>Coupon
                                    <span>
                                        @if(\Illuminate\Support\Facades\Session::get('coupon'))
                                            @foreach(\Illuminate\Support\Facades\Session::get('coupon') as $key => $cou)
                                                @if($cou['coupon_condition'] == 1)
                                                    <div>
                                                        -{{$cou['coupon_number']}}%
                                                        <a href="{{url('checkout/delete_coupon')}}" class="icon_close text-dark border font-weight-bold" title="Delete"></a>
                                                    </div>
                                                    @php
                                                    $total_coupon = ($total*$cou['coupon_number']) / 100;
                                                     @endphp
                                                @elseif($cou['coupon_condition'] == 2)
                                                    <div>
                                                        -{{$cou['coupon_number']}}$
                                                        <a href="{{url('checkout/delete_coupon')}}" class="icon_close text-dark border font-weight-bold" title="Delete"></a>
                                                    </div>
                                                    @php
                                                        $total_coupon = $cou['coupon_number'];
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @else
                                            0
                                        @endif
                                    </span>
                                </li>
                                <li>Total <span class="shipping-cost-total">
                                        @if(\Illuminate\Support\Facades\Session::get('coupon'))
                                            ${{$total - $total_coupon}}
                                        @else
                                            ${{$total}}
                                        @endif

                                    </span></li>
                            </ul>
                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    COD
                                    <input type="radio" id="payment" name="payment_type" value="COD" checked>
                                    <span class="checkmark"></span>
                                    @error("payment_type")
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Paypal
                                    <input type="radio" id="paypal" name="payment_type" value="Paypal">
                                    <span class="checkmark"></span>
                                    @error("payment_type")
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="vnpay">
                                    VNPAY
                                    <input type="radio" id="vnpay" name="payment_type" value="vnpay">
                                    <span class="checkmark"></span>
                                    @error("payment_type")
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="momo">
                                    MOMO
                                    <input type="radio" id="momo" name="payment_type" value="momo">
                                    <span class="checkmark"></span>
                                    @error("payment_type")
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </label>
                            </div>
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>


        </div>
    </div>
</section>
<!-- Checkout Section End -->




@endsection

