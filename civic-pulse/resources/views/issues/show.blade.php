<!DOCTYPE html>
<html>
<head>
    <title>{{ $issue->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">{{ $issue->title }}</h1>
            <a href="/issues" class="text-blue-500 hover:underline">Back to List</a>
        </div>

        <p class="text-gray-600 mb-4 text-lg">{{ $issue->description }}</p>

        <div class="text-sm text-gray-500">
            <p>Status: <span class="font-semibold">{{ $issue->status }}</span></p>
            <p>Reported on: {{ $issue->created_at->format('M d, Y') }}</p>
        </div>

        <div class="mt-8 border-t pt-4">
            <button class="bg-green-500 text-white px-4 py-2 rounded mr-2">Edit</button>
            <button class="bg-red-500 text-white px-4 py-2 rounded">Delete</button>
        </div>

    </div>
</body>
</html>