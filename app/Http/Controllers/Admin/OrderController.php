<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class OrderController extends Controller
{
    public function index(Request $request) {
        try {
            $sortBy = $request->get('sort_by', 'created_at'); // Default column to sort by
            $sortDirection = $request->get('sort_direction', 'desc'); // Default sort direction
            $showDeleted = $request->get('show_deleted', 'no'); // Default to not showing deleted
            $searchTerm = $request->get('search_term', '');

            $order_status = $request->get('order_status', null);
            $payment_status = $request->get('payment_status', null);


            // Validate sort direction
            if (!in_array($sortDirection, ['asc', 'desc'])) {
                $sortDirection = 'desc';
            }
            $query = Order::query();
            // Fetch orders with or without trashed ones
            if ($showDeleted === 'yes') {
                $query = $query->withTrashed();
            }
            if ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('id', 'like', "%$searchTerm%")
                        ->orWhere('user_id', 'like', "%$searchTerm%")
                        ->orWhere('last_name', 'like', "%$searchTerm%")
                        ->orWhere('company_name', 'like', "%$searchTerm%")
                        ->orWhere('country', 'like', "%$searchTerm%")
                        ->orWhere('street_address', 'like', "%$searchTerm%")
                        ->orWhere('postcode_zip', 'like', "%$searchTerm%")
                        ->orWhere('town_city', 'like', "%$searchTerm%")
                        ->orWhere('email', 'like', "%$searchTerm%")
                        ->orWhere('phone', 'like', "%$searchTerm%")
                        ->orWhere('payment_type', 'like', "%$searchTerm%")
                        ->orWhere('shipping_method', 'like', "%$searchTerm%")
                        ->orWhere('status', 'like', "%$searchTerm%")
                        ->orWhere('created_at', 'like', "%$searchTerm%")
                        ->orWhere('note', 'like', "%$searchTerm%")
                        ->orWhere('first_name', 'like', "%$searchTerm%");
                })
                    ->orWhereHas('orderDetails', function ($query) use ($searchTerm) {
                        $query->where(function ($query) use ($searchTerm) {
                            $query->where('product_id', 'like', "%$searchTerm%")
                                ->orWhere('qty', 'like', "%$searchTerm%") // Added column
                                ->orWhere('total', 'like', "%$searchTerm%") // Added column
                                ->orWhere('size', 'like', "%$searchTerm%") // Added column
                                ->orWhere('color', 'like', "%$searchTerm%") // Added column
                                ->orWhere('coupon', 'like', "%$searchTerm%"); // Added column
                        });
                    })
//                ->orWhereHas('voucher', function ($query) use ($searchTerm) {
//                $query->where(function ($query) use ($searchTerm) {
//                    $query->where('code', 'like', "%$searchTerm%");
////                        ->orWhere('email', 'like', "%$searchTerm%") // Added column
////                        ->orWhere('phone_number', 'like', "%$searchTerm%"); // Added column
//                });
//            })
                    ->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where(function ($query) use ($searchTerm) {
                            $query->where('name', 'like', "%$searchTerm%");
//                        ->orWhere('id', 'like', "%$searchTerm%") // Added column
//                        ->orWhere('phone_number', 'like', "%$searchTerm%"); // Added column
                        });
                    });
            }

            if ($order_status !== null) {
                $query = $query->where('status', $order_status);
            }

