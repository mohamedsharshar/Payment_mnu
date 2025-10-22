<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_type' => 'required|in:admin,student',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $user = Auth::user();
            $userType = $request->user_type;

            if ($userType === 'admin' && $user->hasRole('admin')) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'مرحباً بك في لوحة التحكم يا ' . $user->name);
            }

            if ($userType === 'student' && $user->hasRole('student')) {
                $request->session()->regenerate();
                return redirect()->intended(route('student.dashboard'))
                    ->with('success', 'مرحباً بك يا ' . $user->name);
            }

            Auth::logout();
            return back()->withErrors([
                'email' => 'هذا الحساب ليس من نوع ' . ($userType === 'admin' ? 'مدير النظام' : 'طالب'),
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'تم تسجيل الخروج بنجاح');
    }
}
