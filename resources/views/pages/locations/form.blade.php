@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb :pageTitle="$location ? 'Edit Lokasi' : 'Tambah Lokasi'" />

<x-common.component-card :title="$location ? 'Edit Lokasi' : 'Tambah Lokasi'">
    <form method="POST" action="{{ $location ? route('locations.edit', $location) : route('locations.add') }}">
        @csrf

        <div class="space-y-5">
            <div>
                <label for="code" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Kode<span class="text-error-500">*</span>
                </label>
                <input type="text" name="code" id="code" value="{{ old('code', $location->code ?? '') }}"
                    placeholder="cth: LKS-001" required
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                @error('code')
                <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Nama<span class="text-error-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $location->name ?? '') }}"
                    placeholder="cth: Gudang A" required
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                @error('name')
                <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Deskripsi
                </label>
                <textarea name="description" id="description" rows="3" placeholder="Opsional"
                    class="w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">{{ old('description', $location->description ?? '') }}</textarea>
                @error('description')
                <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-brand-600">
                    Simpan
                </button>
                <a href="{{ route('locations.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-white/5">
                    Batal
                </a>
            </div>
        </div>
    </form>
</x-common.component-card>
@endsection