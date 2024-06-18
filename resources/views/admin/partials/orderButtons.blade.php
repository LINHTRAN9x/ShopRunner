@php use App\Utilities\Constant; @endphp
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
