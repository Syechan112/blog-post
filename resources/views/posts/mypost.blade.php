@extends('layouts.dashboard')

@section('content')

    @if (session()->has('success'))
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
            x-show="open" @click.away="open = false" x-data="{ open: true }">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div
                    class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-green-900" id="modal-title">
                                {{ session('success') }}
                            </h3>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button type="button"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm"
                            @click="open = false">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container mx-auto px-6 py-8">

        <div x-data="{ open: false }" class="relative inline-block text-left">
            <!-- Button utama -->
            <button @click="open = !open"
                class="flex items-center w-48 px-4 py-2 text-base font-semibold leading-6 text-white transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-lg shadow-md hover:bg-indigo-500 focus:outline-none focus:ring focus:ring-indigo-300 active:bg-indigo-700">
                <span class="ml-1 mr-2">Manage Posts</span>
                <i class="fas fa-chevron-down ml-auto transform transition-transform duration-200"
                    :class="open ? 'rotate-180' : 'rotate-0'"></i>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute left-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50 overflow-hidden">
                <a href="{{ route('user.posts.create') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                    <i class="fas fa-plus text-indigo-600 mr-3"></i> Add Post
                </a>
                <a href="{{ route('user.posts.index') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                    <i class="fas fa-list text-indigo-600 mr-3"></i> All Posts
                </a>
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.bookmarks.index') : route('user.bookmarks.index') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                    <i class="fas fa-bookmark text-indigo-600 mr-3"></i> Bookmarks
                </a>
                <a href="{{ route('user.archived') }}"
                    class="flex items-center px-4 py-2 text-sm text-yellow-700 hover:bg-yellow-100 transition">
                    <i class="fas fa-archive text-yellow-600 mr-3"></i> Archived
                </a>
            </div>
        </div>



        <div class="mt-6">
            @if ($posts->count() === 0)
                <div class="flex items-center justify-center mt-12">
                    <div class="text-center">
                        <i class="fas fa-file-alt mx-auto text-gray-400 text-4xl"></i>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">Tidak Ada Postingan</h3>
                    </div>
                </div>
            @else
                @foreach ($posts as $post)
                    <div class="mt-6 bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-4 py-1 rounded-full text-sm font-medium {{ $post->status === 'publish' ? 'bg-green-100 text-green-800' : ($post->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{ ucfirst($post->status) }}
                            </span>
                            <h4 class="font-bold text-xl text-gray-800 mt-3">{{ $post->title }}</h4>
                            <p class="text-gray-600 mt-2">By <a href=""
                                    class="text-indigo-600 hover:text-indigo-800">{{ $post->user->name }}</a></p>
                            <p class="text-gray-600 mt-2">Category: {{ $post->category->name }}</p>

                            <p class="text-gray-600 mt-2">{!! Str::limit($post->content, 100) !!}</p>
                        </div>
                        <div class="px-6 py-4 bg-gray-100 flex justify-between items-center">
                            <span class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</span>
                            <div class="flex items-center">
                                <a href="{{ route('user.posts.edit', $post->slug) }}"
                                    class="text-indigo-600 hover:text-indigo-800 text-sm mr-4">
                                    Edit
                                </a>
                                <div x-data="{ showModal: false }">
                                    <button @click="showModal = true" class="text-red-600 hover:text-red-800 text-sm">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto"
                                        aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                        <div
                                            class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <div x-show="showModal" x-transition:enter="ease-out duration-300"
                                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                                x-transition:leave="ease-in duration-200"
                                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                                aria-hidden="true"></div>

                                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                                aria-hidden="true">&#8203;</span>

                                            <div x-show="showModal" x-transition:enter="ease-out duration-300"
                                                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave="ease-in duration-200"
                                                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                    <div class="sm:flex sm:items-start">
                                                        <div
                                                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                            <svg class="h-6 w-6 text-red-600"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor"
                                                                aria-hidden="true">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                            </svg>
                                                        </div>
                                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                            <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                                id="modal-title">
                                                                Delete Post
                                                            </h3>
                                                            <div class="mt-2">
                                                                <p class="text-sm text-gray-500">
                                                                    Are you sure you want to delete this post? This action
                                                                    cannot be undone.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                    <button
                                                        @click="document.getElementById('delete-form-{{ $post->id }}').submit();"
                                                        type="button"
                                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Delete
                                                    </button>
                                                    <button @click="showModal = false" type="button"
                                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form id="delete-form-{{ $post->id }}"
                                action="{{ route('user.posts.destroy', $post->slug) }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
@endsection
