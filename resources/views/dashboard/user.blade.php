@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">

        <div class="flex flex-col items-start space-y-2 sm:space-y-0 sm:flex-row sm:items-center">
            <h3 class="text-2xl sm:text-3xl font-medium text-gray-700"><span class="text-indigo-600">HI</span>,
                {{ ucfirst(auth()->user()->username) }}.</h3>
        </div>

        <div class="mt-6">
            @php
                $posts = \App\Models\Post::withCount('bookmarks')->orderBy('bookmarks_count', 'desc')->take(5)->get();
            @endphp
            <div class="mt-4">
                <p class="text-gray-700 md:text-xl text-lg font-bold">Postingan Ter Populer</p>
            </div>
            <div class="flex flex-wrap -mx-4">
                @foreach ($posts as $post)
                    <div class="w-full lg:w-1/4 md:w-1/2 p-4">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="px-6 py-4">
                                <h4 class="font-bold text-xl text-gray-800">{{ $post->title }}</h4>
                                <p class="text-gray-600 mt-2">By <a href=""
                                        class="text-indigo-600 hover:text-indigo-800">{{ $post->user->name }}</a></p>
                                <p class="text-gray-600 mt-2">Category: {{ $post->category->name }}</p>
                                <p class="text-gray-600 mt-2">{!! Str::limit(strip_tags($post->content), 100) !!}</p>
                            </div>
                            <div class="px-6 py-4 bg-gray-100 flex justify-between items-center">
                                <span class="text-sm text-gray-500">Bookmarks: {{ $post->bookmarks_count }}</span>
                                <a href="{{ route('user.posts.show', $post->slug) }}"
                                    class="text-indigo-600 hover:text-indigo-800 text-sm">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                <p class="text-gray-700 md:text-xl text-lg font-bold">Postingan Terbaru</p>
            </div>
            <div class="flex flex-wrap -mx-4">
                @foreach (\App\Models\Post::latest()->take(5)->get() as $post)
                    <div class="w-full lg:w-1/4 md:w-1/2 p-4">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="px-6 py-4">
                                <h4 class="font-bold text-xl text-gray-800">{{ $post->title }}</h4>
                                <p class="text-gray-600 mt-2">By <a href=""
                                        class="text-indigo-600 hover:text-indigo-800">{{ $post->user->name }}</a></p>
                                <p class="text-gray-600 mt-2">Category: {{ $post->category->name }}</p>
                                <p class="text-gray-600 mt-2">{!! Str::limit(strip_tags($post->content), 100) !!}</p>
                            </div>
                            <div class="px-6 py-4 bg-gray-100 flex justify-between items-center">
                                <span class="text-sm text-gray-500">Posted at:
                                    {{ $post->created_at->format('d-m-Y') }}</span>
                                <a href="{{ route('user.posts.show', $post->slug) }}"
                                    class="text-indigo-600 hover:text-indigo-800 text-sm">
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
@endsection
