@extends('layouts.app')

@section('content')
<x-common.page-breadcrumb pageTitle="Lokasi Penyimpanan" />

<x-common.flash-message />

<div class="rounded-2xl border border-gray-200 bg-white pt-4 dark:border-gray-800 dark:bg-white/[0.03]">
    <!-- Header -->
    <div class="mb-4 flex flex-col gap-3 px-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Daftar Lokasi</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Total: {{ $locations->total() }} kategori</p>
        </div>
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <form method="GET" action="{{ route('locations.index') }}"
                class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <div class="relative">
                    <button type="submit" class="absolute top-1/2 -translate-y-1/2 ltr:left-4 rtl:right-4">
                        <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z"
                                fill="" />
                        </svg>
                    </button>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode / nama..."
                        class="h-[42px] w-full rounded-lg border border-gray-300 bg-transparent py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden ltr:pr-4 ltr:pl-[42px] rtl:pr-[42px] rtl:pl-4 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 xl:w-[260px]" />
                </div>

                <select name="filter" onchange="this.form.submit()"
                    class="h-[42px] rounded-lg border border-gray-300 bg-transparent px-4 text-sm text-gray-800 shadow-theme-xs focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                    <option value="">Semua</option>
                    <option value="with_items" @selected(request('filter')==='with_items' )>Ada Barang</option>
                    <option value="without_items" @selected(request('filter')==='without_items' )>Tanpa Barang</option>
                </select>

                @if (request('search') || request('filter'))
                <a href="{{ route('locations.index') }}"
                    class="inline-flex h-[42px] items-center justify-center rounded-lg border border-gray-300 px-4 text-sm font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-white/5">
                    Reset
                </a>
                @endif
            </form>

            <a href="{{ route('locations.add') }}"
                class="inline-flex h-[42px] items-center justify-center rounded-lg bg-brand-500 px-4 text-sm font-medium text-white transition-colors hover:bg-brand-600">
                Tambah Lokasi
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-hidden">
        <div class="max-w-full overflow-x-auto px-5">
            <table class="w-full min-w-full">
                <thead>
                    <tr class="border-y border-gray-200 dark:border-gray-700">
                        <th scope="col"
                            class="px-4 py-3 text-start text-theme-sm font-normal text-gray-500 dark:text-gray-400">No
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-start text-theme-sm font-normal text-gray-500 dark:text-gray-400">Kode
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-start text-theme-sm font-normal text-gray-500 dark:text-gray-400">Nama
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-start text-theme-sm font-normal text-gray-500 dark:text-gray-400">
                            Deskripsi</th>
                        <th scope="col"
                            class="px-4 py-3 text-start text-theme-sm font-normal text-gray-500 dark:text-gray-400">
                            Barang</th>
                        <th scope="col" class="relative px-4 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($locations as $location)
                    <tr>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ $locations->firstItem() + $loop->index }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900 dark:text-white">
                            {{ $location->code }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ $location->name }}
                        </td>
                        <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ $location->description ?: '-' }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ $location->items_count }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-4 text-sm font-medium">
                            <div class="relative flex justify-center">
                                <x-common.table-dropdown>
                                    <x-slot name="button">
                                        <button type="button" class="text-gray-500 dark:text-gray-400">
                                            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M5.99902 10.245C6.96552 10.245 7.74902 11.0285 7.74902 11.995V12.005C7.74902 12.9715 6.96552 13.755 5.99902 13.755C5.03253 13.755 4.24902 12.9715 4.24902 12.005V11.995C4.24902 11.0285 5.03253 10.245 5.99902 10.245ZM17.999 10.245C18.9655 10.245 19.749 11.0285 19.749 11.995V12.005C19.749 12.9715 18.9655 13.755 17.999 13.755C17.0325 13.755 16.249 12.9715 16.249 12.005V11.995C16.249 11.0285 17.0325 10.245 17.999 10.245ZM13.749 11.995C13.749 11.0285 12.9655 10.245 11.999 10.245C11.0325 10.245 10.249 11.0285 10.249 11.995V12.005C10.249 12.9715 11.0325 13.755 11.999 13.755C12.9655 13.755 13.749 12.9715 13.749 12.005V11.995Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <a href="{{ route('locations.detail', $location) }}" role="menuitem"
                                            class="flex w-full rounded-lg px-3 py-2 text-start text-theme-xs font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                            Detail
                                        </a>
                                        <a href="{{ route('locations.edit', $location) }}" role="menuitem"
                                            class="flex w-full rounded-lg px-3 py-2 text-start text-theme-xs font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('locations.delete', $location) }}"
                                            onsubmit="return confirm('Hapus lokasi ini?')">
                                            @csrf
                                            <button type="submit" role="menuitem"
                                                class="flex w-full rounded-lg px-3 py-2 text-start text-theme-xs font-medium text-error-500 hover:bg-error-50 dark:hover:bg-error-500/10">
                                                Hapus
                                            </button>
                                        </form>
                                    </x-slot>
                                </x-common.table-dropdown>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-10 text-center text-sm text-gray-500 dark:text-gray-400">
                            Belum ada data lokasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <x-common.table-pagination :paginator="$locations" />
</div>
@endsection