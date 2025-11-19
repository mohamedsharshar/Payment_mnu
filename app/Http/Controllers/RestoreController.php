<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class RestoreController extends Controller
{
    /**
     * Display a list of soft deleted customers
     */
    public function trashedCustomers()
    {
        $customers = Customer::onlyTrashed()->get();
        return view('restore.customers', compact('customers'));
    }

    /**
     * Restore a soft deleted customer
     */
    public function restoreCustomer($code)
    {
        $customer = Customer::onlyTrashed()->where('Code', $code)->firstOrFail();
        $customer->restore();

        return redirect()->back()->with('success', 'تم استرجاع العميل بنجاح');
    }

    /**
     * Permanently delete a customer
     */
    public function forceDeleteCustomer($code)
    {
        $customer = Customer::onlyTrashed()->where('Code', $code)->firstOrFail();
        $customer->forceDelete();

        return redirect()->back()->with('success', 'تم حذف العميل نهائياً');
    }

    /**
     * Display a list of soft deleted bills
     */
    public function trashedBills()
    {
        $bills = Bill::onlyTrashed()->with(['customer', 'service'])->get();
        return view('restore.bills', compact('bills'));
    }

    /**
     * Restore a soft deleted bill
     */
    public function restoreBill($id)
    {
        $bill = Bill::onlyTrashed()->findOrFail($id);
        $bill->restore();

        return redirect()->back()->with('success', 'تم استرجاع الفاتورة بنجاح');
    }

    /**
     * Permanently delete a bill
     */
    public function forceDeleteBill($id)
    {
        $bill = Bill::onlyTrashed()->findOrFail($id);
        $bill->forceDelete();

        return redirect()->back()->with('success', 'تم حذف الفاتورة نهائياً');
    }

    /**
     * Display a list of soft deleted services
     */
    public function trashedServices()
    {
        $services = Service::onlyTrashed()->get();
        return view('restore.services', compact('services'));
    }

    /**
     * Restore a soft deleted service
     */
    public function restoreService($id)
    {
        $service = Service::onlyTrashed()->findOrFail($id);
        $service->restore();

        return redirect()->back()->with('success', 'تم استرجاع الخدمة بنجاح');
    }

    /**
     * Permanently delete a service
     */
    public function forceDeleteService($id)
    {
        $service = Service::onlyTrashed()->findOrFail($id);
        $service->forceDelete();

        return redirect()->back()->with('success', 'تم حذف الخدمة نهائياً');
    }

    /**
     * Display a list of soft deleted users
     */
    public function trashedUsers()
    {
        $users = User::onlyTrashed()->get();
        return view('restore.users', compact('users'));
    }

    /**
     * Restore a soft deleted user
     */
    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->back()->with('success', 'تم استرجاع المستخدم بنجاح');
    }

    /**
     * Permanently delete a user
     */
    public function forceDeleteUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->back()->with('success', 'تم حذف المستخدم نهائياً');
    }
}
