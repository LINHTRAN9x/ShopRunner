<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Favourite;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Utilities\Constant;
use App\Utilities\VNPay;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CheckoutController extends Controller
{

    private $orderService;
    private $orderDetailService;

    public function __construct(OrderServiceInterface $orderService
                 ,OrderDetailServiceInterface $orderDetailService)
    {
        $this->orderService = $orderService;
        $this->orderDetailService = $orderDetailService;
    }

    public function index()
    {
        $carts = Cart::content();
        // Check if the cart is empty
        if ($carts->isEmpty()) {
            // Redirect to the shopping cart page or display a message
            return redirect()->route('cart.index')->with('message', 'Your cart is empty.');
        }
        $total = Cart::total();
        $subTotal = Cart::subtotal();
        $locale = Session()->get('locale');

        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }


        return view('front.checkout.index',compact('favouriteCount','carts','total','subTotal','locale'));
    }

    public function calculateShipping(Request $request)
    {
        if ($request->ajax()) {
            $selectedShipping = $request->input('shipping_method');

            $shippingCost = 0;
            if ($selectedShipping == 'standard') {
                $shippingCost = 10;
            } else if ($selectedShipping == 'express') {
                $shippingCost = 20;
            }
            // Tính toán tổng số tiền hàng từ giỏ hàng
            $subtotal = Cart::subtotal();

            // Kiểm tra xem có mã giảm giá trong session không
            $couponDiscount = 0;
            $couponsInSession = $request->session()->get('coupon', []);
            if (!empty($couponsInSession)) {
                foreach ($couponsInSession as $coupon) {
                    $couponDiscount += ($subtotal * $coupon['coupon_number']) / 100;
                }
            }

            // Cập nhật tổng số tiền cuối cùng bằng cách trừ đi giảm giá từ coupon
            $totalAmount = $subtotal + $shippingCost - $couponDiscount;

            // Lưu giá trị totalAmount vào session flash
            $request->session()->put('totalAmount', $totalAmount);

            return response()->json([
                'shippingCost' => $shippingCost,
                'subtotal' => $totalAmount,
            ]);
        }
    }

    public function addOrder(Request $request)
    {
        //validate form:
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'country' => 'required|string',
            'street_address' => 'required|string',
            'town_city' => 'required|string',
            'phone' => 'required|string|min:10',
            'email' => 'required|string|email',
            'postcode_zip' => 'required|string|min:6',
            'shipping_method' => 'required|string',
            'payment_type' => 'required|string',
        ], [
            'required' => 'Vui lòng nhập thông tin :attribute',
            'min' => 'Giá trị tối thiểu của :attribute là :min',
            'email' => ':attribute phải là địa chỉ email hợp lệ',
        ]);

        $data = $request->all();
        $data['status'] = Constant::ORDER_STATUS_RECEIVEORDERS;

        // Thêm đơn hàng
        $order = $this->orderService->create($data);

        // Lấy tất cả mục trong giỏ hàng
        $carts = Cart::content();

        // Lấy giá trị totalAmount từ session flash, nếu không có sẵn, thiết lập giá trị mặc định là 0
        $totalAmount = $request->session()->get('totalAmount', 0);
        $couponsInSession = $request->session()->get('coupon', []);
        // Lặp qua từng mục trong giỏ hàng để thêm chi tiết đơn hàng
        foreach ($carts as $cartItem) {
            $data = [
                'order_id' => $order->id,
                'product_id' => $cartItem->id,
                'qty' => $cartItem->qty,
                'amount' => $cartItem->price,

                'size'=>$cartItem->options->size,
                'color'=>$cartItem->options->color,
            ];
            // Nếu tổng số tiền cuối cùng đã được tính toán từ trước (đã trừ mã coupon)
            if ($totalAmount > 0) {

                $data['total'] = $totalAmount;
            } else {
                // Nếu không có mã coupon, giữ nguyên giá trị total
                $data['total'] = $cartItem->qty * $cartItem->price;
            }
            if ($couponsInSession){
                $data['coupon'] = $couponsInSession[0]['coupon_number'];
            }else{
                $data['coupon'] = null;
            }



            // Thêm chi tiết đơn hàng
            $this->orderDetailService->create($data);

            // Giảm số lượng sản phẩm trong bảng product_details
            $productDetail = ProductDetail::where('product_id', $cartItem->id)
                ->where('size', $cartItem->options->size)
                ->where('color', $this->pickColor($cartItem->options->color))
                ->first();

            if ($productDetail) {
                $productDetail->qty -= $cartItem->qty;
                if ($productDetail->qty <= 0) {
                    $productDetail->delete();
                } else {
                    $productDetail->save();
                }
            }
        }

        if ($request->payment_type == 'COD') {
            //Gui email
            $total = $totalAmount ;
            $subTotal = Cart::subtotal();
            if ($couponsInSession){
                $coupon = $couponsInSession[0]['coupon_number'];
            }else{
                $coupon = 0;
            }
            $this->sendEmail($order,$total,$subTotal,$carts,$coupon);


            // Xóa giỏ hàng
            Cart::destroy();

            //thanh toan bang paypal


            // Trả về kết quả thông báo
            return redirect('checkout/thank-you');
        }

        if ($request->payment_type == 'vnpay') {
            $shipping_cost = 0;
            if ($order->shipping_method == 'express') {
                $shipping_cost = 20;
            } elseif ($order->shipping_method == 'standard') {
                $shipping_cost = 10;
            }

            $total_amount = $totalAmount;


            // Chuyển đổi tổng giá trị đơn hàng sang tiền Việt
            $total_amount_vnd = $total_amount * 25290;
            // Lấy URL thanh toán VNPAY
            $data_url = VNPay::vnpay_create_payment([
                'vnp_TxnRef' => $order->id, // ID của đơn hàng
                'vnp_OrderInfo' => 'Thông tin đơn hàng', // Mô tả đơn hàng
                'vnp_Amount' => round($total_amount_vnd), // Tổng giá trị đơn hàng, chuyển đổi sang tiền Việt
            ]);

            // Kiểm tra URL thanh toán có hợp lệ không
            if ($data_url) {
                // Chuyển hướng đến URL thanh toán
                return redirect()->to($data_url);
            } else {
                // Xử lý lỗi nếu URL thanh toán không hợp lệ
                return redirect()->back()->withErrors(['error' => 'Đã xảy ra lỗi khi tạo URL thanh toán VNPAY.']);
            }
        }
        if($request ->payment_type == 'Paypal'){
            // thanh toán bằng paypal
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('successTransaction'),
                    "cancel_url" =>  route('cancelTransaction'),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => number_format($totalAmount,2,".","") // 1200.50 - string  57.00
                        ]
                    ]
                ]
            ]);
            $this->orderService->update(['status'=>Constant::ORDER_STATUS_PAID],$order->id);
            $total = $totalAmount;
            $subTotal = Cart::subtotal();
            if ($couponsInSession){
                $coupon = $couponsInSession[0]['coupon_number'];
            }else{
                $coupon = 0;
            }
            $this->sendEmail($order,$total,$subTotal,$carts,$coupon);
