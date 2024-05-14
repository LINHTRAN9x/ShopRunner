<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class CheckUserLanguage
{
    public function handle($request, Closure $next)
    {
        // Kiểm tra xem người dùng đã chọn ngôn ngữ trước đó chưa
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }

        return $next($request);
    }
}
