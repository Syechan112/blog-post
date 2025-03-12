@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-3xl font-medium text-gray-700">All Posts</h3>

        @if (auth()->user()->role === 'user')
            <a href="{{ route('my.posts') }}"
                class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white font-medium text-sm rounded hover:bg-indigo-700 transition-colors duration-200">
                <i class="fas fa-file-alt mr-2"></i>My Posts
            </a>
        @endif

        <a href="{{ auth()->user()->role === 'admin' ? route('admin.bookmarks.index') : route('user.bookmarks.index') }}"
            class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white font-medium text-sm rounded hover:bg-indigo-700 transition-colors duration-200 sm:hidden">
            <i class="fas fa-bookmark mr-2"></i>Bookmarks
        </a>

        <div class="flex items-center justify-center">
            <div x-data="searchComponent()" class="relative w-full md:w-1/2 mt-4 md:mt-1">
                <form
                    action="{{ auth()->user()->role === 'admin' ? route('admin.posts.index') : route('user.posts.index') }}"
                    method="GET" @submit="saveSearch">
                    <input type="search" name="search" x-model="searchTerm" placeholder="Search posts..."
                        autocomplete="off"
                        class="w-full peer z-[21] px-6 py-4 rounded-xl outline-none duration-200 ring-2 ring-[transparent] focus:ring-[#11BE86]"
                        @focus="showDropdown = true" @click.away="showDropdown = false" />
                    <div x-show="showDropdown" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute top-16 w-full z-[500] left-0 rounded-xl border border-white-222 p-4 bg-white shadow-lg">
                        <p class="font-semibold text-xs text-[#5D5D5F]">LAST SEARCHES</p>
                        <ul class="flex gap-2 flex-col mt-2">
                            <template x-for="search in lastSearches" :key="search">
                                <li @click="selectSearch(search)"
                                    class="px-2 cursor-pointer text-sm hover:bg-green-100 py-2 rounded-lg" x-text="search">
                                </li>
                            </template>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function searchComponent() {
                return {
                    searchTerm: '{{ request()->query('search') ?? '' }}',
                    showDropdown: false,
                    lastSearches: [],
                    init() {
                        this.lastSearches = JSON.parse(localStorage.getItem('lastSearches')) || [];
                    },
                    saveSearch() {
                        if (this.searchTerm.trim()) {
                            this.lastSearches.unshift(this.searchTerm);
                            this.lastSearches = this.lastSearches.slice(0, 3);
                            localStorage.setItem('lastSearches', JSON.stringify(this.lastSearches));
                        }
                    },
                    selectSearch(search) {
                        this.searchTerm = search;
                        this.$refs.form.submit();
                    }
                }
            }
        </script>


        @if ($posts->isEmpty())
            <p class="text-gray-600">No posts found.</p>
        @else
            @foreach ($posts as $post)
                @if ($post->status === 'publish')
                    <div class="mt-6 bg-white rounded-lg shadow-md overflow-hidden mb-12">
                        <div class="px-6 py-4">
                            <h4 class="font-bold text-xl text-gray-800">{{ $post->title }}</h4>
                            <p class="text-gray-600 mt-2">Created by
                                <a href="{{ auth()->user()->role === 'admin' ? route('admin.posts', $post->user->id) : route('user.posts', $post->user->id) }}"
                                    class="text-indigo-600 hover:text-indigo-800">
                                    {{ $post->user->name }} In
                                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.category.posts', $post->category->slug) : route('user.category.posts', $post->category->slug) }}"
                                        class="text-indigo-600 hover:text-indigo-800">
                                        {{ $post->category->name }}
                                    </a>
                                </a>
                            </p>

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
                @endif
            @endforeach
        @endif



        <div class="mt-4">
            {{ $posts->links('components.paginate') }}
        </div>


    </div>
@endsection
