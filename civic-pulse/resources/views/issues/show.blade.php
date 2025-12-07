@extends('layouts.app')

@section('title', 'Issue Details')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">{{ $issue->title }}</h1>
        <a href="/issues" class="text-blue-500 hover:underline">Back to List</a>
    </div>

    <p class="text-gray-600 mb-4 text-lg">{{ $issue->description }}</p>
    @if ($issue->image_path)
    <div class="mb-6">
        <img src="{{ asset('storage/' . $issue->image_path) }}"
            alt="Issue Image"
            class="w-full max-w-lg rounded shadow-lg">
    </div>
    @endif

    <div class="text-sm text-gray-500">
        <p>Status: <span class="font-semibold">{{ $issue->status }}</span></p>
        <p>Reported on: {{ $issue->created_at->format('M d, Y') }}</p>
    </div>

    <div class="mt-8 border-t pt-4">
        <a href="{{ route('issues.edit', $issue->id) }}" class="bg-green-500 text-white px-4 py-2 rounded mr-2">
            Edit
        </a>
        <form action="{{ route('issues.destroy', $issue->id) }}" method="POST"
            onsubmit="return confirm('Are you sure you want to delete this issue? This cannot be undone.');"
            class="inline-block">

            @csrf
            @method('DELETE')

            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Delete
            </button>
        </form>
    </div>

</div>
@endsection