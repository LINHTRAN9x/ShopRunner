@extends('front.layout.master')
@section('title','My Order')
@section("body")


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>My Orders</h4>
                    <div class="breadcrumb__links">
                        <a href="./">Home</a>

                        <span>My Order</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <h3 class="font-weight-bold mb-2">ORDER HISTORY</h3>
        <form action="{{ url('account/my-order/orders/search') }}" method="GET">
            <div class="row mb-5 justify-content-between align-items-center">
                <div class="col-5 ml-2">
                    <div class="row align-items-center">
                        <h5 class="col font-weight-bolder">Order no.</h5>
                        <div class="messageBox">
                            <input name="order-history-search" placeholder="Order id..." type="text" id="messageInput" value="{{ request('order-history-search') }}" />
                            <button type="submit" id="sendButton">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 664 663">
                                    <path fill="none" d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888"></path>
                                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="33.67" stroke="#6c6c6c" d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-5 mr-5">
                    <div class="row mb-4">
                        <h5 class="col font-weight-bold">From:</h5>
                        <input name="from-date" class="order-date" type="date" value="{{ request('from-date') }}">
                    </div>
                    <div class="row">
                        <h5 class="col font-weight-bold">To:</h5>
                        <input name="to-date" class="order-date" type="date" value="{{ request('to-date') }}">
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="row align-self-end">
                        <div class="col"></div>
                        <a class="row" href="{{ url('account/my-order') }}" title="Reset">
                            <button type="button" class="button-reset">
                                <svg class="svg-icon" fill="none" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><g stroke="#ff342b" stroke-linecap="round" stroke-width="1.5"><path d="m3.33337 10.8333c0 3.6819 2.98477 6.6667 6.66663 6.6667 3.682 0 6.6667-2.9848 6.6667-6.6667 0-3.68188-2.9847-6.66664-6.6667-6.66664-1.29938 0-2.51191.37174-3.5371 1.01468"></path><path d="m7.69867 1.58163-1.44987 3.28435c-.18587.42104.00478.91303.42582 1.0989l3.28438 1.44986"></path></g></svg>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <button type="submit" class="Btn">
                        <span class="text">Search</span>
                        <span class="svgIcon">
                    <i class="fa fa-angle-right"></i>
                </span>
                    </button>
                </div>
            </div>
            <!-- Add hidden inputs for sorting if necessary -->
            <input type="hidden" name="sort_by" value="{{ request('sort_by', 'id') }}">
            <input type="hidden" name="sort_direction" value="{{ request('sort_direction', 'desc') }}">
        </form>

        <div class="row">
            <h4 class="mb-4">RECENT ORDERS</h4>
            <div class="col-lg-12">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                        <tr class="my_order_thead">
                            <th></th>
                            <th onclick="sortTable('id')">ID</th>
                            <th>ORDER DATE</th>
                            <th>PRODUCTS</th>
                            <th>ORDER STATUS</th>
                            <th>TOTAL</th>
                            <th>DETAILS</th>
                        </tr>
                        </thead>
                        <tbody >
                            @foreach($orders as $order)
                                <tr class="my_order_tbody" data-rowid="">
                                    <td class="">
{{--                                        <div class="product__cart__item__pic">--}}
{{--                                            <img src="front/img/product/{{$order->orderDetails[0]->product->productImages[0]->path}}" width="100" alt="">--}}
{{--                                        </div>--}}

                                    </td>
                                    <td class="my_order_id">
                                        #{{$order->id}}
                                    </td>
                                    <td class="my_order_id">
                                        {{$order->created_at}}
                                    </td>
                                    <td class="my_order_products">
                                        {{$order->orderDetails[0]->product->name}}
                                        @if(count($order->orderDetails) > 1)
                                            and ({{count($order->orderDetails)}}) other products
                                        @endif

                                    </td>
                                    <td>
                                        @php
                                            $orderStatus = [
                                                App\Utilities\Constant::ORDER_STATUS_RECEIVEORDERS => 'Receive Orders',

                                                App\Utilities\Constant::ORDER_STATUS_CONFIRMED => 'Confirmed',


                                                App\Utilities\Constant::ORDER_STATUS_SHIPPING => 'Shipping',
                                                App\Utilities\Constant::ORDER_STATUS_FINISH => 'Finish',
                                                App\Utilities\Constant::ORDER_STATUS_CANCEL => 'Cancel',
                                            ];
                                        @endphp

                                        @foreach($orderStatus as $status => $label)
                                            @if($order->status == $status)
                                                {{ $label }}
                                            @endif
                                        @endforeach

                                    </td>

                                    <td class="cart__price">
{{--                                        @if($order->shipping_method == 'standard')--}}
{{--                                            $ {{ array_sum(array_column($order->orderDetails->toArray(),'total')) + 10}}--}}
{{--                                        @elseif($order->shipping_method == 'express')--}}
{{--                                            $ {{ array_sum(array_column($order->orderDetails->toArray(),'total')) + 20}}--}}
{{--                                        @else--}}
{{--                                            $ {{ array_sum(array_column($order->orderDetails->toArray(),'total'))}}--}}
{{--                                        @endif--}}
                                        $ {{ $order->orderDetails->first()->total}}

                                    </td>
                                    <td>
                                        <a href="./account/my-order/{{$order->id}}">
                                            <button class="my-order-button">
                                                See Now
                                                <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                                                    <path
                                                        clip-rule="evenodd"
                                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                                                        fill-rule="evenodd"
                                                    ></path>
                                                </svg>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
{{--                        @endif--}}

                        </tbody>
                    </table>
                    <div class="row mt-5">
                        <div class="col-lg-12">

                            {!! $orders->links("pagination::bootstrap-4") !!}

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="./shop">Continue Shopping</a>
                        </div>
                    </div>
{{--                    <div class="col-lg-6 col-md-6 col-sm-6">--}}
{{--                        <div class="continue__btn update__btn">--}}
{{--                            <div class="delete-all" onclick="--}}
{{--                                (function() {--}}
{{--                                    // Lấy số lượng sản phẩm trong giỏ hàng--}}
{{--                                    var cart_tbody = document.querySelector('.shopping__cart__table tbody');--}}
{{--                                    var cartItemCount = cart_tbody.children.length; // Số lượng hàng trong bảng giỏ hàng--}}

{{--                                    // Kiểm tra nếu giỏ hàng không trống--}}
{{--                                    if (cartItemCount > 0) {--}}
{{--                                        // Hiển thị hộp thoại xác nhận--}}
{{--                                        if (confirm('Are you sure to delete all carts?')) {--}}
{{--                                            // Gọi hàm xóa toàn bộ giỏ hàng nếu người dùng xác nhận--}}
{{--                                            destroyCart();--}}
{{--                                        }--}}
{{--                                    } else {--}}
{{--                                        // Giỏ hàng trống, thông báo cho người dùng--}}
{{--                                        alert('The cart is nothing to remove !');--}}
{{--                                    }--}}
{{--                                })();--}}
{{--                            ">--}}
{{--                                <i class="fa fa-close"></i> Remove all</div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->



@endsection
