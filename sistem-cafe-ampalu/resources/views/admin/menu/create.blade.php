@extends('layouts.admin_dashboard')
@section('title', 'Tambah Menu')

@section('header')
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Menu Baru</h1>
        <a href="{{ route('admin.menu.index') }}" class="text-gray-500 hover:text-gray-800">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </a>
    </div>
@endsection

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.menu.partials.form')
        </form>
    </div>
@endsection
