<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        html, body { height: 100%; }
        body { 
            font-family: 'Poppins', sans-serif;
            background-image: url("{{ asset('images/cafe-background.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false, customerModalOpen: false }">
    <div class="absolute inset-0 bg-black opacity-60"></div>

    <div class="relative min-h-screen">
        <div @click="sidebarOpen = false" class="fixed inset-0 bg-black opacity-50 z-30" x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-end="opacity-0" style="display: none;"></div>
        <aside 
            :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
            class="fixed inset-y-0 left-0 w-64 bg-gray-900 text-white shadow-lg z-40 transform transition-transform duration-300">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-6 text-white border-b border-gray-700 pb-4">Menu Navigasi</h2>
                <nav class="flex flex-col space-y-2">
                    <a href="{{ route('kasir.index') }}" class="text-lg text-gray-300 hover:bg-white/10 p-3 rounded-lg transition-colors">Dashboard Utama</a>
                    <a href="{{ route('admin.menu.index') }}" class="text-lg text-gray-300 hover:bg-white/10 p-3 rounded-lg transition-colors">Kelola Menu</a>
                    <a href="{{ route('admin.orders.history') }}" class="text-lg text-gray-300 hover:bg-white/10 p-3 rounded-lg transition-colors">Riwayat Pesanan</a>
                </nav>
            </div>
             <div class="mt-auto p-6 absolute bottom-0 w-full">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left text-lg text-red-400 hover:bg-white/10 p-3 rounded-lg transition-colors flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="w-full">
            <header class="p-6 flex justify-between items-center w-full absolute top-0 left-0 z-10">
                <button @click.stop="sidebarOpen = !sidebarOpen" class="bg-white/30 text-white p-2 rounded-md shadow backdrop-blur-sm hover:bg-white/50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div class="bg-gray-800/80 text-white text-xs font-bold px-2 py-1 rounded-md backdrop-blur-sm border border-white/20">
                    AMPALU KOPI
                </div>
            </header>

            <div class="min-h-screen flex items-center justify-center px-6">
                <div class="w-full max-w-lg bg-gray-900/40 backdrop-blur-xl rounded-2xl shadow-2xl p-6 text-white text-center border border-white/20">
                    <img src="{{ asset('images/banner-cafe.jpg') }}" alt="Banner Cafe" class="w-full h-auto rounded-xl mb-6">
                    <h1 class="text-2xl font-bold">Hai, {{ Auth::user()->name }}!</h1>
                    <p class="text-lg text-gray-200 mb-4">Silahkan input nama pelanggan jika ingin memesan</p>

                    <button @click="customerModalOpen = true" class="w-full max-w-xs py-2 px-4 rounded-lg bg-white/20 border border-white/30 text-gray-200 hover:bg-white/30 transition-colors">
                        Nama Pelanggan
                    </button>
                </div>
            </div>
        </main>
    </div>

    <div x-show="customerModalOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" style="display: none;">
        <div @click.away="customerModalOpen = false" class="bg-gray-800/80 backdrop-blur-lg border border-white/20 rounded-lg shadow-xl p-6 w-full max-w-sm">
            <h3 class="text-xl font-bold text-white mb-4">Nama Pelanggan :</h3>
            <form action="{{ route('kasir.take_away.start') }}" method="POST">
                @csrf
                <input type="text" name="customer_name_popup" class="mt-1 block w-full px-3 py-2 bg-white/20 border border-white/30 text-white placeholder-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400" placeholder="Masukkan Nama Anda" required>
                <button type="submit" class="mt-6 w-full bg-white/90 text-gray-800 font-bold py-3 rounded-lg hover:bg-white transition-colors">
                    Simpan
                </button>
            </form>
        </div>
    </div>

</body>
</html>