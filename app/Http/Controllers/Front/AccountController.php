<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Social;
use App\Models\User;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Order\OrderServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use App\Utilities\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite; //sử dụng Socialite
use Gloudemans\Shoppingcart\Facades\Cart;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    private $userService;
    private $orderService;

    public function __construct(UserServiceInterface  $userService,
                                OrderServiceInterface $orderService)
    {
        $this->userService = $userService;
        $this->orderService = $orderService;
    }

    public function login()
    {
        return view("front.account.login");
    }

    public function checkLogin(Request $request)
    {
        $dataField = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember = $request->remember;

        if (Auth::attempt($dataField, $remember)) {
            $user = Auth::user(); // Get the authenticated user

            switch ($user->level) {
                case Constant::user_level_client:
                    return redirect()->intended(''); // Chuyển hướng khách hàng tới trang chủ
                case Constant::user_level_admin:
                    return redirect()->intended('/admin'); // Chuyển hướng admin tới trang dashboard
                case Constant::user_level_superAdmin:
                    return redirect()->intended('/admin'); // Chuyển hướng quản lý tới trang tổng quan
                default:
                    return redirect()->intended('/');
            }
        } else {
            return back()->with('notification', 'Error, email or password is wrong');
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        // Clear the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // Clear all data from the session
        Session::flush();

        // Regenerate the session ID and token
        Session::regenerate();
        // Redirect to the desired page after logout
//        return redirect()->route('home')->with('success', 'Logged out successfully.');
        return back();
    }

    public function register()
    {
        return view("front.account.register");
    }

    public function postRegister(Request $request)
    {
        //validate form:
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6',

        ], [
            'required' => 'Vui lòng nhập thông tin :attribute',
            'min' => 'Giá trị tối thiểu của :attribute là :min',
            'email' => ':attribute phải là địa chỉ email hợp lệ',
        ]);

        if ($request->password != $request->password_confirmation) {
            return back()->with("notification", "Error: Confirm password does match");
        }

        $dataField = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => Constant::user_level_client, //mac dinh khach hang thuong.
        ];

        $this->userService->create($dataField);
        return redirect()->to('account/login')->with('notification', 'Register Success, account already login!');
    }

    public function myOrder(Request $request)
    {
        $sortBy = $request->get('sort_by', 'id'); // Default sort by 'id'
        $sortDirection = $request->get('sort_direction', 'desc'); // Default sort direction 'asc'

        $orders = $this->orderService->getOrderByUserId(Auth::id())
            ->with('orderDetails.product')
            ->orderBy('id', $sortDirection)
            ->paginate(10);

        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }
        $locale = Session()->get('locale');

        return view('front.account.my-order.myOrder', compact('orders', 'locale', 'favouriteCount'));
    }

    public function myOrderDetails($id)
    {
        $orders = $this->orderService->find($id);
        $subTotal = 0;
        foreach ($orders->orderDetails as $item) {
            $subTotal += $item->amount * $item->qty;
        }


        $shipping = 0;

        if ($orders->shipping_method == 'express') {
            $shipping = 20;
        } elseif ($orders->shipping_method == 'standard') {
            $shipping = 10;
        }

        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }
        $locale = Session()->get('locale');

        return view('front.account.my-order.orderDetails', compact('orders', 'subTotal', 'shipping', 'locale', 'favouriteCount'));
    }

    public function reOrder($id)
    {
        $originalOrder = Order::with('orderDetails.product')->findOrFail($id);
        // Clear current cart contents
        Cart::destroy();

        // Add order details to cart
        foreach ($originalOrder->orderDetails as $detail) {
            Cart::add([
                'id' => $detail->product_id,
                'name' => $detail->product->name,
                'qty' => $detail->qty,
                'price' => $detail->product->discount ?? $detail->product->price,
                'weight' => $detail->product->weight ?? 0,
                'options' => [
                    'images' => $detail->product->productImages,
                    'size' => $detail->size,
                    'color' => $detail->color,
                ]
            ]);
        }


        return redirect()->route('checkout');
    }

    public function loginFacebook()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFacebook()
    {
        $provider = Socialite::driver('google')->user();
        $account = Social::where('provider', 'google')->where('provider_user_id', $provider->getId())->first();
        if ($account) {

            $account_name = User::where('id', $account->user)->first();
            Session::put('name', $account_name->name);
            Session::put('id', $account_name->id);
            return redirect('/')->with('message', 'Đăng nhập Admin thành công');
        } else {
            $new = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'google'
            ]);

            $orang = User::where('email', $provider->getEmail())->first();

            if ($orang) {
                $orang = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',

                    'avatar' => '',
                    'level' => 2,
                    'description' => '',
                ]);
            }
            $new->login()->associate($orang);
            $new->save();

            $account_name = User::where('id', $account->user)->first();
            Session::put('name', $account_name->name);
            Session::put('id', $account_name->id);
            return redirect('/')->with('message', 'Đăng nhập Admin thành công');
        }
    }

    public function search(Request $request)
    {
        $search = $request->get("order-history-search");
        $fromDate = $request->get("from-date");
        $toDate = $request->get("to-date");
        $sortBy = $request->get('sort_by', 'id'); // Default sort by 'id'
        $sortDirection = $request->get('sort_direction', 'desc'); // Default sort direction 'desc'

        $query = Order::query();

        // Ensure the user is authenticated before filtering by user ID
        if (Auth::check()) {
            $userId = Auth::id();
            $query->where('user_id', $userId);
        }

        if ($search) {
            $query->where("id", 'like', '%' . $search . '%');
        }

        if ($fromDate) {
            $fromDate = \Carbon\Carbon::createFromFormat('Y-m-d', $fromDate)->startOfDay();
            $query->where('created_at', '>=', $fromDate);
        }

        if ($toDate) {
            $toDate = \Carbon\Carbon::createFromFormat('Y-m-d', $toDate)->endOfDay();
            $query->where('created_at', '<=', $toDate);
        }

        // Apply sorting
        $orders = $query->with('orderDetails.product')
            ->orderBy($sortBy, $sortDirection)
            ->paginate(10);

        // Count the favourite items for the authenticated user
        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }
        $locale = session()->get('locale');

        return view('front.account.my-order.myOrder', compact('orders', 'locale', 'favouriteCount', 'fromDate', 'toDate', 'search', 'sortBy', 'sortDirection'));
    }


    public function downloadBill($orderId)
    {
        $order = Order::findOrFail($orderId);

        $client = new Party([
            'name' => 'Shop Runner',
            'phone' => '(096) 848 9910',
            'address' => 'Detech Building 8a Tôn Thất Thuyết, Mỹ Đình, Cầu Giấy, Hà Nội',
            'custom_fields' => [
                'email' => 'runnershop.vn@gmail.com',
            ],
        ]);

        $customer = new Party([
            'name' => $order->first_name . $order->last_name,
            'address' => $order->country . '-' . $order->town_city . '-' . $order->street_address,
            'phone' => $order->phone,
            'custom_fields' => [
                'order number' => '#' . $order->id,
                'email' => $order->email,
                'payment_type' => $order->payment_type,
                'shipping_method' => $order->shipping_method,
                'Post_code' => $order->postcode_zip,
            ],
        ]);


        $items = [];
        foreach ($order->orderDetails as $item) {
            $product = $item->product;
            if ($item->coupon) {
                $discountedPrice = $item->amount * $item->qty * (1 - ($item->coupon / 100));
            }
            $invoiceItem = InvoiceItem::make($product->name)
                ->units($item->size . '-' . $this->pickColor($item->color))
                ->pricePerUnit($item->amount / $item->qty)
                ->quantity($item->qty)
                ->discount($item->discount ?? 0)
                ->discountByPercent($item->coupon ?? 0)
                ->subTotalPrice($discountedPrice ?? $item->amount * $item->qty);
            $items[] = $invoiceItem;

        }
        $shippingCost = 0;
        if ($order->shipping_method == 'express') {
            $shippingCost = 20;
        } elseif ($order->shipping_method == 'standard') {
            $shippingCost = 10;
        } elseif ($order->shipping_method == 'free') {
            $shippingCost = 0;
        }
        $invoice = Invoice::make('INVOICE')
            ->series('BIG')
            // ability to include translated invoice status
            // in case it was paid
            ->status(__('invoices::invoice.paid'))
            ->sequence(random_int(1000, 100000))
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($client)
            ->buyer($customer)
            ->date(now())
            ->dateFormat('d/m/y')
            ->payUntilDays(14)
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->shipping($shippingCost)
            ->filename($customer->name)
            ->addItems($items)
            ->logo(public_path('\front\img\shop-runner-logo-svg-2.svg'))
            // You can additionally save generated invoice to configured disk
            ->save('public');


        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream(); //download()


    }

    public function pickColor($color)
    {
        switch ($color) {
            case '1':
                return 'black';
            case '2':
                return 'darkblue';
            case '3':
                return 'orange';
            case '4':
                return 'grey';
            case '5':
                return 'lightblack';
            case '6':
                return 'pink';
            case '7':
                return 'violet';
            case '8':
                return 'red';
            case '9':
                return 'white';
            default:
                return '';
        }
    }

    public function profile()
    {
        $locale = Session()->get('locale');
        // Trả về view với kết quả tìm kiếm
        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }
        return view('front.account.profile', compact('locale', 'favouriteCount'));
    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();

        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'dateOfBirth' => 'nullable|date',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'postCode' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2024', // Max size 1MB
        ], [
            'avatar' => 'Error >= 2Mb'
        ]);


        // Cập nhật thông tin người dùng
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->date_of_birth = $request->dateOfBirth;
        $user->country = $request->country;
        $user->town_city = $request->city;
        $user->street_address = $request->address;
        $user->company_name = $request->company;
        $user->postcode_zip = $request->postCode;


        // Handle file upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if it exists
            $oldAvatarPath = public_path('front/img/user/' . $user->avatar);
            if ($user->avatar && file_exists($oldAvatarPath)) {
                unlink($oldAvatarPath);
            }

            // Store new avatar
            $avatarName = time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('front/img/user'), $avatarName);
            $user->avatar = $avatarName;
        }


        $user->save();


        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function cancelOrder($id)
    {
        $user = Auth::user();

        $order = $this->orderService->find($id);

        // Kiểm tra trạng thái hiện tại của đơn hàng (có thể chỉ cho phép hủy trong một số trạng thái nhất định)
        if ($order->status == Constant::ORDER_STATUS_CANCEL) {
            return back()->with('notification', 'This order is already cancelled');
        }

        // Cập nhật trạng thái đơn hàng
        $order->status = Constant::ORDER_STATUS_CANCEL;
        $order->save();

        return back()->with('notification', 'Order has been cancelled successfully');
    }

    public function forgotPassword(Request $request)
    {
        return view('front.account.forgot-password');
    }

    public function recoverPassword(Request $request)
    {
        $data = $request->all();

        $now = Carbon::now('Asia/Ho_Chi_minh')->format('d-m-Y');
        $titleMail = 'password retrieval Shoprunner' . ' ' . $now;
        $user = User::where('email', '=', $data['email'])->get();
        foreach ($user as $key => $value) {
            $user_id = $value->id;
        }
        if ($user) {
            $countUser = $user->count();
            if ($countUser == 0) {
                return redirect()->back()->with("error", 'Email not found!');
            } else {
                $tokenRandom = Str::random();
                $user = User::find($user_id);
                $user->user_token = $tokenRandom;
                $user->save();
                //send email
                $toEmail = $data['email'];
                $linkResetPass = url('update-new-password?email=' . $toEmail . '&token=' . $tokenRandom);

                $data = array(
                    'name' => $titleMail,
                    'body' => $linkResetPass,
                    'email' => $data['email'],
                );
                Mail::send('front.account.forget-pass-notify', ['data' => $data], function ($message) use ($titleMail, $data) {
                    $message->to($data['email'])->subject($titleMail);
                    $message->from($data['email'], $titleMail);
                });
                return redirect()->back()->with('message', 'Send mail success. Please check you email.');
            }
        }

    }

    public function updatePassword()
    {
        return view('front.account.update-newpass');
    }

    public function resetNewPassword(Request $request)
    {
        $data = $request->all();
        $tokenRandom = Str::random();

        $user = User::where('email', '=', $data['email'])->where('user_token','=',$data['token'])->get();
        $countUser = $user->count();
        if ($countUser > 0) {
            foreach ($user as $key => $value) {
                $user_id = $value->id;
            }
            $reset = User::find($user_id);
            $reset->password = $data['password'];
            $reset->user_token = $tokenRandom;
            $reset->save();
            return redirect('/account/login')->with("success",'Updated new password successfully!');

        } else {
            return redirect()->back()->with('error', 'Please re-enter the link');
        }
    }
}
