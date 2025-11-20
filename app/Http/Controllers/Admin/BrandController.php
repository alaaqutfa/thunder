<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'logo'      => 'required|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'link'      => 'nullable|url',
            'order'     => 'nullable|integer|min:0',
            'status' => 'boolean',
        ]);

        // رفع الشعار
        $logoName = 'brand_' . time() . '_' . Str::random(6) . '.' . $request->logo->extension();
        $logoPath = $request->logo->storeAs('brands', $logoName, 'public');

        Brand::create([
            'name'      => $request->name,
            'logo'      => $logoPath,
            'link'      => $request->link,
            'order'     => $request->order ?? 0,
            'status' => $request->status ?? true,
        ]);

        return redirect()->route('admin.brands.index')->with('success', 'Brand added successfully');
    }

    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'logo'      => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'link'      => 'nullable|url',
            'order'     => 'nullable|integer|min:0',
            'status' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            // حذف الشعار القديم
            if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
                Storage::disk('public')->delete($brand->logo);
            }

            // رفع الشعار الجديد
            $logoName    = 'brand_' . time() . '_' . Str::random(6) . '.' . $request->logo->extension();
            $logoPath    = $request->logo->storeAs('brands', $logoName, 'public');
            $brand->logo = $logoPath;
        }

        $brand->name      = $request->name;
        $brand->link      = $request->link;
        $brand->order     = $request->order ?? $brand->order;
        $brand->status = $request->status ?? $brand->status;

        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully');
    }

    public function destroy(Brand $brand)
    {
        // حذف الشعار من التخزين
        if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand removed successfully');
    }

    public function toggleStatus(Brand $brand)
    {
        $brand->status = ! $brand->status;
        $brand->save();

        return back()->with('success', 'Brand status updated successfully');
    }
}