//        if ($payment_status !== null) {
//            $query = $query->where('payment_status', $payment_status);
//        }

            $query->orderBy($sortBy, $sortDirection);

            $orders = $query->paginate(4);

            return view('admin.order.index', compact('orders', 'sortBy', 'sortDirection', 'showDeleted', 'order_status', 'payment_status', 'searchTerm'));
        }catch(\Exception $exception) {
            return redirect()->route('home')->with('error', 'Something went wrong!');
        }
    }

    public function delete(Request $request, $order_id)
    {
        $order = Order::findOrFail($order_id);
        $order->delete();
        return redirect(route('orders'));
    }

    public function restore(Request $request)
    {
        $order_id = $request->order_id;
        // Fetch categories based on showDeleted value
        $softDeletedOrder = Order::withTrashed()->find($order_id);
        if ($softDeletedOrder) {

            $softDeletedOrder->restore();

            // Category found, you can perform further actions here
            return response()->json(['success' => true ,'message' => 'Restore thành công.', 'softDeletedOrder' => $softDeletedOrder]);
        } else {
            // Category not found
            return response()->json(['success'=> false, 'message' => 'Order not found.']);
        }
    }

    public function updatePaymentStatus(Request $request) {
        try {
            $newStatus = $request->newStatus;
            $orderId = $request->orderId;
            $order = Order::findOrfail($orderId);
            if ($order) {
                $order->payment_status = $newStatus; // Replace 'Paid' with the actual status
                // Save the changes
                $order->save();
                return response()->json(['success' => true, 'message' => 'Payment Status Changed successfully.']);
            }
            return response()->json(['success' => false, 'message' => 'Order not found,Payment Status change failure.']);
        }catch(\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Something went wrong,Payment Status change failure.', 404]);
        }
    }
    public function updateOrderStatus(Request $request) {
        try {
            $newStatus = $request->newStatus;
            $orderId = $request->orderId;

            $order = Order::findOrfail($orderId);
            if ($order) {
                $order->status = $newStatus; // Replace 'Paid' with the actual status
                // Save the changes
                $order->save();

                return response()->json(['success' => true, 'message' => 'Order Status Changed successfully.']);
            }
            return response()->json(['success' => false, 'message' => 'Order not found,Order Status change failure.']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Something went wrong,Order Status change failure.', 404]);
        }
    }
    public function updateDeliveryFee(Request $request) {
        try {
            $newDeliveryFee = $request->newDeliveryFee;
            $orderId = $request->orderId;
            $order = Order::findOrfail($orderId);
            $oldTotalAmount = $order->sub_total_amount - $order->total_discount;
            $newTotalAmount = $oldTotalAmount + (int)$newDeliveryFee;
            if ($order && $oldTotalAmount && $newTotalAmount) {
                $order->delivery_fee = $newDeliveryFee; // Replace 'Paid' with the actual status
                $order->total_amount = $newTotalAmount;
                // Save the changes

                switch ($order->payment_status) {
                    case 'Chưa Thanh Toán':
                        $pendingPayment = $newTotalAmount;
                        $order->pending_payment  = $pendingPayment;
                        break;
                    case 'Đã thanh toán Phí Ship':
                        $pendingPayment = $oldTotalAmount;
                        $order->pending_payment  = $pendingPayment;
                        break;
                    case 'Đã thanh toán Tiền Hàng':
                        $pendingPayment = (int)$newDeliveryFee;
                        $order->pending_payment  = $pendingPayment;
                        break;
                    case 'Đã thanh toán toàn bộ':
                        $order->pending_payment  = 0;
                        break;
                    default :
                        $order->pending_payment  = 0;
                }
                $order->save();


                return response()->json(['success' => true, 'message' => 'Order Fee Updated successfully.', 'totalAmount' => number_format($order->total_amount, 0, ',', '.'), 'pendingPayment'=>number_format($order->pending_payment, 0, ',', '.')]);
            }
            return response()->json(['success' => false, 'message' => 'Order not found,Order Fee Updated failure.']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Order not found,Order Fee Updated failure.', 404]);
        }
    }


    public function orderDetails(Request $request, Order $order) {

        $user = $order->user;
        $orderDetails = $order->orderDetails();
//        dd($orderDetails->latest()->get());
        // Calculate total quantity (sum of qty for all order details)
        $totalQuantity = $orderDetails->sum('qty');

        // Calculate total amount (sum of amount for all order details)
        $totalAmount = 0;
        foreach ($order->orderDetails()->get() as $orderDetail) {
            $totalAmount+=$orderDetail->amount * $orderDetail->qty;
        }

        $total = $orderDetails->first()->total;

        // Calculate individual product total amount (sum of amount for each product)
//        $individualTotalAmount = $orderDetails->groupBy('product_id')
//            ->map(function ($item) {
//                return $item->sum('amount');
//            })->sum();

        // Calculate shipping fee
        $shippingFee = $total - $totalAmount;
        $orderDetails = $order->orderDetails()->get();
//        dd(gettype($orderDetails) );

        return view('admin.order.orderDetails', [
            'order' => $order,
            'orderDetails' => $orderDetails,
            'user' => $user,
            'totalAmount' => $totalAmount,
            'shippingFee' => $shippingFee,
            'total' => $total,
            'totalQuantity' =>$totalQuantity
        ]);
    }


    public function addDelivery(Request $request) {
        $orderId = $request->get('orderId');
        $order = Order::find($orderId);
        return view('admin.order.addDelivery',['order' => $order]);
    }
    public function updateDelivery(Request $request) {
        try {
            $data = $request->all();
            $orderId = $data['order_id'];
            $order = Order::findOrFail($orderId);

            if ($order) {
                // Check if shipping info exists or create a new instance
                $shippingInfo = ShippingInfo::firstOrNew(['order_id' => $order->id]);

                // Update shipping info with new data
                $shippingInfo->delivery_unit = $data['delivery_unit']    ??'';
                $shippingInfo->order_code = $order->order_code ?? '';
                $shippingInfo->delivery_code = $data['delivery_code'] ?? '';
                $shippingInfo->delivery_method = $data['delivery_method'] ?? '';
                $shippingInfo->real_delivery_fee = $data['real_delivery_fee'] ?? 0;

                // Save the shipping info
                $shippingInfo->save();

                return response()->json(['success' => true, 'message' => 'updateDelivery successfully.']);
            }
            return response()->json(['success' => false, 'message' => 'Order not found, updateDelivery failure.']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Something went wrong, updateDelivery failure.', 'error' => $exception->getMessage()], 404);
        }
    }



    public function editOrderInfo(Request $request) {
        $orderId = $request->get('orderId');
        return view('admin.inProgressPage');
    }
    public function getOrderCancelReason(Request $request) {
        $orderId = $request->orderId;

        $order = Order::findOrfail($orderId);
        if ($order) {
            $cancelReason = $order->cancel_reason ?? '';
            return response()->json(['success' => true, 'message' => 'getOrderCancelReason successfully.', 'cancelReason' => $cancelReason]);
        }
        return response()->json(['success' => false, 'message' => 'Order not found,Cant get getOrderCancelReason.']);
    }

    public function updateOrderCancelReason(Request $request) {
        try {
            $orderId = $request->orderId;
            $newCancelReason = $request->newCancelReason;
            $order = Order::findOrfail($orderId);
            if ($order) {
                $order->cancel_reason = $newCancelReason??'';
                // Save the changes
                $order->save();
                return response()->json(['success' => true, 'message' => 'updateOrderCancelReason successfully.']);
            }
            return response()->json(['success' => false, 'message' => 'Order not found, updateOrderCancelReason failure.']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Something went wrong,updateOrderCancelReason failure.', 404]);
        }
    }

    public function getStaffNote(Request $request) {
        $orderId = $request->orderId;

        $order = Order::findOrfail($orderId);
        if ($order) {
            $staffNote = $order->staff_note ?? '';
            return response()->json(['success' => true, 'message' => 'getStaffNote successfully.', 'staffNote' => $staffNote]);
        }
        return response()->json(['success' => false, 'message' => 'Order not found,Cant getStaffNote.']);
    }

    public function updateStaffNote(Request $request) {
        try {
            $orderId = $request->orderId;
            $newStaffNote = $request->newStaffNote;
            $order = Order::findOrfail($orderId);
            if ($order) {
                $order->staff_note = $newStaffNote??'';
                // Save the changes
                $order->save();
                $staffWarningView = view('admin.partials.staffWarningView', ['order'=> $order])->render();

                return response()->json(['success' => true, 'message' => 'updateStaffNote successfully.', 'staffWarningView' => $staffWarningView]);
            }
            return response()->json(['success' => false, 'message' => 'Order not found, cant updateStaffNote.']);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Something went wrong, cant updateStaffNote.', 404]);
        }
    }

    public function getOrderNote(Request $request) {
        $orderId = $request->orderId;

        $order = Order::findOrfail($orderId);
        if ($order) {
            $orderNote = $order->note ?? '';
            return response()->json(['success' => true, 'message' => 'getOrderNote successfully.', 'orderNote' => $orderNote]);
        }
        return response()->json(['success' => false, 'message' => 'Order not found,Cant getOrderNote.']);
    }
}
