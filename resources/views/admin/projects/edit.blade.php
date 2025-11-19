@extends('web.layout.app')

@section('title', 'Edit Project')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-[#384046]">Edit Project</h1>
                        <p class="mt-2 text-sm text-gray-600">Update project details and images</p>
                    </div>
                    <a href="{{ route('admin.projects.index') }}"
                        class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#cc1820] transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Projects
                    </a>
                </div>
            </div>

            <!-- Project Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('admin.projects.update', $project) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Project Name & Service -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Project Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-[#384046] mb-2">
                                    Project Name *
                                </label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $project->name) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#cc1820] focus:border-[#cc1820] @error('name') border-red-500 @enderror"
                                    required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Service Selection -->
                            <div>
                                <label for="service_id" class="block text-sm font-medium text-[#384046] mb-2">
                                    Service *
                                </label>
                                <select name="service_id" id="service_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#cc1820] focus:border-[#cc1820] @error('service_id') border-red-500 @enderror"
                                    required>
                                    <option value="">Select Service</option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}"
                                            {{ old('service_id', $project->service_id) == $service->id ? 'selected' : '' }}>
                                            {{ $service->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-[#384046] mb-2">
                                Description *
                            </label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#cc1820] focus:border-[#cc1820] @error('description') border-red-500 @enderror"
                                required>{{ old('description', $project->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Images Section -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Main Image -->
                            <div>
                                <label class="block text-sm font-medium text-[#384046] mb-2">
                                    Main Image
                                </label>

                                <!-- Current Main Image -->
                                @if ($project->main_image)
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                                        <div class="relative inline-block">
                                            <img src="{{ asset('public/storage/' . $project->main_image) }}"
                                                alt="{{ $project->name }}"
                                                class="w-48 h-32 object-cover rounded-lg border border-gray-200">
                                        </div>
                                    </div>
                                @endif

                                <!-- New Main Image Upload -->
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                                    <input type="file" name="main_image" id="main_image" accept="image/*" class="hidden"
                                        onchange="previewMainImage(this)">
                                    <label for="main_image" class="cursor-pointer">
                                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span class="mt-2 block text-sm font-medium text-gray-900">
                                            Upload new main image
                                        </span>
                                        <span class="mt-1 block text-xs text-gray-500">
                                            PNG, JPG, GIF up to 2MB
                                        </span>
                                    </label>
                                </div>
                                <div id="mainImagePreview" class="mt-4 hidden">
                                    <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                                    <img id="mainImagePreviewImg"
                                        class="w-48 h-32 object-cover rounded-lg border border-gray-200">
                                </div>
                                @error('main_image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gallery Images -->
                            <div>
                                <label class="block text-sm font-medium text-[#384046] mb-2">
                                    Gallery Images
                                </label>

                                <!-- Current Gallery Images -->
                                @if ($project->gallery_images && count($project->gallery_images) > 0)
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-600 mb-2">Current Gallery Images:</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($project->gallery_images as $index => $galleryImage)
                                                <div class="relative group">
                                                    <img src="{{ asset('public/storage/' . $galleryImage) }}"
                                                        class="w-20 h-16 object-cover rounded-lg border border-gray-200">
                                                    <a href="{{ route('admin.projects.remove-gallery-image', ['project' => $project, 'imageIndex' => $index]) }}"
                                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-200"
                                                        onclick="return confirm('Are you sure you want to remove this image?')">
                                                        ×
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <!-- New Gallery Images Upload -->
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center">
                                    <input type="file" name="gallery_images[]" id="gallery_images" accept="image/*"
                                        multiple class="hidden" onchange="previewGalleryImages(this)">
                                    <label for="gallery_images" class="cursor-pointer">
                                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span class="mt-2 block text-sm font-medium text-gray-900">
                                            Add gallery images
                                        </span>
                                        <span class="mt-1 block text-xs text-gray-500">
                                            Select multiple images
                                        </span>
                                    </label>
                                </div>
                                <div id="galleryPreview" class="mt-4 hidden">
                                    <p class="text-sm text-gray-600 mb-2">New Images Preview:</p>
                                    <div id="galleryPreviewContainer" class="flex flex-wrap gap-2"></div>
                                </div>
                                @error('gallery_images.*')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Order & Status -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <!-- Order -->
                            <div>
                                <label for="order" class="block text-sm font-medium text-[#384046] mb-2">
                                    Order
                                </label>
                                <input type="number" name="order" id="order"
                                    value="{{ old('order', $project->order) }}" min="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#cc1820] focus:border-[#cc1820] @error('order') border-red-500 @enderror">
                                @error('order')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="is_active" class="block text-sm font-medium text-[#384046] mb-2">
                                    Status
                                </label>
                                <select name="is_active" id="is_active"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#cc1820] focus:border-[#cc1820]">
                                    <option value="1" {{ old('is_active', $project->is_active) ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="0" {{ !old('is_active', $project->is_active) ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-[#cc1820] hover:bg-[#a8141a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#cc1820] transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Project
                            </button>
                            <a href="{{ route('admin.projects.index') }}"
                                class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#cc1820] transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Preview main image
        function previewMainImage(input) {
            const preview = document.getElementById('mainImagePreview');
            const previewImg = document.getElementById('mainImagePreviewImg');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.add('hidden');
            }
        }

        // Preview gallery images
        function previewGalleryImages(input) {
            const preview = document.getElementById('galleryPreview');
            const previewContainer = document.getElementById('galleryPreviewContainer');

            previewContainer.innerHTML = '';

            if (input.files && input.files.length > 0) {
                for (let i = 0; i < input.files.length; i++) {
                    const reader = new FileReader();
                    const img = document.createElement('img');
                    img.className = 'w-20 h-16 object-cover rounded-lg border border-gray-200';

                    reader.onload = function(e) {
                        img.src = e.target.result;
                    }

                    reader.readAsDataURL(input.files[i]);
                    previewContainer.appendChild(img);
                }
                preview.classList.remove('hidden');
            } else {
                preview.classList.add('hidden');
            }
        }
    </script>
@endsection
