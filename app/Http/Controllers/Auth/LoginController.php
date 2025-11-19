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
        // تحديد قواعد الـ validation بناءً على نوع المستخدم
        $rules = [
            'user_type' => 'required|in:admin,student',
            'password' => 'required|min:6',
        ];

        $messages = [
            'user_type.required' => 'يجب اختيار نوع المستخدم',
            'user_type.in' => 'نوع المستخدم غير صحيح',
            'password.required' => 'كلمة المرور مطلوبة',
            'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',
        ];

        // للطلاب: يجب أن يكون رقم قومي (14 رقم فقط)
        if ($request->user_type === 'student') {
            $rules['email'] = ['required', 'string', 'regex:/^[0-9]{14}$/', 'size:14'];
            $messages['email.required'] = 'الرقم القومي مطلوب';
            $messages['email.regex'] = 'الرقم القومي يجب أن يكون 14 رقم فقط (بدون حروف أو رموز)';
            $messages['email.size'] = 'الرقم القومي يجب أن يكون 14 رقم بالضبط';
            $messages['email.string'] = 'الرقم القومي غير صحيح';
        } else {
            // للإداريين: بريد إلكتروني عادي
            $rules['email'] = 'required|email|max:255';
            $messages['email.required'] = 'البريد الإلكتروني مطلوب';
            $messages['email.email'] = 'البريد الإلكتروني غير صحيح';
            $messages['email.max'] = 'البريد الإلكتروني طويل جداً';
        }

        $request->validate($rules, $messages);

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
