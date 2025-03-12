<div class="flex h-screen flex-col">
    <!-- Header -->
    <div class="hidden lg:block">
        @include('partials.dashboard-desktop.header')
    </div>

    <div class="hidden lg:block">
        <div class="flex h-screen flex-col">
            <div class="flex flex-1">
                <!-- Sidebar -->
                <div x-data="{ open: false }" class="relative">
                    <div @mouseenter="open = true" @mouseleave="open = false"
                        class="flex flex-col items-center bg-gray-900 text-white w-16 hover:w-48 transition-all duration-300 h-full p-2 space-y-4">

                        <!-- Item 1 -->
                        <div class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded-lg w-full cursor-pointer">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span x-show="open" class="text-sm font-medium">Dashboard</span>
                        </div>

                        <!-- Item 2 -->
                        <div class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded-lg w-full cursor-pointer">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                              </svg>
                            <span x-show="open" class="text-sm font-medium">Management Users</span>
                        </div>

                        <!-- Item 3 -->
                        <div class="flex items-center space-x-2 p-2 hover:bg-gray-700 rounded-lg w-full cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span x-show="open" class="text-sm font-medium">Settings</span>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="flex-1 p-10">
                    @yield('container.dashboard')
                </div>
            </div>
        </div>
    </div>
