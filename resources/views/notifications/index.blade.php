@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">

        <div class="container mx-auto px-4 py-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Notifikasi</h2>
            <div class="flex justify-end mb-3">
                <form action="{{ route('user.notifications.clear') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700 hover:shadow-lg">
                        <i class="fas fa-trash-alt mr-2"></i>
                        Clear All
                    </button>
                </form>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                @forelse ($notifications as $notification)
                    <div class="border-b border-gray-200 last:border-b-0">
                        <div class="px-6 py-4 hover:bg-gray-50 transition duration-150 ease-in-out">
                            <div class="flex items-center space-x-3">
                                <img class="w-10 h-10 rounded-full border-2 border-indigo-200 object-cover"
                                    src="{{ $notification->notifier->image ? asset($notification->notifier->image) : 'https://ui-avatars.com/api/?name=' . urlencode($notification->notifier->name) }}"
                                    alt="User avatar" loading="lazy">
                                <p class="text-sm">
                                    <span class="font-semibold text-gray-700">{{ $notification->notifier->name }}</span>
                                    <span class="text-gray-600">
                                        @if ($notification->comment)
                                            mengomentari postinganmu:
                                            <span
                                                class="italic text-gray-800">"{{ $notification->comment->content }}"</span>
                                        @else
                                            telah membookmark postinganmu
                                        @endif
                                    </span>
                                </p>
                            </div>
                            <a href="{{ route('user.posts.show', $notification->post->slug) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-1 block">
                                {{ $notification->post->title }}
                            </a>
                            <form action="{{ route('user.notifications.destroy', $notification->id) }}" method="POST"
                                class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    <i class="fas fa-trash-alt mr-2"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-4 text-gray-500 text-sm">
                        Tidak ada notifikasi.
                    </div>
                @endforelse
            </div>
        </div>


    </div>
@endsection
