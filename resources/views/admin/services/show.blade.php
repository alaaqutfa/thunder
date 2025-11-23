@extends('web.layout.app')

@section('title', 'Service Details')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-purple-50 to-violet-50 dark:from-gray-700 dark:to-gray-800">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.services.index') }}"
                   class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors duration-200 p-2 rounded-lg hover:bg-white dark:hover:bg-gray-700">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $service->name }}</h2>
                    <p class="text-gray-600 dark:text-gray-300 mt-1">Service details and information</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.services.edit', $service) }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-all duration-200">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Description -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-3">Description</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ $service->description }}</p>
                </div>

                <!-- Projects -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Related Projects</h3>
                    @if($service->projects->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($service->projects->take(4) as $project)
                            <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <h4 class="font-medium text-gray-800 dark:text-white">{{ $project->name }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ Str::limit($project->description, 60) }}</p>
                                <span class="inline-block mt-2 px-2 py-1 text-xs bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded">
                                    {{ $project->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            @endforeach
                        </div>
                        @if($service->projects->count() > 4)
                        <div class="mt-4 text-center">
                            <a href="{{ route('admin.projects.index') }}?service={{ $service->id }}"
                               class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium">
                                View all {{ $service->projects->count() }} projects
                            </a>
                        </div>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-folder-open text-gray-400 text-3xl mb-3"></i>
                            <p class="text-gray-500 dark:text-gray-400">No projects found for this service</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Icon & Status -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-blue-100 dark:bg-blue-900 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="{{ $service->icon }} text-blue-600 dark:text-blue-400 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $service->name }}</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ $service->slug }}</p>

                        <div class="mt-4 space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400">Status:</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $service->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400">Order:</span>
                                <span class="font-medium text-gray-800 dark:text-white">{{ $service->order }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400">Projects:</span>
                                <span class="font-medium text-gray-800 dark:text-white">{{ $service->active_projects_count }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 dark:text-gray-400">Created:</span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $service->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.services.edit', $service) }}"
                           class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg flex items-center justify-center gap-2 transition-all duration-200">
                            <i class="fas fa-edit"></i>
                            Edit Service
                        </a>
                        <form action="{{ route('admin.services.toggle', $service) }}" method="POST">
                            @csrf
                            <button type="submit"
                                    class="w-full bg-{{ $service->is_active ? 'yellow' : 'green' }}-600 hover:bg-{{ $service->is_active ? 'yellow' : 'green' }}-700 text-white px-4 py-3 rounded-lg flex items-center justify-center gap-2 transition-all duration-200">
                                <i class="fas fa-{{ $service->is_active ? 'pause' : 'play' }}"></i>
                                {{ $service->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
