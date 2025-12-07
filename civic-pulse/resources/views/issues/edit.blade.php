@extends('layouts.app')

@section('title', 'Edit Issue')
@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold mb-6">Edit Issue</h1>

        <form method="POST" action="{{ route('issues.update', $issue->id) }}">
            
            @csrf
            
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Title</label>
                <input type="text" name="title" value="{{ $issue->title }}" 
                       class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="description" class="w-full border p-2 rounded" rows="4" required>{{ $issue->description }}</textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Update Issue
            </button>
            
            <a href="{{ route('issues.show', $issue->id) }}" class="ml-4 text-gray-600">Cancel</a>
        </form>
    </div>
@endsection
