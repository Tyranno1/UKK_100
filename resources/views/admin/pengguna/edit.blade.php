@extends('layouts.app')

@section('content')

<div class="min-h-screen flex bg-gray-50" style="font-family: 'Poppins', sans-serif;">

    <aside class="w-64 min-h-screen flex flex-col fixed top-0 left-0 z-30"
        style="background: linear-gradient(150deg, #fefefe 1%, #b2f0d8 65%, #6b1a1a 100%);">
        <div class="flex items-center gap-3 px-6 py-6 border-b border-white border-opacity-30">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
            <div>
                <p class="text-xs font-black text-[#6b1a1a] tracking-widest leading-none">SILOKA</p>
                <p class="text-[10px] text-gray-500 leading-tight">Sistem Informasi Lapor & Kelola Aset</p>
            </div>
        </div>
        <nav class="flex-1 px-4 py-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition text-gray-700 hover:bg-white hover:bg-opacity-50">
                <i class="fa-solid fa-house w-5 text-center"></i>Dashboard
            </a>
            <a href="{{ route('admin.kategori.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition text-gray-700 hover:bg-white hover:bg-opacity-50">
                <i class="fa-solid fa-tags w-5 text-center"></i>Manajemen Kategori
            </a>
            <a href="{{ route('admin.pengguna.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold transition bg-[#6b1a1a] text-white shadow-md">
                <i class="fa-solid fa-users w-5 text-center"></i>Manajemen User
            </a>
        </nav>
        <div class="px-6 py-4">
            <p class="text-[9px] text-black opacity-50 text-center">© {{ date('Y') }} UKK Paket 3 - Aplikasi Pengaduan Sarana & Prasarana Sekolah</p>
        </div>
    </aside>

    <div class="flex-1 ml-64 flex flex-col min-h-screen">
        <header class="bg-white shadow-sm px-8 py-4 flex items-center gap-3 sticky top-0 z-20">
            <a href="{{ route('admin.pengguna.index') }}"
                class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition">
                <i class="fa-solid fa-arrow-left text-gray-500 text-xs"></i>
            </a>
            <div>
                <p class="text-xs text-gray-400 font-medium">Manajemen Pengguna</p>
                <h1 class="text-base font-bold text-[#6b1a1a] leading-tight">Tambah Pengguna</h1>
            </div>
        </header>

        <main class="flex-1 px-8 py-6">
            <div class="max-w-lg">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-6">
                    <form method="POST" action="{{ route('admin.pengguna.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wider">
                                NIS / NIP <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="nis_nip"
                                value="{{ old('nis_nip', $user->nis_nip) }}"
                                class="w-full text-sm border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#6b1a1a] transition">
                            @error('nis_nip')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wider">
                                Nama Lengkap <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="name"
                                value="{{ old('name', $user->name) }}"
                                class="w-full text-sm border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#6b1a1a] transition">
                            @error('name')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wider">Email</label>
                            <input type="email" name="email"
                                value="{{ old('email', $user->email) }}"
                                placeholder="opsional"
                                class="w-full text-sm border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#6b1a1a] transition">
                            @error('email')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wider">No. Telepon</label>
                            <input type="text" name="telp"
                                value="{{ old('telp', $user->telp) }}"
                                placeholder="08xxxxxxxxxx"
                                class="w-full text-sm border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#6b1a1a] transition">
                            @error('telp')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wider">Kelas</label>
                            <input type="text" name="kelas"
                                value="{{ old('kelas', $user->kelas) }}"
                                placeholder="Contoh: XII RPL 1"
                                class="w-full text-sm border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#6b1a1a] transition">
                            @error('kelas')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label class="block text-xs font-bold text-gray-700 mb-1.5 uppercase tracking-wider">
                                Konfirmasi Password <span class="text-red-400">*</span>
                            </label>
                            <input type="password" name="password_confirmation"
                                placeholder="Ulangi password"
                                class="w-full text-sm border border-gray-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#6b1a1a] transition">
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit"
                                class="px-6 py-2.5 bg-[#6b1a1a] hover:bg-[#8b0000] text-white text-xs font-bold rounded-xl transition">
                                Simpan Pengguna
                            </button>
                            <a href="{{ route('admin.pengguna.index') }}"
                                class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 text-xs font-bold rounded-xl transition">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

@endsection