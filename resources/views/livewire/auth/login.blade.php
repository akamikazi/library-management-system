<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string')]
    public string $username = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'username' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'username' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->username).'|'.request()->ip());
    }
}; ?>

<div class="flex flex-col gap-7">
    {{-- Header --}}
    <div class="flex flex-col gap-2 text-center">
        <div class="mx-auto mb-2 flex h-12 w-12 items-center justify-center rounded-xl bg-zinc-900 dark:bg-white">
            <svg class="h-6 w-6 text-white dark:text-zinc-900" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
            {{ __('Welcome back') }}
        </h1>
        <p class="text-sm text-zinc-500 dark:text-zinc-400">
            {{ __('Enter your credentials to access your account') }}
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

    <form wire:submit="login" class="flex flex-col gap-5">
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
                    autofocus
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
            <div class="flex items-center justify-between">
                <label for="password" class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">
                    {{ __('Password') }}
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-medium text-zinc-500 underline-offset-4 transition-all duration-200 hover:text-zinc-700 hover:underline dark:text-zinc-400 dark:hover:text-zinc-200">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>
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
                    autocomplete="current-password"
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

        {{-- Remember Me --}}
        <label class="inline-flex cursor-pointer items-center gap-2.5">
            <div class="relative flex items-center">
                <input
                    wire:model="remember"
                    type="checkbox"
                    class="peer h-4.5 w-4.5 cursor-pointer appearance-none rounded-md border border-zinc-300 bg-white transition-all duration-200 checked:border-zinc-900 checked:bg-zinc-900 focus:ring-4 focus:ring-zinc-900/10 dark:border-zinc-700 dark:bg-zinc-900 dark:checked:border-zinc-400 dark:checked:bg-zinc-400"
                />
                <svg class="pointer-events-none absolute h-3.5 w-3.5 scale-0 text-white transition-transform duration-200 peer-checked:scale-100 dark:text-zinc-900" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="text-sm text-zinc-600 select-none dark:text-zinc-400">
                {{ __('Remember me') }}
            </span>
        </label>

        {{-- Submit Button --}}
        <button
            type="submit"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-zinc-900 px-4 py-3 text-sm font-semibold text-white transition-all duration-200 hover:bg-zinc-800 hover:shadow-lg hover:shadow-zinc-900/10 focus:outline-none focus:ring-4 focus:ring-zinc-900/20 focus:ring-offset-2 active:scale-[0.98] disabled:pointer-events-none disabled:opacity-50 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100 dark:hover:shadow-white/10 dark:focus:ring-white/20 dark:focus:ring-offset-zinc-900"
        >
            <span wire:loading.remove wire:target="login">{{ __('Sign in') }}</span>
            <span wire:loading wire:target="login" class="flex items-center gap-2">
                <svg class="h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                </svg>
                {{ __('Signing in...') }}
            </span>
        </button>
    </form>

    {{-- Divider --}}
    <div class="relative">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-zinc-200 dark:border-zinc-800"></div>
        </div>
        <div class="relative flex justify-center text-xs uppercase">
            <span class="bg-white px-2 text-zinc-400 dark:bg-zinc-900 dark:text-zinc-500">{{ __('New here?') }}</span>
        </div>
    </div>

    {{-- Register Link --}}
    <a
        href="{{ route('register') }}"
        wire:navigate
        class="inline-flex items-center justify-center gap-2 rounded-xl border border-zinc-300 bg-white px-4 py-3 text-sm font-semibold text-zinc-700 transition-all duration-200 hover:bg-zinc-50 hover:text-zinc-900 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-zinc-900/10 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white dark:focus:ring-zinc-400/10"
    >
        {{ __('Create an account') }}
        <svg class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </a>
</div>
