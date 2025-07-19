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
    <div x-data="{ openOrderId: null }" class="space-y-6">
        @forelse($orders as $index => $order)
            @php
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
                            <button @click="openOrderId === {{ $order->id }} ? openOrderId = null : openOrderId = {{ $order->id }}" class="text-blue-600 font-semibold underline">
                                Detail
                            </button>
                        </div>
                    </div>
                    <span class="bg-green-100 text-green-800 font-bold text-sm px-3 py-1 rounded-full">SELESAI</span>
                </div>

                <div x-show="openOrderId === {{ $order->id }}" x-transition class="mt-6 border-t pt-6">
                    <h3 class="font-bold text-lg mb-4 text-gray-800">Rincian Pesanan:</h3>
                    <div class="space-y-4">
                        @foreach($order->orderItems as $item)
                            <div class="flex justify-between">
                                <div>
                                    <p class="font-bold text-gray-800">{{ $item->menu->name }}</p>
                                    <p class="text-sm text-gray-500">Ulasan : {{ optional($item->rating)->review ?: '-' }}</p>
                                    <div class="flex space-x-1 mt-1">
                                        @php $rating = optional($item->rating)->rating ?? 0; @endphp
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
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
                </div>
            </div>
        @empty
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <p class="text-gray-500">Belum ada riwayat pesanan yang selesai.</p>
            </div>
        @endforelse
    </div>
@endsection