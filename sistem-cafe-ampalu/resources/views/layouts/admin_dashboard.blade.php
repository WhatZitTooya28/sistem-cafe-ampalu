<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Cafe Ampalu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Memuat Alpine.js untuk interaktivitas sidebar --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">

        <!-- (BARU) Overlay untuk mobile, akan muncul saat sidebar terbuka -->
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity md:hidden" 
             style="display: none;">
        </div>

        <!-- Sidebar -->
        <aside 
            class="fixed inset-y-0 left-0 z-30 w-64 bg-green-700 text-white transform -translate-x-full transition-transform duration-300 ease-in-out md:relative md:translate-x-0"
            :class="{'translate-x-0': sidebarOpen}"
        >
            <!-- Konten Sidebar -->
            <div class="flex flex-col p-4 h-full">
                <div class="text-center mb-10 mt-4">
                    <img src="https://placehold.co/80x80/FFFFFF/333333?text=Chef" alt="Foto Profil" class="w-20 h-20 rounded-full mx-auto mb-2 border-2 border-green-400">
                    <h2 class="font-bold text-lg">{{ Auth::user()->name }}</h2>
                    <p class="text-sm text-green-200">{{ Auth::user()->email }}</p>
                </div>

                <nav class="flex flex-col space-y-2">
                    <a href="#" class="flex items-center p-3 rounded-lg hover:bg-green-600 transition-colors">
                        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        <span>DASHBOARD</span>
                    </a>
                    <a href="{{ route('admin.menu.index') }}" class="flex items-center p-3 rounded-lg bg-green-800">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                        <span>Kelola Menu</span>
                    </a>
                    <a href="{{ route('admin.orders.history') }}" class="flex items-center p-3 rounded-lg hover:bg-green-600">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Riwayat Pesanan</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center p-3 rounded-lg hover:bg-green-600">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        <span>Pesanan</span>
                    </a>
                </nav>

                <div class="mt-auto">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-white text-green-700 font-bold py-2 px-4 rounded-lg hover:bg-gray-200">Logout</button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-md p-4 flex items-center justify-between">
                <!-- Tombol Hamburger untuk membuka sidebar di mobile -->
                <button @click.stop="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-500 focus:outline-none">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <div class="flex-1">
                    @yield('header')
                </div>
            </header>

            <!-- Area Konten -->
            <div class="flex-1 p-4 sm:p-8 overflow-y-auto">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>