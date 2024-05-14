
<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product__item">
        <div class="product__item__pic set-bg" data-setbg="front/img/product/{{$product->productImages[0]->path}}">
            @if(isset($product->discount) && $product->discount !== null)
                <span class="label">Sale</span>
            @else
                <span></span>
            @endif

            <ul class="product__hover">
                <li><a href="javascript:addFav({{ $product->id }})"><img src="front/img/icon/heart.png" alt=""></a></li>
                <li><a href="#"><img src="front/img/icon/compare.png" alt=""> <span>Compare</span></a>
                </li>
                <li><a href="#"><img src="front/img/icon/search.png" alt=""></a></li>
            </ul>
        </div>
        <div class="product__item__text">
            <h6>{{$product->name}}</h6>
            <a href="javascript:addCart({{$product->id}})" class="add-cart">+ @if($locale == 'vi'){{ __('vi.Add To Cart') }}@else{{ __('en.Add To Cart') }}@endif</a>
            <a href="shop/product/{{$product->id}}" class="quick-view"><i class="fa fa-eye"></i>@if($locale == 'vi'){{ __('vi.Quick view') }}@else{{ __('en.Quick view') }}@endif</a>

            <div class="rating">

                @php
                    $rating = $productRating->where('product_id', $product->id)->first();
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
            @if($product->discount != null)
                <h5 class="">${{$product->discount}} <span class="related-discount-span">${{$product->price}}</span></h5>
            @else
                <h5>${{$product->price}} <span></span></h5>
            @endif
            <div class="product__color__select">
                @foreach(array_unique(array_column($product->productDetails->toArray(), 'color')) as $productColor)
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
