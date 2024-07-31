<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // التحقق مما إذا كان المستخدم مسجلاً الدخول كمسؤول
        if (Auth::guard('admin')->check()) {
            // إذا كان مسجلاً الدخول كمسؤول، فلا يمكنه العودة لصفحة تسجيل الدخول
            if ($request->is('admin/login')) {
                return redirect()->route('admin.dashboard');
            }
        } else {
            // إذا لم يكن مسجلاً الدخول كمسؤول، فلا يمكنه زيارة أي رابط غير admin/login
            if (!$request->is('admin/login')) {
                return redirect()->route('admin.login');
            }
        }

        // يمكن للمستخدم الذي لم يسجل الدخول الوصول إلى الصفحة المطلوبة
        return $next($request);


        // if (!$request->expectsJson()) {
        //     if (FacadesRequest::is('admin/*'))
        //         return route('admin.login');
        //     else
        //         return route('login');
        //         return $next($request);

        // }
    }
}
