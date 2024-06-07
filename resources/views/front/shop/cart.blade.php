@extends('front.layout.master')
@section('title','Cart')
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
                        <a href="./shop">Shop</a>
                        <span>Shopping Cart</span>
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
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        @if($carts->isEmpty())
                            <h3 class="text-muted p-2">Cart Empty...</h3>
                        @else
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $cart)
                                <tr data-rowid="{{ $cart->rowId }}">
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
{{--                                            <a title="Xem chi tiết sản phẩm {{$cart->name}}" href="shop/product/{{$cart->id}}">--}}
                                                <a title="Edit this product" href="#" data-toggle="modal" data-target="#cart-quickview" value="cart-quickview" class="cart-quickview" data-id_product="{{$cart->id}}">
                                                    <img src="front/img/product/{{ $cart->options->images[0]->path }}" width="100" alt="">
                                                </a>

{{--                                            </a>--}}
                                        </div>
                                        <div class="product__cart__item__text">
                                            <a title="Edit this product" href="#" data-toggle="modal" data-target="#cart-quickview" value="cart-quickview" class="cart-quickview" data-id_product="{{$cart->id}}">
                                            <h6>{{ $cart->name }}</h6>
                                            <h5>${{ number_format($cart->price, 2) }}</h5>
                                            <h6 class="cart-h6">{{$cart->options->size}} -
                                                <span class="c-{{ $cart->options->color }} border border-dark">

                                                </span>
                                            </h6>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{ $cart->qty }}" data-rowid="{{ $cart->rowId }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">$ {{ number_format($cart->price * $cart->qty, 2) }}</td>
                                    <td class="cart__close">
                                        <i onclick="removeCart('{{ $cart->rowId }}')" class="fa fa-close"></i>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

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
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <form action="{{url('checkout/check_coupon')}}" method="POST">
                        @csrf
                        <input type="text" name="coupon"  placeholder="Coupon code">
                        <button type="submit" name="check_coupon">Apply</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li >Subtotal <span class="cart__subTotal">$ {{$subTotal}}</span></li>
                        <li>Total <span class="cart__Total">$ {{$total}}</span></li>
                    </ul>
                    <a href="./checkout" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

<!-- Modal -->
<form action="{{url('/cart-quickview')}}" method="POST">
    @csrf
    <div class="modal cart-modal fade" id="cart-quickview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-rowid="">
        <div class="modal-dialog">
            <div class="modal-content-product-cart">
                <div class="modal-header modal-header-cart">
                    <a style="--clr: #4C7F78" class="detail-button" href="shop/product/">
                        <span class="button__icon-wrapper">
                            <svg width="10" class="button__icon-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 15">
                                <path fill="currentColor" d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"></path>
                            </svg>

                            <svg class="button__icon-svg  button__icon-svg--copy" xmlns="http://www.w3.org/2000/svg" width="10" fill="none" viewBox="0 0 14 15">
                                <path fill="currentColor" d="M13.376 11.552l-.264-10.44-10.44-.24.024 2.28 6.96-.048L.2 12.56l1.488 1.488 9.432-9.432-.048 6.912 2.304.024z"></path>
                            </svg>
                        </span>
                        <div class="modal-title" style="--clr: #7808d0">  </div>
                    </a>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="icon_close font-weight-bold" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body-product d-flex p-2">
                    ...
                </div>
            </div>
        </div>
    </div>
</form>


@endsection


