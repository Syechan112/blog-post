@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8 mb-12">
        <h1 class="text-2xl font-semibold mb-6">{{ $post->title }}</h1>
        <p class="text-gray-600">By <a href="#" class="text-indigo-600 hover:text-indigo-800">{{ $post->user->name }}</a>
            in <a href="#" class="text-indigo-600 hover:text-indigo-800">{{ $post->category->name }}</a></p>
        <p class="text-gray-600 mt-2 text-justify">{!! $post->content !!}</p>
    </div>

    <div class="container mx-auto px-6 py-4 hidden sm:block">
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.posts.index') : route('user.posts.index') }}"
            class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md text-gray-600 font-semibold">
            &larr; Back
        </a>
    </div>

    <div class="container mx-auto px-4 sm:px-6 py-6 sm:py-8 bg-gray-50 rounded-lg shadow-md">
        <h2 class="text-2xl sm:text-3xl font-bold mb-6 sm:mb-8 text-gray-800 border-b pb-2">Comments</h2>

        {{-- Comment Form --}}
        <div class="mb-6 sm:mb-8">
            <h3 class="text-lg sm:text-xl font-semibold mb-3 sm:mb-4 text-gray-700">Add a Comment</h3>
            <form
                action="{{ auth()->user()->role === 'admin' ? route('admin.comments.store') : route('user.comments.store') }}"
                method="POST" class="space-y-3 sm:space-y-4">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <textarea name="content" required placeholder="Write your comment here..."
                    class="w-full p-2 sm:p-3 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out"></textarea>
                <button type="submit"
                    class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 sm:px-6 rounded-lg text-sm sm:text-base transition duration-300 ease-in-out flex items-center justify-center">
                    <i class="fas fa-comment mr-2"></i> Post Comment
                </button>

            </form>
        </div>

        {{-- Display Comments --}}
        <div class="mb-12 md:mb-0" x-data="{ loaded: false }" x-init="new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    loaded = true;
                }
            });
        }).observe($el)">

            <template x-if="loaded">
                <div class="space-y-4 sm:space-y-6">
                    @foreach ($post->comments->take(5) as $comment)
                        {{-- Batasi awalnya hanya 5 komentar --}}
                        <div
                            class="bg-white rounded-lg shadow p-4 sm:p-6 transition duration-300 ease-in-out hover:shadow-md">
                            <div class="flex items-start space-x-3 sm:space-x-4">
                                <img class="w-8 h-8 sm:w-10 sm:h-10 rounded-full border-2 border-blue-300 object-cover"
                                    src="{{ $comment->user->image ? asset($comment->user->image) : 'https://ui-avatars.com/api/?name=' . urlencode($comment->user->name) }}"
                                    alt="{{ $comment->user->name }}'s avatar" loading="lazy">
                                <div class="flex-1">
                                    <p class="font-bold text-base sm:text-lg text-gray-800">
                                        {{ $comment->user->name ?? 'Guest' }}</p>
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm sm:text-base text-gray-600 mt-1 sm:mt-2">{{ $comment->content }}
                                        </p>

                                        @if (auth()->check() && auth()->id() === $comment->user_id)
                                            <form
                                                action="{{ auth()->user()->role === 'admin' ? route('admin.comments.destroy', $comment->id) : route('user.comments.destroy', $comment->id) }}"
                                                method="POST" class="ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-800 text-xs sm:text-sm font-medium">
                                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>


                                    {{-- Reply Form --}}
                                    <form
                                        action="{{ auth()->user()->role === 'admin' ? route('admin.comments.store') : route('user.comments.store') }}"
                                        method="POST" class="mt-3 sm:mt-4 space-y-2 sm:space-y-3">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <textarea name="content" required placeholder="Reply to this comment..."
                                            class="w-full p-2 text-sm sm:text-base border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-300 focus:border-blue-400 transition duration-200 ease-in-out"></textarea>
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 sm:px-4 py-1 sm:py-2 rounded-md text-sm sm:text-base transition duration-300 ease-in-out">
                                            Reply
                                        </button>
                                    </form>

                                    {{-- Nested Comments (Replies) --}}
                                    @foreach ($comment->replies as $reply)
                                        <div
                                            class="mt-3 sm:mt-4 ml-4 sm:ml-8 p-3 sm:p-4 bg-gray-50 rounded-md border-l-4 border-blue-300">
                                            <div class="flex items-start space-x-2 sm:space-x-3">
                                                <img class="w-6 h-6 sm:w-8 sm:h-8 rounded-full border-2 border-blue-200 object-cover"
                                                    src="{{ $reply->user->image ? asset($reply->user->image) : 'https://ui-avatars.com/api/?name=' . urlencode($reply->user->name) }}"
                                                    alt="{{ $reply->user->name }}'s avatar" loading="lazy">
                                                <div>
                                                    <p class="font-semibold text-sm sm:text-base text-gray-800">
                                                        {{ $reply->user->name ?? 'Guest' }}</p>
                                                    <p class="text-xs sm:text-sm text-gray-600 mt-1">{{ $reply->content }}
                                                    </p>

                                                    @if (auth()->check() && auth()->id() === $reply->user_id)
                                                        <form
                                                            action="{{ auth()->user()->role === 'admin' ? route('admin.comments.destroy', $reply->id) : route('user.comments.destroy', $reply->id) }}"
                                                            method="POST" class="ml-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-red-600 hover:text-red-800 text-xs font-medium">
                                                                <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                            </button>
                                                        </form>
                                                    @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </template>
        </div>

    </div>
@endsection
