<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $username = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-7">
    {{-- Header --}}
    <div class="flex flex-col gap-2 text-center">
        <div class="mx-auto mb-2 flex h-12 w-12 items-center justify-center rounded-xl bg-zinc-900 dark:bg-white">
            <svg class="h-6 w-6 text-white dark:text-zinc-900" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
            {{ __('Library Management') }}
        </h1>
        <p class="text-sm text-zinc-500 dark:text-zinc-400">
            {{ __('Fill in the details below to get started') }}
        </p>
    </div>

    {{-- Session Status --}}
    @if (session('status'))
        <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-800 dark:bg-emerald-950/50 dark:text-emerald-400">
            <div class="flex items-center gap-2">
                <svg class="h-4 w-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
                {{ session('status') }}
            </div>
        </div>
    @endif

    <form wire:submit="register" class="flex flex-col gap-5">
        {{-- Name --}}
        <div class="space-y-2">
            <label for="name" class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">
                {{ __('Full name') }}
            </label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                    <svg class="h-5 w-5 text-zinc-400 dark:text-zinc-500 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                    </svg>
                </div>
                <input
                    wire:model="name"
                    id="name"
                    type="text"
                    name="name"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="John Doe"
                    class="block w-full rounded-xl border border-zinc-300 bg-zinc-50/50 py-3 pl-11 pr-4 text-sm text-zinc-900 placeholder-zinc-400 transition-all duration-200 focus:border-zinc-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-zinc-900/10 dark:border-zinc-700 dark:bg-zinc-900/50 dark:text-white dark:placeholder-zinc-500 dark:focus:border-zinc-400 dark:focus:bg-zinc-900 dark:focus:ring-zinc-400/10 @if($errors->has('name')) border-red-400 focus:border-red-500 focus:ring-red-500/10 dark:border-red-800 dark:focus:border-red-400 @endif"
                />
            </div>
            @error('name')
                <p class="flex items-center gap-1.5 text-xs text-red-600 dark:text-red-400">
                    <svg class="h-3.5 w-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Username --}}
        <div class="space-y-2">
            <label for="username" class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">
                {{ __('Username') }}
            </label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                    <svg class="h-5 w-5 text-zinc-400 dark:text-zinc-500 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" />
                    </svg>
                </div>
                <input
                    wire:model="username"
                    id="username"
                    type="text"
                    name="username"
                    required
                    autocomplete="username"
                    placeholder="your_username"
                    class="block w-full rounded-xl border border-zinc-300 bg-zinc-50/50 py-3 pl-11 pr-4 text-sm text-zinc-900 placeholder-zinc-400 transition-all duration-200 focus:border-zinc-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-zinc-900/10 dark:border-zinc-700 dark:bg-zinc-900/50 dark:text-white dark:placeholder-zinc-500 dark:focus:border-zinc-400 dark:focus:bg-zinc-900 dark:focus:ring-zinc-400/10 @if($errors->has('username')) border-red-400 focus:border-red-500 focus:ring-red-500/10 dark:border-red-800 dark:focus:border-red-400 @endif"
                />
            </div>
            @error('username')
                <p class="flex items-center gap-1.5 text-xs text-red-600 dark:text-red-400">
                    <svg class="h-3.5 w-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="space-y-2">
            <label for="password" class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">
                {{ __('Password') }}
            </label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                    <svg class="h-5 w-5 text-zinc-400 dark:text-zinc-500 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input
                    wire:model="password"
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="Enter your password"
                    class="block w-full rounded-xl border border-zinc-300 bg-zinc-50/50 py-3 pl-11 pr-4 text-sm text-zinc-900 placeholder-zinc-400 transition-all duration-200 focus:border-zinc-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-zinc-900/10 dark:border-zinc-700 dark:bg-zinc-900/50 dark:text-white dark:placeholder-zinc-500 dark:focus:border-zinc-400 dark:focus:bg-zinc-900 dark:focus:ring-zinc-400/10 @if($errors->has('password')) border-red-400 focus:border-red-500 focus:ring-red-500/10 dark:border-red-800 dark:focus:border-red-400 @endif"
                />
            </div>
            @error('password')
                <p class="flex items-center gap-1.5 text-xs text-red-600 dark:text-red-400">
                    <svg class="h-3.5 w-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="space-y-2">
            <label for="password_confirmation" class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">
                {{ __('Confirm password') }}
            </label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                    <svg class="h-5 w-5 text-zinc-400 dark:text-zinc-500 transition-colors duration-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input
                    wire:model="password_confirmation"
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Enter your password"
                    class="block w-full rounded-xl border border-zinc-300 bg-zinc-50/50 py-3 pl-11 pr-4 text-sm text-zinc-900 placeholder-zinc-400 transition-all duration-200 focus:border-zinc-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-zinc-900/10 dark:border-zinc-700 dark:bg-zinc-900/50 dark:text-white dark:placeholder-zinc-500 dark:focus:border-zinc-400 dark:focus:bg-zinc-900 dark:focus:ring-zinc-400/10 @if($errors->has('password_confirmation')) border-red-400 focus:border-red-500 focus:ring-red-500/10 dark:border-red-800 dark:focus:border-red-400 @endif"
                />
            </div>
            @error('password_confirmation')
                <p class="flex items-center gap-1.5 text-xs text-red-600 dark:text-red-400">
                    <svg class="h-3.5 w-3.5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <button
            type="submit"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-zinc-900 px-4 py-3 text-sm font-semibold text-white transition-all duration-200 hover:bg-zinc-800 hover:shadow-lg hover:shadow-zinc-900/10 focus:outline-none focus:ring-4 focus:ring-zinc-900/20 focus:ring-offset-2 active:scale-[0.98] disabled:pointer-events-none disabled:opacity-50 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100 dark:hover:shadow-white/10 dark:focus:ring-white/20 dark:focus:ring-offset-zinc-900"
        >
            <span wire:loading.remove wire:target="register">{{ __('Create account') }}</span>
            <span wire:loading wire:target="register" class="flex items-center gap-2">
                <svg class="h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                </svg>
                {{ __('Creating account...') }}
            </span>
        </button>
    </form>

    {{-- Divider --}}
    <div class="relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-zinc-200 dark:border-zinc-800"></div>
        </div>
        <div class="relative flex justify-center text-xs uppercase">
            <span class="bg-white px-2 text-zinc-400 dark:bg-zinc-900 dark:text-zinc-500">{{ __('Already registered?') }}</span>
        </div>
    </div>

    {{-- Login Link --}}
    <a
        href="{{ route('login') }}"
        wire:navigate
        class="inline-flex items-center justify-center gap-2 rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm font-semibold text-zinc-700 transition-all duration-200 hover:bg-zinc-50 hover:text-zinc-900 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-zinc-900/10 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white dark:focus:ring-zinc-400/10"
    >
        <svg class="h-4 w-4 -ml-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414-1.414L13.586 11H3a1 1 0 110-2h10.586l-5.293-5.293a1 1 0 011.414-1.414l7 7a1 1 0 010 1.414l-7 7z" clip-rule="evenodd" />
        </svg>
        {{ __('Sign in to existing account') }}
    </a>
</div>
