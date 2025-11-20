@extends('web.layout.app')

@section('title', 'Create Brand')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-[#384046]">Create New Brand</h1>
                        <p class="mt-2 text-sm text-gray-600">Add a new brand to your portfolio</p>
                    </div>
                    <a href="{{ route('admin.brands.index') }}"
                        class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#cc1820] transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Brands
                    </a>
                </div>
            </div>

            <!-- Brand Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Brand Name & Link -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Brand Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-[#384046] mb-2">
                                    Brand Name *
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#cc1820] focus:border-[#cc1820] @error('name') border-red-500 @enderror"
                                    placeholder="Enter brand name" required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Brand Link -->
                            <div>
                                <label for="link" class="block text-sm font-medium text-[#384046] mb-2">
                                    Website Link
                                </label>
                                <input type="url" name="link" id="link" value="{{ old('link') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#cc1820] focus:border-[#cc1820] @error('link') border-red-500 @enderror"
                                    placeholder="https://example.com">
                                @error('link')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Logo Upload -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-[#384046] mb-2">
                                Brand Logo *
                            </label>

                            <!-- Logo Upload Area -->
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-[#cc1820] transition-colors duration-200">
                                <input type="file" name="logo" id="logo" accept="image/*" class="hidden" required
                                    onchange="previewLogo(this)">
                                <label for="logo" class="cursor-pointer block">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span class="mt-4 block text-sm font-medium text-gray-900">
                                        Upload brand logo
                                    </span>
                                    <span class="mt-2 block text-xs text-gray-500">
                                        PNG, JPG, JPEG, SVG, WEBP up to 2MB
                                    </span>
                                    <span class="mt-1 block text-xs text-gray-500">
                                        Recommended: Square aspect ratio
                                    </span>
                                </label>
                            </div>
                            <div id="logoPreview" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 mb-2">Logo Preview:</p>
                                <img id="logoPreviewImg"
                                    class="w-32 h-32 object-contain rounded-lg border border-gray-200 shadow-sm bg-gray-50">
                            </div>
                            @error('logo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Order & Status -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <!-- Order -->
                            <div>
                                <label for="order" class="block text-sm font-medium text-[#384046] mb-2">
                                    Order
                                </label>
                                <input type="number" name="order" id="order" value="{{ old('order', 0) }}"
                                    min="0" placeholder="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#cc1820] focus:border-[#cc1820] @error('order') border-red-500 @enderror">
                                <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                                @error('order')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-[#384046] mb-2">
                                    Status
                                </label>
                                <select name="status" id="status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#cc1820] focus:border-[#cc1820]">
                                    <option value="1" {{ old('status', 1) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !old('status', 1) ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <p class="mt-1 text-xs text-gray-500">Inactive brands won't be visible on the website</p>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 pt-6 border-t border-gray-200">
                            <button type="submit"
                                class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-[#cc1820] hover:bg-[#a8141a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#cc1820] transition ease-in-out duration-150 shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create Brand
                            </button>
                            <a href="{{ route('admin.brands.index') }}"
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


@endsection

@push('script')
    <script>
        // Preview logo
        function previewLogo(input) {
            const preview = document.getElementById('logoPreview');
            const previewImg = document.getElementById('logoPreviewImg');

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

        // Form validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const logoInput = document.getElementById('logo');

            form.addEventListener('submit', function(e) {
                let valid = true;

                // Validate required fields
                const requiredFields = form.querySelectorAll('[required]');
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        valid = false;
                        field.classList.add('border-red-500');
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });

                // Validate logo
                if (!logoInput.files || logoInput.files.length === 0) {
                    valid = false;
                    logoInput.closest('.border-dashed').classList.add('border-red-500');
                } else {
                    logoInput.closest('.border-dashed').classList.remove('border-red-500');
                }

                if (!valid) {
                    e.preventDefault();
                    alert('Please fill in all required fields and upload a brand logo.');
                }
            });
        });
    </script>
@endpush
