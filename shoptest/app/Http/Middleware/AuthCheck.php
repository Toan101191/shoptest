<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
{
    if (Auth::check()) {
        $customer = Auth::user();

        // Kiểm tra nếu role_id không phải là 1 hoặc 3 và đang cố truy cập vào trang admin hoặc các trang con trong nhóm admin
        if (!Gate::allows('access-admin', $customer) && $request->is('admin*')) {
            return redirect()->route('layout.home')->with('errorMsg', 'Bạn không có quyền truy cập vào trang admin.');
        }

        // Nếu có quyền hoặc không truy cập vào trang admin, tiếp tục xử lý request
        return $next($request);
    }

    return redirect()->route('layout.login')->with('errorMsg', 'Đăng nhập để thực hiện');
}

}
