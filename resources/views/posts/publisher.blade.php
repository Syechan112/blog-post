@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold mb-4">Postingan dari <span class="text-indigo-500">{{ $user->name }}</span></h2>

        @foreach ($posts as $post)
            <div class="mt-6 bg-white rounded-lg shadow-md overflow-hidden mb-12">
                <div class="px-6 py-4">
                    <h4 class="font-bold text-xl text-gray-800">{{ $post->title }}</h4>
                    <p class="text-gray-600 mt-2">By
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.posts', $post->user->id) : route('user.posts', $post->user->id) }}"
                            class="text-indigo-600 hover:text-indigo-800">
                            {{ $post->user->name }} In
                            <a href="{{ auth()->user()->role === 'admin' ? route('admin.category.posts', $post->category->slug) : route('user.category.posts', $post->category->slug) }}"
                                class="text-indigo-600 hover:text-indigo-800">
                                {{ $post->category->name }}
                            </a>
                        </a>
                    <p class="text-gray-600 mt-2">{!! Str::limit(strip_tags($post->content), 100) !!}</p>
                </div>
                <div class="px-6 py-4 bg-gray-100 flex justify-between items-center">
                    <span class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</span>
                    <div class="flex items-center space-x-2">
                        <form
                            action="{{ auth()->user()->role === 'admin' ? (auth()->user()->bookmarks->contains('post_id', $post->id) ? route('admin.bookmarks.destroy', $post->id) : route('admin.bookmarks.store')) : (auth()->user()->bookmarks->contains('post_id', $post->id) ? route('user.bookmarks.destroy', $post->id) : route('user.bookmarks.store')) }}"
                            method="POST" style="display: inline;">
                            @csrf
                            @if (auth()->user()->bookmarks->contains('post_id', $post->id))
                                @method('DELETE')
                                <button type="submit"
                                    class="flex items-center text-red-600 hover:text-red-800 transition-colors duration-200">
                                    <i class="fas fa-bookmark mr-2"></i>
                                    <span class="text-sm">Unbookmark {{ $post->bookmarks->count() }}</span>
                                </button>
                            @else
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <button type="submit"
                                    class="flex items-center text-gray-600 hover:text-red-600 transition-colors duration-200">
                                    <i class="fas fa-bookmark mr-2 text-gray-400"></i>
                                    <span class="text-sm">Bookmark {{ $post->bookmarks->count() }}</span>
                                </button>
                            @endif
                        </form>
                        <span class="text-gray-400 text-sm">|</span>
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.posts.show', $post->slug) : route('user.posts.show', $post->slug) }}"
                            class="text-indigo-600 hover:text-indigo-800 text-sm">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

        @if ($posts->isEmpty())
            <p class="text-gray-500">User ini belum punya postingan.</p>
        @endif
    </div>
@endsection
