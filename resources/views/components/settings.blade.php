@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-2xl font-semibold mb-6">Pengaturan</h1>

        <div class="space-y-6">
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin.profile') }}"
                    class="block p-6 bg-white shadow-md rounded-lg hover:bg-gray-50 transition duration-300 ease-in-out transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <i class="fas fa-user-circle text-3xl text-blue-500 mr-4"></i>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Profile</h2>
                            <p class="text-gray-600">Update your profile information and photo</p>
                        </div>
                    </div>
                </a>
            @else
                <a href="{{ route('user.profile') }}"
                    class="block p-6 bg-white shadow-md rounded-lg hover:bg-gray-50 transition duration-300 ease-in-out transform hover:-translate-y-1">
                    <div class="flex items-center">
                        <i class="fas fa-user-circle text-3xl text-blue-500 mr-4"></i>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Profile</h2>
                            <p class="text-gray-600">Update your profile information and photo</p>
                        </div>
                    </div>
                </a>
            @endif

            <a href="#"
                class="block p-6 bg-white shadow-md rounded-lg hover:bg-gray-50 transition duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="flex items-center">
                    <i class="fas fa-shield-alt text-3xl text-green-500 mr-4"></i>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Security</h2>
                        <p class="text-gray-600">Change your password and security settings</p>
                    </div>
                </div>
            </a>

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('users.managements.index') }}"
                    class="block p-6 bg-white shadow-md rounded-lg hover:bg-gray-50 transition duration-300 ease-in-out transform hover:-translate-y-1 sm:hidden">
                    <div class="flex items-center">
                        <i class="fas fa-users text-3xl text-green-500 mr-4"></i>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">User Managements</h2>
                            <p class="text-gray-600">Manage users, create, edit, delete, and give permissions</p>
                        </div>
                    </div>
                </a>
            @endif

            <a href="#"
                class="block p-6 bg-white shadow-md rounded-lg hover:bg-gray-50 transition duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="flex items-center">
                    <i class="fas fa-bell text-3xl text-yellow-500 mr-4"></i>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Notifications</h2>
                        <p class="text-gray-600">Manage your notification preferences</p>
                    </div>
                </div>
            </a>

            <a href="#"
                class="block p-6 bg-white shadow-md rounded-lg hover:bg-gray-50 transition duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="flex items-center">
                    <i class="fas fa-user-secret text-3xl text-purple-500 mr-4"></i>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">Privacy</h2>
                        <p class="text-gray-600">Manage your account privacy settings</p>
                    </div>
                </div>
            </a>


        </div>


    </div>
@endsection
