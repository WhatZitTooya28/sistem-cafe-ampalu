@extends('layouts.admin_dashboard')
@section('title', 'Riwayat Pesanan')
@section('header')
    <h1 class="text-2xl font-bold text-gray-800">Riwayat Pesanan</h1>
@endsection
@section('content')
    <div class="space-y-6">
        @forelse($orders as $order)
            <div class="bg-white p-6 rounded-lg shadow-lg opacity-75">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-xl font-bold text-gray-600">Pesanan #{{ $order->id }}</h2>
                        <p class="text-sm text-gray-500">Nomor Meja: {{ $order->table_number ?? $order->customer_name }}</p>
                    </div>
                    <span class="bg-green-200 text-green-800 text-sm font-semibold px-2.5 py-0.5 rounded-full">SELESAI</span>
                </div>
            </div>
        @empty
            <p>Belum ada riwayat pesanan.</p>
        @endforelse
    </div>
@endsection