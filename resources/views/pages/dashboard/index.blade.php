@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-title-md font-semibold text-gray-800 dark:text-white/90">Dashboard</h1>
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
        Selamat datang di Sistem Inventaris, {{ $user->name }}.
    </p>
</div>

<div class="grid grid-cols-2 gap-4 xl:grid-cols-4">
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-sm text-gray-500 dark:text-gray-400">Jumlah Barang</p>
        <p class="mt-2 text-title-md font-semibold text-gray-800 dark:text-white/90">{{ $itemCount }}</p>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-sm text-gray-500 dark:text-gray-400">Total Stok</p>
        <p class="mt-2 text-title-md font-semibold text-brand-500">{{ $totalStock }}</p>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-sm text-gray-500 dark:text-gray-400">Stok Menipis</p>
        <p class="mt-2 text-title-md font-semibold text-error-500">{{ $lowStockCount }}</p>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-sm text-gray-500 dark:text-gray-400">Kategori</p>
        <p class="mt-2 text-title-md font-semibold text-gray-800 dark:text-white/90">{{ $categoryCount }}</p>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-sm text-gray-500 dark:text-gray-400">Lokasi</p>
        <p class="mt-2 text-title-md font-semibold text-gray-800 dark:text-white/90">{{ $locationCount }}</p>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-sm text-gray-500 dark:text-gray-400">Kondisi</p>
        <p class="mt-2 text-title-md font-semibold text-gray-800 dark:text-white/90">{{ $conditionCount }}</p>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03]">
        <p class="text-sm text-gray-500 dark:text-gray-400">Pengguna</p>
        <p class="mt-2 text-title-md font-semibold text-gray-800 dark:text-white/90">{{ $userCount }}</p>
    </div>
    <a href="{{ route('reports.index') }}"
        class="flex items-center justify-center rounded-2xl border border-dashed border-gray-300 bg-white p-5 text-sm font-medium text-brand-500 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:bg-white/[0.03] dark:hover:bg-white/5">
        Lihat Laporan &rarr;
    </a>
</div>

<div class="mt-6 grid grid-cols-1 gap-5 xl:grid-cols-2">
    <!-- Stok Menipis -->
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
            <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Stok Menipis</h3>
            <a href="{{ route('reports.index', ['status' => 'low']) }}"
                class="text-theme-xs font-medium text-brand-500 hover:underline">Lihat semua</a>
        </div>
        <div class="overflow-x-auto px-5">
            <table class="w-full min-w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="px-2 py-3 text-start text-theme-xs font-normal text-gray-500 dark:text-gray-400">
                            Barang</th>
                        <th class="px-2 py-3 text-start text-theme-xs font-normal text-gray-500 dark:text-gray-400">
                            Lokasi</th>
                        <th class="px-2 py-3 text-start text-theme-xs font-normal text-gray-500 dark:text-gray-400">Stok
                        </th>
                        <th class="px-2 py-3 text-start text-theme-xs font-normal text-gray-500 dark:text-gray-400">Min
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($lowStockItems as $item)
                    <tr>
                        <td class="px-2 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $item->name }}</td>
                        <td class="px-2 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $item->location->name }}</td>
                        <td class="px-2 py-3 text-sm font-medium text-error-500">{{ $item->stock }}</td>
                        <td class="px-2 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $item->min_stock }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-2 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            Semua stok aman.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Riwayat Terbaru -->
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="flex items-center justify-between border-b border-gray-200 px-5 py-4 dark:border-gray-800">
            <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">Riwayat Terbaru</h3>
            <a href="{{ route('histories.index') }}"
                class="text-theme-xs font-medium text-brand-500 hover:underline">Lihat semua</a>
        </div>
        <div class="overflow-x-auto px-5">
            <table class="w-full min-w-full">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="px-2 py-3 text-start text-theme-xs font-normal text-gray-500 dark:text-gray-400">
                            Waktu</th>
                        <th class="px-2 py-3 text-start text-theme-xs font-normal text-gray-500 dark:text-gray-400">
                            Barang</th>
                        <th class="px-2 py-3 text-start text-theme-xs font-normal text-gray-500 dark:text-gray-400">Tipe
                        </th>
                        <th class="px-2 py-3 text-start text-theme-xs font-normal text-gray-500 dark:text-gray-400">
                            Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse ($recentHistories as $history)
                    <tr>
                        <td class="px-2 py-3 text-sm text-gray-500 dark:text-gray-400">{{
                            $history->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-2 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $history->item->name }}</td>
                        <td class="px-2 py-3 text-sm">
                            @if ($history->type === 'in')
                            <span
                                class="inline-flex items-center rounded-full bg-success-500/10 px-2.5 py-0.5 text-theme-xs font-medium text-success-500">Masuk</span>
                            @else
                            <span
                                class="inline-flex items-center rounded-full bg-error-500/10 px-2.5 py-0.5 text-theme-xs font-medium text-error-500">Keluar</span>
                            @endif
                        </td>
                        <td
                            class="px-2 py-3 text-sm font-medium {{ $history->type === 'in' ? 'text-success-500' : 'text-error-500' }}">
                            {{ $history->type === 'in' ? '+' : '-' }}{{ $history->quantity }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-2 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            Belum ada riwayat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection