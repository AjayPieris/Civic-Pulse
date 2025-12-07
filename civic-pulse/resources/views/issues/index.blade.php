@extends('layouts.app')

@section('title', 'All Issues')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Reported Issues</h1>

    @if ($issues->isEmpty())
        <div class="bg-white p-6 rounded shadow text-center">
            <p class="text-gray-500">No issues reported yet.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($issues as $issue)
                <div class="bg-white p-6 rounded shadow hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <h2 class="text-xl font-semibold text-gray-800">
                            <a href="{{ route('issues.show', $issue->id) }}" class="hover:text-blue-600">
                                {{ $issue->title }}
                            </a>
                        </h2>
                        <span class="px-2 py-1 text-xs font-bold uppercase rounded 
                            {{ $issue->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                            {{ $issue->status }}
                        </span>
                    </div>
                    <p class="text-gray-600 mt-2 line-clamp-2">{{ $issue->description }}</p>
                    <div class="text-sm text-gray-400 mt-4">
                        Reported {{ $issue->created_at->diffForHumans() }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection