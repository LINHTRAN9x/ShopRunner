@php use App\Utilities\Constant; @endphp
@extends('admin.layouts.admin')

@section('title')
    <title>Product Detail #{{$product->id}}</title>
@endsection
@section('this-css')
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('admins/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/css/bs513/bootstrap.css')}}">
    <style>
        img {
            max-width: 230px;
            height: 80px;
            object-fit: cover;
        }

        .table td, .table th {
            vertical-align: middle;
        }

    </style>
    <style>
        .dropzone {
            border: 2px dashed #0087F7;
            border-radius: 5px;
            background: white;
            min-height: 150px;
        }

        .previews {
            margin-top: 10px;
        }

        .previews .dz-preview {
            display: inline-block;
            margin: 0 10px 10px 0;
        }
        .navbar-badge {
            right: -4.1px;
            top: -0px;
        }
        .badge {
            font-size: 0.65em;
            border-radius: 0.5rem;
        }
        .placeholder {
            min-height:38px;
        }
    </style>
@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header',['name' => 'Danh Sách Sản Phẩm', 'key' => 'Danh Sách Sản Phẩm Chi tiết cho sản phẩm id: #'.$product->id,'url' => route('products')])
        <hr style="margin-block: 5px;">
        @php
            $FEATURES = Constant::$FEATURES;
    //        $PAYMENT_STATUSES = App\Constants\OrderConstants::PAYMENTSTATUSES;
            $STATUS_COLORS = Constant::STATUSCOLORS;
        @endphp
        {{--        <form class="form-inline ml-3" method="GET" action="{{ route('products') }}">--}}
        {{--            <input type="hidden" name="sort_by" value="{{ request('sort_by', $sortBy) }}">--}}
        {{--            <input type="hidden" name="sort_direction" value="{{ request('sort_direction', $sortDirection) }}">--}}
        {{--            <input type="hidden" name="show_deleted" value="{{ request('show_deleted', $showDeleted) }}">--}}
        {{--            <input type="hidden" name="page" value="{{ $products->currentPage() }}">--}}
        {{--            <div class="input-group input-group-sm">--}}
        {{--                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search"--}}
        {{--                       value="{{ request('search_term', $searchTerm) }}" name="search_term">--}}
        {{--                <div class="input-group-append">--}}
        {{--                    <button class="btn btn-navbar" type="submit">--}}
        {{--                        <i class="fas fa-search"></i>--}}
        {{--                    </button>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </form>--}}
        <div class="content">
            <form method="GET" action="{{ route('products.productDetails', ['product' => $product->id]) }}" class="p-3">
                <input type="hidden" name="sort_by" value="{{ request('sort_by', $sortBy) }}">
                <input type="hidden" name="sort_direction" value="{{ request('sort_direction', $sortDirection) }}">
                {{--                <input type="hidden" name="page" value="{{ $orders->currentPage() }}">--}}

                <div class="form-row">
{{--                    <div class="form-group col-md-2">--}}
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" type="checkbox" name="show_deleted" id="show_deleted" value="yes" {{ $showDeleted === 'yes' ? 'checked' : '' }}>--}}
{{--                            <label class="form-check-label" for="show_deleted">--}}
{{--                                Display hidden products?--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    {{--                <div class="form-group col-md-2">--}}
                    {{--                    <label for="order_status">Order status</label>--}}
                    {{--                    <select class="form-control" name="order_status" id="order_status">--}}
                    {{--                        <option value="">Tất cả</option>--}}
                    {{--                        @foreach($ORDERS_STATUSES as $key => $status)--}}
                    {{--                            <option value="{{$key}}" {{ $key == $order_status ? 'selected' : '' }}>--}}
                    {{--                                {{$status}}--}}
                    {{--                            </option>--}}
                    {{--                        @endforeach--}}
                    {{--                    </select>--}}
                    {{--                </div>--}}
{{--                    <div class="form-group col-md-2">--}}
{{--                        <label for="min_price">Min Price</label>--}}
{{--                        <input type="number" class="form-control" id="min_price" name="min_price" value="{{ request('min_price',$minPrice) }}" placeholder="0" min="0">--}}
{{--                    </div>--}}
{{--                    <div class="form-group col-md-2">--}}
{{--                        <label for="max_price">Max Price</label>--}}
{{--                        <input type="number" class="form-control" id="max_price" name="max_price" value="{{ request('max_price',$maxPrice) }}" placeholder="">--}}
{{--                    </div>--}}
                    <div class="form-group col-md-4">
                        <label for="search_term">Search</label>
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" value="{{ request('search_term', $searchTerm) }}" name="search_term">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{--            <form method="GET" action="{{ route('products') }}" style="padding-left: 13px;">--}}
            {{--                <input type="hidden" name="sort_by" value="{{ request('sort_by', $sortBy) }}">--}}
            {{--                <input type="hidden" name="sort_direction" value="{{ request('sort_direction', $sortDirection) }}">--}}
            {{--                <input type="hidden" name="search_term" value="{{ request('search_term', $searchTerm) }}">--}}
            {{--                <input type="hidden" name="page" value="{{ $products->currentPage() }}">--}}
            {{--                <div class="form-check">--}}
            {{--                    <input class="form-check-input" type="checkbox" name="show_deleted" id="show_deleted"--}}
            {{--                           value="yes" {{ $showDeleted === 'yes' ? 'checked' : '' }}>--}}
            {{--                    <label class="form-check-label" for="show_deleted">--}}
            {{--                        Hiển thị Sản Phẩm đã ẩn--}}
            {{--                    </label>--}}
            {{--                </div>--}}
            {{--                <button type="submit" class="btn btn-primary">Lọc</button>--}}
            {{--            </form>--}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12" style="display: flex; justify-content: end;">
                        <button type="button" class="btn btn-primary createItem"
                                data-id="{{$product->id}}"
                                data-bs-toggle="modal" data-bs-target="#createProductItem"
                        >

                            Create Product Item
                        </button>

                    </div>
                    <div class="div col-md-12">

                        <table class="table">
                            <thead>
                            <tr>
                                @php
                                    $columns = [
                                     'id' => ['name' => 'ID', 'sortable' => true],
                                     'product_id' => ['name' => 'product_id', 'sortable' => false],
                                     'color' => ['name' => 'color', 'sortable' => true],
                                     'size' => ['name' => 'size', 'sortable' => true],
                                     'qty' => ['name' => 'Còn Lại', 'sortable' => true],
                                     'created_at' => ['name' => 'created_at', 'sortable' => true],
                                     'updated_at' => ['name' => 'updated_at', 'sortable' => true],
                                 ];
                                @endphp

                                @foreach($columns as $column => $details)
                                    <th>
                                        @if($details['sortable'])
                                            <a href="{{ route('products.productDetails', [ 'product' => $product->id,
                                                        'sort_by' => $column,
                                                        'sort_direction' => $sortBy === $column && $sortDirection === 'asc' ? 'desc' : 'asc',
                                                        'search_term' => request('search_term', $searchTerm),
                                                        'page' => $productDetails->currentPage(), // Preserve current page
                                                    ]) }}">
                                                {{ $details['name'] }}
                                                @if($sortBy === $column)
                                                    <i class="fa fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                                @endif
                                            </a>
                                        @else
                                            {{ $details['name'] }}
                                        @endif
                                    </th>
                                @endforeach
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($productDetails as $productDetail)
                                @php
                                    $updated_at = ($productDetail->updated_at?$productDetail->updated_at->format('H:i d/m/Y'):'');
                                    $created_at = ($productDetail->created_at?$productDetail->created_at->format('H:i d/m/Y'):'');
                                    $qty = $productDetail->qty;
                                    $size = $productDetail->size??'';
                                    $color = $productDetail->color??'';
                                    $product_id = $product->id;
                                    $id = $productDetail->id;
                                @endphp
                                <tr>
                                    <th scope="row">{{ $id}}</th>
                                    <td>{{ $product_id }}</td>
                                    <td>{{ $color }}</td>
                                    <td>{{ $size }}</td>
                                    <td>
                                        {{$qty}}
                                    </td>

                                    <td>
                                        {{$created_at}}
                                    </td>
                                    <td>
                                        {{$updated_at}}
                                    </td>
                                    <td>
                                        <button style="margin-left: 15px !important;" type="button" class="btn btn-primary edit-productItem" data-bs-toggle="modal" data-bs-target="#editProductItemModal" data-productid="{{ $product->id }}" data-itemid="{{ $productDetail->id }}">
                                            <i class="fas fa-edit"></i> Edit Item
                                        </button>
                                            <a title="Delete" href="#" class="btn btn-danger delete-item" style="  "
                                               data-url="{{ route('products.deleteItem', $productDetail->id) }}">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="col-md-12">
                            {{ $productDetails->appends([
                                    'sort_by' =>  request('sort_by', $sortBy),
                                    'sort_direction' =>  request('sort_direction', $sortDirection),
                                    'search_term' => request('search_term', $searchTerm),
                                ])->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
        <div class="modal fade" id="createProductItem" tabindex="-1" role="dialog"
             aria-labelledby="createProductItemLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProductItemLabel">Create Product Item</h5>
                        <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form id="createProductItemForm" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input type="number" class="form-control" id="qty" name="qty" required min="0">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <label for="color">Color</label>
                                <select class="form-control" id="color" name="color" required>
                                    @foreach(Constant::$COLORS as $key => $color)
                                        <option value="{{ $color }}">{{ $color }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <!-- Featured Select -->
                            <div class="form-group">
                                <label for="size">Size</label>
                                <select class="form-control" id="size" name="size" required>
                                    @foreach(Constant::$SIZES as $key => $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Product Modal -->
        <div class="modal fade" id="editProductItemModal" tabindex="-1"
             aria-labelledby="editProductItemModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductItemLabel">Edit Product Item</h5>
                        <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form id="editProductItemForm" enctype="multipart/form-data">
                        <div class="modal-body placeholder-glow">

                            <div class="form-group">
                                <label for="edit_qty">Quantity</label>
                                <input type="number" class="form-control" id="edit_qty" name="qty" required min="0">
                                <div class="invalid-feedback"></div>
                                <span class="placeholder placeholder-lg col-12"></span>
                            </div>

                            <div class="form-group">
                                <label for="edit_color">Color</label>
                                <select class="form-control" id="edit_color" name="color" required>
                                    @foreach(Constant::$COLORS as $key => $color)
                                        <option value="{{ $color }}">{{ $color }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                                <span class="placeholder placeholder-lg col-12"></span>
                            </div>
                            <!-- Featured Select -->
                            <div class="form-group">
                                <label for="edit_size">Size</label>
                                <select class="form-control" id="edit_size" name="size" required>
                                    @foreach(Constant::$SIZES as $key => $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                                <span class="placeholder placeholder-lg col-12"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection
        @section('this-js')
            <script src="{{asset('admins/js/bs513/bootstrap.bundle.js')}}"></script>

{{--                    delete --}}
            <script>

                $(document).ready(function() {
                    $(document).on('click', '.delete-item', function(e) {
                        e.preventDefault(); // Prevent the default action of the link

                        var $this = $(this); // Capture the clicked element
                        var currentUrl = new URL(window.location.href);// currentUrl chỉ để lấy query string
                        var queryParams = currentUrl.search; // Get the query parameters

                        alertify.confirm(
                            'Confirm Message',
                            'Are you sure you want to Permanently delete this Product item?',
                            function () {
                                var deleteUrl = $this.data('url') + queryParams;
                                window.location.href = deleteUrl; // Redirect with query parameters
                            },
                            function () {
                                alertify.error('Cancel'); // Handle cancel action
                            }
                        );
                    });
                });
            </script>





{{--.createItem--}}
            <script>
                $(document).on('click', '.createItem', function (e) {
                    e.preventDefault();
                    // $('#createProductItem').modal('show');
                    var productId = $(this).data('id');
                    $('#createProductItemForm').on('submit', function (e) {
                        e.preventDefault();
                        var form = $(this);
                        var formData = new FormData(this);
                        //reset validation signal
                        form.find('.is-invalid').removeClass('is-invalid');
                        form.find('.invalid-feedback').text('');
                        $.ajax({
                            url: "{{ route('products.storeItem', '')}}/"+ productId, // Adjust route as necessary
                            type: 'POST',
                            data: formData,
                            processData: false, // Important for FormData
                            contentType: false, // Important for FormData
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//important incase this code is in the blade and not in a separate js file
                            success: function(response) {
                                if(response.success) {
                                    location.reload()
                                    console.log(response);
                                    // $('#createProductItem').modal('hide');
                                    alertify.success(response.message)
                                }else{
                                    alertify.error(response.message)
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                var errors = xhr.responseJSON;
                                $.each(errors.errors, function(key, value) {
                                    console.log(key);
                                    console.log(value);
                                    var field = form.find('[name="' + key + '"]');
                                    if(key === 'size' && value[0] === 'The combination of color and size already exists for this product.') {
                                        form.find('[name]').addClass('is-invalid');
                                        form.find('[name="qty"]').removeClass('is-invalid');
                                        field.next('.invalid-feedback').text(value);
                                        return false;
                                    }
                                    field.addClass('is-invalid');
                                    field.next('.invalid-feedback').text(value);
                                });
                            }
                        });
                    });
                });
            </script>
{{--    eidtITem--}}
            <script>

                $(document).on('click', '.edit-productItem', function (e) {
                    // e.preventDefault();

                    // return false;
                    var productId = $(this).data('productid');
                    var productDetailId = $(this).data('itemid');
                    // alertify.success(''+productDetailId+" "+productId);
                    var $form = $('#editProductItemForm');
                    // $form.reset();
                    $form.find('[name]').hide();
                    $form.find('[type="submit"]').addClass('disabled');
                    $form.find('.placeholder').show();
                    $form.find('.is-invalid').removeClass('is-invalid');
                    $form.find('.invalid-feedback').text('');
                    $('#editProductItemLabel').text('Edit Product Item #'+productDetailId);
                    ///wait for 5s to continue
                    setTimeout(function() {
                        $.ajax({
                        url: "{{ route('products.editItem', '') }}/" + productDetailId,
                        type: 'GET',
                        beforeSend: function() {
                            // Optionally show a loader or perform other UI changes
                        },
                        success: function (response) {
                            // Populate form fields
                            $form.find('[name]').show();
                            $form.find('[type="submit"]').removeClass('disabled');
                            $form.find('.placeholder').hide();

                            var productDetail = response.productDetail;

                            // alertify.success((''+productDetail));
                            console.log((productDetail.color));
                            // // Populate form fields
                            $('#edit_qty').val(productDetail.qty);
                            $('#edit_color').val(productDetail.color);
                            $('#edit_size').val(productDetail.size);
                        },
                        error: function (xhr, status, error) {
                            console.error("Error fetching product detail data:", error);
                        }
                    });
                    }, 200); // 5000 milliseconds = 5 seconds

                    // Handle form submission for editing product
                    $('#editProductItemForm').on('submit', function (e) {
                        e.preventDefault();
                        // e.stopPropagation()
                        var form = $(this);
                        var formData = new FormData(this);
                        //reset validation signal
                        form.find('.is-invalid').removeClass('is-invalid');
                        form.find('.invalid-feedback').text('');
                        $.ajax({
                            url: "{{ route('products.updateItem', '')}}/"+ productDetailId, // Adjust route as necessary
                            type: 'POST',
                            data: formData,
                            processData: false, // Important for FormData
                            contentType: false, // Important for FormData
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//important incase this code is in the blade and not in a separate js file
                            success: function(response) {
                                if(response.success) {
                                    location.reload()
                                    console.log(response);
                                    // $('#createProductItem').modal('hide');
                                    // alertify.success(response.message)
                                }else{
                                    alertify.error(response.message)
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                var errors = xhr.responseJSON;
                                $.each(errors.errors, function(key, value) {
                                    console.log(key);
                                    console.log(value);
                                    var field = form.find('[name="' + key + '"]');
                                    if(key === 'size' && value[0] === 'The combination of color and size already exists for this product.') {
                                        form.find('[name]').addClass('is-invalid');
                                        form.find('[name="qty"]').removeClass('is-invalid');
                                        field.next('.invalid-feedback').text(value);
                                        return false;
                                    }
                                    field.addClass('is-invalid');
                                    field.next('.invalid-feedback').text(value);
                                });
                            }
                        });
                    });
                });
            </script>

@endsection






