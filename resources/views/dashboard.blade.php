<x-layouts.app>
    <div class="min-h-screen bg-zinc-50/50 dark:bg-zinc-900/50">
        {{-- Welcome Header with Gradient --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-zinc-900 via-zinc-800 to-zinc-700 px-8 pb-10 pt-6 dark:from-zinc-950 dark:via-zinc-900 dark:to-zinc-800">
            {{-- Decorative background elements --}}
            <div class="pointer-events-none absolute -right-20 -top-20 size-64 rounded-full bg-white/5 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-10 -left-10 size-48 rounded-full bg-white/[3%] blur-2xl"></div>

            <div class="relative">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="flex items-center gap-3">
                            <div class="flex size-10 items-center justify-center rounded-xl bg-white/10 shadow-lg shadow-black/10 backdrop-blur-sm">
                                <svg class="size-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.664 1.319a.75.75 0 01.672 0 41.059 41.059 0 018.198 5.424.75.75 0 01-.254 1.285 31.372 31.372 0 00-7.86 3.83.75.75 0 01-.84 0 31.372 31.372 0 00-7.86-3.83.75.75 0 01-.254-1.285 41.059 41.059 0 018.198-5.424z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M4 8.754V13.5c0 1.242.622 2.335 1.567 3.06a5.536 5.536 0 001.757.964A7.46 7.46 0 0010 18.25a7.46 7.46 0 002.676-.726 5.539 5.539 0 001.757-.964A3.756 3.756 0 0016 13.5V8.754l-5.336 2.599a2.25 2.25 0 01-1.328 0L4 8.754z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold tracking-tight text-white">Dashboard</h1>
                                <p class="mt-0.5 text-sm text-zinc-300/80">Welcome back, <span class="font-semibold text-white">{{ auth()->user()->name }}</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="hidden items-center gap-3 sm:flex">
                        <div class="rounded-lg bg-white/10 px-4 py-2 shadow-lg shadow-black/10 backdrop-blur-sm">
                            <p class="text-xs font-medium text-zinc-400">Today</p>
                            <p class="text-sm font-semibold text-white">{{ now()->format('l, F j, Y') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Stat Cards --}}
                <div class="mt-8 grid grid-cols-2 gap-4 lg:grid-cols-4">
                    {{-- Total Books --}}
                    <div class="group relative overflow-hidden rounded-xl bg-white/10 shadow-lg shadow-black/10 backdrop-blur-sm transition-all duration-300 hover:-translate-y-0.5 hover:bg-emerald-500/15 hover:shadow-xl hover:shadow-emerald-500/10">
                        <div class="absolute right-0 top-0 size-24 translate-x-8 -translate-y-8 rounded-full bg-emerald-500/10 blur-2xl transition-all duration-500 group-hover:bg-emerald-400/20"></div>
                        <div class="relative p-5">
                            <div class="mb-3 flex size-10 items-center justify-center rounded-lg bg-emerald-500/20 shadow-sm">
                                <svg class="size-5 text-emerald-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.75 16.82a.75.75 0 01-1.5 0 11.57 11.57 0 01-5.5-4.375.75.75 0 011.5 0 9.999 9.999 0 004.5 4.375.75.75 0 010-1.5zm0-3.25a.75.75 0 01-1.5 0 7.25 7.25 0 01-7 0 .75.75 0 010 1.5h.75c.19 0 .38.01.56.03a6.999 6.999 0 014.94 2.47.75.75 0 11-1.06 1.06 5.5 5.5 0 00-3.89-1.94.75.75 0 010-1.5h.75zm0-3.25c-.69 0-1.34.08-1.97.23a.75.75 0 11-.33-1.46c.83-.19 1.7-.27 2.63-.27v.75a6.5 6.5 0 016.3 2.25.75.75 0 01-1.5 0 4.999 4.999 0 00-4.8-1.75h-.33.75z" />
                                </svg>
                            </div>
                            <p class="text-xs font-medium uppercase tracking-wider text-zinc-300/70">Total Books</p>
                            <p class="mt-1 text-3xl font-bold tracking-tight text-white">{{ $totalBooks }}</p>
                            <div class="mt-2 flex items-center gap-1">
                                <span class="text-xs text-emerald-300/70">Collection</span>
                            </div>
                        </div>
                    </div>

                    {{-- Total Students --}}
                    <div class="group relative overflow-hidden rounded-xl bg-white/10 shadow-lg shadow-black/10 backdrop-blur-sm transition-all duration-300 hover:-translate-y-0.5 hover:bg-blue-500/15 hover:shadow-xl hover:shadow-blue-500/10">
                        <div class="absolute right-0 top-0 size-24 translate-x-8 -translate-y-8 rounded-full bg-blue-500/10 blur-2xl transition-all duration-500 group-hover:bg-blue-400/20"></div>
                        <div class="relative p-5">
                            <div class="mb-3 flex size-10 items-center justify-center rounded-lg bg-blue-500/20 shadow-sm">
                                <svg class="size-5 text-blue-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M7 8a3 3 0 100-6 3 3 0 000 6zm7.5 3a4.5 4.5 0 00-6.5-1.5.75.75 0 01-1.5 0 6 6 0 0111.5 0 .75.75 0 01-1.5 0zm-9.5 2.25a6 6 0 017.5-9.75.75.75 0 01-1.5 0 4.5 4.5 0 00-6 0 .75.75 0 01-1.5 0zm9.5 3a.75.75 0 01.75.75v.75a4.5 4.5 0 01-4.5 4.5h-.75a.75.75 0 010-1.5h.75A2.999 2.999 0 0017.25 14v-.75a.75.75 0 011.5 0v.75a4.497 4.497 0 01-4.5 4.5h-.75a.75.75 0 010-1.5h.75a3 3 0 003-3v-.75a.75.75 0 01.75-.75z" />
                                </svg>
                            </div>
                            <p class="text-xs font-medium uppercase tracking-wider text-zinc-300/70">Total Students</p>
                            <p class="mt-1 text-3xl font-bold tracking-tight text-white">{{ $totalStudents }}</p>
                            <div class="mt-2 flex items-center gap-1">
                                <span class="text-xs text-blue-300/70">Enrolled</span>
                            </div>
                        </div>
                    </div>

                    {{-- Active Borrows --}}
                    <div class="group relative overflow-hidden rounded-xl bg-white/10 shadow-lg shadow-black/10 backdrop-blur-sm transition-all duration-300 hover:-translate-y-0.5 hover:bg-amber-500/15 hover:shadow-xl hover:shadow-amber-500/10">
                        <div class="absolute right-0 top-0 size-24 translate-x-8 -translate-y-8 rounded-full bg-amber-500/10 blur-2xl transition-all duration-500 group-hover:bg-amber-400/20"></div>
                        <div class="relative p-5">
                            <div class="mb-3 flex size-10 items-center justify-center rounded-lg bg-amber-500/20 shadow-sm">
                                <svg class="size-5 text-amber-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 2a.75.75 0 01.75.75v.008a.75.75 0 01-.34.649l-.018.011a8.002 8.002 0 00-.574 1.245c-.042.113-.09.226-.14.338a7.999 7.999 0 00-8.265 3.228.75.75 0 01-1.497.094 9.001 9.001 0 019.543-5.59.75.75 0 01.743.297A8.002 8.002 0 0114 6.006v-.008a.75.75 0 01-.75-.75V2zm.75 4.5a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01.75-.75zm0 3a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01.75-.75zm0 3a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-xs font-medium uppercase tracking-wider text-zinc-300/70">Active Borrows</p>
                            <p class="mt-1 text-3xl font-bold tracking-tight text-white">{{ $activeBorrows }}</p>
                            <div class="mt-2 flex items-center gap-1">
                                <span class="text-xs text-amber-300/70">Not returned</span>
                            </div>
                        </div>
                    </div>

                    {{-- Total Borrows --}}
                    <div class="group relative overflow-hidden rounded-xl bg-white/10 shadow-lg shadow-black/10 backdrop-blur-sm transition-all duration-300 hover:-translate-y-0.5 hover:bg-purple-500/15 hover:shadow-xl hover:shadow-purple-500/10">
                        <div class="absolute right-0 top-0 size-24 translate-x-8 -translate-y-8 rounded-full bg-purple-500/10 blur-2xl transition-all duration-500 group-hover:bg-purple-400/20"></div>
                        <div class="relative p-5">
                            <div class="mb-3 flex size-10 items-center justify-center rounded-lg bg-purple-500/20 shadow-sm">
                                <svg class="size-5 text-purple-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm3.857-1.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-xs font-medium uppercase tracking-wider text-zinc-300/70">Total Borrows</p>
                            <p class="mt-1 text-3xl font-bold tracking-tight text-white">{{ $totalBorrows }}</p>
                            <div class="mt-2 flex items-center gap-1">
                                <span class="text-xs text-purple-300/70">All time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="space-y-6 p-6 lg:p-8">
            {{-- Active Borrows Section --}}
            <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm transition-all duration-200 hover:shadow-md dark:border-zinc-700 dark:bg-zinc-800/50 dark:hover:shadow-black/20">
                <div class="relative border-b border-zinc-200 bg-gradient-to-r from-amber-50/50 to-transparent px-6 py-5 dark:border-zinc-700 dark:from-amber-900/10">
                    {{-- Decorative element --}}
                    <div class="pointer-events-none absolute -right-10 -top-10 size-32 rounded-full bg-amber-500/[2%] blur-2xl dark:bg-amber-500/5"></div>

                    <div class="relative flex items-center gap-4">
                        <div class="flex size-11 items-center justify-center rounded-xl bg-gradient-to-br from-amber-400 to-amber-600 shadow-lg shadow-amber-200/50 dark:shadow-amber-900/30">
                            <svg class="size-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 2a.75.75 0 01.75.75v.008a.75.75 0 01-.34.649l-.018.011a8.002 8.002 0 00-.574 1.245c-.042.113-.09.226-.14.338a7.999 7.999 0 00-8.265 3.228.75.75 0 01-1.497.094 9.001 9.001 0 019.543-5.59.75.75 0 01.743.297A8.002 8.002 0 0114 6.006v-.008a.75.75 0 01-.75-.75V2zm.75 4.5a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01.75-.75zm0 3a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01.75-.75zm0 3a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Active Borrows</h2>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Students who have not returned their books</p>
                        </div>
                        <div class="shrink-0">
                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700 ring-1 ring-amber-200 dark:bg-amber-900/30 dark:text-amber-300 dark:ring-amber-700/50">
                                <span class="size-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                {{ $activeBorrows }} active
                            </span>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-zinc-200 bg-gradient-to-r from-amber-50/30 to-zinc-50/50 dark:border-zinc-700 dark:from-amber-900/5 dark:to-zinc-800/30">
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Student</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Book</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Borrow Date</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Days</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700/50">
                            @forelse ($activeBorrowsList as $borrow)
                                <tr class="transition-all duration-200 hover:bg-amber-50/60 dark:hover:bg-amber-900/10">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-amber-400 to-amber-600 text-xs font-bold text-white shadow-sm ring-2 ring-amber-100 dark:ring-amber-700/30">
                                                {{ Str::of($borrow->student->name ?? '?')->substr(0, 2)->upper() }}
                                            </div>
                                            <span class="font-medium text-zinc-900 dark:text-white">{{ $borrow->student->name ?? '—' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-medium text-zinc-900 dark:text-white">{{ $borrow->book->title ?? '—' }}</span>
                                            <span class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">{{ $borrow->book->author ?? '' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-zinc-600 dark:text-zinc-300">{{ $borrow->borrow_date?->format('M d, Y') ?? '—' }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-zinc-600 dark:text-zinc-300">{{ $borrow->borrow_date?->diffInDays(now()) ?? '—' }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 ring-1 ring-red-200 dark:bg-red-900/30 dark:text-red-300 dark:ring-red-700/50">
                                            <span class="size-1.5 rounded-full bg-red-500"></span>
                                            Not returned
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center gap-4">
                                            <div class="flex size-16 items-center justify-center rounded-2xl bg-emerald-50 dark:bg-emerald-900/20">
                                                <svg class="size-8 text-emerald-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-zinc-900 dark:text-white">All clear!</p>
                                                <p class="text-sm text-zinc-500 dark:text-zinc-400">All books have been returned</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Returned Books Section --}}
            <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm transition-all duration-200 hover:shadow-md dark:border-zinc-700 dark:bg-zinc-800/50 dark:hover:shadow-black/20">
                <div class="relative border-b border-zinc-200 bg-gradient-to-r from-emerald-50/50 to-transparent px-6 py-5 dark:border-zinc-700 dark:from-emerald-900/10">
                    {{-- Decorative element --}}
                    <div class="pointer-events-none absolute -right-10 -top-10 size-32 rounded-full bg-emerald-500/[2%] blur-2xl dark:bg-emerald-500/5"></div>

                    <div class="relative flex items-center gap-4">
                        <div class="flex size-11 items-center justify-center rounded-xl bg-gradient-to-br from-emerald-400 to-emerald-600 shadow-lg shadow-emerald-200/50 dark:shadow-emerald-900/30">
                            <svg class="size-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Returned Books</h2>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Recent returned books with dates</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="border-b border-zinc-200 bg-gradient-to-r from-emerald-50/30 to-zinc-50/50 dark:border-zinc-700 dark:from-emerald-900/5 dark:to-zinc-800/30">
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Student</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Book</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Borrow Date</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Return Date</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100 dark:divide-zinc-700/50">
                            @forelse ($returnedBorrowsList as $borrow)
                                <tr class="transition-all duration-200 hover:bg-emerald-50/60 dark:hover:bg-emerald-900/10">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-gradient-to-br from-emerald-400 to-emerald-600 text-xs font-bold text-white shadow-sm ring-2 ring-emerald-100 dark:ring-emerald-700/30">
                                                {{ Str::of($borrow->student->name ?? '?')->substr(0, 2)->upper() }}
                                            </div>
                                            <span class="font-medium text-zinc-900 dark:text-white">{{ $borrow->student->name ?? '—' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-medium text-zinc-900 dark:text-white">{{ $borrow->book->title ?? '—' }}</span>
                                            <span class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">{{ $borrow->book->author ?? '' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-zinc-600 dark:text-zinc-300">{{ $borrow->borrow_date?->format('M d, Y') ?? '—' }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200 dark:bg-emerald-900/30 dark:text-emerald-300 dark:ring-emerald-700/50">
                                            <svg class="size-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $borrow->return_date?->format('M d, Y') ?? '—' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200 dark:bg-emerald-900/30 dark:text-emerald-300 dark:ring-emerald-700/50">
                                            <span class="size-1.5 rounded-full bg-emerald-500"></span>
                                            Returned
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center gap-4">
                                            <div class="flex size-16 items-center justify-center rounded-2xl bg-zinc-50 dark:bg-zinc-700/30">
                                                <svg class="size-8 text-zinc-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-zinc-900 dark:text-white">No returned books yet</p>
                                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Returned books will appear here</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
