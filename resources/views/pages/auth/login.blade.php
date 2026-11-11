@extends('layouts.fullscreen-layout')

@section('content')
<div class="relative z-1 bg-white p-6 sm:p-0 dark:bg-gray-900">
    <div class="relative flex h-screen w-full flex-col justify-center sm:p-0 lg:flex-row dark:bg-gray-900">

        <div class="flex w-full flex-1 flex-col lg:w-1/2">
            <div class="mx-auto flex w-full max-w-md flex-1 flex-col justify-center">
                <div class="mb-5 sm:mb-8">
                    <h1 class="mb-2 text-title-sm font-semibold text-gray-800 sm:text-title-md dark:text-white/90">
                        Sign In
                    </h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Silakan masuk ke Sistem Inventaris.
                    </p>
                </div>

                @if ($errors->any())
                <div
                    class="mb-4 rounded-lg border border-error-500 bg-error-500/10 px-4 py-3 text-sm text-error-500 dark:border-error-400 dark:bg-error-400/10 dark:text-error-400">
                    {{ $errors->first() }}
                </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label for="email"
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Email<span class="text-error-500">*</span>
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                placeholder="admin@inventaris.test" required autofocus
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        </div>

                        <div>
                            <label for="password"
                                class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Password<span class="text-error-500">*</span>
                            </label>
                            <input type="password" name="password" id="password" placeholder="••••••••" required
                                class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                        </div>

                        <div class="flex items-center justify-between">
                            <label for="remember"
                                class="flex cursor-pointer items-center text-sm font-normal text-gray-700 select-none dark:text-gray-400">
                                <input type="checkbox" name="remember" id="remember"
                                    class="mr-3 h-5 w-5 rounded-md border-gray-300 dark:border-gray-700" />
                                Remember me
                            </label>
                        </div>

                        <button type="submit"
                            class="flex w-full items-center justify-center rounded-lg bg-brand-500 px-4 py-3 text-sm font-medium text-white shadow-theme-xs transition hover:bg-brand-600">
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection