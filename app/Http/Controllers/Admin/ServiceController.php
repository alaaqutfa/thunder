<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('order')->orderBy('created_at', 'desc')->get();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:services,name',
            'description' => 'required|string',
            'icon' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // إنشاء slug تلقائياً من الاسم
        $validated['slug'] = Str::slug($validated['name']);

        // رفع الصورة إذا وجدت
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = $imagePath;
        }

        // القيم الافتراضية
        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_active'] = $validated['is_active'] ?? true;

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $service->load('projects');

        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:services,name,' . $service->id,
            'description' => 'required|string',
            'icon' => 'required|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // تحديث slug إذا تغير الاسم
        if ($service->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // رفع صورة جديدة إذا وجدت
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            $imagePath = $request->file('image')->store('services', 'public');
            $validated['image'] = $imagePath;
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // حذف الصورة إذا كانت موجودة
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * تبديل حالة الخدمة (نشط/غير نشط)
     */
    public function toggle(Service $service)
    {
        $service->update([
            'is_active' => !$service->is_active
        ]);

        $status = $service->is_active ? 'activated' : 'deactivated';

        return back()->with('success', "Service {$status} successfully.");
    }

    /**
     * تحديث ترتيب الخدمات
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
        ]);

        foreach ($request->order as $index => $id) {
            Service::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * حذف صورة الخدمة
     */
    public function deleteImage(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
            $service->update(['image' => null]);

            return back()->with('success', 'Service image deleted successfully.');
        }

        return back()->with('error', 'No image found to delete.');
    }
}
