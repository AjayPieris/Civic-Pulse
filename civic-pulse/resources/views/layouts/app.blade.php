<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CivicPulse - @yield('title', 'Community App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-blue-600 p-4 text-white">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <a href="/issues" class="font-bold text-xl">CivicPulse</a>
            <div>
                <a href="/issues" class="mr-4 hover:underline">All Issues</a>
                <a href="/issues/create" class="bg-white text-blue-600 px-3 py-1 rounded font-semibold hover:bg-gray-100">
                    + Report
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto mt-8 px-4">
        @yield('content')
    </div>


</body>
</html>