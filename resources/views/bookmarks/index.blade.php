@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-3xl font-medium md:font-bold text-gray-700"><i class="fas fa-bookmark mr-2"></i><span
                class="md:italic md:font-bold">{{ $title }} </span><span
                class="text-indigo-600 md:italic md:font-bold">{{ Auth::user()->username }}</span></h3>

        @foreach ($bookmarks as $bookmark)
            <div class="mt-6 bg-white rounded-lg shadow-md overflow-hidden mb-12">
                <div class="px-6 py-4">
                    <h4 class="font-bold text-xl text-gray-800">{{ $bookmark->post->title }}</h4>
                    <p class="text-gray-600 mt-2">Created by
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.posts', $bookmark->post->user->id) : route('user.posts', $bookmark->post->user->id) }}"
                            class="text-indigo-600 hover:text-indigo-800">
                            {{ $bookmark->post->user->name }} In
                            <a href="{{ auth()->user()->role === 'admin' ? route('admin.category.posts', $bookmark->post->category->slug) : route('user.category.posts', $bookmark->post->category->slug) }}"
                                class="text-indigo-600 hover:text-indigo-800">
                                {{ $bookmark->post->category->name }}
                            </a>
                        </a>
                    </p>
                    <p class="text-gray-600 mt-2">{!! Str::limit(strip_tags($bookmark->post->content), 100) !!}</p>
                </div>
                <div class="px-6 py-4 bg-gray-100 flex justify-between items-center">
                    <span class="text-sm text-gray-500">{{ $bookmark->post->created_at->format('M d, Y') }}</span>
                    <div class="flex items-center space-x-2">
                        <form
                            action="{{ auth()->user()->role === 'admin' ? route('admin.bookmarks.destroy', $bookmark->post->id) : route('user.bookmarks.destroy', $bookmark->post->id) }}"
                            method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center text-red-600 hover:text-red-800 transition-colors duration-200">
                                <i class="fas fa-bookmark mr-2"></i>
                                <span class="text-sm">Unbookmark {{ $bookmark->post->bookmarks->count() }}</span>
                            </button>
                        </form>
                        <span class="text-gray-400 text-sm">|</span>
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.posts.show', $bookmark->post->slug) }}"
                                class="text-indigo-600 hover:text-indigo-800 text-sm">
                                Read More
                            </a>
                        @else
                            <a href="{{ route('user.posts.show', $bookmark->post->slug) }}"
                                class="text-indigo-600 hover:text-indigo-800 text-sm">
                                Read More
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
