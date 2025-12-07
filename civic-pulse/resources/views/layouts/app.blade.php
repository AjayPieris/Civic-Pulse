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
                @auth
                <span class="text-gray-200 mr-4">Hi, {{ auth()->user()->name }}</span>

                @unless(auth()->user()->is_admin)
                <a href="/issues/create" class="bg-white text-blue-600 px-3 py-1 rounded font-semibold hover:bg-gray-100 mr-2">
                    + Report
                </a>
                @endunless

                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:underline">Logout</button>
                </form>
                @endauth

                @guest
                <a href="/login" class="text-white hover:underline mr-4">Login</a>
                <a href="/register" class="bg-white text-blue-600 px-3 py-1 rounded font-semibold">Register</a>
                @endguest
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto mt-8 px-4">
        
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        @yield('content')
    </div>

</body>

</html>