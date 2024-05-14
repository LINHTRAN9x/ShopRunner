@extends('front.layout.master')
@section('title','My Order')
@section("body")


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
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
        <div class="row">
            <div class="col-lg-12">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                        <tr class="my_order_thead">
                            <th></th>
                            <th>ID</th>
                            <th>PRODUCTS</th>
                            <th>SHIPPING</th>
                            <th>TOTAL</th>
                            <th>DETAILS</th>
                        </tr>
                        </thead>
                        <tbody >
                            @foreach($orders as $order)
                                <tr class="my_order_tbody" data-rowid="">
                                    <td class="">
                                        <div class="product__cart__item__pic">
                                            <img src="front/img/product/{{$order->orderDetails[0]->product->productImages[0]->path}}" width="100" alt="">
                                        </div>

                                    </td>
                                    <td class="my_order_id">
                                        #{{$order->id}}
                                    </td>
                                    <td class="my_order_products">
                                        {{$order->orderDetails[0]->product->name}}
                                        @if(count($order->orderDetails) > 1)
                                            and ({{count($order->orderDetails)}}) other products
                                        @endif

                                    </td>
                                    <td>{{$order->shipping_method}}</td>

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
                                        <a href="./account/my-order/{{$order->id}}">More...</a>
                                    </td>
                                </tr>
                            @endforeach
{{--                        @endif--}}

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="./shop">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <div class="delete-all" onclick="
                                (function() {
                                    // Lấy số lượng sản phẩm trong giỏ hàng
                                    var cart_tbody = document.querySelector('.shopping__cart__table tbody');
                                    var cartItemCount = cart_tbody.children.length; // Số lượng hàng trong bảng giỏ hàng

                                    // Kiểm tra nếu giỏ hàng không trống
                                    if (cartItemCount > 0) {
                                        // Hiển thị hộp thoại xác nhận
                                        if (confirm('Are you sure to delete all carts?')) {
                                            // Gọi hàm xóa toàn bộ giỏ hàng nếu người dùng xác nhận
                                            destroyCart();
                                        }
                                    } else {
                                        // Giỏ hàng trống, thông báo cho người dùng
                                        alert('The cart is nothing to remove !');
                                    }
                                })();
                            ">
                                <i class="fa fa-close"></i> Remove all</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->



@endsection
