@extends('web.layout.app')

@section('title', 'Add New Staff Member')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-[#384046]">Add New Staff Member</h1>
                <p class="mt-2 text-sm text-gray-600">Enter staff details to create a new account</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden p-6">
                <form method="POST" action="{{ route('admin.staff.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Avatar -->
                        <div class="md:col-span-2">
                            <label for="avatar" class="block text-sm font-medium text-[#384046] mb-2">Profile
                                Picture</label>
                            <input type="file" name="avatar" id="avatar" accept="image/*"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#cc1820] focus:ring focus:ring-[#cc1820] focus:ring-opacity-50">
                            @error('avatar')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-[#384046] mb-2">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#cc1820] focus:ring focus:ring-[#cc1820] focus:ring-opacity-50">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-[#384046] mb-2">Email
                                Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#cc1820] focus:ring focus:ring-[#cc1820] focus:ring-opacity-50">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-[#384046] mb-2">Phone Number</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#cc1820] focus:ring focus:ring-[#cc1820] focus:ring-opacity-50">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div>
                            <label for="role_id" class="block text-sm font-medium text-[#384046] mb-2">Role</label>
                            <select name="role_id" id="role_id" required
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#cc1820] focus:ring focus:ring-[#cc1820] focus:ring-opacity-50">
                                <option value="">Select a role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-[#384046] mb-2">Password</label>
                            <input type="password" name="password" id="password" required
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#cc1820] focus:ring focus:ring-[#cc1820] focus:ring-opacity-50">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-[#384046] mb-2">Confirm
                                Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#cc1820] focus:ring focus:ring-[#cc1820] focus:ring-opacity-50">
                        </div>

                        <!-- Active Status & Team Options -->
                        <div class="md:col-span-2">
                            <!-- Team Position (optional) -->
                            <div class="mt-4">
                                <label for="team_position" class="block text-sm font-medium text-[#384046] mb-2">
                                    Team Position (optional) <span class="text-gray-400 text-xs">– If left empty, the role
                                        name will be displayed</span>
                                </label>
                                <input type="text" name="team_position" id="team_position"
                                    value="{{ old('team_position') }}"
                                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#cc1820] focus:ring focus:ring-[#cc1820] focus:ring-opacity-50"
                                    placeholder="e.g. Creative Director">
                                @error('team_position')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Active Account -->
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="is_active" value="1"
                                        {{ old('is_active', true) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-[#cc1820] shadow-sm focus:border-[#cc1820] focus:ring focus:ring-[#cc1820] focus:ring-opacity-50">
                                    <span class="text-sm text-[#384046]">Active Account</span>
                                </label>

                                <!-- Show in Team -->
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="show_in_team" value="1"
                                        {{ old('show_in_team') ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-[#cc1820] shadow-sm focus:border-[#cc1820] focus:ring focus:ring-[#cc1820] focus:ring-opacity-50">
                                    <span class="text-sm text-[#384046]">Show in Team Section</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.staff.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#cc1820]">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-[#cc1820] border border-transparent rounded-lg hover:bg-[#a8141a] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#cc1820]">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
