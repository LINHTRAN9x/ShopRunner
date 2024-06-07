
<div class="col-lg-4 col-md-6 col-sm-6">
    <div class="product__item">
        <div class="product__item__pic set-bg" data-setbg="front/img/product/{{$product->productImages[0]->path}}">

            @if(isset($product->discount) && $product->discount !== null)
                <span class="label">Sale</span>
            @else
                <span></span>
            @endif

            <ul class="product__hover">
                @php
                    $isFavourite = in_array($product->id, $favourites);
                 @endphp
                <li>
                    <a href="javascript:addFav({{ $product->id }})">
                        <img class="{{ $isFavourite ? 'icon-heart' : '' }}" src="front/img/icon/heart.png" alt="">
                    </a>
                </li>
                <li><a href="shop/product/{{$product->id}}"><img src="front/img/icon/view.png" alt=""> <span>View details</span></a>
                </li>
                <li><a href="#"><img src="front/img/icon/search.png" alt=""></a></li>
            </ul>
        </div>
        <div class="product__item__text">
            <h6>{{$product->name}}</h6>
            <a href="javascript:addCartQuick({{$product->id}})" class="add-cart">+ @if($locale == 'vi'){{ __('vi.Add To Cart') }}@else{{ __('en.Add To Cart') }}@endif</a>
{{--            <a href="shop/product/{{$product->id}}" class="quick-view"><i class="fa fa-eye"></i>@if($locale == 'vi'){{ __('vi.Quick view') }}@else{{ __('en.Quick view') }}@endif</a>--}}
            <a href="#" data-toggle="modal" data-target="#quick-view" value="quick-view" class="quick-view" data-id_product="{{$product->id}}"><i class="fa fa-eye"></i>Quick view</a>

            <div class="rating">
                @php
                    $avgRating = $product->avgRating ?? 0;
                    $fullStars = floor($avgRating);
                    $halfStar = ($avgRating - $fullStars) >= 0.5 ? 1 : 0;
                    $emptyStars = 5 - $fullStars - $halfStar;
                @endphp

                @for($i = 1; $i <= $fullStars; $i++)
                    <i class="fa fa-star"></i>
                @endfor

                @if($halfStar)
                    <i class="fa fa-star-half-o"></i>
                @endif

                @for($i = 1; $i <= $emptyStars; $i++)
                    <i class="fa fa-star-o"></i>
                @endfor

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
<!-- Modal -->
<form action="{{url('/quick-view')}}" method="POST">
    @csrf
    <div class="modal fade" id="quick-view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content-product">
                <div class="modal-header">
                    <a style="--clr: #fff" class="detail-button" href="shop/product/{{$product->id}}">
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

