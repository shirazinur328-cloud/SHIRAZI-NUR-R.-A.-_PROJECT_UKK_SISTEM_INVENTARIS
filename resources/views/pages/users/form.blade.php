@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb :pageTitle="$user ? 'Edit Pengguna' : 'Tambah Pengguna'" />

<x-common.component-card :title="$user ? 'Edit Pengguna' : 'Tambah Pengguna'">
    <form method="POST" action="{{ $user ? route('users.edit', $user) : route('users.add') }}">
        @csrf

        <div class="space-y-5">
            <div>
                <label for="name" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Nama<span class="text-error-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}"
                    placeholder="cth: Administrator" required
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                @error('name')
                <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Email<span class="text-error-500">*</span>
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}"
                    placeholder="cth: admin@inventaris.test" required
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                @error('email')
                <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Password @if ($user)<span class="text-gray-400">(kosongkan bila tidak diubah)</span>@else<span
                        class="text-error-500">*</span>@endif
                </label>
                <input type="password" name="password" id="password" autocomplete="new-password"
                    placeholder="Minimal 8 karakter"
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                @error('password')
                <p class="mt-1 text-xs text-error-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation"
                    class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Konfirmasi Password
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    autocomplete="new-password" placeholder="Ulangi password"
                    class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
            </div>

            <div class="flex items-center gap-3">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-brand-600">
                    Simpan
                </button>
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-white/5">
                    Batal
                </a>
            </div>
        </div>
    </form>
</x-common.component-card>
@endsection