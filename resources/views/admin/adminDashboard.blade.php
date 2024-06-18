@php use App\Utilities\Constant as Constant @endphp
@extends('admin.layouts.admin')
@section('title')
<title>Dashboard</title>
@endsection
@section('this-css')
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">--}}
    <!-- Font Awesome -->
{{--    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">--}}
    <!-- Ionicons -->
{{--    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">--}}
{{--    <!-- Tempusdominus Bootstrap 4 -->--}}
{{--    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">--}}
{{--    <!-- iCheck -->--}}
{{--    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">--}}
{{--    <!-- JQVMap -->--}}
{{--    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">--}}
{{--    <!-- Theme style -->--}}
{{--    <link rel="stylesheet" href="dist/css/adminlte.min.css">--}}
{{--    <!-- overlayScrollbars -->--}}
{{--    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">--}}
{{--    <!-- Daterange picker -->--}}
{{--    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">--}}
{{--    <!-- summernote -->--}}
{{--    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">--}}
{{--<link rel="stylesheet" href="{{asset('admins/DashboardAdminLte/')}}">--}}
{{--<link rel="stylesheet" href="{{asset('admins/DashboardAdminLte/')}}">--}}
{{--<link rel="stylesheet" href="{{asset('admins/DashboardAdminLte/')}}">--}}
<link rel="stylesheet" href="{{asset('admins/DashboardAdminLte/ionicons.min.css')}}">
<link rel="stylesheet" href="{{asset('admins/DashboardAdminLte/tempusdominus-bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{asset('admins/DashboardAdminLte/icheck-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('admins/DashboardAdminLte/jqvmap.min.css')}}">
<link rel="stylesheet" href="{{asset('admins/DashboardAdminLte/adminlte.min.css')}}">
<link rel="stylesheet" href="{{asset('admins/DashboardAdminLte/OverlayScrollbars.min.css')}}">
<link rel="stylesheet" href="{{asset('admins/DashboardAdminLte/daterangepicker.css')}}">
<link rel="stylesheet" href="{{asset('admins/DashboardAdminLte/summernote-bs4.min.css')}}">
<style>
    .inner h3{
        margin: 0;
    }
    .inner p{
        margin: 0;
    }
    .inner {

    }
    #orders-container td.phone,  th{
        width: 10px !important;
        /*vertical-align: middle;*/
    }
</style>
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$ordersCount}}</h3>
                                <p>Total Orders</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <a href="{{route('orders')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$productsCount}}</h3>

                                <p>Total Products</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-database"></i>
                            </div>
                            <a href="{{route('products')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$usersCount}}</h3>

                                <p>Users Number</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <a href="{{route('users')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$reviewsCount}}</h3>

                                <p>Rating & Reviews</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <a href="{{route('productComments')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3 >${{$revenueDay}}</h3>

                                <p>Today Revenue</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign" style="font-size: 40px"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 >${{$revenueWeek}}</h3>

                                <p>Week Revenue</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign" style="font-size: 40px"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 >${{$revenueMonth}}</h3>

                                <p>Month Revenue</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign" style="font-size: 40px"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 >${{$revenueYear}}</h3>

                                <p>Year Revenue</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign" style="font-size: 40px"></i>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-8 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-bar"></i>
                                     &nbsp;Sales by Nearest 15 days
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">

                                        <button type="button" class="btn btn-sm" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </ul>
                                </div>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="revenue-chart"
                                         style="position: relative; height: 300px;">
                                        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                    </div>

                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- DIRECT CHAT -->
                        <div class="card direct-chat direct-chat-primary">
                            <div class="card-header">

                                <h3 class="card-title"><i class="fas fa-cart-plus"></i> Newest Orders List</h3>

                                <div class="card-tools">
                                    {{--                                    <span title="3 New Messages" class="badge badge-primary">3</span>--}}
                                    <a href="{{route('orders')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

{{--                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                                        <i class="fas fa-minus"></i>--}}
{{--                                    </button>--}}
                                    {{--                                    <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">--}}
                                    {{--                                        <i class="fas fa-comments"></i>--}}
                                    {{--                                    </button>--}}
{{--                                    <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
{{--                                        <i class="fas fa-times"></i>--}}
{{--                                    </button>--}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="container">
                                    <div  class="mt-1">

                                        <table class="table">
                                            <thead>
                                            <tr>
                                                @php
                                                    $columns = [
                                                     'id' => ['name' => 'ID', 'sortable' => true],
//                                                     'user_id' => ['name' => 'UserID', 'sortable' => true],
                                                     'first_name' => ['name' => 'Name', 'sortable' => true],
                                                     'phone' => ['name' => 'Phone', 'sortable' => true],
            //                                         'sub_total_amount' => ['name' => 'Tiền Hàng', 'sortable' => false],
            //                                         'total_discount' => ['name' => 'Giảm giá', 'sortable' => false],
            //                                         'delivery_fee' => ['name' => 'Phí Ship', 'sortable' => false],
                                                     'total_amount' => ['name' => 'Total', 'sortable' => false],
//                                                     'payment_type' => ['name' => 'Phương thức thanh toán', 'sortable' => true],
            //                                         'pending_payment' => ['name' => 'Cần thanh toán', 'sortable' => true],
                                                     'payment_status' => ['name' => 'Paid', 'sortable' => true],
                                                     'status' => ['name' => 'Status', 'sortable' => true],
                                                     'created_at' => ['name' => 'Created', 'sortable' => true],
                                                 ];
                                                @endphp

                                                @foreach($columns as $column => $details)
                                                    <th>
{{--                                                        @if($details['sortable'])--}}
{{--                                                            <a href="javascript:void(0);">--}}
{{--                                                                {{ $details['name'] }}--}}
{{--                                                                @if($sortBy === $column)--}}
{{--                                                                    <i class="fa fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>--}}
{{--                                                                @endif--}}
{{--                                                            </a>--}}
{{--                                                        @else--}}
{{--                                                            {{ $details['name'] }}--}}
{{--                                                        @endif--}}
                                                            {{ $details['name'] }}
                                                    </th>
                                                @endforeach
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody id="orders-container" style="height: 591px; overflow-y: scroll">
{{--                                            @foreach($orders as $order)--}}
{{--                                                @php--}}
{{--                                                    //                                    dd($order);--}}
{{--                                                                                            $orderDetail = $order->orderDetails->first();--}}

{{--                                                                                            $user = $order->user;--}}
{{--                                                    //                                        $voucher = $order->voucher;--}}
{{--                                                    //                                        $shippingInfo = $order->shippingInfo;--}}
{{--                                                                                            $orderId = $order->id;--}}
{{--                                                                                            $name = $order->first_name.' '.$order->last_name;--}}
{{--                                                    //                                        $subTotal = $orderDetail->sub_total_amount;//tiền hàng--}}
{{--                                                    //                                        $totalDiscount = $order->total_discount ?? 0;--}}
{{--                                                    //                                        $deliveryFee = $order->delivery_fee ?? 0;--}}
{{--                                                                                            $paymentType = $order->payment_type;--}}
{{--                                                                                            $phone = $order->phone;--}}
{{--                                                                                            $totalAmount = $orderDetail->total??0;--}}
{{--                                                    //                                        $pendingPayment = $order->pending_payment ?? 0;--}}
{{--                                                    //                                        $paymentStatus = $order->payment_status ?? '';--}}
{{--                                                                                            $orderStatus = $order->status ?? '';--}}
{{--                                                                                            $paymentStatus = $order->payment_status ?? '';--}}
{{--                                                                                            $createdAt = $order->created_at->format('H:i d/m/Y');--}}
{{--                                                @endphp--}}
{{--                                                <tr>--}}
{{--                                                    <td style="width:auto;">--}}
{{--                                            <span style="position: relative">--}}
{{--                                            {{ $orderId }}--}}
{{--                                                --}}{{--                                                @if(trim($order->note??''))--}}
{{--                                                --}}{{--                                                    <a class="orderNoteDisplay" id="orderNoteDisplay{{$order->id}}"--}}
{{--                                                --}}{{--                                                       title="Customer Note"--}}
{{--                                                --}}{{--                                                       href="javascript:void(0)"--}}
{{--                                                --}}{{--                                                       onclick="displayOrderNote(this, {{$order->id}})"><i--}}
{{--                                                --}}{{--                                                            class="fas fa-comment-alt"></i></a>--}}
{{--                                                --}}{{--                                                @endif--}}
{{--                                            </span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        {{ $user->id }}--}}
{{--                                                    </td>--}}
{{--                                                    <td>{{$name}}</td>--}}
{{--                                                    <td>{{$phone}}</td>--}}
{{--                                                    <td style="width:10%;">--}}
{{--                                                        $ {{$totalAmount}}--}}
{{--                                                    </td>--}}
{{--                                                    <td>{{$paymentType}}</td>--}}
{{--                                                    <td>--}}
{{--                                                        <div class="paymentSta"--}}
{{--                                                             style="color:{{$paymentStatus == 1 ? '#373434;' : '#01a935' }}"--}}
{{--                                                        >--}}
{{--                                                            {{Constant::$PAYMENT_STATUS[$paymentStatus]}}--}}
{{--                                                        </div>--}}

{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <div class="paymentSta"--}}
{{--                                                             style="color:{{Constant::STATUSCOLORS[$orderStatus]}}; font-size: 1.1em"--}}
{{--                                                        >--}}
{{--                                                                {{Constant::$ORDER_STATUS[$orderStatus]}}--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
{{--                                                    <td>{{ $createdAt }}</td>--}}
{{--                                                    <td>--}}
{{--                                                        <div class="dropdown" style=" margin-bottom: 5px; margin-right: 5px">--}}
{{--                                                            <button class="btn btn-secondary dropdown-toggle" type="button"--}}
{{--                                                                    id="dropdownMenuButton" data-toggle="dropdown"--}}
{{--                                                                    aria-haspopup="true" aria-expanded="false">--}}
{{--                                                                Actions--}}
{{--                                                            </button>--}}
{{--                                                            <div class="dropdown-menu dropdown-menu-right"--}}
{{--                                                                 aria-labelledby="dropdownMenuButton"--}}
{{--                                                                 id="actionOptions_{{$order->id}}">--}}
{{--                                                                <a class="dropdown-item"--}}
{{--                                                                   href="{{route('orders.orderDetails',['order'=> $order->id])}}"><i--}}
{{--                                                                        class="fas fa-eye"></i> Order Details</a>--}}

{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endforeach--}}
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="pagination-container" class=" d-flex justify-content-center " >

                                    </div>
                                </div>

                            </div>
                            <!-- /.card-footer-->
                        </div>
{{--                        <div class="card direct-chat direct-chat-primary">--}}
{{--                            <div class="card-header">--}}
{{--                                <h3 class="card-title">Top selling Products in 7 days--}}

{{--                                </h3>--}}

{{--                                <div class="card-tools">--}}
{{--                                    <a href="{{route('products')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}

{{--                                    --}}{{--                                    <span title="3 New Messages" class="badge badge-primary">3</span>--}}
{{--                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                                        <i class="fas fa-minus"></i>--}}
{{--                                    </button>--}}

{{--                                    --}}{{--                                    <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">--}}
{{--                                    --}}{{--                                        <i class="fas fa-comments"></i>--}}
{{--                                    --}}{{--                                    </button>--}}
{{--                                    <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
{{--                                        <i class="fas fa-times"></i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-header -->--}}
{{--                            <div class="card-body">--}}
{{--                                <!-- Conversations are loaded here -->--}}

{{--                            </div>--}}
{{--                            <!-- /.card-footer-->--}}
{{--                        </div>--}}
                        <!--/.direct-chat -->


                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-4 connectedSortable">

                        <!-- Map card -->
                        <div class="card ">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-pie mr-1"></i>
                                    Today Order Status Report
                                </h3>
                                <!-- card tools -->
                                <div class="card-tools">
{{--                                    <button type="button" class="btn  btn-sm " title="Date range">--}}
{{--                                        <i class="far fa-calendar-alt"></i>--}}
{{--                                    </button>--}}
                                    <button type="button" class="btn  btn-sm" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <div class="card-body">
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body-->
                            <div class="card-footer bg-transparent">
                                <div class="row justify-content-center">
                                    <div class="row d-flex  mt-4">
                                        <div id="chart-legend" class="col-md-12 text-center d-flex justify-content-around"></div>
                                    </div>
                                </div>

                                <!-- /.row -->
                            </div>

                        </div>
                        <!-- /.card -->

                        <!-- solid sales graph -->
                        <div class="card ">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-bar"></i>

                                    Top Selling Products
                                </h3>

                                <div class="card-tools">
                                    <a href="{{route('orders')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

                                    {{--                                    <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">--}}
{{--                                        <i class="fas fa-times"></i>--}}
{{--                                    </button>--}}
                                </div>
                            </div>
                            <div class="card-body pt-1" id="t_products-container" style="height:570px; overflow-y: scroll">
{{--                                @foreach($t_products as $t_product)--}}
{{--                                    @php--}}
{{--                                        $product = \App\Models\Product::find($t_product->product_id);--}}
{{--                                        $thumbImgPath = $product->productImages()->first()->path??'';--}}

{{--                                    @endphp--}}
{{--                                    <div class="d-flex " style="font-size: 1.1em">--}}
{{--                                        <img src="{{asset("front/img/product/$thumbImgPath")}}" style="max-width:75px">--}}

{{--                                        <div class="pl-3">--}}
{{--                                            <p class="text-primary ">Sold: {{$t_product->total_quantity_sold}}</p>--}}
{{--                                            <p class="text-secondary">{{$product->name}}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <hr class="mt-1">--}}
{{--                                @endforeach--}}

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer bg-transparent pb-0 d-flex justify-content-center" id="t_product_pagination-container">
{{--                                --}}
                                <!-- /.row -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->

                        <!-- Calendar -->
{{--                        <div class="card bg-gradient-success">--}}
{{--                            <div class="card-header border-0">--}}

{{--                                <h3 class="card-title">--}}
{{--                                    <i class="far fa-calendar-alt"></i>--}}
{{--                                    Calendar--}}
{{--                                </h3>--}}
{{--                                <!-- tools card -->--}}
{{--                                <div class="card-tools">--}}
{{--                                    <!-- button with a dropdown -->--}}
{{--                                    <div class="btn-group">--}}
{{--                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">--}}
{{--                                            <i class="fas fa-bars"></i>--}}
{{--                                        </button>--}}
{{--                                        <div class="dropdown-menu" role="menu">--}}
{{--                                            <a href="#" class="dropdown-item">Add new event</a>--}}
{{--                                            <a href="#" class="dropdown-item">Clear events</a>--}}
{{--                                            <div class="dropdown-divider"></div>--}}
{{--                                            <a href="#" class="dropdown-item">View calendar</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">--}}
{{--                                        <i class="fas fa-minus"></i>--}}
{{--                                    </button>--}}
{{--                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">--}}
{{--                                        <i class="fas fa-times"></i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                                <!-- /. tools -->--}}
{{--                            </div>--}}
{{--                            <!-- /.card-header -->--}}
{{--                            <div class="card-body pt-0">--}}
{{--                                <!--The calendar -->--}}
{{--                                <div id="calendar" style="width: 100%"></div>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-body -->--}}
{{--                        </div>--}}
                        <!-- /.card -->
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('this-js')
    <script src="{{asset('admins/DashboardAdminLte/jquery-ui.min.js')}}"></script>

{{--    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>--}}
{{--    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->--}}
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
{{--    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>--}}
{{--    <!-- ChartJS -->--}}
{{--    <script src="plugins/chart.js/Chart.min.js"></script>--}}
{{--    <!-- Sparkline -->--}}
{{--    <script src="plugins/sparklines/sparkline.js"></script>--}}
{{--    <!-- JQVMap -->--}}
{{--    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>--}}
{{--    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>--}}
{{--    <!-- jQuery Knob Chart -->--}}
{{--    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>--}}
{{--    <!-- daterangepicker -->--}}
{{--    <script src="plugins/moment/moment.min.js"></script>--}}
{{--    <script src="plugins/daterangepicker/daterangepicker.js"></script>--}}
{{--    <!-- Tempusdominus Bootstrap 4 -->--}}
{{--    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>--}}
{{--    <!-- Summernote -->--}}
{{--    <script src="plugins/summernote/summernote-bs4.min.js"></script>--}}
{{--    <!-- overlayScrollbars -->--}}
{{--    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>--}}
{{--    <!-- AdminLTE App -->--}}
{{--    <script src="dist/js/adminlte.js"></script>--}}
{{--    <!-- AdminLTE for demo purposes -->--}}
{{--    <script src="dist/js/demo.js"></script>--}}
{{--    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->--}}
{{--    <script src="dist/js/pages/dashboard.js"></script>--}}
    <script src="{{asset('admins/DashboardAdminLte/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admins/DashboardAdminLte/Chart.min.js')}}"></script>
    <script src="{{asset('admins/DashboardAdminLte/sparkline.js')}}"></script>
    <script src="{{asset('admins/DashboardAdminLte/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('admins/DashboardAdminLte/jquery.vmap.usa.js')}}"></script>
    <script src="{{asset('admins/DashboardAdminLte/jquery.knob.min.js')}}"></script>
    <script src="{{asset('admins/DashboardAdminLte/moment.min.js')}}"></script>
    <script src="{{asset('admins/DashboardAdminLte/daterangepicker.js')}}"></script>
    <script src="{{asset('admins/DashboardAdminLte/tempusdominus-bootstrap-4.min.js')}}"></script>
    <script src="{{asset('admins/DashboardAdminLte/summernote-bs4.min.js')}}"></script>
    <script src="{{asset('admins/DashboardAdminLte/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{asset('admins/DashboardAdminLte/adminlte.js')}}"></script>
    <script src="{{asset('admins/DashboardAdminLte/demo.js')}}"></script>
    <script src="{{asset('admins/DashboardAdminLte/dashboard.js')}}"></script>


    <script>
        $(document).ready(function() {
            // AJAX request to fetch data for the chart
            $.ajax({
                url: "{{ route('getOrdersForChart') }}",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Data returned from server
                    var labels = response.labels;
                    var dataset = response.dataset;
                    // alertify.success(dataset);
                    // console.log(labels);
                    // Create Chart.js chart
                    var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
                    // $('#revenue-chart').get(0).getContext('2d');

                    var salesChartData = {
                        labels: labels,
                        datasets: dataset
                    }

                    var salesChartOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                        legend: {
                            display: false
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    display: false
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    display: false
                                }
                            }]
                        }
                    }

                    // This will get the first returned node in the jQuery collection.
                    // eslint-disable-next-line no-unused-vars
                    var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
                        type: 'line',
                        data: salesChartData,
                        options: salesChartOptions
                    })
                },
                error: function(error) {
                    console.log(error); // Handle error as needed
                }
            });
        });
    </script>

    <script>

        $(document).ready(function() {
            // AJAX request to fetch data for the chart
            $.ajax({
                url: "{{ route('getTodayOrderStatusData') }}",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Data returned from server
                    var labels = response.labels;
                    var data = response.data;
                    var backgroundColors = response.backgroundColors;
                    // alertify.success(dataset);
                    // console.log(labels);
                    // Create Chart.js chart
                    var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
                    var pieData = {
                        labels: labels,
                        datasets: [
                            {
                                data: data,
                                backgroundColor: backgroundColors
                            }
                        ]
                    }
                    var pieOptions = {
                        legend: {
                            display: false
                        },
                        maintainAspectRatio: false,
                        responsive: true
                    }
                    // Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    // eslint-disable-next-line no-unused-vars
                    var pieChart = new Chart(pieChartCanvas, { // lgtm[js/unused-local-variable]
                        type: 'doughnut',
                        data: pieData,
                        options: pieOptions
                    })
                    const legendContainer = $('#chart-legend');
                    legendContainer.empty(); // Clear existing content
                    $.each(labels, function(index, label) {
                        const backgroundColor = backgroundColors[index];
                        const legendItem = `<span class="ml-2" >
                              <span  class="legend-box" style="background-color:${backgroundColor}; display:inline-block; width:12px; height:12px;"></span>${label}
                            </span>`;
                        legendContainer.append(legendItem);
                    });
                },
                error: function(error) {
                    console.log(error); // Handle error as needed
                }
            });
        });


    </script>
    <script>
        function fetchOrders(pageUrl = '/admin/getLatestOrders?page=1') {
            $.ajax({
                url: pageUrl,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#orders-container').html(response.orders_table_html);
                    $('#pagination-container').html(response.pagination_buttons);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching orders:', error);
                }
            });
        }

        $(document).ready(function() {
            fetchOrders(); // Fetch the first page on page load
            $('#pagination-container').on('click', '.btn', function() {
                // Event handler function
                var $this = $(this);
                var url = $this.data('url')
                // alertify.success(url+'');
                fetchOrders(url);
            });
        });

    </script>

    <script>
        function fetchProducts(pageUrl = '/admin/getBestSellingProducts?page=1') {
            $.ajax({
                url: pageUrl,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // console.log(response.products_table_html);
                    // return false;
                    $('#t_products-container').html(response.products_table_html);
                    $('#t_product_pagination-container').html(response.pagination_buttons);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching orders:', error);
                }
            });
        }

        $(document).ready(function() {
            fetchProducts(); // Fetch the first page on page load
            $('#t_product_pagination-container').on('click', '.btn', function() {
                // Event handler function
                var $this = $(this);
                var url = $this.data('url')
                // alertify.success(url+'');
                fetchProducts(url);
            });
        });

    </script>

@endsection





