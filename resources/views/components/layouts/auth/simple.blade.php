<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="flex min-h-svh items-center justify-center bg-linear-to-br from-zinc-100 via-zinc-50 to-zinc-200 px-4 py-12 antialiased dark:from-zinc-950 dark:via-zinc-950 dark:to-zinc-900">
        <div class="flex w-full max-w-sm flex-col items-center gap-8">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                <span class="flex h-10 w-10 items-center justify-center">
                    <x-app-logo-icon class="h-10 w-10 fill-current text-zinc-900 dark:text-white" />
                </span>
                <span class="text-sm font-semibold text-zinc-600 dark:text-zinc-400">{{ config('app.name', 'Laravel') }}</span>
                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>

            {{-- Card --}}
            <div class="w-full rounded-2xl border border-zinc-200 bg-white/80 p-8 shadow-xl backdrop-blur-xl dark:border-zinc-800 dark:bg-zinc-900/80">
                {{ $slot }}
            </div>

            {{-- Footer --}}
            <p class="text-xs text-zinc-400 dark:text-zinc-600">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. {{ __('All rights reserved.') }}
            </p>
        </div>

        @fluxScripts
    </body>
</html>
