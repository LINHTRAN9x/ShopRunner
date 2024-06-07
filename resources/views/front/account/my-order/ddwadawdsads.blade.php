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
                        <h4>Order Details</h4>
                        <div class="breadcrumb__links">
                            <a href="./ ">Home</a>
                            <a href="./account/my-order">My Order</a>
                            <span>Order Details</span>
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
                        <input type="hidden" id="user_id" name="user_id" value="{}">
                        <div class="col-lg-8 col-md-6" style="background: #f3f2ee;padding: 20px">
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input value="{{$orders->first_name}}" type="text" name="first_name">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input value="{{$orders->last_name}}" type="text" name="last_name">

                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input value="{{$orders->country}}" type="text" name="country">

                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input value="{{$orders->street_address }}" type="text" placeholder="Street Address" class="checkout__input__add" name="street_address">

                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input value="{{$orders->town_city}}" type="text" name="town_city">

                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input value="{{$orders->postcode_zip}}" type="text" name="postcode_zip">

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input value="{{$orders->phone}}" type="text" name="phone">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input value="{{$orders->email}}" type="text" name="email">

                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="free_ship">
                                    Free Shipping (slow delivery)
                                    <input disabled name="shipping_method"  value="free" type="radio" id="free_ship" {{$orders->shipping_method == 'free' ? 'checked' : ''}}>
                                    <span class="checkmark"></span>

                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="standard">
                                    Standard (+10$) (medium delivery)
                                    <input disabled name="shipping_method"  value="standard" type="radio" id="standard" {{$orders->shipping_method == 'standard' ? 'checked' : ''}}>
                                    <span class="checkmark"></span>

                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="express">
                                    Express (+20$) (fast delivery)
                                    <input disabled name="shipping_method"  value="express" type="radio" id="express" {{$orders->shipping_method == 'express' ? 'checked' : ''}}>
                                    <span class="checkmark"></span>

                                </label>
                            </div>
                            <div class="text-primary">
                                {{\App\Utilities\Constant::$ORDER_STATUS[$orders->status]}}
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                <ul class="checkout__total__products">
                                    @foreach($orders->orderDetails as $item)
                                        <li>{{ $loop->iteration }}.{{$item->product->name}} x {{$item->qty}} <span>$ {{$item->amount}}</span></li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>$ {{ $subTotal }}</span></li>
                                    <li>Shipping <span class="shipping-cost">
                                            ${{$shipping}}</span></li>
                                    </span></li>
                                    <li>Coupon <span>

                                            @if($orders->orderDetails->first()->coupon == null)
                                                0
                                            @else
                                                {{ '-'.$orders->orderDetails->first()->coupon.'%'}}
                                            @endif
                                        </span></li>
                                    <li>Total <span>
{{--                                            @if($orders->shipping_method == 'standard')--}}
                                            {{--                                                $ {{ array_sum(array_column($orders->orderDetails->toArray(),'total')) + 10}}--}}
                                            {{--                                            @elseif($orders->shipping_method == 'express')--}}
                                            {{--                                                $ {{ array_sum(array_column($orders->orderDetails->toArray(),'total')) + 20}}--}}
                                            {{--                                            @else--}}
                                            {{--                                                $ {{ array_sum(array_column($orders->orderDetails->toArray(),'total'))}}--}}
                                            {{--                                            @endif--}}
                                            $ {{ $orders->orderDetails->first()->total}}
                                        </span></li>
                                </ul>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        COD
                                        <input disabled type="radio" id="payment" name="payment_type" value="COD" {{$orders->payment_type == 'COD' ? 'checked' : ''}} >
                                        <span class="checkmark"></span>

                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input disabled type="radio" id="paypal" name="payment_type" value="Paypal" {{$orders->payment_type == 'Paypal' ? 'checked' : ''}}>
                                        <span class="checkmark"></span>

                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="vnpay">
                                        VNPAY
                                        <input disabled type="radio" id="vnpay" name="payment_type" value="vnpay" {{$orders->payment_type == 'vnpay' ? 'checked' : ''}}>
                                        <span class="checkmark"></span>
                                        @error("payment_type")
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->




@endsection



