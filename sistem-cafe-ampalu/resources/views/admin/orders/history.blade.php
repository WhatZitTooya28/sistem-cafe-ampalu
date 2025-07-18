@extends('layouts.admin_dashboard')

@section('title', 'Riwayat Pesanan')

@section('header')
    <div class="flex items-center space-x-4">
        <div class="bg-white p-2 rounded-lg shadow">
            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800">Riwayat Pesanan</h1>
    </div>
@endsection

@section('content')
    {{-- Inisialisasi Alpine.js untuk mengelola state order yang terbuka --}}
    <div x-data="{ openOrderId: null }" class="space-y-6">
        @forelse($orders as $index => $order)
            @php
                // Menghitung total produk untuk ringkasan
                $totalProducts = $order->orderItems->sum('quantity');
            @endphp
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-start">
                    <div class="flex space-x-4">
                        <span class="text-2xl font-bold text-gray-800">{{ $index + 1 }}.</span>
                        <div class="space-y-2">
                            <div class="flex items-baseline space-x-4">
                                <span class="w-36 font-semibold text-gray-600">Informasi Pelanggan :</span>
                                <span class="font-bold text-gray-800">{{ $order->customer_name ?: 'Nomor Meja : ' . $order->table_number }}</span>
                            </div>
                            <div class="flex items-baseline space-x-4">
                                <span class="w-36 font-semibold text-gray-600">Total Produk :</span>
                                <span class="text-gray-800">{{ $totalProducts }}x</span>
                            </div>
                            <div class="flex items-baseline space-x-4">
                                <span class="w-36 font-semibold text-gray-600">Total Belanja :</span>
                                <span class="font-bold text-yellow-600">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-baseline space-x-4">
                                <span class="w-36 font-semibold text-gray-600">Catatan :</span>
                                <span class="text-gray-500 italic">.........</span>
                            </div>
                            {{-- Tombol untuk membuka/menutup detail --}}
                            <button @click="openOrderId === {{ $order->id }} ? openOrderId = null : openOrderId = {{ $order->id }}" class="text-blue-600 font-semibold underline">
                                Detail
                            </button>
                        </div>
                    </div>
                    <span class="text-red-600 font-bold text-sm">SELESAI</span>
                </div>

                <div x-show="openOrderId === {{ $order->id }}" x-transition class="mt-6 border-t pt-6">
                    <div class="flex justify-between items-start mb-4">
                         <div class="flex items-baseline space-x-4">
                            <span class="w-36 font-semibold text-gray-600">Informasi Pelanggan :</span>
                            <span class="font-bold text-gray-800">{{ $order->customer_name ?: 'Nomor Meja : ' . $order->table_number }}</span>
                        </div>
                        <div class="w-24"></div> </div>

                    <h3 class="font-bold text-lg mb-4 text-gray-800">Pesanan:</h3>
                    <div class="space-y-4">
                        @foreach($order->orderItems as $item)
                            <div class="flex justify-between">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $item->menu->name }}</p>
                                    <p class="text-sm text-gray-500">Catatan : {{ $item->notes ?: '-' }}</p>
                                    <div class="flex space-x-1 mt-1">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-800">{{ $item->quantity }}x</p>
                                    <p class="font-semibold text-yellow-600">Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="border-t mt-4 pt-4 flex justify-between font-bold text-gray-800">
                        <div>
                            <p>Total : <span class="text-yellow-600">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</span></p>
                            <p>Total Produk : <span>{{ $totalProducts }} x</span></p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <p class="text-gray-500">Belum ada riwayat pesanan yang selesai.</p>
            </div>
        @endforelse
    </div>
@endsection 