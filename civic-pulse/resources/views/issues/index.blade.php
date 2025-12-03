<!DOCTYPE html>
<html>

<head>
    <title>CivicPulse - Local Issues</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold mb-4">Reported Issues</h1>
        <a href="/issues/create" class="inline-block bg-blue-500 text-white px-4 py-2 rounded mb-4">
            + Report New Issue
        </a>
        @foreach ($issues as $issue)
        <div class="border-b p-4">
            <h2 class="text-xl font-semibold hover:text-blue-600">
                <a href="{{ route('issues.show', $issue->id) }}">
                    {{ $issue->title }}
                </a>
            </h2>
            <p class="text-gray-600">{{ $issue->description }}</p>
            <span class="bg-yellow-200 text-yellow-800 px-2 py-1 text-sm rounded">{{ $issue->status }}</span>
        </div>
        @endforeach

        @if ($issues->isEmpty())
        <p class="text-gray-500 mt-4">No issues reported yet. Good job, citizens!</p>
        @endif
    </div>
</body>

</html>