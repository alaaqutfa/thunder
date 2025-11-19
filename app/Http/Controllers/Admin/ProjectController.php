<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('service')
            ->ordered()
            ->get();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::active()->ordered()->get();
        return view('admin.projects.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'service_id' => 'required|exists:services,id',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // معالجة الصورة الرئيسية
        $mainImagePath = null;
        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $mainImageName = 'project_' . time() . '_' . Str::random(10) . '.' . $mainImage->getClientOriginalExtension();
            $mainImagePath = $mainImage->storeAs('projects', $mainImageName, 'public');
        }

        // معالجة معرض الصور
        $galleryImagesPaths = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryImageName = 'gallery_' . time() . '_' . Str::random(10) . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImagesPaths[] = $galleryImage->storeAs('projects/gallery', $galleryImageName, 'public');
            }
        }

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'main_image' => $mainImagePath,
            'gallery_images' => $galleryImagesPaths,
            'service_id' => $request->service_id,
            'order' => $request->order ?? 0,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('service');
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $services = Service::active()->ordered()->get();
        $project->load('service');
        return view('admin.projects.edit', compact('project', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'service_id' => 'required|exists:services,id',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // معالجة الصورة الرئيسية
        $mainImagePath = $project->main_image;
        if ($request->hasFile('main_image')) {
            // حذف الصورة القديمة
            if ($project->main_image && Storage::disk('public')->exists($project->main_image)) {
                Storage::disk('public')->delete($project->main_image);
            }

            $mainImage = $request->file('main_image');
            $mainImageName = 'project_' . time() . '_' . Str::random(10) . '.' . $mainImage->getClientOriginalExtension();
            $mainImagePath = $mainImage->storeAs('projects', $mainImageName, 'public');
        }

        // معالجة معرض الصور
        $galleryImagesPaths = $project->gallery_images ?? [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryImageName = 'gallery_' . time() . '_' . Str::random(10) . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImagesPaths[] = $galleryImage->storeAs('projects/gallery', $galleryImageName, 'public');
            }
        }

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'main_image' => $mainImagePath,
            'gallery_images' => $galleryImagesPaths,
            'service_id' => $request->service_id,
            'order' => $request->order ?? $project->order,
            'is_active' => $request->is_active ?? $project->is_active,
        ]);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // حذف الصور من التخزين
        if ($project->main_image && Storage::disk('public')->exists($project->main_image)) {
            Storage::disk('public')->delete($project->main_image);
        }

        if ($project->gallery_images) {
            foreach ($project->gallery_images as $galleryImage) {
                if (Storage::disk('public')->exists($galleryImage)) {
                    Storage::disk('public')->delete($galleryImage);
                }
            }
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    /**
     * Remove a specific gallery image
     */
    public function removeGalleryImage(Project $project, $imageIndex)
    {
        $galleryImages = $project->gallery_images ?? [];

        if (isset($galleryImages[$imageIndex])) {
            // حذف الصورة من التخزين
            if (Storage::disk('public')->exists($galleryImages[$imageIndex])) {
                Storage::disk('public')->delete($galleryImages[$imageIndex]);
            }

            // إزالة الصورة من المصفوفة
            unset($galleryImages[$imageIndex]);
            $galleryImages = array_values($galleryImages); // إعادة ترتيب المفاتيح

            $project->update(['gallery_images' => $galleryImages]);

            return redirect()->back()
                ->with('success', 'Gallery image removed successfully.');
        }

        return redirect()->back()
            ->with('error', 'Image not found.');
    }

    /**
     * Toggle project status
     */
    public function toggleStatus(Project $project)
    {
        $project->update([
            'is_active' => !$project->is_active
        ]);

        $status = $project->is_active ? 'activated' : 'deactivated';

        return redirect()->back()
            ->with('success', "Project {$status} successfully.");
    }
}
