@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb :pageTitle="$item ? 'Edit Barang' : 'Tambah Barang'" />

<x-common.component-card :title="$item ? 'Edit Barang' : 'Tambah Barang'">
    <form method="POST" action="{{ $item ? route('items.edit', $item) : route('items.add') }}">
        @csrf

        <div class="space-y-5">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <label for="code" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Kode<span class="text-error-500">*</span>
                    </label>
                    <input type="text" name="code" id="code" value="{{ old('code', $item->code ?? '') }}"
                        placeholder="cth: BRG-001" required
                        class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('code')
                    <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Nama<span class="text-error-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $item->name ?? '') }}"
                        placeholder="cth: Kamera Canon" required
                        class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('name')
                    <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                <div>
                    <label for="category_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Kategori<span class="text-error-500">*</span>
                    </label>
                    <select name="category_id" id="category_id" required
                        class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $item->category_id ?? '') ==
                            $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="location_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Lokasi<span class="text-error-500">*</span>
                    </label>
                    <select name="location_id" id="location_id" required
                        class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                        <option value="">Pilih Lokasi</option>
                        @foreach ($locations as $location)
                        <option value="{{ $location->id }}" @selected(old('location_id', $item->location_id ?? '') ==
                            $location->id)>{{ $location->name }}</option>
                        @endforeach
                    </select>
                    @error('location_id')
                    <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="condition_id" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Kondisi<span class="text-error-500">*</span>
                    </label>
                    <select name="condition_id" id="condition_id" required
                        class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                        <option value="">Pilih Kondisi</option>
                        @foreach ($conditions as $condition)
                        <option value="{{ $condition->id }}" @selected(old('condition_id', $item->condition_id ?? '') ==
                            $condition->id)>{{ $condition->name }}</option>
                        @endforeach
                    </select>
                    @error('condition_id')
                    <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <label for="unit" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Satuan
                    </label>
                    <input type="text" name="unit" id="unit" value="{{ old('unit', $item->unit ?? '') }}"
                        placeholder="cth: unit / pcs"
                        class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('unit')
                    <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="min_stock" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Stok Minimum<span class="text-error-500">*</span>
                    </label>
                    <input type="number" name="min_stock" id="min_stock" min="0"
                        value="{{ old('min_stock', $item->min_stock ?? 0) }}" required
                        class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    @error('min_stock')
                    <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            @if ($item)
            <div
                class="rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-600 dark:border-gray-700 dark:bg-white/5 dark:text-gray-300">
                Stok saat ini: <span class="font-medium text-gray-800 dark:text-white/90">{{ $item->stock }}</span> —
                hanya berubah lewat transaksi barang masuk/keluar.
            </div>
            @endif

            <div>
                <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Deskripsi
                </label>
                <textarea name="description" id="description" rows="3" placeholder="Opsional"
                    class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('description', $item->description ?? '') }}</textarea>
                @error('description')
                <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-brand-600">
                    Simpan
                </button>
                <a href="{{ route('items.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-white/5">
                    Batal
                </a>
            </div>
        </div>
    </form>
</x-common.component-card>
@endsection