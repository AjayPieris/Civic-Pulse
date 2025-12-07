@extends('layouts.app')

@section('title', 'Edit Issue')

@section('content')
<section class="mx-auto max-w-3xl animate-fade-in-up">
    <div class="rounded-2xl border border-white/10 bg-slate-900/50 backdrop-blur-md shadow-xl shadow-black/30">
        <div class="px-5 py-4 border-b border-white/10">
            <h1 class="text-2xl sm:text-3xl font-semibold tracking-tight text-white">Edit Issue</h1>
            <p class="mt-1 text-sm text-slate-300">Update the details and image for your reported issue.</p>
        </div>

        <div class="px-5 py-6">
            <form method="POST" action="{{ route('issues.update', $issue->id) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-2">Title</label>
                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $issue->title) }}"
                        required
                        class="w-full rounded-lg border border-white/10 bg-slate-900/60 px-3 py-2 text-slate-100 shadow-inner placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') ring-2 ring-red-500 @enderror"
                        placeholder="Brief, descriptive title"
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
                        required
                        class="w-full rounded-lg border border-white/10 bg-slate-900/60 px-3 py-2 text-slate-100 shadow-inner placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') ring-2 ring-red-500 @enderror"
                        placeholder="Describe the issue, steps to reproduce, and any relevant context..."
                    >{{ old('description', $issue->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-2">Update Image (Optional)</label>

                    @if($issue->image_path)
                        <div class="mb-3">
                            <p class="text-xs text-slate-400 mb-2">Current image</p>
                            <div class="overflow-hidden rounded-xl border border-white/10 bg-slate-900/40 shadow-md w-36 h-36">
                                <img src="{{ asset('storage/' . $issue->image_path) }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                    @endif

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
                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:from-blue-500 hover:to-indigo-500 hover:shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-slate-900"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Issue
                    </button>

                    <a
                        href="{{ route('issues.show', $issue->id) }}"
                        class="inline-flex items-center rounded-lg border border-white/10 bg-white/5 px-3 py-2 text-sm font-medium text-slate-200 hover:bg-white/10 hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white/30 focus:ring-offset-slate-900"
                    >
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection