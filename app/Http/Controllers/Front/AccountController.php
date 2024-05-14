<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Favourite;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite; //sử dụng Socialite

class AccountController extends Controller
{
    private $userService;
    private $orderService;

    public function __construct(UserServiceInterface $userService,
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
          'email'=> $request->email,
            'password'=>$request->password,
            'level'=> Constant::user_level_client, //account khach hang.
        ];

        $remember = $request->remember;

        if(Auth::attempt($dataField,$remember)){
            //return redirect()->to('');
            return redirect()->intended('');//home page
        }else{
            return back()->with('notification','Error,email or password is wrong');
        }
    }

    public function logout()
    {
        Auth::logout();

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

        if ($request->password != $request->password_confirmation){
            return back()->with("notification", "Error: Confirm password does match");
        }

        $dataField = [
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'level'=> Constant::user_level_client, //mac dinh khach hang thuong.
        ];

        $this->userService->create($dataField);
        return redirect()->to('account/login')->with('notification', 'Register Success, account already login!');
    }

    public function myOrder()
    {
        $orders = $this->orderService->getOrderByUserId(Auth::id());

        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }
        $locale = Session()->get('locale');

        return view('front.account.my-order.myOrder',compact('orders','locale','favouriteCount'));
    }

    public function myOrderDetails($id)
    {
        $orders = $this->orderService->find($id);

        $shipping = 0;

        if ($orders->shipping_method == 'express'){
            $shipping = 20;
        } elseif ($orders->shipping_method == 'standard'){
            $shipping = 10;
        }

        $favouriteCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();
            $favouriteCount = Favourite::where('user_id', $userId)->count();
        }
        $locale = Session()->get('locale');

        return view('front.account.my-order.orderDetails',compact('orders','shipping','locale','favouriteCount'));
    }

    public function loginFacebook(){
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


}
