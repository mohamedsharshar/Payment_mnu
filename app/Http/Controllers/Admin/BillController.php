<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with(['customer', 'service'])
            ->latest()
            ->paginate(15);

        return view('admin.bills.index', compact('bills'));
    }

    public function show($id)
    {
        $bill = Bill::with(['customer', 'service', 'billAmounts', 'payments'])
            ->findOrFail($id);

        return view('admin.bills.show', compact('bill'));
    }

    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();

        return view('admin.bills.create', compact('customers', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ServiceType_ID' => 'required|exists:services,ID',
            'CustomerCode' => 'required|exists:customers,Code',
            'DueDate' => 'required|date',
        ]);

        $validated['BillStatus'] = 1;
        $validated['CreatedIn'] = now();

        Bill::create($validated);

        return redirect()->route('admin.bills.index')
            ->with('success', 'تم إنشاء الفاتورة بنجاح');
    }

    public function edit($id)
    {
        $bill = Bill::findOrFail($id);
        $customers = Customer::all();
        $services = Service::all();

        return view('admin.bills.edit', compact('bill', 'customers', 'services'));
    }

    public function update(Request $request, $id)
    {
        $bill = Bill::findOrFail($id);

        $validated = $request->validate([
            'ServiceType_ID' => 'required|exists:services,ID',
            'CustomerCode' => 'required|exists:customers,Code',
            'DueDate' => 'required|date',
            'BillStatus' => 'required|integer',
        ]);

        $bill->update($validated);

        return redirect()->route('admin.bills.index')
            ->with('success', 'تم تحديث الفاتورة بنجاح');
    }

    public function destroy($id)
    {
        $bill = Bill::findOrFail($id);
        $bill->delete();

        return redirect()->route('admin.bills.index')
            ->with('success', 'تم حذف الفاتورة بنجاح');
    }
}
