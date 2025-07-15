<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Staf</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- (DIPERBARUI) Memuat Alpine.js untuk interaktivitas tombol password --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-100 relative">
    <!-- Tombol Close di pojok kiri atas -->
    <a href="{{ route('home') }}" class="absolute top-6 left-6 text-gray-600 hover:text-gray-900">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </a>

    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="w-full max-w-sm bg-white p-8 rounded-2xl shadow-lg">
            <div class="text-center mb-6">
                <div class="inline-block bg-gray-200 p-3 rounded-full mb-2">
                    <svg class="w-8 h-8 text-gray-800" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">login</h1>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <!-- Input Email -->
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path></svg>
                        </span>
                        <input type="email" name="email" placeholder="Masukkan Email" class="w-full pl-12 pr-3 py-3 bg-gray-100 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    </div>

                    <!-- (DIPERBARUI) Input Password dengan Tombol Hide/Show -->
                    <div x-data="{ showPassword: false }" class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                           <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2-2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                        </span>
                        <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Masukkan Password" class="w-full pl-12 pr-12 py-3 bg-gray-100 border-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                            <button type="button" @click="showPassword = !showPassword" class="text-gray-400 hover:text-gray-600">
                                <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 .847 0 1.67.128 2.453.36m6.425 9.344A10.01 10.01 0 0012 19c-1.624 0-3.16-.42-4.5-1.175m-2.14-2.14a8.96 8.96 0 00-1.06 2.315M18.364 5.636l-2.828 2.828m-2.122-2.121a4 4 0 00-5.656 5.656l-2.828 2.828m10.304-10.304l-2.828 2.828"></path></svg>
                            </button>
                        </div>
                    </div>

                    <!-- Dropdown Jabatan -->
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
                        </span>
                        <select name="role" class="w-full pl-12 pr-10 py-3 bg-gray-100 border-transparent rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <option value="" disabled selected>Pilih Jabatan</option>
                            <option value="kasir">Kasir</option>
                            <option value="dapur">Admin Dapur</option>
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </span>
                    </div>
                </div>
                <button type="submit" class="mt-6 w-full bg-green-500 text-white font-bold py-3 rounded-lg hover:bg-green-600 transition-colors">
                    login
                </button>
            </form>
        </div>
        <!-- Footer -->
        <div class="text-center mt-4">
            <p class="text-xs text-gray-400 font-semibold">Ampalu Cafe © 2025</p>
        </div>
    </div>
</body>
</html>