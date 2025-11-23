@extends('web.layout.app')

@section('title', 'Create Service')

@push('css')
    <style>
        #iconPreview {
            color: #cc1820;
            font-size: 2.25rem;
        }
    </style>
@endpush

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-[#384046]">Create New Service</h1>
                        <p class="mt-2 text-sm text-gray-600">Add a new service to your portfolio</p>
                    </div>
                    <a href="{{ route('admin.services.index') }}"
                        class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#cc1820] transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Services
                    </a>
                </div>
            </div>

            <!-- Service Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('admin.services.store') }}" method="POST">
                        @csrf

                        <!-- Service Name & Icon -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Service Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-[#384046] mb-2">
                                    Service Name *
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#cc1820] focus:border-[#cc1820] @error('name') border-red-500 @enderror"
                                    placeholder="Enter service name" required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Icon -->
                            <div>
                                <label for="icon" class="block text-sm font-medium text-[#384046] mb-2">
                                    Icon *
                                </label>
                                <input type="text" name="icon" id="icon" value="{{ old('icon', 'fas fa-cube') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#cc1820] focus:border-[#cc1820] @error('icon') border-red-500 @enderror"
                                    placeholder="fas fa-icon-name" required>
                                <p class="mt-1 text-xs text-gray-500">Click <a href="https://icons.getbootstrap.com/"
                                        target="_blank">here</a> to see icons list</p>
                                @error('icon')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-[#384046] mb-2">
                                Description *
                            </label>
                            <textarea name="description" id="description" rows="4" placeholder="Enter service description"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#cc1820] focus:border-[#cc1820] @error('description') border-red-500 @enderror"
                                required>{{ old('description') }}</textarea>
                            @error('description')
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
                                <label for="is_active" class="block text-sm font-medium text-[#384046] mb-2">
                                    Status
                                </label>
                                <select name="is_active" id="is_active"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-[#cc1820] focus:border-[#cc1820]">
                                    <option value="1" {{ old('is_active', 1) ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !old('is_active', 1) ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <p class="mt-1 text-xs text-gray-500">Inactive services won't be visible on the website</p>
                            </div>
                        </div>

                        <!-- Icon Preview -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-[#384046] mb-2">
                                Icon Preview
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50">
                                <div class="text-4xl text-[#cc1820] mb-3">
                                    <i id="iconPreview"></i>
                                </div>
                                <p class="text-sm text-gray-600" id="iconPreviewText"></p>
                                <p class="text-xs text-gray-500 mt-1">Live preview of your selected icon</p>
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
                                Create Service
                            </button>
                            <a href="{{ route('admin.services.index') }}"
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
        // Live icon preview
        document.getElementById('icon').addEventListener('input', function(e) {
            const preview = document.getElementById('iconPreview');
            const previewText = document.getElementById('iconPreviewText');

            preview.className = e.target.value;
            previewText.textContent = e.target.value;
        });

        // Form validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');

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

                if (!valid) {
                    e.preventDefault();
                    alert('Please fill in all required fields.');
                }
            });
        });
    </script>
@endsection
