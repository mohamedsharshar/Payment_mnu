<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً');
        }

        if (!auth()->user()->hasRole('admin')) {
            if (auth()->user()->hasRole('student')) {
                return redirect()->route('student.dashboard')
                    ->with('error', 'أنت مسجل كطالب. لا يمكنك الوصول إلى لوحة تحكم الأدمن');
            }

            return redirect()->route('login')
                ->with('error', 'ليس لديك صلاحية الوصول إلى لوحة التحكم');
        }

        return $next($request);
    }
}
