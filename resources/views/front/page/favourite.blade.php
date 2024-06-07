@extends('front.layout.master')
@section('title','My Favourite')
@section("body")


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>My Favourite</h4>
                        <div class="breadcrumb__links">
                            <a href="./">Home</a>

                            <span>My Favourite</span>
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
                                <th>ID</th>
                                <th></th>

                                <th>PRODUCTS</th>
                                <th>Price</th>
                                <th>DETAILS</th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach($favourites as $item)
                                <tr class="my_order_tbody">
                                    <td class="my_order_id">
                                        #{{$item->id}}
                                    </td>
                                    <td class="">
                                        <div class="product__cart__item__pic">
                                            <img src="{{ asset('front/img/product/' . $item->product->productImages[0]->path) }}" width="100" height="100" alt="" style="object-fit: cover">

                                        </div>

                                    </td>

                                    <td class="my_order_products">
                                        {{$item->product->name}}

                                    </td>


                                    <td class="cart__price">
                                        ${{$item->product->price}}

                                    </td>
                                    <td>
                                        <a href="./shop/product/{{$item->product->id}}">
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
                                    <td class="cart__close">
                                        <a href="./favourite/remove/{{$item->product->id}}"  ><i class="fa fa-close"></i></a>
                                    </td>
                                </tr>
                            @endforeach


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
                                <div class="delete-all" onclick="(function() {
                                    var cart_tbody = document.querySelector('.shopping__cart__table tbody');
                                    var cartItemCount = cart_tbody.children.length;


                                    if (cartItemCount > 0) {
                                        if (confirm('Are you sure to delete all favourites?')) {
                                            clearFav();
                                        }
                                    } else {
                                        alert('The cart is nothing to remove !');
                                    }
                                })();">
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

