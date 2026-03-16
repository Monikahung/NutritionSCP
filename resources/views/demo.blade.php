<!DOCTYPE html>
<html>

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Tailwind Test</title>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <h1 class="text-red-500 text-3xl font-bold">
        Tailwind Test
    </h1>
    <div class="bg-white p-10 rounded-xl shadow-lg text-center">
        <h1 class="text-4xl font-bold text-blue-600">
            Tailwind Working 🚀
        </h1>

        <p class="mt-4 text-gray-600">
            Jika styling ini muncul, Tailwind sudah aktif di Laravel kamu.
        </p>

        <button class="mt-6 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
            Test Button
        </button>
    </div>

</body>

</html>