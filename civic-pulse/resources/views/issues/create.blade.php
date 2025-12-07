@extends('layouts.app')

@section('title', 'Report Issue')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Report a New Issue</h1>

    <form method="POST" action="/issues" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Title</label>
            <input type="text" name="title"
                class="w-full border p-2 rounded @error('title') border-red-500 @enderror"
                value="{{ old('title') }}"
                placeholder="e.g. Broken Street Light">

            @error('title')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Description</label>
            <textarea name="description" rows="5"
                class="w-full border p-2 rounded @error('description') border-red-500 @enderror"
                placeholder="Describe the issue details...">{{ old('description') }}</textarea>

            @error('description')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Attach Image (Optional)</label>
            <input type="file" name="image" class="w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

            @error('image')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-4">
            <a href="/issues" class="text-gray-600 px-4 py-2 hover:underline">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Submit Report
            </button>
        </div>
    </form>
</div>
@endsection