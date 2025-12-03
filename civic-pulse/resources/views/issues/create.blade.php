<!DOCTYPE html>
<html>
<head>
    <title>Report an Issue</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold mb-6">Report a New Issue</h1>

        <form method="POST" action="/issues">
            
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Title</label>
                <input type="text" name="title" class="w-full border p-2 rounded" placeholder="e.g. Broken Traffic Light" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Description</label>
                <textarea name="description" class="w-full border p-2 rounded" rows="4" placeholder="Details..." required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Submit Report
            </button>
        </form>
    </div>
</body>
</html>