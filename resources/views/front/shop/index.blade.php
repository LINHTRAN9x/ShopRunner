@extends('front.layout.master')
@section('title','Shop')
@section('body')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="./">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">

            <div class="col-lg-3">

                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form action="shop">
                            <input name="search" value="{{ request('search') }}" type="text" id="search-input" placeholder="Search here.....">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>

                    </div>
                    <form action="shop">
                        @csrf
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories" >
                                            <ul class="nice-scroll">
                                                @foreach($categories as $category)
                                                <li><a href="/shop/category/{{ $category->name }}">{{ $category->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                </div>
                                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            @foreach($brands as $brand)
                                                <label for="bc-{{$brand->id}}">
                                                    {{$brand->name}}
                                                    <input type="checkbox" {{ (request('brand')[$brand->id] ?? '') == 'on' ? 'checked' : ''}}
                                                                id="bc-{{$brand->id}}" name="brand[{{$brand->id}}]"
                                                                onchange="this.form.submit();">
                                                    <span class="checkmark"></span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="{{ request()->fullUrlWithQuery(['price_min' => 0, 'price_max' => 50]) }}">$0.00 - $50.00</a></li>
                                                <li><a href="{{ request()->fullUrlWithQuery(['price_min' => 50, 'price_max' => 100]) }}">$50.00 - $100.00</a></li>
                                                <li><a href="{{ request()->fullUrlWithQuery(['price_min' => 100, 'price_max' => 150]) }}">$100.00 - $150.00</a></li>
                                                <li><a href="{{ request()->fullUrlWithQuery(['price_min' => 150, 'price_max' => 200]) }}">$150.00 - $200.00</a></li>
                                                <li><a href="{{ request()->fullUrlWithQuery(['price_min' => 200, 'price_max' => 250]) }}">$200.00 - $250.00</a></li>
                                                <li><a href="{{ request()->fullUrlWithQuery(['price_min' => 250]) }}">$250.00+</a></li>
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                </div>
                                <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__size">
                                            <label for="xs" class="{{ request('size') == 'xs' ? 'active' : '' }}">xs
                                                <input type="radio" id="xs" name="size" value="xs" onchange="this.form.submit();"
                                                    {{ request('size') == 'xs' ? 'checked' : ''}}>
                                            </label>
                                            <label for="sm" class="{{ request('size') == 's' ? 'active' : '' }}">s
                                                <input type="radio" id="sm" name="size" value="s" onchange="this.form.submit();"
                                                    {{ request('size') == 's' ? 'checked' : ''}}>
                                            </label>
                                            <label for="md" class="{{ request('size') == 'm' ? 'active' : '' }}">m
                                                <input type="radio" id="md" name="size" value="m" onchange="this.form.submit();"
                                                    {{ request('size') == 'm' ? 'checked' : ''}}>
                                            </label>
                                            <label for="xl" class="{{ request('size') == 'xl' ? 'active' : '' }}">xl
                                                <input type="radio" id="xl" name="size" value="xl" onchange="this.form.submit();"
                                                    {{ request('size') == 'xl' ? 'checked' : ''}}>
                                            </label>
                                            <label for="2xl" class="{{ request('size') == '2xl' ? 'active' : '' }}">2xl
                                                <input type="radio" id="2xl" name="size" value="2xl" onchange="this.form.submit();"
                                                    {{ request('size') == '2xl' ? 'checked' : ''}}>
                                            </label>
                                            <label for="xxl" class="{{ request('size') == 'xxl' ? 'active' : '' }}">xxl
                                                <input type="radio" id="xxl" name="size" value="xxl" onchange="this.form.submit();"
                                                    {{ request('size') == 'xxl' ? 'checked' : ''}}>
                                            </label>
                                            <label for="3xl" class="{{ request('size') == '3xl' ? 'active' : '' }}">3xl
                                                <input type="radio" id="3xl" name="size" value="3xl" onchange="this.form.submit();"
                                                    {{ request('size') == '3xl' ? 'checked' : ''}}>
                                            </label>
                                            <label for="4xl" class="{{ request('size') == '4xl' ? 'active' : '' }}">4xl
                                                <input type="radio" id="4xl" name="size" value="4xl" onchange="this.form.submit();"
                                                    {{ request('size') == '4xl' ? 'checked' : ''}}>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                </div>
                                <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__color">
                                            <label class="c-1 {{ request('color') == 'black' ? 'border border-danger' : '' }}" for="sp-1"  >
                                                <input type="radio" id="sp-1" name="color" value="black" onchange="this.form.submit();"
                                                    {{request('color') == 'black' ? 'checked' : ''}}>
                                            </label>
                                            <label class="c-2 {{ request('color') == 'darkblue' ? 'border border-danger' : '' }}" for="sp-2" >
                                                <input type="radio" id="sp-2" name="color" value="darkblue" onchange="this.form.submit();"
                                                    {{request('color') == 'darkblue' ? 'checked' : ''}}>
                                            </label>
                                            <label class="c-3 {{ request('color') == 'orange' ? 'border border-danger' : '' }}" for="sp-3" >
                                                <input type="radio" id="sp-3" name="color" value="orange" onchange="this.form.submit();"
                                                    {{request('color') == 'orange' ? 'checked' : ''}}>
                                            </label>
                                            <label class="c-4 {{ request('color') == 'grey' ? 'border border-danger' : '' }}" for="sp-4" >
                                                <input type="radio" id="sp-4" name="color" value="grey" onchange="this.form.submit();"
                                                    {{request('color') == 'grey' ? 'checked' : ''}}>
                                            </label>
                                            <label class="c-5 {{ request('color') == 'lightblack' ? 'border border-danger' : '' }}" for="sp-5" >
                                                <input type="radio" id="sp-5" name="color" value="lightblack" onchange="this.form.submit();"
                                                    {{request('color') == 'lightblack' ? 'checked' : ''}}>
                                            </label>
                                            <label class="c-6 {{ request('color') == 'pink' ? 'border border-danger' : '' }}" for="sp-6" >
                                                <input type="radio" id="sp-6" name="color" value="pink" onchange="this.form.submit();"
                                                    {{request('color') == 'pink' ? 'checked' : ''}}>
                                            </label>
                                            <label class="c-7 {{ request('color') == 'violet' ? 'border border-danger' : '' }}" for="sp-7" >
                                                <input type="radio" id="sp-7" name="color" value="violet" onchange="this.form.submit();"
                                                    {{request('color') == 'violet' ? 'checked' : ''}}>
                                            </label>
                                            <label class="c-8 {{ request('color') == 'red' ? 'border border-dark' : '' }}" for="sp-8" >
                                                <input type="radio" id="sp-8" name="color" value="red" onchange="this.form.submit();"
                                                    {{request('color') == 'red' ? 'checked' : ''}}>
                                            </label>
                                            <label class="c-9 {{ request('color') == 'white' ? 'border border-danger' : '' }}" for="sp-9" >
                                                <input type="radio" id="sp-9" name="color" value="white" onchange="this.form.submit();"
                                                    {{request('color') == 'white' ? 'checked' : ''}}>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                </div>
                                <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__tags">
                                            <label for="pp-9" class="c-1 {{ request('tag') == 'clothing' ? 'tag-background' : '' }}">Clothing<input style="display: none" type="checkbox" id="pp-9" name="tag" value="clothing" onchange="this.form.submit();" {{ request('tag') == 'clothing' ? 'checked' : ''}}></label>
                                            <label for="pp-8" class="c-1 {{ request('tag') == 'accessories' ? 'tag-background' : '' }}">Accessories<input style="display: none" type="checkbox" id="pp-8" name="tag" value="accessories" onchange="this.form.submit();" {{ request('tag') == 'accessories' ? 'checked' : ''}}></label>
                                            <label for="pp-7" class="c-1 {{ request('tag') == 'Shoes' ? 'tag-background' : '' }}">Shoes<input style="display: none" type="checkbox" id="pp-7" name="tag" value="Shoes" onchange="this.form.submit();" {{ request('tag') == 'Shoes' ? 'checked' : ''}}></label>
                                            <label for="pp-6" class="c-1 {{ request('tag') == 'handbag' ? 'tag-background' : '' }}">HandBag<input style="display: none" type="checkbox" id="pp-6" name="tag" value="handbag" onchange="this.form.submit();" {{ request('tag') == 'handBag' ? 'checked' : ''}}></label>
                                            <label for="pp-5" class="c-1 {{ request('tag') == 'Pant' ? 'tag-background' : '' }}">Pant<input style="display: none" type="checkbox" id="pp-5" name="tag" value="Pant" onchange="this.form.submit();" {{ request('tag') == 'Pant' ? 'checked' : ''}}></label>
                                            <label for="pp-4" class="c-1 {{ request('tag') == 'Shirt' ? 'tag-background' : '' }}">Shirt<input style="display: none" type="checkbox" id="pp-4" name="tag" value="Shirt" onchange="this.form.submit();" {{ request('tag') == 'Shirt' ? 'checked' : ''}}></label>
                                            <label for="pp-3" class="c-1 {{ request('tag') == 'Hat' ? 'tag-background' : '' }}">Hat<input style="display: none" type="checkbox" id="pp-3" name="tag" value="Hat" onchange="this.form.submit();" {{ request('tag') == 'Hat' ? 'checked' : ''}}></label>
                                            <label for="pp-2" class="c-1 {{ request('tag') == 'Calf' ? 'tag-background' : '' }}">Calf<input style="display: none" type="checkbox" id="pp-2" name="tag" value="Calf" onchange="this.form.submit();" {{ request('tag') == 'Calf' ? 'checked' : ''}}></label>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing Total {{$products->total()}} results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <form action="">
                                <div class="shop__product__option__right">
                                    <p>Sorting:</p>
                                    <select name="sort_by" onchange="this.form.submit();" class="sorting">
                                        <option {{ request('sort_by') == 'latest' ? 'selected' : ''  }} value="latest">Latest</option>
                                        <option {{ request('sort_by') == 'oldest' ? 'selected' : ''  }} value="oldest">Oldest</option>
                                        <option {{ request('sort_by') == 'name-ascending' ? 'selected' : ''  }} value="name-ascending">Name: A-Z</option>
                                        <option {{ request('sort_by') == 'name-descending' ? 'selected' : ''  }}  value="name-descending">Name: Z-A</option>
                                        <option {{ request('sort_by') == 'price-ascending' ? 'selected' : ''  }} value="price-ascending">Price Ascending</option>
                                        <option {{ request('sort_by') == 'price-descending' ? 'selected' : ''  }} value="price-descending">Price Decrease</option>

                                    </select>
                                    <p>Show:</p>
                                    <select name="show" onchange="this.form.submit();" class="p-show">
                                        <option {{ request('show') == '12' ? 'selected' : ''  }} value="12"> 12</option>
                                        <option {{ request('show') == '22' ? 'selected' : ''  }} value="22"> 22</option>
                                        <option {{ request('show') == '32' ? 'selected' : ''  }} value="32"> 32</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($products as $product)
                        @include("front.components.product-item")
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">

                            {!! $products->links("pagination::bootstrap-4") !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Shop Section End -->

@endsection
