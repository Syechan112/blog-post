<header class="hidden lg:flex items-center justify-between px-6 py-4 bg-white shadow-sm">
    <div class="flex items-center">
        <span class="text-2xl font-bold text-indigo-600">{{ $title }}</span>
    </div>
    <div class="flex items-center space-x-4">
        <a href="{{ route('user.profile') }}" class="flex items-center space-x-2 focus:outline-none">
            <img class="w-10 h-10 rounded-full border-2 border-indigo-200 object-cover"
                src="{{ auth()->user()->image ? asset(auth()->user()->image) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) }}"
                alt="User avatar" loading="lazy">
            <span class="hidden md:block text-sm font-medium text-gray-700">{{ auth()->user()->username }}</span>
        </a>
    </div>
</header>
