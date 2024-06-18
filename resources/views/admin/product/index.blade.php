@php use App\Utilities\Constant; @endphp
@extends('admin.layouts.admin')

@section('title')
    <title>Danh Sách Sản Phẩm</title>
@endsection
@section('this-css')
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">

    <link rel="stylesheet" href="{{asset('admins/css/select2.min.css')}}">
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
        input[type='search'] {
            height: auto !important;
            font-size: 1.175rem !important;
        }
        .nav-item#product {
            background-color: rgba(255, 255, 255, .1);
            color: #fff;
        }
    </style>
@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header',['name' => '', 'key' => 'Danh Sách Sản Phẩm','url' => ''])
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
            <form method="GET" action="{{ route('products') }}" class="p-3">
                <input type="hidden" name="sort_by" value="{{ request('sort_by', $sortBy) }}">
                <input type="hidden" name="sort_direction" value="{{ request('sort_direction', $sortDirection) }}">
                {{--                <input type="hidden" name="page" value="{{ $orders->currentPage() }}">--}}

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="show_deleted" id="show_deleted" value="yes" {{ $showDeleted === 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="show_deleted">
                                Display hidden products?
                            </label>
                        </div>
                    </div>
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
                    <div class="form-group col-md-2">
                        <label for="min_price">Min Price</label>
                        <input type="number" class="form-control" id="min_price" name="min_price" value="{{ request('min_price',$minPrice) }}" placeholder="0" min="0">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="max_price">Max Price</label>
                        <input type="number" class="form-control" id="max_price" name="max_price" value="{{ request('max_price',$maxPrice) }}" placeholder="">
                    </div>
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
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#createProductModal">
                            Create Product
                        </button>

                    </div>
                    <div class="div col-md-12">

                        <table class="table">
                            <thead>
                            <tr>
                                @php
                                    $columns = [
                                     'id' => ['name' => 'ID', 'sortable' => true],
                                     'brand_id' => ['name' => 'brand', 'sortable' => true],
                                     'product_category_id' => ['name' => 'category', 'sortable' => true],
                                     'name' => ['name' => 'name', 'sortable' => true],
                                     'image' => ['name' => 'image', 'sortable' => false],
                                     'description' => ['name' => 'description', 'sortable' => true],
                                     'content' => ['name' => 'content', 'sortable' => true],
                                     'price' => ['name' => 'price', 'sortable' => true],
                                     'qty' => ['name' => 'total qty', 'sortable' => true],
                                     'sku' => ['name' => 'sku', 'sortable' => true],
                                     'featured' => ['name' => 'featured', 'sortable' => true],
                                     'tag' => ['name' => 'tag', 'sortable' => true],
                                     'notes' => ['name' => 'notes', 'sortable' => true],
                                     'additional_info' => ['name' => 'additional_info', 'sortable' => true],
                                     'created_at' => ['name' => 'created_at', 'sortable' => true],
                                 ];
                                @endphp

                                @foreach($columns as $column => $details)
                                    <th>
                                        @if($details['sortable'])
                                            <a href="{{ route('products', [
                                                        'sort_by' => $column,
                                                        'sort_direction' => $sortBy === $column && $sortDirection === 'asc' ? 'desc' : 'asc',
                                                        'search_term' => request('search_term', $searchTerm),
                                                        'show_deleted' => request('show_deleted', $showDeleted),
                                                        'page' => $products->currentPage(), // Preserve current page
                                                        'max_price' => request('max_price',$maxPrice),
                                                        'min_price' => request('min_price',$minPrice),
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
                            @foreach ($products as $product)
                                @php
                                    $brand = $product->brand;
                                    $category = $product->productCategory;
                                    $thumbImgPath = $product->productImages()->first()->path??'';
                                    $description = $product->description??'';
                                    $content = $product->content??'';
                                    $notes = $product->notes??'';
                                    $additionalInfo = $product->additional_info??'';
                                @endphp
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>
                                        <img src="{{asset("front/img/product/$thumbImgPath")}}" style="max-width:75px">
                                    </td>

                                    <td>
                                        <span
                                            id="description_{{$product->id}}">{{ strlen($description) > 40 ? substr($description, 0, 40).'...':$description}}</span>
                                        <a class="edit-link" href="#" data-toggle="modal" data-target="#bigTextModal"
                                           data-column="description" data-id="{{ $product->id }}"
                                           data-title="Edit Description">Edit</a>
                                    </td>
                                    <td>
                                        <span
                                            id="content_{{$product->id}}">{{ strlen($content) > 40 ? substr($content, 0, 40).'...':$content}}</span>
                                        <a class="edit-link" href="#" data-toggle="modal" data-target="#bigTextModal"
                                           data-column="content" data-id="{{ $product->id }}" data-title="Edit Content">Edit</a>
                                    </td>
                                    <td>$ {{$product->price}}</td>
                                    <td>{{$product->qty}}</td>
                                    <td>{{$product->sku}}</td>
                                    <td>{{$FEATURES[$product->featured]}}</td>
                                    <!-- Accessing the name of the category -->
                                    <td>{{ $product->tag }}</td>
                                    <td>
                                        <span
                                            id="notes_{{$product->id}}">{{ strlen($notes) > 40 ? substr($notes, 0, 40).'...':$notes}}</span>
                                        <a class="edit-link" href="#" data-toggle="modal" data-target="#bigTextModal"
                                           data-column="notes" data-id="{{ $product->id }}"
                                           data-title="Edit Notes">Edit</a>
                                    </td>
                                    <td>
                                        <span
                                            id="additional_info_{{$product->id}}">{{ strlen($additionalInfo) > 40 ? substr($additionalInfo, 0, 40).'...':$additionalInfo}}</span>
                                        <a class="edit-link" href="#" data-toggle="modal" data-target="#bigTextModal"
                                           data-column="additional_info" data-id="{{ $product->id }}"
                                           data-title="Edit Additional Info">Edit</a>
                                    </td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>

                                        <div class="dropdown" style="margin-bottom: 5px; margin-right: 5px">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                 aria-labelledby="dropdownMenuButton"
                                                 id="actionOptions_{{$product->id}}">
                                                <a class="dropdown-item btn btn-primary" role="button"
                                                   href="{{route('products.productDetails',['product'=> $product->id])}}">
                                                    <i class="fas fa-eye"></i> Products Details
                                                </a>

                                                <button style="margin-left: 15px !important;" type="button" class="btn btn-primary edit-product" data-toggle="modal" data-target="#editProductModal" data-id="{{ $product->id }}">
                                                    <i class="fas fa-edit"></i> Edit Product
                                                </button>
                                            </div>
                                            {{--                                                    ....--}}
                                        </div>
                                        <span id="delRes_{{$product->id}}">
                                        @if($product->deleted_at)
                                            <button type="button" class="btn btn-success"
                                                    onclick="restoreProduct(this, {{ $product->id }})" title="Restore"
                                                    data-url="{{ route('products.restore', $product->id) }}"
                                                    id="restoreBtn_{{ $product->id }}">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        @else
                                            <a title="Delete" href="#" class="btn btn-danger delete-product"
                                               onclick="deleteProduct(this, {{ $product->id }})"
                                               data-url="{{ route('products.delete', $product->id) }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endif
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="col-md-12">
                            {{ $products->appends([
                                    'sort_by' =>  request('sort_by', $sortBy),
                                    'sort_direction' =>  request('sort_direction', $sortDirection),
                                    'show_deleted' => request('show_deleted', $showDeleted),
                                    'search_term' => request('search_term', $searchTerm),
                                    'max_price' => request('max_price',$maxPrice),
                                    'min_price' => request('min_price',$minPrice),
                                ])->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
        <div class="modal fade" id="bigTextModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Text</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea id="edit-textarea" class="form-control" rows="5"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save-button">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="createProductModal" tabindex="-1" role="dialog"
             aria-labelledby="createProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProductModalLabel">Create Product</h5>
                        <button type="button" onclick="emptyTempFolder()" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="createProductForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            <!-- Product Name Input -->
                            <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="productName" >
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Brand Select -->
                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                <select class="form-control" id="brand_id" name="brand_id" required>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Product Category Select -->
                            <div class="form-group">
                                <label for="product_category_id">Product Category</label>
                                <select class="form-control" id="product_category_id" name="product_category_id"
                                        required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>

                            <!-- Content -->
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea class="form-control" id="content" name="content"></textarea>
                            </div>

                            <!-- Price -->
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>

                            <!-- Weight -->
                            <div class="form-group">
                                <label for="weight">Weight</label>
                                <input type="number" class="form-control" id="weight" name="weight">
                            </div>

                            <!-- Featured Select -->
                            <div class="form-group">
                                <label for="featured">Featured</label>
                                <select class="form-control" id="featured" name="featured" required>
                                    @foreach(Constant::$FEATURES as $key => $feature)
                                        <option value="{{ $key }}">{{ $feature }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Tag Select -->
                            <div class="form-group">
                                <label for="tag">Tag</label>
                                <select class="form-control" id="tag" name="tag">
                                    @foreach(Constant::$TAGS as $tag)
                                        <option value="{{ $tag }}">{{ $tag }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Notes -->
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea class="form-control" id="notes" name="notes"></textarea>
                            </div>

                            <!-- Additional Info -->
                            <div class="form-group">
                                <label for="additional_info">Additional Info</label>
                                <textarea class="form-control" id="additional_info" name="additional_info"></textarea>
                            </div>

                            <!-- Dropzone for Images -->
                            <div class="form-group">
                                <label for="productImages">Product Images</label>
                                <div id="productImages" class="dropzone"></div>
                                <div class="invalid-feedback " id="noImage" ></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="emptyTempFolder()">Close</button>
                            <button type="submit" class="btn btn-primary">Create Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Product Modal -->
        <div class="modal fade" data-backdrop="static" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="editProductForm" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                            <button type="button" onclick="emptyTempFolder()"class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <!-- Product Name Input -->
                            <div class="form-group">
                                <label for="edit_productName">Product Name</label>
                                <input type="text" class="form-control" id="edit_productName" name="productName" >
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Brand Select -->
                            <div class="form-group">
                                <label for="edit_brand_id">Brand</label>
                                <select class="form-control" id="edit_brand_id" name="brand_id" required>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Product Category Select -->
                            <div class="form-group">
                                <label for="edit_product_category_id">Product Category</label>
                                <select class="form-control" id="edit_product_category_id" name="product_category_id"
                                        required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="edit_description">Description</label>
                                <textarea class="form-control" id="edit_description" name="description"></textarea>
                            </div>

                            <!-- Content -->
                            <div class="form-group">
                                <label for="edit_content">Content</label>
                                <textarea class="form-control" id="edit_content" name="content"></textarea>
                            </div>

                            <!-- Price -->
                            <div class="form-group">
                                <label for="edit_price">Price</label>
                                <input type="number" class="form-control" id="edit_price" name="price" required>
                            </div>

                            <!-- Weight -->
                            <div class="form-group">
                                <label for="edit_weight">Weight</label>
                                <input type="number" class="form-control" id="edit_weight" name="weight" step="0.1">
                            </div>

                            <!-- Featured Select -->
                            <div class="form-group">
                                <label for="edit_featured">Featured</label>
                                <select class="form-control" id="edit_featured" name="featured" required>
                                    @foreach(Constant::$FEATURES as $key => $feature)
                                        <option value="{{ $key }}">{{ $feature }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Tag Select -->
                            <div class="form-group">
                                <label for="edit_tag">Tag</label>
                                <select class="form-control" id="edit_tag" name="tag">
                                    @foreach(Constant::$TAGS as $tag)
                                        <option value="{{ $tag }}">{{ $tag }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Notes -->
                            <div class="form-group">
                                <label for="edit_notes">Notes</label>
                                <textarea class="form-control" id="edit_notes" name="notes"></textarea>
                            </div>

                            <!-- Additional Info -->
                            <div class="form-group">
                                <label for="edit_additional_info">Additional Info</label>
                                <textarea class="form-control" id="edit_additional_info" name="additional_info"></textarea>
                            </div>

                            <!-- Dropzone for Images -->
                            <div class="form-group">
                                <label for="editProductImages">Product Images</label>
                                <div id="editProductImages" class="dropzone"></div>
                                <div class="invalid-feedback" ></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="emptyTempFolder()">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection
        @section('this-js')
            <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
{{--        product create dropzone and form submit--}}
            <script>
                // $('#createProductButton').click(function () {
                //     $('#createProductModal').modal('show');
                // });
                Dropzone.autoDiscover = false;
                var myDropzone = new Dropzone("#productImages", {
                    url: "{{ route('uploadImgDZ')}}",
                    paramName: "file",
                    addRemoveLinks: true,
                    dictRemoveFile: "Remove",
                    maxFilesize: 5,
                    acceptedFiles: 'image/*',
                    parallelUploads: 2,
                    uploadMultiple: true,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//important incase this code is in the blade and not in a separate js file
                    init: function () {
                        // var csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                        // Event triggered when multiple files are successfully uploaded
                        this.on("successmultiple", function (files, response) {
                            // Assuming the server returns an array of file IDs
                            files.forEach(function (file, index) {
                                // Store the server ID in the file object
                                file.baseName = response[index].baseName;// access object data with array [] symbols
                            });
                        });

                        // Event triggered when a file is removed from the Dropzone area
                        this.on("removedfile", function (file) {
                            // Check if the file has a server ID (i.e., it was uploaded to the server)
                            if (file.baseName) {
                                // Make an AJAX request to delete the file on the server
                                // var msgAl;
                                $.ajax({
                                    url: "{{ route('deleteImgDZ') }}",
                                    type: "POST",
                                    data: {baseName: file.baseName},
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//important incase this code is in the blade and not in a separate js file
                                    beforeSend: function() {
                                        // This function will be executed before the request is sent
                                        // msgAl = alertify.message('Đang xóa ảnh!', 0);
                                    },
                                    complete: function() {
                                        // This function will be executed after the request is completed
                                        // msgAl.dismiss();
                                    },
                                    success: function (response) {
                                        console.log("File deleted successfully");
                                        alertify.success("Image deleted successfully");
                                    },
                                    error: function (xhr, status, error) {
                                        console.error("Error deleting file:", error);
                                        alertify.error("Error deleting file:", error);
                                    }
                                });
                            }
                        });
                    }
                });

                $(document).ready(function () {
                    $('#createProductForm').submit(function (event) {
                        event.preventDefault();
                        var form = $(this);
                        var formData = new FormData(form[0]);
                        //reset validation signal
                        form.find('.is-invalid').removeClass('is-invalid');
                        form.find('.invalid-feedback').text('');
                        // Add Dropzone files to FormData manually
                        myDropzone.files.forEach(function(file) {
                            if (file.baseName) {
                                formData.append('file[]', file.baseName);
                            }
                        });

                        $.ajax({
                            type: 'POST',
                            url: "{{ route('products.store') }}",
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//important incase this code is in the blade and not in a separate js file
                            success: function(response) {
                                if(response.success) {
                                    location.reload()
                                    console.log(response);
                                    $('#createProductModal').modal('hide');
                                    alertify.success(response.message)
                                }else{
                                    alertify.error(response.message)
                                }
                            },
                            error: function(xhr, status, error) {
                                // console.error(error);
                                var errors = xhr.responseJSON;
                                $.each(errors.errors, function(key, value) {
                                    console.log(key);
                                    console.log(value);
                                    var field = form.find('[name="' + key + '"]');
                                    field.addClass('is-invalid');
                                    field.next('.invalid-feedback').text(value);
                                    if(key === 'file') {
                                        $('#productImages').next('.invalid-feedback').text(value).show();
                                        // $('.noImage').text(value);
                                    }
                                });
                            }
                        });
                    });
                });
            </script>
{{--            each edit on text cell--}}
            <script>
                $(document).ready(function () {
                    let column, productId, fullText;

                    $('.edit-link').on('click', function () {
                        $('#edit-textarea').val('');
                        column = $(this).data('column');
                        productId = $(this).data('id');
                        var title = $(this).data('title');
                        $('#editModalLabel').text(title);
                        var url = '{{route('products.getText')}}';
                        // Fetch the full text for the specified column and product
                        $.ajax({
                            url: url, // URL to your route that fetches the text
                            type: 'GET',
                            data: {
                                column: column,
                                id: productId
                            },
                            success: function (response) {
                                if (response.success) {
                                    fullText = response.text;
                                    $('#edit-textarea').val(fullText);
                                    $('#bigTextModal').modal('show');
                                    alertify.success(response.message)
                                } else {
                                    alertify.error(response.message)
                                }
                            },
                            error: function (error) {
                                console.error('Error Fetching text:', error);
                                var response = JSON.parse(error.responseText);
                                alertify.error(response.message);
                            }
                        });
                    });

                    $('#save-button').on('click', function () {
                        fullText = $('#edit-textarea').val();

                        // Save the updated text to the database
                        var url = '{{route('products.updateText')}}';
                        $.ajax({
                            url: url, // URL to your route that saves the text
                            type: 'POST',
                            data: {
                                column: column,
                                id: productId,
                                text: fullText
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if (response.success) {
                                    $(`#${column}_${productId}`).text(response.truncatedText);
                                    $('#bigTextModal').modal('hide');
                                    alertify.success(response.message)
                                } else {
                                    alertify.error(response.message)
                                }
                            },
                            error: function (error) {
                                console.error('Error saving text:', error);
                                var response = JSON.parse(error.responseText);
                                alertify.error(response.message);
                            }
                        });
                    });
                });
            </script>

            {{--        product edit update dropzone and form submit--}}
            <script>
                // Initialize Dropzone for editProductImages
                Dropzone.autoDiscover = false;
                var editDropzone = new Dropzone("#editProductImages", {
                    url: "{{ route('uploadImgDZ')}}",
                    paramName: "file",
                    addRemoveLinks: true,
                    dictRemoveFile: "Remove",
                    maxFilesize: 5,
                    acceptedFiles: 'image/*',
                    parallelUploads: 2,
                    uploadMultiple: true,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//important incase this code is in the blade and not in a separate js file
                    init: function () {
                        var dz = this;
                        $(document).on('click', '.edit-product', function (e) {
                            e.preventDefault();
                            var productId = $(this).data('id');
                            $.ajax({
                                url: "{{ route('products.edit', '') }}" + productId,
                                type: 'GET',
                                success: function (response) {
                                    // Populate form fields

                                    var product = response.thisProduct;
                                    var images = response.images;
                                    // alertify.success((''+product.brand_id));
                                    // Populate form fields
                                    $('#edit_productName').val(product.name);
                                    $('#edit_brand_id').val(product.brand_id);
                                    $('#edit_product_category_id').val(product.product_category_id);
                                    $('#edit_description').val(product.description);
                                    $('#edit_content').val(product.content);
                                    $('#edit_price').val(product.price);
                                    $('#edit_weight').val(product.weight);
                                    $('#edit_featured').val(product.featured);
                                    $('#edit_tag').val(product.tag);
                                    $('#edit_notes').val(product.notes);
                                    $('#edit_additional_info').val(product.additional_info);

                                    // Clear existing files in Dropzone
                                    dz.removeAllFiles();
                                    Dropzone.forElement("#editProductImages").removeAllFiles(true);
                                    dz.removeAllFiles();
                                    // Cancel current uploads
                                    dz.removeAllFiles(true);
                                    // Add existing product images to Dropzone
                                    response.images.forEach(function (image) {
                                        var mockFile = { name: image.path, size: image.size, baseName: image.path, isMocked: true }; // Assuming image.path is the baseName
                                        dz.emit("addedfile", mockFile);
                                        dz.emit("thumbnail", mockFile, "/front/img/product/" + image.path); // Adjust URL as necessary
                                        dz.emit("complete", mockFile);
                                        dz.files.push(mockFile); // Manually add the mock file to Dropzone's files array
                                        mockFile.previewElement.querySelector(".dz-remove").dataset.baseName = image.path; // Assuming image.path is the baseName
                                    });

                                    $('#editProductModal').modal('show');
                                },
                                error: function (xhr, status, error) {
                                    console.error("Error fetching product data:", error);
                                }
                            });


                            // Handle form submission for editing product
                            $('#editProductForm').on('submit', function (e) {
                                // alertify.error(""+'howmany');

                                e.preventDefault();
                                var form = $(this);
                                var formData = new FormData(this);
                                //reset validation signal
                                form.find('.is-invalid').removeClass('is-invalid');
                                form.find('.invalid-feedback').text('');
                                // Add Dropzone files to FormData manually
                                editDropzone.files.forEach(function(file) {
                                    // alertify.error(""+'howmany');
                                    if (file.baseName) {
                                        formData.append('file[]', file.baseName);
                                    }
                                });
                                // return false;
                                // alertify.success('reach here 877');
                                // Submit form data via AJAX
                                $.ajax({
                                    url: "{{ route('products.update', '') }}" +'/'+ productId, // Adjust route as necessary
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//important incase this code is in the blade and not in a separate js file
                                    success: function(response) {
                                        if(response.success) {
                                            location.reload()
                                            console.log(response);
                                            $('#createProductModal').modal('hide');
                                            alertify.success(response.message)
                                        }else{
                                            alertify.error(response.message)
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        // console.error(error);
                                        var errors = xhr.responseJSON;
                                        $.each(errors.errors, function(key, value) {
                                            console.log(key);
                                            console.log(value);
                                            var field = form.find('[name="' + key + '"]');
                                            field.addClass('is-invalid');
                                            field.next('.invalid-feedback').text(value);
                                            if(key === 'file') {
                                                $('#editProductImages').next('.invalid-feedback').text(value).show();
                                            }
                                        });
                                    }
                                });
                            });
                        });

                        this.on("successmultiple", function (files, response) {
                            // Assuming the server returns an array of file IDs
                            files.forEach(function (file, index) {
                                // Store the server ID in the file object
                                file.baseName = response[index].baseName;// access object data with array [] symbols
                            });
                        });
                        // Fetch product data and populate form on edit button click
                        this.on("removedfile", function (file) {
                            // Check if the file has a server ID (i.e., it was uploaded to the server)
                            if (file.baseName && !file.isMocked) {
                                // Make an AJAX request to delete the file on the server
                                // var msgAl;
                                $.ajax({
                                    url: "{{ route('deleteImgDZ') }}",
                                    type: "POST",
                                    data: {baseName: file.baseName},
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//important incase this code is in the blade and not in a separate js file
                                    beforeSend: function() {
                                        // This function will be executed before the request is sent
                                        // msgAl = alertify.message('Đang xóa ảnh!', 0);
                                    },
                                    complete: function() {
                                        // This function will be executed after the request is completed
                                        // msgAl.dismiss();
                                    },
                                    success: function (response) {
                                        console.log("File deleted successfully");
                                        alertify.success("Image deleted successfully");
                                    },
                                    error: function (xhr, status, error) {
                                        console.error("Error deleting file:", error);
                                        alertify.error("Error deleting file:", error);
                                    }
                                });
                            }
                        });


                    }
                });
            </script>
            <script>
                function emptyTempFolder(){
                    // myDropzone.removeAllFiles();
                    // Dropzone.forElement("#editProductImages").removeAllFiles(true);
                    // dz.removeAllFiles();
                    // // Cancel current uploads
                    editDropzone.removeAllFiles(true);
                    myDropzone.removeAllFiles(true);
                    $.ajax({
                        url: "{{ route('products.emptyTempFolder') }}",
                        type: 'POST',
                        data: {},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//important incase this code is in the blade and not in a separate js file
                        success: function(response) {
                            if(response.success) {
                                alertify.success(response.message)
                            }else{
                                alertify.error(response.message)
                            }
                        },
                        error: function(xhr, status, error) {
                            // console.error(error);
                            var errors = xhr.responseJSON;
                            $.each(errors.errors, function(key, value) {
                            });
                        }
                    });
                }
            </script>

            <script>
                function deleteProduct(button, productId) {
                    const url = $(button).data('url');

                    $.ajax({
                        url: url,
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (response) {
                            if (response.success) {
                                alertify.success(response.message);
                                $('#delRes_' + productId).html(response.html);
                            } else {
                                alertify.error(response.message);
                            }
                        },
                        error: function (xhr) {
                            alertify.error('An error occurred while deleting the brand.');
                        }
                    });
                }

                function restoreProduct(button, productId) {
                    const url = $(button).data('url');

                    $.ajax({
                        url: url,
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (response) {
                            if (response.success) {
                                alertify.success(response.message);
                                $('#delRes_' + productId).html(response.html);
                            } else {
                                alertify.error(response.message);
                            }
                        },
                        error: function (xhr) {
                            alertify.error('An error occurred while restoring the brand.');
                        }
                    });
                }

            </script>
@endsection






