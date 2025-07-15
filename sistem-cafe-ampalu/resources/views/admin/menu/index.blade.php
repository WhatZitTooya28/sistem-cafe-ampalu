@extends('layouts.admin_dashboard')
@section('title', 'Kelola Menu')

@section('header')
    <div class="flex items-center space-x-4">
        <div class="bg-white p-2 rounded-lg shadow">
            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">Kelola Menu</h1>
    </div>
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.menu.create') }}" class="bg-gray-200 text-gray-800 font-bold py-2 px-6 rounded-lg border border-gray-300 hover:bg-gray-300">Tambah Menu</a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Bungkus tabel dengan div ini untuk membuatnya scrollable di mobile -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <!-- (DIPERBARUI) Menambahkan whitespace-nowrap -->
                        <th class="py-3 px-4 text-left font-semibold text-gray-600 whitespace-nowrap">Nama</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-600 whitespace-nowrap">Harga</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-600 whitespace-nowrap">Kategori</th>
                        <th class="py-3 px-4 text-left font-semibold text-gray-600 whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($menus as $menu)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4 flex items-center">
                                <img src="{{ $menu->image ? asset('images/menus/' . $menu->image) : 'https://placehold.co/40x40' }}" alt="{{ $menu->name }}" class="w-10 h-10 rounded-md object-cover mr-4 flex-shrink-0">
                                <span class="font-medium whitespace-nowrap">{{ $menu->name }}</span>
                            </td>
                            <td class="py-3 px-4 whitespace-nowrap">Rp{{ number_format($menu->price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 whitespace-nowrap">{{ $menu->category }}</td>
                            <td class="py-3 px-4 whitespace-nowrap">
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('admin.menu.edit', $menu->id) }}" class="text-yellow-500 hover:text-yellow-700">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus menu ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Belum ada menu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
