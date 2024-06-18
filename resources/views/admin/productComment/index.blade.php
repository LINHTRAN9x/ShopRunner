@php use App\Utilities\Constant; @endphp

@extends('admin.layouts.admin')
@section('title')
    <title>Danh Sách Đánh Giá</title>
@endsection
@section('this-css')
    <link rel="stylesheet" href="{{asset('admins/css/select2.min.css')}}">
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .deliveryFeeInput {
            max-width: 90px;
            padding-block: 0;
            height: auto !important;
        }

        .color-indicator {
            height: 8px;
            width: 100%;
            /* border-radius: 50%; */
            position: absolute;
            top: 0;
        }

        .cancelReasonBox {
            position: absolute;
            top: -22px;
            right: -25px;
            font-size: 24px;
            color: #f14d68;
        }

        .staffNote {
            vertical-align: text-top;
            font-size: 21px;
            margin-left: 10px;

        }

        td, th {
            vertical-align: middle !important;
        }

        #loading-spinner {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000; /* Ensure it is above other content */
        }

        .spinner {
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .staffNoteWarning {
            position: absolute;
            font-size: 16px;
            top: -7px;
            right: -8px;
            color: #ff031b;
        }

        .orderNoteDisplay {
            position: absolute;
            font-size: 22px;
            top: -36px;
            right: -16px;
        }

        .shippingInfoIcon {
            color: #22d271;
        }

        #order_status, #payment_status {
            min-width: 300px;
            width: 30%;
        }

        /*.delete-order {*/
        /*    padding: 5px;*/
        /*}*/
        .nav-item#productComment {
            background-color: rgba(255, 255, 255, .1);
            color: #fff;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        @include('admin.partials.content-header',['name' => '', 'key' => 'Danh Sánh Đánh Giá','url' => ''])
        <hr style="margin-block: 5px;">
        <div class="content">
            <form method="GET" action="{{ route('productComments') }}" class="p-3">
                <input type="hidden" name="sort_by" value="{{ request('sort_by', $sortBy) }}">
                <input type="hidden" name="sort_direction" value="{{ request('sort_direction', $sortDirection) }}">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="show_deleted" id="show_deleted"
                                   value="yes" {{ $showDeleted === 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="show_deleted">
                                Display hidden Reviews?
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="search_term">Search</label>
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                   aria-label="Search" value="{{ request('search_term', $searchTerm) }}"
                                   name="search_term">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="container-fluid">
                <div class="row">
                    <div class="div col-md-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    @php
                                        $columns = [
                                         'id' => ['name' => 'ID', 'sortable' => true],
                                         'product_id' => ['name' => 'Product', 'sortable' => true],
                                         '' => ['name' => 'Image', 'sortable' => false],
                                         'name' => ['name' => 'User Name', 'sortable' => true],
                                         'messages' => ['name' => 'Review', 'sortable' => true],
                                         'rating' => ['name' => 'Rating', 'sortable' => true],
                                         'status' => ['name' => 'Status', 'sortable' => true],
                                         'shop_response' => ['name' => 'Response', 'sortable' => true],
                                         'created_at' => ['name' => 'Rated_at', 'sortable' => true],
                                     ];
                                    @endphp

                                    @foreach($columns as $column => $details)
                                        <th>
                                            @if($details['sortable'])
                                                <a
                                                    href="{{ route('productComments', [
                                                        'sort_by' => $column,
                                                        'sort_direction' => $sortBy === $column && $sortDirection === 'asc' ? 'desc' : 'asc',
                                                        'search_term' => request('search_term', $searchTerm),
                                                        'show_deleted' => request('show_deleted', $showDeleted),
                                                        'page' => $productComments->currentPage(), // Preserve current page
                                                    ]) }}"
                                                >
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
                                @foreach($productComments as $productComment)
                                    @php
                                        $product = $productComment->product;
                                        $thumbImgPath = $product->productImages()->first()->path??'';
                                    @endphp
                                    <tr>
                                        <td >
                                            {{$productComment->id}}
                                        </td>
                                        <td>{{ strlen($product->name) > 30 ? substr($product->name, 0, 30).'...':$product->name}}</td>
                                        <td>
                                            <img src="{{asset("front/img/product/$thumbImgPath")}}" style="max-width:75px">
                                        </td>
                                        <td >
                                            {{$productComment->name}}
                                        </td>
                                        <td style="width: 10%">
                                           <span
                                               id="messages_{{$productComment->id}}">{{ strlen($productComment->messages) > 40 ? substr($productComment->messages, 0, 40).'...':$productComment->messages}}</span>
                                            @if(strlen($productComment->messages) > 40)
                                            <a class="edit-link" href="javascript:void(0);"
                                               data-column="messages" data-id="{{ $productComment->id }}"
                                               data-title="show detail">Detail</a>
                                            @endif
                                        </td>
                                        <td>
                                            <span style="white-space: nowrap" title="{{$productComment->rating}} sao">
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($i < $productComment->rating)

                                                        <i class="fas fa-star" style="color: #d5d50f ;"></i>
                                                    @endif
                                                @endfor
                                            </span>

                                        </td>
                                        <td>
                                            <div class="form-group" style="position: relative; margin-bottom: 0">
                                                <select
                                                    class="form-control productComment-status"
                                                    name="productCommentStatus"
                                                    data-id="{{$productComment->id}}"
                                                >
                                                    @foreach( Constant::$REVIEW_STATUS as $key => $status)
                                                        <option
                                                            value="{{$key}}"
                                                            {{ $key === $productComment->status? 'selected' : '' }} data-color="{{Constant::$REVIEW_STATUS_COLOR[$key]}}">
                                                            {{ $status  }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="color-indicator"
                                                     style="background-color: {{ Constant::$REVIEW_STATUS_COLOR[ $productComment->status] ?? 'transparent' }};"></div>
                                                <input type="hidden" class="previous-productComment-status"
                                                       value="{{ $productComment->status }}">
                                            </div>
                                        </td>
                                        <td id="shopResponse_{{$productComment->id}}" style="white-space: nowrap"><a href="javascript:void(0);" data-id="{{$productComment->id}}" onclick="submitproductCommentResponse(this)" style="white-space: nowrap">Phản Hồi</a>
                                            @if(trim($productComment->shop_response??''))
                                                <i class="fas fa-check-circle reviewResponseWarning" id="reviewResponseWarning_{{$productComment->id}}" style="    color: #00ad00;
    font-size: 1.2em;"></i>
                                            @endif
                                        </td>
                                        <td>{{ $productComment->created_at }}</td>
                                        <td>
                                           <span id="delRes_{{$productComment->id}}">
                                             @if($productComment->deleted_at)
                                                   <button type="button" class="btn btn-success"
                                                           onclick="restoreProductComment(this, {{ $productComment->id }})" title="Restore"
                                                           data-url="{{ route('productComments.restore', $productComment->id) }}"
                                                           id="restoreBtn_{{ $productComment->id }}">
                                                        <i class="fas fa-undo"></i>
                                                </button>
                                               @else
                                                   <a title="Delete" href="#" class="btn btn-danger delete-productComment"
                                                      onclick="deleteProductComment(this, {{ $productComment->id }})"
                                                      data-url="{{ route('productComments.delete', $productComment->id) }}">
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
                                {{ $productComments->appends([
                                    'sort_by' =>  request('sort_by', $sortBy),
                                    'sort_direction' =>  request('sort_direction', $sortDirection),
                                    'show_deleted' => request('show_deleted', $showDeleted),
                                    'search_term' => request('search_term', $searchTerm)
                                ])->links('vendor.pagination.bootstrap-4') }}
                            </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
@section('this-js')
    <script>
        function submitproductCommentResponse(thisEl) {
            var $this = $(thisEl);
            var id = $this.data('id');
            var shopResponse = ''
            $.ajax({
                url: "{{ route('productComments.getShopResponse', '')}}/" + id,
                method: 'GET'
                , beforeSend: function () {
                    // Disable the link
                    $this.addClass('disabled');
                    $this.css('pointer-events', 'none');
                },
                complete: function () {
                    // Enable the link
                    $this.removeClass('disabled');
                    $this.css('pointer-events', '');
                },
                // headers: {
                //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                success: function (response) {
                    if (response.success) {
                        shopResponse = response.shopResponse;
                        alertify.prompt('Phản hồi của Người Bán', '', shopResponse
                            , function (evt, newShopResponse) {
                                $.ajax({
                                    url: "{{ route('productComments.submitShopResponse', '')}}/" + id,
                                    method: 'POST',
                                    data: {
                                        newShopResponse: newShopResponse,
                                    }, beforeSend: function () {
                                        // Disable the link
                                        $this.addClass('disabled');
                                        $this.css('pointer-events', 'none');
                                    },
                                    complete: function () {
                                        // Enable the link
                                        $this.removeClass('disabled');
                                        $this.css('pointer-events', '');
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function (response) {
                                        if (response.success) {

                                            $('#reviewResponseWarning_' + id).remove();
                                            $('#shopResponse_' + id).append(response.reviewResponseWarningView);
                                        } else {
                                            alertify.error(response.message);
                                        }
                                    },
                                    error: function (xhr, status, error) {
                                        console.error(xhr.responseText);
                                        alertify.error(xhr.responseText);
                                    }
                                });

                            }
                            , function () {

                                alertify.error('Cancel')

                            })
                            .set('labels', {ok: 'Save', cancel: 'Cancel'});
                    } else {
                        alertify.error(response.message);
                        shopResponse = ''
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    alertify.error(xhr.responseText);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function () {
            function updateColor($select) {
                var selectedOption = $select.find('option:selected');
                var color = selectedOption.data('color');
                $select.siblings('.color-indicator').css('background-color', color);
            }

            // Initialize background colors and color indicators for all selects
            $('.productComment-status').each(function () {
                updateColor($(this));
            });
            // Event listener for change on .review-status selects
            $('.productComment-status').change(function () {
                var $select = $(this);
                var $hiddenInput = $select.siblings('.previous-productComment-status'); // Find corresponding hidden input
                var previousValue = $hiddenInput.val(); // Get previous selected value from hidden input
                updateColor($select);

                // Show confirmation dialog using alertify
                alertify.confirm('Confirm Message', 'Are you sure you want to change Review Status?',
                    function () { // On confirm
                        var id = $select.data('id');
                        var newStatus = $select.val();//newStatus for db table but is current status of the select
                        // Example of AJAX request to update order status
                        $.ajax({
                            url: "{{ route('productComments.updateProductCommentStatus', '')}}/" + id,
                            method: 'POST',
                            data: {
                                newStatus: newStatus
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (response) {
                                if (response.success) {
                                    alertify.success(response.message);
                                    // Update hidden input with new value after successful update
                                    $hiddenInput.val(newStatus);
                                    $select.val(newStatus);
                                    //important for the updateColor work correctly
                                    // $select.find('option').removeAttr('selected');
                                    // $select.find('option[value="' + newStatus + '"]').attr('selected', true);
                                    updateColor($select);
                                } else {
                                    alertify.error(response.message);
                                    // Revert to previous value on error
                                    $select.val(previousValue);
                                    //important for the updateColor work correctly
                                    // $select.find('option').removeAttr('selected');
                                    // $select.find('option[value="' + previousValue + '"]').attr('selected', true);
                                    updateColor($select);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error(xhr.responseText);
                                alertify.error(xhr.responseText);
                                // Revert to previous value on error
                                $select.val(previousValue);
                                //important for the updateColor work correctly
                                // $select.find('option').removeAttr('selected');
                                // $select.find('option[value="' + previousValue + '"]').attr('selected', true);
                                updateColor($select);
                            }
                        });
                    },
                    function () { // On cancel
                        // Revert to previous value
                        $select.val(previousValue);
                        //important for the updateColor work correctly
                        // $select.find('option').removeAttr('selected');
                        // $select.find('option[value="' + previousValue + '"]').attr('selected', true);
                        updateColor($select);
                        alertify.error('Cancel');
                    }
                );
            });
        });
    </script>
    <script>
        function deleteProductComment(button, productCommentId) {
            const url = $(button).data('url');

            $.ajax({
                url: url,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    if (response.success) {
                        alertify.success(response.message);
                        $('#delRes_' + productCommentId).html(response.html);
                    } else {
                        alertify.error(response.message);
                    }
                },
                error: function (xhr) {
                    alertify.error('An error occurred while deleting the productComment.');
                }
            });
        }

        function restoreProductComment(button, productCommentId) {
            const url = $(button).data('url');

            $.ajax({
                url: url,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    if (response.success) {
                        alertify.success(response.message);
                        $('#delRes_' + productCommentId).html(response.html);
                    } else {
                        alertify.error(response.message);
                    }
                },
                error: function (xhr) {
                    alertify.error('An error occurred while restoring the productComment.');
                }
            });
        }

    </script>
@endsection





