<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $customer = $user->customer;

        if (!$customer) {
            return redirect()->route('student.dashboard')->with('error', 'لا يوجد بيانات طالب مرتبطة بحسابك');
        }

        $faculty = $customer->faculty;

        return view('student.faculty', compact('customer', 'faculty'));
    }
}
