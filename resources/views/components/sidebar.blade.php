{{-- dashboard --}}
<div class="hidden lg:flex lg:flex-col lg:flex-shrink-0 lg:w-16 lg:hover:w-64 lg:transition-all lg:duration-300 lg:ease-in-out lg:bg-white lg:border-r lg:border-gray-200 lg:shadow-sm"
    x-data="{ sidebarOpen: false }" @mouseenter="sidebarOpen = true" @mouseleave="sidebarOpen = false">
    <div class="flex items-center justify-center h-16 lg:border-b lg:border-gray-100">
        <img x-show="!sidebarOpen" src="{{ asset('icons/icon-dashboard/logo.png') }}" alt="logo" class="w-10 h-10">
        <span x-show="sidebarOpen" class="text-xl font-semibold"><span class="text-indigo-600">Write</span>Spce</span>
    </div>
    <nav class="flex-grow py-4">
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-6 py-3 text-gray-600 hover:text-indigo-600 hover:bg-gray-50 transition-colors duration-200 {{ $active === 'dashboard' ? 'bg-gray-200 text-indigo-600' : '' }}">
            @else
                <a href="{{ route('user.dashboard') }}"
                    class="flex items-center px-6 py-3 text-gray-600 hover:text-indigo-600 hover:bg-gray-50 transition-colors duration-200 {{ $active === 'dashboard' ? 'bg-gray-200 text-indigo-600' : '' }}">
        @endif
        <i class="fas fa-home w-5 h-5 text-center"></i>
        <span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Dashboard</span>
        </a>
        @if (auth()->user()->role === 'admin')
            <a href="{{ route('users.managements.index') }}"
                class="flex items-center px-6 py-3 mt-2 text-gray-600 hover:text-indigo-600 hover:bg-gray-50 transition-colors duration-200 {{ $active === 'users-managements' ? 'bg-gray-200 text-indigo-600' : '' }}">
                <i class="fas fa-users w-5 h-5 text-center"></i>
                <span x-show="sidebarOpen" class="ml-3 text-sm font-medium">User Management</span>
            </a>
        @endif
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.posts.index') : route('user.posts.index') }}"
            class="flex items-center px-6 py-3 mt-2 text-gray-600 hover:text-indigo-600 hover:bg-gray-50 transition-colors duration-200 {{ $active === 'posts' ? 'bg-gray-200 text-indigo-600' : '' }}">
            <i class="fas fa-newspaper w-5 h-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Posts</span>
        </a>
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.bookmarks.index') : route('user.bookmarks.index') }}"
            class="flex items-center px-6 py-3 mt-2 text-gray-600 hover:text-indigo-600 hover:bg-gray-50 transition-colors duration-200 {{ $active === 'bookmarks' ? 'bg-gray-200 text-indigo-600' : '' }}">
            <i class="fas fa-bookmark w-5 h-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Bookmarks</span>
        </a>
        <a href="#"
            class="flex items-center px-6 py-3 mt-2 text-gray-600 hover:text-indigo-600 hover:bg-gray-50 transition-colors duration-200">
            <i class="fas fa-envelope w-5 h-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Messages</span>
        </a>
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.settings') : route('user.settings') }}"
            class="flex items-center px-6 py-3 mt-2 text-gray-600 hover:text-indigo-600 hover:bg-gray-50 transition-colors duration-200 {{ $active === 'settings' ? 'bg-gray-200 text-indigo-600' : '' }}">
            <i class="fas fa-cog w-5 h-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Settings</span>
        </a>
    </nav>
    <div class="flex items-center justify-center h-16 mt-auto lg:border-t lg:border-gray-100">
        <form action="{{ route('logout') }}" method="POST"
            class="flex items-center text-gray-600 hover:text-indigo-600 transition-colors duration-200">
            @csrf
            <button type="submit" class="flex items-center focus:outline-none">
                <i class="fas fa-sign-out-alt w-5 h-5 text-center"></i>
                <span x-show="sidebarOpen" class="ml-3 text-sm font-medium">Logout</span>
            </button>
        </form>
    </div>
</div>



{{-- mobiile --}}
<nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg">
    <div class="flex justify-around items-center h-16">
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}"
            class="flex flex-col items-center text-gray-600 hover:text-indigo-600 transition-colors duration-200 {{ $active === 'dashboard' ? 'text-indigo-600' : '' }}">
            <i class="fas fa-home text-xl"></i>
            <span class="text-xs mt-1">Home</span>
        </a>
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.posts.index') : route('user.posts.index') }}"
            class="flex flex-col items-center text-gray-600 hover:text-indigo-600 transition-colors duration-200 {{ $active === 'posts' ? 'text-indigo-600' : '' }}">
            <i class="fas fa-list text-xl"></i>
            <span class="text-xs mt-1">Posts</span>
        </a>
        <a href="#"
            class="flex flex-col items-center text-gray-600 hover:text-indigo-600 transition-colors duration-200">
            <i class="fas fa-plus text-xl"></i>
            <span class="text-xs mt-1">Add</span>
        </a>
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.settings') : route('user.settings') }}"
            class="flex flex-col items-center text-gray-600 hover:text-indigo-600 transition-colors duration-200 {{ $active === 'settings' ? 'text-indigo-600' : '' }}">
            <i class="fas fa-cog text-xl"></i>
            <span class="text-xs mt-1">Settings</span>
        </a>
        <form action="{{ route('logout') }}" method="POST"
            class="flex flex-col items-center text-gray-600 hover:text-indigo-600 transition-colors duration-200">
            @csrf
            <button type="submit" class="flex flex-col items-center focus:outline-none">
                <i class="fas fa-sign-out-alt text-xl"></i>
                <span class="text-xs mt-1">Logout</span>
            </button>
        </form>
    </div>
</nav>
