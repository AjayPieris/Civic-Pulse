@extends('layouts.app')

@section('title', 'Edit Issue')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-3xl font-bold mb-6">Edit Issue</h1>

    <form method="POST" action="{{ route('issues.update', $issue->id) }}" enctype="multipart/form-data">
        
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Title</label>
            <input type="text" name="title" value="{{ old('title', $issue->title) }}" 
                   class="w-full border p-2 rounded @error('title') border-red-500 @enderror" required>
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Description</label>
            <textarea name="description" class="w-full border p-2 rounded @error('description') border-red-500 @enderror" 
                      rows="4" required>{{ old('description', $issue->description) }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Update Image (Optional)</label>
            
            @if($issue->image_path)
                <div class="mb-2">
                    <p class="text-xs text-gray-500 mb-1">Current Image:</p>
                    <img src="{{ asset('storage/' . $issue->image_path) }}" class="w-32 h-32 object-cover rounded border">
                </div>
            @endif

            <input type="file" name="image" class="w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Update Issue
            </button>
            
            <a href="{{ route('issues.show', $issue->id) }}" class="text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection