@extends('layouts.app')

@section('title', 'Login')

@section('content')
<section class="mx-auto max-w-md animate-fade-in-up">
    <div class="rounded-2xl border border-white/10 bg-slate-900/50 backdrop-blur-md shadow-xl shadow-black/30">
        <div class="px-5 py-6 border-b border-white/10 text-center">
            <h1 class="text-2xl sm:text-3xl font-semibold tracking-tight text-white">Login to CivicPulse</h1>
            <p class="mt-2 text-sm text-slate-300">Welcome back! Enter your credentials to continue.</p>
        </div>

        <div class="px-5 py-6">
            <form method="POST" action="/login" class="space-y-5">
                @csrf

                @if (session('status'))
                    <div class="rounded-lg border border-red-500/30 bg-red-600/15 px-3 py-2 text-sm text-red-200">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-2">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full rounded-lg border border-white/10 bg-slate-900/60 px-3 py-2 text-slate-100 shadow-inner placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') ring-2 ring-red-500 @enderror"
                        placeholder="you@example.com"
                    >
                    @error('email')
                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-2">Password</label>
                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full rounded-lg border border-white/10 bg-slate-900/60 px-3 py-2 text-slate-100 shadow-inner placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') ring-2 ring-red-500 @enderror"
                        placeholder="Your password"
                    >
                    @error('password')
                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="pt-2">
                    <button
                        type="submit"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:from-blue-500 hover:to-indigo-500 hover:shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-slate-900"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Login
                    </button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-slate-300">
                Don't have an account?
                <a href="/register" class="font-medium text-blue-300 hover:text-blue-200 transition-colors">Register</a>
            </p>
        </div>
    </div>
</section>
@endsection