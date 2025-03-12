@extends('layouts.dashboard')

@section('content')
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none !important;
        }
    </style>


    <div class="container mx-auto px-6 py-8">

        <h3 class="text-3xl font-medium text-gray-700">Create Post</h3>

        <form action="{{ route('user.posts.store') }}" method="POST" class="mt-6">
            @csrf

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="hidden">
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                <input type="hidden" name="slug" id="slug" value="{{ old('slug') }}">
            </div>

            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <div class="mb-6 bg-white border border-gray-300 rounded-md">
                <main>
                    <trix-toolbar id="my_toolbar"></trix-toolbar>
                    <div class="more-stuff-inbetween"></div>
                    <trix-editor toolbar="my_toolbar" input="my_input"></trix-editor>
                </main>
                <input id="my_input" type="hidden" name="content" value="{{ old('content') }}">
                @error('content')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id"
                    class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('category_id') border-red-500 @enderror">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                    class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('status') border-red-500 @enderror">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
                @error('status')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center w-full justify-center mb-12">
                <button type="submit"
                    class="inline-flex w-full justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Create
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("trix-file-accept", function(event) {
            event.preventDefault(); // Mencegah file diupload
        });
    </script>
@endsection
