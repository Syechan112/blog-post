<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WriteSpace | {{ $title }}</title>
    {{-- @vite('resources/css/app.css') --}}
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('font/font.css') }}">

    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

</head>

<body class="poppins-regular">

    <div class="header sticky top-0 bg-white">
        <!-- Navbar Desktop -->
        <nav class="bg-white shadow-md py-4 hidden md:block">
            <div class="container mx-auto px-6 flex justify-between items-center">
                <a href="#" class="text-2xl font-semibold text-gray-800">WriteSpace</a>
                <ul class="flex items-center space-x-6">
                    <li><a href="#" class="text-gray-700 hover:text-gray-500 transition">Home</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-gray-500 transition">About</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-gray-500 transition">Contact</a></li>
                    <li><a href="/register" class="text-gray-700 hover:text-gray-500 transition">Register</a></li>
                </ul>
            </div>
        </nav>

        <!-- Navbar Mobile -->
        <nav x-data="{ isOpen: false }" class="bg-white shadow-md py-4 md:hidden sticky top-0 z-[100]">
            <div class="container mx-auto px-6 flex justify-between items-center">
                <a href="#" class="text-2xl font-semibold text-gray-800">WriteSpace</a>
                <button @click="isOpen = !isOpen" class="text-gray-700 focus:outline-none">
                    <svg x-show="!isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                    <svg x-show="isOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Dropdown Mobile -->
            <div x-show="isOpen" x-cloak class="mt-3 space-y-2 bg-white p-4"
                x-transition:enter="transition ease-out duration-200 transform"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150 transform"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                <ul class="flex flex-col space-y-3">
                    <li><a href="#" class="block text-gray-700 hover:text-gray-500 transition">Home</a></li>
                    <li><a href="#" class="block text-gray-700 hover:text-gray-500 transition">About</a></li>
                    <li><a href="#" class="block text-gray-700 hover:text-gray-500 transition">Contact</a></li>
                    <li><a href="/register" class="block text-gray-700 hover:text-gray-500 transition">Register</a></li>
                </ul>
            </div>
        </nav>

    </div>

    <div class="hero relative min-h-screen flex items-center justify-center px-4 overflow-hidden">
        <!-- Background Abstract Candy -->
        <div class="absolute inset-0 bg-gradient-to-r from-pink-300 via-purple-300 to-blue-300 opacity-80"></div>

        <!-- Blob Shapes -->
        <div class="absolute top-10 left-10 w-40 h-40 bg-pink-400 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-20 right-10 w-56 h-56 bg-purple-500 rounded-full blur-2xl opacity-40"></div>
        <div
            class="absolute top-1/3 left-1/2 transform -translate-x-1/2 w-72 h-72 bg-yellow-300 rounded-full blur-[90px] opacity-30">
        </div>

        <!-- Content -->
        <div class="relative text-center text-white max-w-2xl mx-auto">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">Welcome to My Blog</h1>
            <p class="text-lg sm:text-xl mb-8">Discover amazing stories and insights</p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mt-6">
                <a href="#content-1"
                    class="bg-white text-purple-600 px-6 py-3 rounded-full font-semibold hover:bg-purple-100 transition duration-300 w-48 text-center">
                    View More
                </a>
                <a href="/login"
                    class="bg-purple-700 text-white px-6 py-3 rounded-full font-semibold hover:bg-purple-800 transition duration-300 w-48 text-center">
                    Login Now
                </a>
            </div>
        </div>
    </div>


    </div>

