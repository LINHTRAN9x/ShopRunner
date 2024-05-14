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
                                            <a title="Xem chi tiết sản phẩm {{$cart->name}}" href="shop/product/{{$cart->id}}"><img src="front/img/product/{{ $cart->options->images[0]->path }}" width="100" alt=""></a>
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{ $cart->name }}</h6>
                                            <h5>${{ number_format($cart->price, 2) }}</h5>
                                            <h6>{{$cart->options->size}} -
                                                <span class="c-{{ $cart->options->color }}">

                                                </span>
                                            </h6>
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
                    <form action="{{url('cart/check_coupon')}}" method="POST">
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



@endsection
