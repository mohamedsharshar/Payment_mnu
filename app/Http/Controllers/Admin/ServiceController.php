<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::withCount('bills')->get();

        return view('admin.services.index', compact('services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'SERVICESName' => 'required|max:255',
            'value' => 'required|numeric|min:0',
        ]);

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'تم إضافة الخدمة بنجاح');
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'SERVICESName' => 'required|max:255',
            'value' => 'required|numeric|min:0',
        ]);

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'تم تحديث الخدمة بنجاح');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->bills()->count() > 0) {
            return redirect()->route('admin.services.index')
                ->with('error', 'لا يمكن حذف هذه الخدمة لأنها مرتبطة بفواتير');
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'تم حذف الخدمة بنجاح');
    }
}
