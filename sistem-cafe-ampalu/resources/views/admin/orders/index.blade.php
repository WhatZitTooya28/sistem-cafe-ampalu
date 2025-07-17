@extends('layouts.admin_dashboard')
@section('title', 'Pesanan Masuk')
@section('header')
    <h1 class="text-2xl font-bold text-gray-800">Pesanan</h1>
@endsection
@section('content')
    @if(session('success'))
        <div class="bg-green-100 p-4 mb-4 rounded-md">{{ session('success') }}</div>
    @endif
    <div class="space-y-6">
        @forelse($orders as $order)
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="flex justify-between items-start border-b pb-4 mb-4">
                    <div>
                        <h2 class="text-xl font-bold">Pesanan #{{ $order->id }}</h2>
                        <p class="text-sm text-gray-500">Nomor Meja: {{ $order->table_number ?? $order->customer_name }}</p>
                    </div>
                    <div class="text-right">
                        <span class="text-lg font-bold">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                        <p class="text-sm text-gray-500">{{ $order->created_at->format('H:i') }}</p>
                    </div>
                </div>
                @foreach($order->orderItems as $item)
                    <p>{{ $item->quantity }}x {{ $item->menu->name }}</p>
                @endforeach
                <div class="flex justify-end space-x-2 mt-4">
                    <span class="bg-red-200 text-red-800 text-sm font-semibold px-2.5 py-0.5 rounded-full">Proses</span>
                    <form action="{{ route('admin.orders.complete', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-200 text-green-800 text-sm font-semibold px-2.5 py-0.5 rounded-full hover:bg-green-300">Selesai</button>
                    </form>
                </div>
            </div>
        @empty
            <p>Tidak ada pesanan yang sedang diproses.</p>
        @endforelse
    </div>
@endsection
