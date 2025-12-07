@extends('layouts.app')

@section('title', 'Issue Details')

@section('content')
<section class="mx-auto max-w-3xl animate-fade-in-up">
    <!-- Header -->
    <div class="rounded-2xl border border-white/10 bg-slate-900/50 backdrop-blur-md shadow-xl shadow-black/30">
        <div class="flex items-start justify-between gap-4 border-b border-white/10 px-5 py-4">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-white">
                    {{ $issue->title }}
                </h1>
                <div class="mt-2 flex items-center gap-2 text-sm">
                    <span class="text-slate-300">Reported by</span>
                    <span class="font-semibold text-slate-100">{{ $issue->user->name }}</span>
                    <span class="text-slate-500">•</span>
                    <span class="text-slate-400">{{ $issue->created_at->format('M d, Y') }}</span>
                </div>
            </div>
            <a href="/issues"
               class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-3 py-1.5 text-sm font-medium text-slate-200 hover:bg-white/10 hover:text-white transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white/30 focus:ring-offset-slate-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9.707 14.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L6.414 8H17a1 1 0 110 2H6.414l3.293 3.293a1 1 0 010 1.414z"/>
                </svg>
                Back to List
            </a>
        </div>

        <!-- Description -->
        <div class="px-5 py-6">
            <p class="text-slate-200 leading-relaxed">
                {{ $issue->description }}
            </p>

            <!-- Image -->
            @if ($issue->image_path)
                <div class="mt-6">
                    <div class="overflow-hidden rounded-xl border border-white/10 bg-slate-900/40 shadow-md">
                        <img src="{{ asset('storage/' . $issue->image_path) }}"
                             alt="Issue Image"
                             class="w-full h-auto object-cover transition-transform duration-300 ease-out hover:scale-[1.02]">
                    </div>
                </div>
            @endif

            <!-- Status + Admin Actions -->
            <div class="mt-6">
                <div class="flex flex-col gap-4 rounded-xl border border-white/10 bg-slate-900/40 p-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="text-sm text-slate-300">Current Status:</span>
                        @php
                            $statusColor = match($issue->status) {
                                'Resolved' => 'bg-emerald-500/20 text-emerald-300 ring-emerald-400/30',
                                'In Progress' => 'bg-amber-500/20 text-amber-300 ring-amber-400/30',
                                default => 'bg-yellow-500/20 text-yellow-300 ring-yellow-400/30'
                            };
                        @endphp
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold ring-1 {{ $statusColor }}">
                            {{ $issue->status }}
                        </span>
                    </div>

                    @if(auth()->check() && auth()->user()->is_admin)
                        <div class="rounded-lg border border-white/10 bg-white/5 p-4">
                            <h3 class="mb-3 text-sm font-semibold text-slate-200">Admin Actions</h3>

                            <form action="{{ route('issues.updateStatus', $issue->id) }}" method="POST" class="flex flex-wrap items-center gap-3">
                                @csrf
                                <label class="relative">
                                    <select name="status"
                                            class="w-48 rounded-lg border border-white/10 bg-slate-900/60 px-3 py-2 text-sm text-slate-100 shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="Pending" {{ $issue->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="In Progress" {{ $issue->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="Resolved" {{ $issue->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                    </select>
                                </label>

                                <button type="submit"
                                        class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:from-blue-500 hover:to-indigo-500 hover:shadow-md transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 focus:ring-offset-slate-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Update Status
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Owner Actions -->
            @if (auth()->id() === $issue->user_id)
                <div class="mt-8 border-t border-white/10 pt-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('issues.edit', $issue->id) }}"
                           class="inline-flex items-center gap-2 rounded-lg bg-amber-500 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-amber-600 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 focus:ring-offset-slate-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m2 0h2m-6 4h6m-6 4h6m-6 4h6"/>
                            </svg>
                            Edit
                        </a>

                        <form action="{{ route('issues.destroy', $issue->id) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this issue? This cannot be undone.');"
                              class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 focus:ring-offset-slate-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3"/>
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection