<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billzecue</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js (optional) -->
    <script src="//unpkg.com/alpinejs" defer></script>

    @livewireStyles
</head>
<body class="bg-gray-100">

<!-- Navbar Full Width -->
<nav class="bg-blue-600 text-white px-6 py-4 shadow">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <h1 class="text-xl font-semibold">
            <a href="{{ route('dashboard') }}" class="hover:underline">Billzecue</a>
        </h1>

        @if (Route::is('dashboard'))
            <a href="{{ route('reservasi-booking') }}"
               class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100 font-medium transition">
                Reservasi
            </a>
            @auth
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="ml-4 text-white hover:underline">Logout</button>
                </form>

            @endauth

        @endif
    </div>
</nav>

<!-- Main Content -->
<main class="pb-10">
    {{ $slot }}
</main>

@livewireScripts
</body>
</html>
