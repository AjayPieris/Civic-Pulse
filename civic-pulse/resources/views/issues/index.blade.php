@extends('layouts.app')

@section('title', 'All Issues')

@section('content')
<section class="mx-auto max-w-6xl animate-fade-in-up">
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-semibold tracking-tight text-white">Reported Issues</h1>
        <p class="mt-2 text-sm text-slate-300">Browse and track community-reported issues in real time.</p>
    </div>

    @if ($issues->isEmpty())
        <div class="rounded-2xl border border-white/10 bg-slate-900/50 p-8 text-center shadow-xl shadow-black/30 backdrop-blur-md">
            <div class="mx-auto inline-flex h-12 w-12 items-center justify-center rounded-xl bg-white/5 ring-1 ring-white/10 text-slate-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 opacity-80" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a7 7 0 100 14A7 7 0 009 2zM8 7a1 1 0 012 0v3a1 1 0 01-2 0V7zm1 6a1 1 0 100-2 1 1 0 000 2z"/>
                </svg>
            </div>
            <p class="mt-4 text-slate-300">No issues reported yet.</p>
            <p class="mt-1 text-xs text-slate-500">Be the first to report an issue and help improve the community.</p>
        </div>
    @else
        <div class="grid gap-4 sm:gap-5">
            @foreach ($issues as $issue)
                <article class="group rounded-2xl border border-white/10 bg-slate-900/50 p-5 shadow-md shadow-black/20 backdrop-blur-md transition-all hover:shadow-xl hover:shadow-black/30 hover:border-white/20">
                    <div class="flex items-start justify-between gap-4">
                        <h2 class="text-lg sm:text-xl font-semibold tracking-tight">
                            <a href="{{ route('issues.show', $issue->id) }}"
                               class="bg-gradient-to-r from-blue-200 to-cyan-200 bg-clip-text text-transparent group-hover:from-blue-100 group-hover:to-cyan-100 transition-colors">
                                {{ $issue->title }}
                            </a>
                        </h2>

                        @php
                            $statusStyles = match($issue->status) {
                                'Resolved' => 'bg-emerald-500/20 text-emerald-300 ring-emerald-400/30',
                                'In Progress' => 'bg-amber-500/20 text-amber-300 ring-amber-400/30',
                                default => 'bg-yellow-500/20 text-yellow-300 ring-yellow-400/30'
                            };
                        @endphp
                        <span class="inline-flex items-center rounded-full px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide ring-1 {{ $statusStyles }}">
                            {{ $issue->status }}
                        </span>
                    </div>

                    <p class="mt-2 text-slate-200 line-clamp-2">
                        {{ $issue->description }}
                    </p>

                    <div class="mt-4 flex items-center justify-between text-xs text-slate-400">
                        <span>Reported {{ $issue->created_at->diffForHumans() }}</span>
                        <a href="{{ route('issues.show', $issue->id) }}"
                           class="inline-flex items-center gap-1 rounded-md border border-white/10 bg-white/5 px-2.5 py-1 text-slate-200 hover:bg-white/10 hover:text-white transition-colors">
                            View details
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M12.293 5.293a1 1 0 011.414 0L17 8.586a2 2 0 010 2.828l-3.293 3.293a1 1 0 01-1.414-1.414L14.586 11H7a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"/>
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</section>
@endsection