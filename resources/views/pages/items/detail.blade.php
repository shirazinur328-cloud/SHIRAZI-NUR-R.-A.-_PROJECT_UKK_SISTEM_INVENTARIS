@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Detail Barang" />

<x-common.component-card title="Detail Barang">
    <div class="flex items-start justify-between gap-3">
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Informasi lengkap data barang.
        </p>
        <div class="flex items-center gap-2">
            <a href="{{ route('items.edit', $item) }}"
                class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-brand-600">
                Edit
            </a>
            <a href="{{ route('items.index') }}"
                class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-white/5">
                Kembali
            </a>
        </div>
    </div>

    <dl class="divide-y divide-gray-100 dark:divide-gray-800">
        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Kode</dt>
            <dd class="text-sm font-medium text-gray-800 sm:col-span-2 dark:text-white/90">{{ $item->code }}</dd>
        </div>
        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Nama</dt>
            <dd class="text-sm font-medium text-gray-800 sm:col-span-2 dark:text-white/90">{{ $item->name }}</dd>
        </div>
        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Slug</dt>
            <dd class="text-sm font-medium text-gray-800 sm:col-span-2 dark:text-white/90">{{ $item->slug }}</dd>
        </div>
        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Kategori</dt>
            <dd class="text-sm text-gray-800 sm:col-span-2 dark:text-white/90">{{ $item->category->name }}</dd>
        </div>
        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Lokasi</dt>
            <dd class="text-sm text-gray-800 sm:col-span-2 dark:text-white/90">{{ $item->location->name }}</dd>
        </div>
        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Kondisi</dt>
            <dd class="text-sm text-gray-800 sm:col-span-2 dark:text-white/90">{{ $item->condition->name }}</dd>
        </div>
        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Stok</dt>
            <dd class="text-sm font-medium text-gray-800 sm:col-span-2 dark:text-white/90">{{ $item->stock }}</dd>
        </div>
        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Satuan</dt>
            <dd class="text-sm text-gray-800 sm:col-span-2 dark:text-white/90">{{ $item->unit ?: '-' }}</dd>
        </div>
        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Stok Minimum</dt>
            <dd class="text-sm text-gray-800 sm:col-span-2 dark:text-white/90">{{ $item->min_stock }}</dd>
        </div>
        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Deskripsi</dt>
            <dd class="text-sm text-gray-800 sm:col-span-2 dark:text-white/90">{{ $item->description ?: '-' }}</dd>
        </div>
        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Transaksi</dt>
            <dd class="text-sm text-gray-800 sm:col-span-2 dark:text-white/90">
                Masuk: {{ $item->stock_ins_count }} · Keluar: {{ $item->stock_outs_count }} · Riwayat: {{
                $item->histories_count }}
            </dd>
        </div>
        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Dibuat</dt>
            <dd class="text-sm text-gray-800 sm:col-span-2 dark:text-white/90">{{ $item->created_at->format('d/m/Y H:i')
                }}</dd>
        </div>
        <div class="grid grid-cols-1 gap-1 py-4 sm:grid-cols-3">
            <dt class="text-sm text-gray-500 dark:text-gray-400">Diperbarui</dt>
            <dd class="text-sm text-gray-800 sm:col-span-2 dark:text-white/90">{{ $item->updated_at->format('d/m/Y H:i')
                }}</dd>
        </div>
    </dl>
</x-common.component-card>
@endsection