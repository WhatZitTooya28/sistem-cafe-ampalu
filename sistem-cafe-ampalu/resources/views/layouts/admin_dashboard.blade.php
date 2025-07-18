<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Cafe Ampalu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100" x-data="{ sidebarOpen: false, customerModalOpen: false }">
    <div class="flex h-screen bg-gray-100">

        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity md:hidden" style="display: none;"></div>

        <aside 
            class="fixed inset-y-0 left-0 z-30 w-64 bg-green-700 text-white transform -translate-x-full transition-transform duration-300 ease-in-out md:relative md:translate-x-0"
            :class="{'translate-x-0': sidebarOpen}">
            
            <div class="flex flex-col p-4 h-full">
                <div class="text-center mb-10 mt-4">
                    <img src="https://placehold.co/80x80/FFFFFF/333333?text={{ substr(Auth::user()->name, 0, 1) }}" alt="Foto Profil" class="w-20 h-20 rounded-full mx-auto mb-2 border-2 border-green-400">
                    <h2 class="font-bold text-lg">{{ Auth::user()->name }}</h2>
                    <p class="text-sm text-green-200 capitalize">{{ Auth::user()->role }}</p>
                </div>

                <nav class="flex flex-col space-y-2">
                    @if(in_array(Auth::user()->role, ['admin', 'dapur']))
                        <a href="{{ route('admin.orders.index') }}" class="flex items-center p-3 rounded-lg hover:bg-green-600 transition-colors">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                            <span>Pesanan Masuk</span>
                        </a>
                    @endif

                    @if(Auth::user()->role == 'kasir')
                         <a href="{{ route('kasir.dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-green-600 transition-colors">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"></path></svg>
                            <span>Halaman Awal</span>
                        </a>
                         <a href="{{ route('kasir.index') }}" class="flex items-center p-3 rounded-lg hover:bg-green-600 transition-colors">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            <span>Dashboard</span>
                        </a>
                    @endif

                    <a href="{{ route('admin.menu.index') }}" class="flex items-center p-3 rounded-lg hover:bg-green-600 transition-colors">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                        <span>Kelola Menu</span>
                    </a>
                    <a href="{{ route('admin.orders.history') }}" class="flex items-center p-3 rounded-lg hover:bg-green-600 transition-colors">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Riwayat Pesanan</span>
                    </a>
                </nav>

                <div class="mt-auto">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center bg-green-800 text-green-200 font-bold py-2 px-4 rounded-lg hover:bg-red-500 hover:text-white transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow-md p-4 flex items-center">
                <button @click.stop="sidebarOpen = !sidebarOpen" class="md:hidden text-gray-500 focus:outline-none mr-4">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6H20M4 12H20M4 18H20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
                <div class="flex-1">
                    @yield('header')
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-8 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>