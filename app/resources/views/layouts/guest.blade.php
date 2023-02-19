<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script src="https://cdn.tailwindcss.com"></script>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100
">
        <div class="flex flex-col w-96 sm:max-w-md bg-white justify-center shadow-md overflow-hidden sm:rounded-md box-border mt-16">
            <div class="w-full h-18 bg-blue-600 text-white py-4 pl-5">{{$page_title}}</div>
            <div class="p-10">
                {{ $slot }}
            </div>

        </div>
    </div>
</body>

</html>