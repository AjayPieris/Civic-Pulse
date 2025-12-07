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

    <div class="text-sm text-gray-500 mb-6">
        <div class="mb-4">
            <span class="text-gray-500">Current Status:</span>
            <span class="font-bold {{ $issue->status == 'Resolved' ? 'text-green-600' : 'text-yellow-600' }}">
                {{ $issue->status }}
            </span>

            @if(auth()->check() && auth()->user()->is_admin)
            <div class="mt-4 bg-gray-50 p-4 rounded border">
                <h3 class="font-bold text-sm mb-2">Admin Actions</h3>

                <form action="{{ route('issues.updateStatus', $issue->id) }}" method="POST" class="flex gap-2">
                    @csrf
                    <select name="status" class="border p-2 rounded">
                        <option value="Pending" {{ $issue->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ $issue->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Resolved" {{ $issue->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">
                        Update Status
                    </button>
                </form>
            </div>
            @endif
        </div>

        <p>Reported by: <span class="font-bold text-gray-800">{{ $issue->user->name }}</span></p>
        <p>Date: {{ $issue->created_at->format('M d, Y') }}</p>
    </div>

    @if (auth()->id() === $issue->user_id)
        <div class="mt-8 border-t pt-4 flex gap-2">
            
            <a href="{{ route('issues.edit', $issue->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
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
    @endif

</div>
@endsection