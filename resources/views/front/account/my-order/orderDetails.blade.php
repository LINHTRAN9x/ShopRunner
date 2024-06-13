@extends("front.layout.master")
@section('title','Order Details')
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

                    <h2>#{{$orders->id}} ORDER</h2>
                    <div class="row justify-content-between">
                        <div class="col-lg-5">
                            <div class="row border-bottom pt-3">
                                <p class="col-6 ">Order no.</p>
                                <p class="col-6 font-weight-bold">{{$orders->id}}</p>
                            </div>
                            <div class="row border-bottom pt-3">
                                <p class="col-6">Order status</p>
                                <p class="col-6 text-warning font-weight-bold">{{\App\Utilities\Constant::$ORDER_STATUS[$orders->status]}}</p>
                            </div>
                            <div class="row border-bottom pt-3">
                                <p class="col-6">Shipping method</p>
                                <p class="col-6 font-weight-bold">{{$orders->shipping_method}}</p>
                            </div>
                            <div class="row border-bottom pt-3">
                                <p class="col-6">Order date</p>
                                <p class="col-6 font-weight-bold">{{$orders->created_at}}</p>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="row border-bottom pt-3">
                                <p class="col-6">Payment method</p>
                                <p class="col-6 font-weight-bold">{{$orders->payment_type}}</p>
                            </div>
                            <div class="row border-bottom pt-3">
                                <p class="col-6">Name</p>
                                <p class="col-6 font-weight-bold">{{$orders->first_name}}{{$orders->last_name}}</p>
                            </div>
                            <div class="row border-bottom pt-3">
                                <p class="col-6">Phone</p>
                                <p class="col-6 font-weight-bold">{{$orders->phone}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-4">
                            <h6 class="font-weight-bold">SELL-TO ADDRESS</h6>
                            <p class="text-info">Việt Nam <br> Mỹ Đình, Cầu Giấy, Hà Nội <br> Detech Building 8a Tôn Thất Thuyết</p>
                        </div>
                        <div class="col-lg-4">
                            <h6 class="font-weight-bold">SHIP-TO ADDRESS</h6>
                            <p class="text-info">{{$orders->country}} <br> {{$orders->town_city}} <br> {{$orders->street_address }}</p>

                        </div>

                        <div class="col-lg-4">3</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col"></div>
                        <form action="{{ route('reorder', ['id' => $orders->id]) }}" method="POST" class="row align-self-end">
                            @csrf
                            @if($orders->status == 1)
                                <a href="{{ route('order.cancel', $orders->id) }}" class="btn btn-outline-danger"
                                   onclick="return confirm('Are you sure you want to CANCEL this order?')">CANCEL</a>
                            @endif
                            <a href="{{ route('download.bill', ['orderId' => $orders->id]) }}">
                            <div class="button-dowbill" data-tooltip="Size: ~20Kb">
                                <div class="button-wrapper-dowbill">
                                    <div class="text-dowbill">DOWNLOAD ORDER</div>
                                    <span class="icon-dowbill">
                                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15V3m0 12l-4-4m4 4l4-4M2 17l.621 2.485A2 2 0 0 0 4.561 21h14.878a2 2 0 0 0 1.94-1.515L22 17"></path></svg>
                                    </span>
                                </div>
                            </div>
                            </a>
                            <button type="submit" class="btn-reorder font-weight-bold"> <span> REORDER </span></button>
                        </form>

                    </div>
                    <h6 class="font-weight-bold mt-3">ORDER PRODUCTS:</h6>
                    <div class="row mt-4">
                        <div class="col">
                            <div class="row border-bottom">
                                <p class="col-3">Title</p>
                                <p class="col-1 text-right">Price</p>
                                <p class="col-2 text-right">Quantity</p>
                                <p class="col-2 text-right">Size</p>
                                <p class="col-2 text-right">Color</p>
                                <p class="col-2 text-right">Total</p>
                            </div>
                            @foreach($orders->orderDetails as $item)
                            <div class="row border-bottom py-2 align-items-center">
                                <a href="shop/product/{{$item->product->id}}" class="col-3 text-dark font-weight-bold " data-toggle="tooltip" data-placement="left" title="View Details">{{$item->product->name}}</a>
                                <p class="col-1 text-right font-weight-bold">${{$item->product->discount ?? $item->product->price}}</p>
                                <p class="col-2 text-right font-weight-bold">{{$item->qty}}</p>
                                <p class="col-2 text-right font-weight-bold">{{$item->size}}</p>
                                <p class="col-2 text-right font-weight-bold product__cart__item__text ">
                                    <span class="c-{{ $item->color }} border border-dark"></span>
                                </p>
                                <p class="col-2 text-right font-weight-bold">${{$item->amount * $item->qty}}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row border-bottom pt-3">
                                <div class="col"></div>
                                <div class="row align-items-end">
                                    <p class="col">Subtotal</p>
                                    <p class="col font-weight-bold" >${{ $subTotal }}</p>
                                </div>
                            </div>
                            <div class="row border-bottom pt-3">
                                <div class="col"></div>
                                <div class="row align-items-end">
                                    <p class="col">Shipping</p>
                                    <p class="col font-weight-bold" >${{$shipping}}</p>
                                </div>
                            </div>
                            <div class="row border-bottom pt-3">
                                <div class="col"></div>
                                <div class="row align-items-end">
                                    <p class="col">Coupon</p>
                                    <p class="col font-weight-bold" >@if($orders->orderDetails->first()->coupon == null)
                                            0
                                        @else
                                            {{ '-'.$orders->orderDetails->first()->coupon.'%'}}
                                        @endif</p>
                                </div>
                            </div>
                            <div class="row border-bottom pt-3">
                                <div class="col"></div>
                                <div class="row align-items-end">
                                    <p class="col font-weight-bold h5">Total</p>
                                    <p class="col font-weight-bold h5" >${{ $orders->orderDetails->first()->total}}</p>
                                </div>
                            </div>
                        </div>

                    </div>

            </div>
        </div>
    </section>
    <!-- Checkout Section End -->




@endsection


