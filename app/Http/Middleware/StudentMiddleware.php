<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً');
        }

        if (!auth()->user()->hasRole('student')) {
            if (auth()->user()->hasRole('admin')) {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'أنت مسجل كأدمن. لا يمكنك الوصول إلى بوابة الطالب');
            }

            return redirect()->route('login')
                ->with('error', 'ليس لديك صلاحية الوصول إلى بوابة الطالب');
        }

        return $next($request);
    }
}
