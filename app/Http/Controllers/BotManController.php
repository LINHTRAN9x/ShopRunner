<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\BotManFactory;
use BotMan\Drivers\Web\WebDriver;
use Illuminate\Support\Facades\Session;

class BotManController extends Controller
{
    public function handle()
    {

        DriverManager::loadDriver(WebDriver::class);

        $config = [];

        $botman = BotManFactory::create($config);


        $botman->hears('hello', function (BotMan $bot) {
            $bot->reply('Hello👋!');
        });
        $botman->hears('what you name?', function (BotMan $bot) {
            $bot->reply('my name is Botman🤗!');
        });
        $botman->hears('i love you', function (BotMan $bot) {
            $bot->reply('thank you🥰');
        });
        $botman->hears('i hate you', function (BotMan $bot) {
            $bot->reply('sorry😣');
        });
        $botman->hears('xin chào', function (BotMan $bot) {
            $bot->reply('Chào bạn, Tôi có thể giúp gì cho bạn😊?');
        });
        $botman->hears('lọc đồ cho nam', function (BotMan $bot) {
            $bot->reply('<img src="/front/img/product/Man-product-2/ÁO THUN CHẠY BỘ NEW BALANCE-1.jpg" width="200px" alt="do nam"><br><a href="/shop/category/Men">Đến trang đồ cho nam🫡</a>');
        });
        $botman->hears('shop runner là trang web gì?', function (BotMan $bot) {
            $bot->reply('Shop Runner là hệ thống cửa hàng các thiết bị chạy bộ toàn cầu. Chuyên bán các dụng cụ cho việc luyện
            tập các môn thể thao liên quan đến chạy, đi bộ như giày, quần áo thể thao. Shop Runner đem đến cộng đồng yêu thể thao các sản
             phẩm dành cho vận động viên chạy bộ & ba môn phối hợp gồm: Quần áo chạy bộ chuyên dụng, Phụ kiện (Mũ, Vest nước, Bó bắp, Khăn,
             Belt, Bình nước v.v...) và Dinh dưỡng.🏃‍♂️🏃‍♀️🏃
        ');
        });


        $botman->listen();
    }

    public function sendMessage(Request $request)
    {
        DriverManager::loadDriver(WebDriver::class);

        $config = [];

        $botman = BotManFactory::create($config);

        $message = $request->input('message');

        $botman->hears('hello', function (BotMan $bot) {
            $bot->reply('Hello!');
        });
        $botman->hears('what is your name?', function (BotMan $bot) {
            $bot->reply('My name is BotMan!');
        });


        // Listen for incoming messages
        $botman->listen();

        // Capture the response from BotMan
        $response = $botman->getMessages();

        return response()->json(['status' => 200, 'messages' => $response]);
    }

    public function tinker()
    {
        return view('tinker');
    }
}
