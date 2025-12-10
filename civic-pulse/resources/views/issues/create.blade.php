@extends('layouts.app')

@section('title', 'Report Issue')

@section('content')
<section class="mx-auto max-w-3xl animate-fade-in-up">
    <div class="rounded-2xl border border-white/10 bg-slate-900/50 backdrop-blur-md shadow-xl shadow-black/30">
        <div class="px-5 py-4 border-b border-white/10">
            <h1 class="text-2xl sm:text-3xl font-semibold tracking-tight text-white">Report a New Issue</h1>
            <p class="mt-1 text-sm text-slate-300">Share details to help the community address problems faster.</p>
        </div>

        <div class="px-5 py-6">
            <form method="POST" action="/issues" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-2">Title</label>
                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="e.g. Broken Street Light"
                        class="w-full rounded-lg border border-white/10 bg-slate-900/60 px-3 py-2 text-slate-100 shadow-inner placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') ring-2 ring-red-500 @enderror"
                    >
                    @error('title')
                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-2">Description</label>
                    <textarea
                        name="description"
                        rows="5"
                        placeholder="Describe the issue details, location, and any steps to reproduce..."
                        class="w-full rounded-lg border border-white/10 bg-slate-900/60 px-3 py-2 text-slate-100 shadow-inner placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') ring-2 ring-red-500 @enderror"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-2">Attach Image (Optional)</label>
                    <input
                        type="file"
                        name="image"
                        class="block w-full text-slate-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-white/10 file:text-slate-100 hover:file:bg-white/15 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                    @error('image')
                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-slate-500">Accepted formats: JPG, PNG. Max size per your validation rules.</p>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3 pt-2">
                    <a
                        href="/"
                        class="inline-flex items-center rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm font-medium text-slate-200 hover:bg-white/10 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white/30 focus:ring-offset-slate-900"
                    >
                        Cancel
                    </a>
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-5 py-2 text-sm font-semibold text-white shadow-sm hover:from-blue-500 hover:to-indigo-500 hover:shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-slate-900"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Submit Report
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection