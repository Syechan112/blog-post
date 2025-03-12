@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-3xl font-medium text-gray-700">Manage Users</h3>

        <div class="mt-4 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <a href="{{ route('users.managements.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-md hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700 sm:px-6 sm:py-2 sm:text-base sm:font-semibold sm:leading-6 md:w-auto">
                    <svg class="w-4 h-4 mr-2 sm:w-5 sm:h-5 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New User
                </a>
            </div>

            <div x-data="searchComponent()" class="relative w-full md:w-2/3">
                <form action="{{ route('users.managements.index') }}" method="GET" @submit="saveSearch">
                    <input type="search" name="search" x-model="searchTerm" placeholder="Search users..." autocomplete="off"
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

        </div>

        @if (session()->has('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif


        <div class="mt-8">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr class="text-left">
                            <th class="px-6 py-3 text-gray-600 font-bold uppercase text-xs border-b border-gray-200">
                                No</th>
                            <th class="px-6 py-3 text-gray-600 font-bold uppercase text-xs border-b border-gray-200">
                                Image</th>
                            <th class="px-6 py-3 text-gray-600 font-bold uppercase text-xs border-b border-gray-200">
                                Name</th>
                            <th class="px-6 py-3 text-gray-600 font-bold uppercase text-xs border-b border-gray-200">
                                Username</th>
                            <th class="px-6 py-3 text-gray-600 font-bold uppercase text-xs border-b border-gray-200">
                                Email</th>
                            <th class="px-6 py-3 text-gray-600 font-bold uppercase text-xs border-b border-gray-200">
                                Phone</th>
                            <th class="px-6 py-3 text-gray-600 font-bold uppercase text-xs border-b border-gray-200">
                                Role</th>
                            <th class="px-6 py-3 text-gray-600 font-bold uppercase text-xs border-b border-gray-200">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr class="hover:bg-gray-100 transition-colors duration-200">
                                <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $index + 1 }}</td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-4">
                                    <img src="{{ $user->image ? asset($user->image) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                        alt="User avatar" class="h-10 w-10 rounded-full object-cover">
                                </td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $user->name }}</td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $user->username }}</td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $user->email }}</td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-4">{{ $user->phone }}</td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-4">
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight rounded-full
                                        {{ $user->role === 'admin' ? 'bg-orange-100 text-orange-700' : 'bg-green-100 text-green-700' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="border-dashed border-t border-gray-200 px-6 py-4 flex justify-center">
                                    <a href="{{ route('users.managements.edit', $user) }}"
                                        class="text-yellow-500 hover:text-yellow-700 hover:underline px-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <div x-data="{ showModal: false, userToDelete: null }">
                                        <button @click="showModal = true; userToDelete = '{{ $user->id }}'"
                                            class="text-red-500 hover:text-red-700 hover:underline px-2">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto"
                                            aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                            <div
                                                class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                <div x-show="showModal" x-transition:enter="ease-out duration-300"
                                                    x-transition:enter-start="opacity-0"
                                                    x-transition:enter-end="opacity-100"
                                                    x-transition:leave="ease-in duration-200"
                                                    x-transition:leave-start="opacity-100"
                                                    x-transition:leave-end="opacity-0"
                                                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                                    aria-hidden="true"></div>

                                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                                    aria-hidden="true">&#8203;</span>

                                                <div x-show="showModal" x-transition:enter="ease-out duration-300"
                                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave="ease-in duration-200"
                                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                        <div class="sm:flex sm:items-start">
                                                            <div
                                                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                                <svg class="h-6 w-6 text-red-600"
                                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor"
                                                                    aria-hidden="true">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                                </svg>
                                                            </div>
                                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                                <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                                    id="modal-title">
                                                                    Delete User
                                                                </h3>
                                                                <div class="mt-2">
                                                                    <p class="text-sm text-gray-500">
                                                                        Are you sure you want to delete this user? This
                                                                        action cannot be undone.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                        <form
                                                            x-bind:action="'{{ route('users.destroy', '') }}/' + userToDelete"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                                Delete
                                                            </button>
                                                        </form>
                                                        <button @click="showModal = false" type="button"
                                                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $users->links('components.paginate') }}
                </div>


            </div>
        </div>
    </div>
@endsection
