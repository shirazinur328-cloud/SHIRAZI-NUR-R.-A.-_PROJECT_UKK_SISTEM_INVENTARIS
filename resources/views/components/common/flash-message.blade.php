@php
$flashMessages = array_filter([
'success' => session('success'),
'error' => session('error'),
]);
@endphp

@foreach ($flashMessages as $type => $message)
<div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.200ms
    @class([ 'mb-4 flex items-start justify-between gap-3 rounded-lg border px-4 py-3 text-sm'
    , 'border-success-500 bg-success-500/10 text-success-500 dark:border-success-400 dark:text-success-400'=> $type ===
    'success',
    'border-error-500 bg-error-500/10 text-error-500 dark:border-error-400 dark:text-error-400' => $type === 'error',
    ])>
    <span>{{ $message }}</span>
    <button type="button" @click="show = false" aria-label="Tutup"
        class="shrink-0 rounded p-0.5 transition-colors hover:bg-black/5 dark:hover:bg-white/10">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>
@endforeach