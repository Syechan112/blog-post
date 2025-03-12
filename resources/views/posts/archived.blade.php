@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">

        <div class="container mx-auto px-6 py-8">
            <h3 class="text-3xl font-medium text-gray-700">Archived Posts</h3>

            <div class="mt-6">
                @foreach (auth()->user()->posts->where('status', 'archived') as $post)
                    <div class="mt-6 bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="px-6 py-4">
                            <h4 class="font-bold text-xl text-gray-800">{{ $post->title }}</h4>
                            <p class="text-gray-600 mt-2">By <a href=""
                                    class="text-indigo-600 hover:text-indigo-800">{{ $post->user->name }}</a></p>
                            <p class="text-gray-600 mt-2">Category: {{ $post->category }}</p>

                            <p class="text-gray-600 mt-2">{!! Str::limit(strip_tags($post->content), 100) !!}</p>
                        </div>
                        <div class="px-6 py-4 bg-gray-100 flex justify-between items-center">
                            <span class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</span>
                            <a href="{{ route('user.posts.show', $post->slug) }}"
                                class="text-indigo-600 hover:text-indigo-800 text-sm">
                                Read More
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
