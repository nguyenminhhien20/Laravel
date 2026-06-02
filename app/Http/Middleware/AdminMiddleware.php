<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// class AdminMiddleware
// {
//     public function handle(Request $request, Closure $next): mixed
//     {
//         if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->roles === 'admin') {
//             return $next($request);
//         }

//         if ($request->expectsJson()) {
//             return response()->json(['message' => 'Bạn không có quyền truy cập.'], 403);
//         }

//         return redirect()->route('admin.login')->with('error', 'Bạn không có quyền truy cập.');
//     }
// }
//

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Bạn không có quyền truy cập.'], 403);
        }

        return redirect()->route('login')->with('error', 'Bạn không có quyền truy cập.');
    }
}