<section x-data="{ activeTab: 'write' }" class="bg-gradient-to-r from-purple-100 to-blue-100 py-16">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-8 text-center text-purple-800">Discover WriteSpace</h2>
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <div class="mb-6 flex space-x-4 border-b border-purple-300">
                    <button @click="activeTab = 'write'" :class="{ 'border-b-2 border-purple-600': activeTab === 'write' }" class="pb-2 px-4 text-lg font-semibold text-purple-800 focus:outline-none">Write</button>
                    <button @click="activeTab = 'connect'" :class="{ 'border-b-2 border-purple-600': activeTab === 'connect' }" class="pb-2 px-4 text-lg font-semibold text-purple-800 focus:outline-none">Connect</button>
                    <button @click="activeTab = 'grow'" :class="{ 'border-b-2 border-purple-600': activeTab === 'grow' }" class="pb-2 px-4 text-lg font-semibold text-purple-800 focus:outline-none">Grow</button>
                </div>
                <div x-show="activeTab === 'write'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100">
                    <p class="text-lg mb-6 text-gray-700 leading-relaxed">
                        WriteSpace provides a seamless writing experience with our intuitive editor. Craft your stories, articles, and ideas with ease. Our platform supports various formats and styles, allowing your creativity to flourish without technical limitations.
                    </p>
                </div>
                <div x-show="activeTab === 'connect'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" style="display: none;">
                    <p class="text-lg mb-6 text-gray-700 leading-relaxed">
                        Join a vibrant community of writers and readers. Share your work, receive feedback, and collaborate with like-minded individuals. WriteSpace's social features make it easy to build your network and find your audience.
                    </p>
                </div>
                <div x-show="activeTab === 'grow'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" style="display: none;">
                    <p class="text-lg mb-6 text-gray-700 leading-relaxed">
                        Take your writing to the next level with WriteSpace's growth tools. Track your progress, analyze your audience engagement, and leverage our promotional features to expand your readership and potentially monetize your content.
                    </p>
                </div>
                <a href="{{ route('register.index') }}" class="inline-block bg-purple-600 text-white py-3 px-6 rounded-full hover:bg-purple-700 transition duration-300 ease-in-out transform hover:scale-105">Start Your Journey</a>
            </div>
            <div class="hidden md:block relative">
                <img src="https://picsum.photos/seed/writeSpace/600/400" alt="WriteSpace Illustration" class="w-full h-auto rounded-lg shadow-lg transition-all duration-300 ease-in-out transform hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-tr from-purple-500 to-blue-500 opacity-20 rounded-lg"></div>
            </div>
        </div>
    </div>
</section>




    <footer class="bg-gray-400 text-black py-10">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Kolom 1: Logo & Deskripsi -->
            <div>
                <h2 class="text-2xl font-bold text-white">WriteSpace</h2>
                <p class="text-sm mt-2 text-text-white">Tempat berbagi inspirasi, cerita, dan wawasan terbaru dari
                    berbagai penulis.</p>
            </div>

            <!-- Kolom 2: Navigasi Cepat -->
            <div>
                <h3 class="text-lg font-semibold text-white">Navigasi</h3>
                <ul class="mt-2 space-y-2">
                    <li><a href="#" class="hover:text-white">Beranda</a></li>
                    <li><a href="#" class="hover:text-white">Artikel</a></li>
                    <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white">Kontak</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Sosial Media -->
            <div>
                <h3 class="text-lg font-semibold text-white">Ikuti Kami</h3>
                <ul class="mt-2 space-y-2">
                    <li><a href="#" class="flex items-center hover:text-white">
                            <i class="fab fa-facebook mr-2"></i> Facebook
                        </a></li>
                    <li><a href="#" class="flex items-center hover:text-white">
                            <i class="fab fa-twitter mr-2"></i> Twitter
                        </a></li>
                    <li><a href="#" class="flex items-center hover:text-white">
                            <i class="fab fa-instagram mr-2"></i> Instagram
                        </a></li>
                </ul>
            </div>

            <!-- Kolom 4: Kontak -->
            <div>
                <h3 class="text-lg font-semibold text-white">Kontak Kami</h3>
                <ul class="mt-2 space-y-2">
                    <li class="flex items-center"><i class="fas fa-envelope mr-2"></i> support@myblog.com</li>
                    <li class="flex items-center"><i class="fas fa-phone mr-2"></i> +62 812-3456-7890</li>
                    <li class="flex items-center"><i class="fas fa-map-marker-alt mr-2"></i> Jakarta, Indonesia</li>
                </ul>
            </div>

        </div>

        <!-- Copyright -->
        <div class="text-center text-white text-sm mt-10 border-t border-white pt-4">
            &copy; {{ date('Y') }} MyBlog. All Rights Reserved.
        </div>
    </footer>



</body>

</html>
