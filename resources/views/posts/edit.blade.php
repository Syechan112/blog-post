@extends('layouts.dashboard')

@section('content')
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none !important;
        }
    </style>

    <div class="container mx-auto px-6 py-8">

        <form action="{{ route('user.posts.update', $post->slug) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
                    class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
            <div class="mb-6 bg-white">
                <input id="my_input" type="hidden" name="content" value="{{ old('content', $post->content) }}">
                <trix-editor input="my_input"></trix-editor>
                @error('content')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" id="category"
                    class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('category') border-red-500 @enderror">
                    <option value="Teknologi & Programming"
                        {{ old('category', $post->category) == 'Teknologi & Programming' ? 'selected' : '' }}>Teknologi &
                        Programming
                    </option>
                    <option value="Bisnis & Keuangan"
                        {{ old('category', $post->category) == 'Bisnis & Keuangan' ? 'selected' : '' }}>Bisnis & Keuangan
                    </option>
                    <option value="Gaya Hidup & Kesehatan"
                        {{ old('category', $post->category) == 'Gaya Hidup & Kesehatan' ? 'selected' : '' }}>Gaya Hidup &
                        Kesehatan</option>
                    <option value="Edukasi & Karier"
                        {{ old('category', $post->category) == 'Edukasi & Karier' ? 'selected' : '' }}>Edukasi & Karier
                    </option>
                    <option value="Hiburan & Pop Culture"
                        {{ old('category', $post->category) == 'Hiburan & Pop Culture' ? 'selected' : '' }}>Hiburan & Pop
                        Culture</option>
                    <option value="Hobi & Kreativitas"
                        {{ old('category', $post->category) == 'Hobi & Kreativitas' ? 'selected' : '' }}>Hobi & Kreativitas
                    </option>
                    <option value="Review & Rekomendasi"
                        {{ old('category', $post->category) == 'Review & Rekomendasi' ? 'selected' : '' }}>Review &
                        Rekomendasi</option>
                </select>
                @error('category')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status"
                    class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('status') border-red-500 @enderror">
                    <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="publish" {{ old('status', $post->status) == 'publish' ? 'selected' : '' }}>Publish
                    </option>
                    <option value="archived" {{ old('status', $post->status) == 'archived' ? 'selected' : '' }}>Archived
                    </option>
                </select>
                @error('status')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center w-full mb-12">
                <button type="submit"
                    class="inline-flex justify-center w-full py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Update
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