//            dd($response);
            if (isset($response['id']) && $response['id'] != null) {

                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }

                return redirect()
                    ->route('createTransaction')
                    ->with('error', 'Something went wrong.');

            }
        }

        if($request ->payment_type == 'momo') {


            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = $totalAmount;
            $orderId = $order->id;
            $redirectUrl = "http://127.0.0.1:8000/checkout/thank-you";
            $ipnUrl = "http://127.0.0.1:8000/checkout/thank-you";
            $extraData = "";
                $requestId = time() . "";
                $requestType = "payWithATM";
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $secretKey);
                $data = array('partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature);
                $result = $this->execPostRequest($endpoint, json_encode($data));
                dd($result);
                $jsonResult = json_decode($result, true);  // decode json

                //Just a example, please check more in there
                return redirect()->to($jsonResult['payUrl']);
//                header('Location: ' . $jsonResult['./checkout/thank-you']);
        }

    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "post");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function successTransaction(Request $request)
    {
            Cart::destroy();
            return redirect()->to("checkout/thank-you");
    }
    public function cancelTransaction(Request $request)
    {
        return redirect()->to("checkout/thank-you");
    }


    public function vnPayCheck(Request $request)
    {
        // Lấy tất cả mục trong giỏ hàng
        $carts = Cart::content();
        //1.Lay data tu url do vnpay gui ve qua $vnp_Returnurl
        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); //Ma phan hoi kq thanh toan. 00: thanh cong
        $vnp_TxnRef = $request->get('vnp_TxnRef'); //Order ID
        $vnp_Amount = $request->get('vnp_Amount'); // Tong tien thanh toan

        $totalAmount = $request->session()->get('totalAmount', 0);
        $couponsInSession = $request->session()->get('coupon', []);

        //2.Kiem tra data ,xem kq giao dich tra ve tu vnpay hop le k?
        if ($vnp_ResponseCode != null) {
            //Neu thanh cong
            if ($vnp_ResponseCode == 00){
                //Update STATUS don hang:
                $this->orderService->update(['status'=>Constant::ORDER_STATUS_PAID],$vnp_TxnRef);
               $order = $this->orderService->find($vnp_TxnRef);
                //Gui email
                $total = $totalAmount;
                $subTotal = Cart::subtotal();
                if ($couponsInSession){
                    $coupon = $couponsInSession[0]['coupon_number'];
                }else{
                    $coupon = 0;
                }
                $this->sendEmail($order,$total,$subTotal,$carts,$coupon);


                Cart::destroy();
                return redirect('checkout/thank-you');
            }else{ // k thanh cong
                //xoa don hang khoi database
                $this->orderService->delete($vnp_TxnRef);
                //thong bao loi
                return redirect('');
            }
        }
    }

    private function sendEmail($order,$total,$subtotal,$carts,$coupon)
    {
        $email_to = $order->email;



        Mail::send('front.checkout.email',compact('order','total','subtotal','carts','coupon'),
            function ($message) use ($email_to){
            $message->from('ShopRunner@gmail.com','Shop Runner');
            $message->to($email_to,$email_to);
            $message->subject('Thanks for your order');

        });

//        return view('front.checkout.email',compact('order','total', 'subtotal', 'carts'));
    }

    public function thankYou()
    {

        $latestOrderDetail = OrderDetail::latest('created_at')->first();
        $total = 0;
        $amount = 0;
        $locale = Session()->get('locale');


        if ($latestOrderDetail) {

            $order = $latestOrderDetail->order;
            $orderDetails = $order->orderDetails;
            $total += $latestOrderDetail->total;
            $orderProducts = $order->orderDetails;
            $shipping = 0;
            $subTotal = 0;

            foreach ($orderDetails as $item) {
                $subTotal += $item->amount * $item->qty;
            }


            if ($order->shipping_method == 'express'){
                $shipping = 20;
            } elseif ($order->shipping_method == 'standard'){
                $shipping = 10;
            }

            $coupon = Session::get('coupon');

            if ($coupon) {
                foreach ($coupon as $key => $cou) {
                    $discount = $cou['coupon_number'];

                    // Truy vấn và cập nhật giá trị coupon_time trong cơ sở dữ liệu
                    $couponModel = Coupon::where('coupon_code', $cou['coupon_code'])->first();
                    if ($couponModel) {
                        $couponModel->decrement('coupon_time');
                        // Đảm bảo giá trị không nhỏ hơn 0
                        $couponModel->update(['coupon_time' => max(0, $couponModel->coupon_time)]);

                        // Nếu coupon_time trở thành 0, loại bỏ mã giảm giá đó khỏi cơ sở dữ liệu
                        if ($couponModel->coupon_time == 0) {
                            $couponModel->delete(); // hoặc $couponModel->update(['available' => false]);
                        }
                    }
                }
            } else {
                $discount = 0;
            }


            foreach ($orderProducts as $orderProduct) {

                $amount += $orderProduct->amount;

            }

            $favouriteCount = 0;
            if (Auth::check()) {
                $userId = Auth::id();
                $favouriteCount = Favourite::where('user_id', $userId)->count();
            }
            Session::forget('coupon');


            return view('front.checkout.thank-you', compact('orderProducts','order','subTotal','shipping','discount','total','amount','locale','favouriteCount'));
        } else {
            // Xử lý khi không tìm thấy thông tin đơn hàng gần nhất
            // ...
        }

    }

    public function checkCoupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();

        if ($coupon !== null) { // Kiểm tra xem coupon có tồn tại không
            $count_coupon = $coupon->count();
            if ($count_coupon > 0) {
                $coupon_session = Session::get('coupon');
                if ($coupon_session == true) {
                    $is_avaiable = 0;
                    if ($is_avaiable == 0) {
                        $cou[] = array(
                            'coupon_id' => $coupon->coupon_id,
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        Session::put('coupon', $cou);
                    }
                } else {
                    $cou[] = array(
                        'coupon_id' => $coupon->coupon_id,
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    Session::put('coupon', $cou);
                }
                Session::save();

                return redirect()->back()->with('message', 'Add coupon successful!');
            }
        } else {
            return redirect()->back()->with('error', 'Fail apply coupon!');
        }
    }

    public function deleteCoupon()
    {
        Session::forget('coupon');
        return redirect()->back();
    }

    public function pickColor($color) {
        switch ($color) {
            case '1': return 'black';
            case '2': return 'darkblue';
            case '3': return 'orange';
            case '4': return 'grey';
            case '5': return 'lightblack';
            case '6': return 'pink';
            case '7': return 'violet';
            case '8': return 'red';
            case '9': return 'white';
            default: return '';
        }
    }

}
