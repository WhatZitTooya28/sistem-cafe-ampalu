@extends('layouts.admin_dashboard')

@section('title', 'Dashboard Kasir')

@section('header')
    <h1 class="text-2xl font-bold text-gray-800">Dashboard Kasir</h1>
@endsection

@section('content')
    {{-- Grid untuk menata layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Kolom Kiri: Welcome & Aksi --}}
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center h-full flex flex-col justify-center">
                <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h2>
                <p class="text-gray-600 mt-2 mb-6">Pilih tindakan yang ingin Anda lakukan.</p>
                <button @click="customerModalOpen = true" class="bg-green-600 text-white font-bold py-3 px-8 rounded-lg shadow-md hover:bg-green-700 transform hover:scale-105 transition-all">
                    Buat Pesanan Take Away
                </button>
            </div>
        </div>

        {{-- Kolom Kanan: Grafik Penjualan --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Grafik Pendapatan (7 Hari Terakhir)</h3>
            {{-- Elemen canvas ini akan menjadi tempat grafik digambar --}}
            <canvas id="salesChart"></canvas>
        </div>

    </div>

    {{-- Pop-up / Modal untuk input nama pelanggan --}}
    <div x-show="customerModalOpen"
         x-transition
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
         style="display: none;">

        <div @click.away="customerModalOpen = false" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm">
            <h3 class="text-xl font-bold mb-4">Input Nama Pelanggan</h3>
            <form action="{{ route('kasir.take_away.start') }}" method="POST">
                @csrf
                <input type="text" name="customer_name_popup" class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan Nama Pelanggan" required>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" @click="customerModalOpen = false" class="bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded-lg hover:bg-gray-300">
                        Batal
                    </button>
                    <button type="submit" class="bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700">
                        Lanjutkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- SKRIP UNTUK CHART.JS --}}
    {{-- 1. Memuat library Chart.js dari CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // 2. Mengambil data yang dikirim dari controller
        const salesLabels = @json($labels);
        const salesData = @json($data);

        // 3. Mengkonfigurasi dan membuat grafik
        const ctx = document.getElementById('salesChart');
        new Chart(ctx, {
            type: 'line', // Tipe grafik: 'line', 'bar', 'pie', dll.
            data: {
                labels: salesLabels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: salesData,
                    fill: true,
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.3,
                    pointBackgroundColor: 'rgb(34, 197, 94)',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false // Menyembunyikan legenda 'Pendapatan (Rp)'
                    }
                }
            }
        });
    </script>
@endsection