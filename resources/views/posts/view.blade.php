@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8 mb-12">

        <h1 class="text-2xl font-semibold mb-6">{{ $post->title }}</h1>
        <p class="text-gray-600">By <a href="" class="text-indigo-600 hover:text-indigo-800">{{ $post->user->name }}</a>
            in <a href="" class="text-indigo-600 hover:text-indigo-800">{{ $post->category->name }}</a></p>
        <p class="text-gray-600 mt-2 text-justify justify">{!! $post->content !!}</p>

    </div>


        <div class="container mx-auto px-6 py-4 hidden sm:block">
            <a href="{{ auth()->user()->role === 'admin' ? route('admin.posts.index') : route('user.posts.index') }}" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded-md text-gray-600 font-semibold">
                &larr; Back
            </a>
        </div>
@endsection


