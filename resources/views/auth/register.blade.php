@extends('layouts.auth.main')

@section('container.auth')
    <section class="h-screen flex md:flex-row flex-col-reverse">

        <div class="md:w-2/3 md:h-full hidden md:block">
            <img src="{{ asset('background/auth/register.jpg') }}" alt="" class="w-full h-full object-cover">
        </div>

        <div class="w-full md:w-1/3 h-full md:h-full p-6 md:p-10 flex flex-col justify-center">

            <div class="min-h-screen flex items-center justify-center py-6 px-4 sm:px-8">
                <div class="max-w-md w-full bg-white p-6 md:p-10 rounded-lg">
                    <div class="text-center">
                        <h2 class="text-xl md:text-2xl font-bold text-gray-900">Create Your Account</h2>
                        <p class="mt-2 text-gray-600">Sign up to get started</p>
                    </div>
                    <form action="{{ route('register.submit') }}" method="POST" class="mt-6 space-y-4 md:space-y-6">
                        @csrf
                        <div class="space-y-3 md:space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                    class="w-full mt-1 p-2 md:p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black text-gray-900 bg-gray-50">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input id="username" name="username" type="text" required value="{{ old('username') }}"
                                    class="w-full mt-1 p-2 md:p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black text-gray-900 bg-gray-50">
                                @error('username')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                <input id="email" name="email" type="email" required value="{{ old('email') }}"
                                    class="w-full mt-1 p-2 md:p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black text-gray-900 bg-gray-50">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <div x-data="{ showPassword: false, showConfirm: false }">
                                    <!-- Password -->
                                    <div class="relative">
                                        <label for="password"
                                            class="block text-sm font-medium text-gray-700">Password</label>
                                        <div class="relative">
                                            <input id="password" name="password" :type="showPassword ? 'text' : 'password'"
                                                required
                                                class="w-full mt-1 p-2 md:p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black text-gray-900 bg-gray-50">
                                            <span @click="showPassword = !showPassword"
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                                                <svg x-show="!showPassword"
                                                    class="h-5 w-5 text-gray-600 transition duration-200 ease-in-out"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3.98 8.783C5.918 5.713 8.74 4 12 4c3.26 0 6.082 1.713 8.02 4.783a10.317 10.317 0 010 6.434C18.082 18.287 15.26 20 12 20c-3.26 0-6.082-1.713-8.02-4.783a10.317 10.317 0 010-6.434z">
                                                    </path>
                                                    <circle cx="12" cy="12" r="3" stroke-linecap="round"
                                                        stroke-linejoin="round"></circle>
                                                </svg>
                                                <svg x-show="showPassword"
                                                    class="h-5 w-5 text-gray-600 transition duration-200 ease-in-out"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-3.26 0-6.082-1.713-8.02-4.783a10.317 10.317 0 010-6.434C5.918 5.713 8.74 4 12 4c3.26 0 6.082 1.713 8.02 4.783a10.317 10.317 0 010 6.434c-.642 1.026-1.461 1.937-2.415 2.67M3 3l18 18">
                                                    </path>
                                                </svg>
                                            </span>
                                        </div>
                                        @error('password')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="relative mt-4">
                                        <label for="password_confirmation"
                                            class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                        <div class="relative">
                                            <input id="password_confirmation" name="password_confirmation"
                                                :type="showConfirm ? 'text' : 'password'" required
                                                class="w-full mt-1 p-2 md:p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black text-gray-900 bg-gray-50">
                                            <span @click="showConfirm = !showConfirm"
                                                class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer">
                                                <svg x-show="!showConfirm"
                                                    class="h-5 w-5 text-gray-600 transition duration-200 ease-in-out"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3.98 8.783C5.918 5.713 8.74 4 12 4c3.26 0 6.082 1.713 8.02 4.783a10.317 10.317 0 010 6.434C18.082 18.287 15.26 20 12 20c-3.26 0-6.082-1.713-8.02-4.783a10.317 10.317 0 010-6.434z">
                                                    </path>
                                                    <circle cx="12" cy="12" r="3" stroke-linecap="round"
                                                        stroke-linejoin="round"></circle>
                                                </svg>
                                                <svg x-show="showConfirm"
                                                    class="h-5 w-5 text-gray-600 transition duration-200 ease-in-out"
                                                    fill="none" stroke="currentColor" stroke-width="2"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-3.26 0-6.082-1.713-8.02-4.783a10.317 10.317 0 010-6.434C5.918 5.713 8.74 4 12 4c3.26 0 6.082 1.713 8.02 4.783a10.317 10.317 0 010 6.434c-.642 1.026-1.461 1.937-2.415 2.67M3 3l18 18">
                                                    </path>
                                                </svg>
                                            </span>
                                        </div>
                                        @error('password_confirmation')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone
                                        Number</label>
                                    <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                                        class="w-full mt-1 p-2 md:p-3 border border-gray-300 rounded-md focus:ring-black focus:border-black text-gray-900 bg-gray-50">
                                    @error('phone')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="role" value="user">
                            <div>
                                <button type="submit"
                                    class="w-full flex justify-center py-2 md:py-3 px-4 border border-transparent rounded-md text-white bg-gray-800 hover:bg-gray-900 transition duration-200">
                                    Register
                                </button>
                            </div>

                            <div class="mt-4 text-center">
                                <p class="text-sm text-gray-600">Already have an account?
                                    <a href="{{ route('login.index') }}" class="text-gray-800 hover:underline">
                                        Log in
                                    </a>
                                </p>
                            </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
@endsection
