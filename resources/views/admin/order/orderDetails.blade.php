@php use App\Utilities\Constant; @endphp
@extends('admin.layouts.admin')
@section('title')
    <title>Danh Sách Đơn Hàng</title>
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
    </style>
@endsection
@section('content')
    @php
        //        $ORDERS_STATUSES = App\Constants\OrderConstants::ORDERSSTATUSES;
        //        $PAYMENT_STATUSES = App\Constants\OrderConstants::PAYMENTSTATUSES;
        //        $STATUS_COLORS = App\Constants\OrderConstants::STATUSCOLORS;
        //    dd($orderDetails->latest()->get());
    @endphp
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{--        <div style="display: flex; justify-content: end" >    {{(explode('.',request()->route()->getName())[0]). '.' .'search'}}--}}
        @include('admin.partials.content-header',['name' => 'Danh Sách Orders', 'key' => 'Chi tiết đơn hàng','url' => route('orders')])
        {{--            breadCrumb--}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        {{--                                <div class="callout callout-info">--}}
                        {{--                                    <h5><i class="fas fa-info"></i> Note:</h5>--}}
                        {{--                                    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.--}}
                        {{--                                </div>--}}


                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> Shop Runner.
                                        <small class="float-right">{{$order->created_at}}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>Shop Runner</strong><br>
                                        Detech Building 8a Tôn Thất Thuyết<br>
                                        Mỹ Đình, Cầu Giấy, Hà Nội<br>
                                        Phone: 0961056732<br>
                                        Email: ShopRunner@gmail.com
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>{{$order->first_name.' '.$order->last_name}}</strong><br>
                                        {{$order->street_address}}<br>
                                        {{$order->town_city}},{{$order->country}}<br>
                                        Phone: {{$order->phone}}<br>
                                        Email: {{$order->email}}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Invoice #007612</b><br>
                                    <br>
                                    <b>Order ID:</b> #{{$order->id}}<br>
                                    <b>Payment Due:</b> {{ $order->created_at->format('Y-m-d') }}<br>
                                    <b>Usr ID:</b> #{{$order->user->id}}
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Qty</th>
                                            <th>Product</th>
                                            <th>Image</th>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>SKU #</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orderDetails as $key => $orderDetail)
                                            @php
                                                $product = \App\Models\Product::find($orderDetail->product_id);
                                                $thumbImgPath = $product->productImages()->first()->path;
                                                $size = $orderDetail->size;
                                                $color = $orderDetail->color;
                                                $coupon = $orderDetail->coupon;
                                            @endphp
                                            <tr>
                                                <td>{{$orderDetail->qty}}</td>
                                                <td>{{strlen($product->name) > 50 ? substr($product->name, 0, 50).'...':$product->name}}</td>
                                                <td><img src="{{asset("front/img/product/$thumbImgPath")}}"
                                                         style="max-width:75px"></td>
                                                <td>{{$orderDetail->size}}</td>
                                                <td>{{Constant::$COLORS[$orderDetail->color]}}</td>
                                                <td>{{$product->sku}}</td>
                                                <td>{{ strlen($product->description) > 50 ? substr($product->description, 0, 50).'...':$product->description}}</td>
                                                <td>$ {{$orderDetail->amount}}</td>
                                                <td>$ {{$orderDetail->qty*$orderDetail->amount}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">
                                    <p class="lead">Payment Methods: {{$order->payment_type}}</p>
                                    <img src={{asset("front/img/payment.png")}} alt="">
                                    <p class="mt-3 ">Order Note:</p>
                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        @if($order->note)
                                        {{$order->note}}
                                        @else
                                            Đóng gói hàng an toàn và đầy đủ phụ kiện cho tôi, tốt tôi sẽ mua thêm! Cảm ơn
                                            shop
                                        @endif
                                    </p>
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <p class="lead">Amount Due: {{$order->created_at->format('Y-m-d')}}</p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>$ {{$totalAmount}}</td>
                                            </tr>
                                            <tr>
                                                <th>Tax</th>
                                                <td>$ 0</td>
                                            </tr>
                                            <tr>
                                                <th>Shipping:</th>
                                                <td>$ {{$shippingFee}}</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>$ {{$total}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12 d-flex justify-content-between " id="buttonsBox">
                                    <span
                                        class="mt-5"
                                        style="background-color:#f8f9fb; border: solid     1px grey; padding: 10px; color:{{Constant::STATUSCOLORS[$order->status]}}">{{Constant::$ORDER_STATUS[$order->status]}}</span>
                                    <div>
                                        @php
                                            $orderStatus = $order->status; // assuming $order is the order object
                                        @endphp

                                        @if($orderStatus < 3)
                                            <button type="button" class="cancel-button btn btn-primary"
                                                    onclick="changeStatus(5)">Cancel Order
                                            </button>
                                        @endif

                                        @if($orderStatus < 4)
                                            @php
                                                $nextStatus = $orderStatus + 1;
                                                $nextStatusName = '';
                                                switch($nextStatus) {
//                                                                                        case Constant::ORDER_STATUS_RECEIVEORDERS:
//                                                                                            $nextStatusName = 'Receive Orders';
//                                                                                            break;
                                                    case Constant::ORDER_STATUS_CONFIRMED:
                                                        $nextStatusName = 'Confirm';
                                                        break;
                                                    case Constant::ORDER_STATUS_SHIPPING:
                                                        $nextStatusName = 'Shipping';
                                                        break;
                                                    case Constant::ORDER_STATUS_FINISH:
                                                        $nextStatusName = 'Finish';
                                                        break;
                                                }
                                            @endphp
                                            <button class="status-button btn btn-primary" type="button" style="    margin-right: 69px;
    margin-left: 2.7px;"
                                                    onclick="changeStatus({{ $nextStatus }})">{{ $nextStatusName }}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
@section('this-js')
    <script type="text/javascript">
        var orderStatuses = @json(Constant::$ORDER_STATUS);

        function changeStatus(status) {
            var statusLabel = `"${orderStatuses[status]}"`;
            alertify.confirm('Are you sure you want to change Order Status?', 'This will change the Order Status to ' + statusLabel,
                function(){
                    $.ajax({
                        url: "{{ route('changeStatus') }}", // Define your route
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}", // CSRF token
                            order_id: "{{ $order->id }}", // Pass the order ID
                            status: status
                        },
                        success: function(response) {
                            if(response.success) {
                                // Update the status text and color
                                // Update the buttons dynamically
                                $('#buttonsBox').html(response.buttonsHtml);
                                alertify.success('Successful to change status');
                            } else {
                                alertify.error('Failed to change status');
                            }
                        },
                        error: function() {
                            alert('Error occurred');
                        }
                    });
                },
                function(){ alertify.error('Cancel')});
        }
    </script>

@endsection





