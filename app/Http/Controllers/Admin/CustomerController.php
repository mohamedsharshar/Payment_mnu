<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with(['faculty', 'userLevel'])
            ->withCount('bills')
            ->paginate(15);

        return view('admin.customers.index', compact('customers'));
    }

    public function show($code)
    {
        $customer = Customer::with(['bills.service', 'faculty', 'userLevel'])
            ->findOrFail($code);

        return view('admin.customers.show', compact('customer'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Code' => 'required|unique:customers,Code|max:14',
            'Name' => 'required|max:500',
            'Email' => 'nullable|email|max:50',
            'Mobile' => 'nullable|max:50',
            'Description' => 'nullable|max:500',
        ]);

        Customer::create($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'تم إضافة الطالب بنجاح');
    }

    public function edit($code)
    {
        $customer = Customer::findOrFail($code);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $code)
    {
        $customer = Customer::findOrFail($code);

        $validated = $request->validate([
            'Name' => 'required|max:500',
            'Email' => 'nullable|email|max:50',
            'Mobile' => 'nullable|max:50',
            'Description' => 'nullable|max:500',
        ]);

        $customer->update($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'تم تحديث بيانات الطالب بنجاح');
    }

    public function destroy($code)
    {
        $customer = Customer::findOrFail($code);
        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'تم حذف الطالب بنجاح');
    }
}
