@php use App\Utilities\Constant; @endphp
@extends('admin.layouts.admin')
@section('title')
    <title>Danh Sách Mã Giám Giá</title>
@endsection
@section('this-css')

    <link rel="stylesheet" href="{{asset('admins/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/css/bs513/bootstrap.css')}}">
    <style>
        .select2 {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--multiple {
            height: auto;
        }

        .select2-selection__choice {
            background-color: #3b3b3b !important;
        }

        .logo {
            max-width: 135px;
            height: 80px;
            object-fit: cover;
        }

        .banner {
            max-width: 230px;
            height: 80px;
            object-fit: cover;
        }

        .table td, .table th {
            vertical-align: middle;
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
            min-height: 38px;
        }
        .nav-item#coupon {
            background-color: rgba(255, 255, 255, .1);
            color: #fff;
        }
    </style>
@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header',['name' => '', 'key' => 'Danh Sách Mã Giảm Giá','url' => ''])
        <hr style="margin-block: 5px;">
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <form method="GET" action="{{ route('coupons') }}" class="p-3">
                <input type="hidden" name="sort_by" value="{{ request('sort_by', $sortBy) }}">
                <input type="hidden" name="sort_direction" value="{{ request('sort_direction', $sortDirection) }}">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="show_deleted" id="show_deleted"
                                   value="yes" {{ $showDeleted === 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="show_deleted">
                                Display hidden Vouchers?
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        {{--                        <label for="search_term">Search</label>--}}
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
                    <div class="col-md-12" style="display: flex; justify-content: end;">
                        <button type="button" class="btn btn-primary createCoupon" data-bs-toggle="modal"
                                data-bs-target="#createCouponModal">
                            Create new Voucher
                        </button>
                    </div>
                    <div class="div col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                @php
                                    $columns = [
                                     'coupon_id' => ['name' => 'ID', 'sortable' => true],
                                     'coupon_name' => ['name' => 'Name', 'sortable' => true],
                                     'coupon_time' => ['name' => 'Time', 'sortable' => true],
                                     'coupon_condition' => ['name' => 'Type', 'sortable' => true],
                                     'coupon_number' => ['name' => 'Amount Number', 'sortable' => true],
                                     'coupon_code' => ['name' => 'Code', 'sortable' => true],
                                     'created_at' => ['name' => 'created_at', 'sortable' => true],
                                     'updated_at' => ['name' => 'updated_at', 'sortable' => true],

                                 ];
                                @endphp

                                @foreach($columns as $column => $details)
                                    <th>
                                        @if($details['sortable'])
                                            <a href="{{ route('coupons', [
                                                        'sort_by' => $column,
                                                        'sort_direction' => $sortBy === $column && $sortDirection === 'asc' ? 'desc' : 'asc',
                                                        'search_term' => request('search_term', $searchTerm),
                                                        'show_deleted' => request('show_deleted', $showDeleted),
                                                        'page' => $coupons->currentPage(), // Preserve current page

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
                            @foreach ($coupons as $coupon)
                                <tr>
                                    <th scope="row">{{ $coupon->coupon_id}}</th>
                                    <td>{{ $coupon->coupon_name }}</td>
                                    <td>{{ $coupon->coupon_time.' ngày' }}</td>
                                    <td>{{ Constant::$COUPON_CONDITION[$coupon->coupon_condition] }}</td>
                                    <td>@if($coupon->coupon_condition==1)
                                            {{ $coupon->coupon_number.' %'}}
                                        @else
                                            {{ '$ '.$coupon->coupon_number}}
                                        @endif</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>{{ $coupon->created_at }}</td>
                                    <td>{{ $coupon->updated_at }}</td>
                                    <td>
                                        <button style="margin-left: 15px !important;" type="button"
                                                class="btn btn-primary edit-coupon" data-bs-toggle="modal"
                                                data-bs-target="#editCouponModal" data-couponid="{{ $coupon->coupon_id }}">
                                            <i class="fas fa-edit"></i> Edit Voucher
                                        </button>
                                        <span id="delRes_{{$coupon->coupon_id }}">
                                             @if($coupon->deleted_at)
                                                <button type="button" class="btn btn-success"
                                                        onclick="restoreCoupon(this, {{ $coupon->coupon_id  }})"
                                                        title="Restore"
                                                        data-url="{{ route('coupons.restore', $coupon->coupon_id ) }}"
                                                        id="restoreBtn_{{ $coupon->coupon_id  }}">
                                                        <i class="fas fa-undo"></i>
                                                </button>
                                            @else
                                                <a title="Delete" href="javascript:void(0);"
                                                   class="btn btn-danger delete-coupon"
                                                   onclick="deleteCoupon(this, {{ $coupon->coupon_id  }})"
                                                   data-url="{{ route('coupons.delete', $coupon->coupon_id ) }}">
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
                            {{ $coupons->appends([
                                    'sort_by' =>  request('sort_by', $sortBy),
                                    'sort_direction' =>  request('sort_direction', $sortDirection),
                                    'search_term' => request('search_term', $searchTerm),
                                    'show_deleted' => request('show_deleted', $showDeleted),
                                ])->links('vendor.pagination.bootstrap-4')}}
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="createCouponModal" tabindex="-1" role="dialog"
         aria-labelledby="createCouponModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCouponModalLabel">Create New Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="createCouponModalForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="number" class="form-control" id="time" name="time" min="0" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" id="type" name="type" required>
                                @foreach(Constant::$COUPON_CONDITION as $key => $condition)
                                    <option value="{{ $key }}">{{ $condition }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="amount">Amount Number</label>
                            <input type="number" class="form-control" id="amount" name="amount" min="0" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Voucher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editCouponModal" tabindex="-1"
         aria-labelledby="editCouponModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCouponLabel">Edit Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="editCouponForm" enctype="multipart/form-data" class="placeholder-glow">
                    <div class="modal-body">

                            <div class="form-group">
                                <label for="edit_name">Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                                <div class="invalid-feedback"></div>
                                <span class="placeholder col-12"></span>
                            </div>

                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_time">Time</label>
                            <input type="number" class="form-control" id="edit_time" name="time" min="0" required>
                            <div class="invalid-feedback"></div>
                            <span class="placeholder col-12"></span>

                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_type">Type</label>
                            <select class="form-control" id="edit_type" name="type" required>
                                @foreach(Constant::$COUPON_CONDITION as $key => $condition)
                                    <option value="{{ $key }}">{{ $condition }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                            <span class="placeholder col-12"></span>

                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_amount">Amount Number</label>
                            <input type="number" class="form-control" id="edit_amount" name="amount" min="0" required>
                            <div class="invalid-feedback"></div>
                            <span class="placeholder col-12"></span>

                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_code">Code</label>
                            <input type="text" class="form-control" id="edit_code" name="code" required>
                            <div class="invalid-feedback"></div>
                            <span class="placeholder col-12"></span>

                        </div>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Voucher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('this-js')
    <script src="{{asset('admins/js/select2.min.js')}}"></script>
    <script src="{{asset('admins/js/bs513/bootstrap.bundle.js')}}"></script>


    <script>
        $(document).on('click', '.createCoupon', function (e) {
            e.preventDefault();
            $('#createCouponModalForm').on('submit', function (e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(this);
                //reset validation signal
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').text('');
                $.ajax({
                    url: "{{ route('coupons.store', '')}}", // Adjust route as necessary
                    type: 'POST',
                    data: formData,
                    processData: false, // Important for FormData
                    contentType: false, // Important for FormData
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//important incase this code is in the blade and not in a separate js file
                    success: function (response) {
                        if (response.success) {
                            location.reload()
                            console.log(response);
                            // $('#createProductItem').modal('hide');
                            // alertify.success(response.message)
                        } else {
                            alertify.error(response.message)
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        var errors = xhr.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            console.log(key);
                            console.log(value);
                            var field = form.find('[name="' + key + '"]');
                            field.addClass('is-invalid');
                            field.next('.invalid-feedback').text(value);
                        });
                    }
                });
            });
        });
    </script>
    <script>

        $(document).on('click', '.edit-coupon', function (e) {
            // e.preventDefault();


            // return false;
            var couponId = $(this).data('couponid');
            // alertify.success('ho' + couponId);
            // alertify.success(''+productDetailId+" "+productId);
            var $form = $('#editCouponForm');
            // $form.reset();
            $form.find('.is-invalid').removeClass('is-invalid');
            $form.find('.invalid-feedback').text('');
            $('#editCouponLabel').text('Edit Voucher #' + couponId);
            ///wait for 5s to continue
            $form.find('[name]').hide();
            $form.find('[type="submit"]').addClass('disabled');
            $form.find('.placeholder').show();
            $.ajax({
                url: "{{ route('coupons.edit', '') }}/" + couponId,
                type: 'GET',
                success: function (response) {
                    $form.find('[name]').show();
                    $form.find('[type="submit"]').removeClass('disabled');
                    $form.find('.placeholder').hide();
                    var coupon = response.coupon;
                    $('#edit_name').val(coupon.coupon_name);
                    $('#edit_time').val(coupon.coupon_time);
                    $('#edit_type').val(coupon.coupon_condition);
                    $('#edit_amount').val(coupon.coupon_number);
                    $('#edit_code').val(coupon.coupon_code );
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching voucher detail data:", error);
                }
            });
            // Handle form submission for editing product
            $('#editCouponForm').on('submit', function (e) {
                e.preventDefault();
                // e.stopPropagation()
                var form = $(this);
                var formData = new FormData(this);
                //reset validation signal
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').text('');
                $.ajax({
                    url: "{{ route('coupons.update', '')}}/" + couponId, // Adjust route as necessary
                    type: 'POST',
                    data: formData,
                    processData: false, // Important for FormData
                    contentType: false, // Important for FormData
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//important incase this code is in the blade and not in a separate js file
                    success: function (response) {
                        if (response.success) {
                            location.reload()
                            console.log(response);
                            // $('#createProductItem').modal('hide');
                            // alertify.success(response.message)
                        } else {
                            alertify.error(response.message)
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        var errors = xhr.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            console.log(key);
                            console.log(value);
                            var field = form.find('[name="' + key + '"]');
                            field.addClass('is-invalid');
                            field.next('.invalid-feedback').text(value);
                        });
                    }
                });
            });
        });
    </script>
    <script>
        function deleteCoupon(button, couponId) {
            const url = $(button).data('url');

            $.ajax({
                url: url,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    if (response.success) {
                        alertify.success(response.message);
                        $('#delRes_' + couponId).html(response.html);
                    } else {
                        alertify.error(response.message);
                    }
                },
                error: function (xhr) {
                    alertify.error('An error occurred while deleting the coupon.');
                }
            });
        }

        function restoreCoupon(button, couponId) {
            const url = $(button).data('url');

            $.ajax({
                url: url,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    if (response.success) {
                        alertify.success(response.message);
                        $('#delRes_' + couponId).html(response.html);
                    } else {
                        alertify.error(response.message);
                    }
                },
                error: function (xhr) {
                    alertify.error('An error occurred while restoring the coupon.');
                }
            });
        }

    </script>
@endsection





