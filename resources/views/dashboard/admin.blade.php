@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">

        <div class="flex flex-col items-start space-y-2 sm:space-y-0 sm:flex-row sm:items-center">
            <h3 class="text-2xl sm:text-3xl font-medium text-gray-700"><span class="text-indigo-600">HI</span>,
                {{ ucfirst(auth()->user()->username) }}.</h3>
        </div>

        <div class="">
            <div class="px-8 pt-6 pb-8 mb-4">



            </div>
        </div>
    </div>
@endsection
