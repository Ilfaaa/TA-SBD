<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Billzecue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Navbar Full Width -->
<nav class="bg-blue-600 text-white px-6 py-4 shadow">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <h1 class="text-xl font-semibold">
            <a href="{{ route('dashboard') }}" class="hover:underline">Billzecue</a>
        </h1>

        <div class="flex items-center gap-4">
            @auth
                <!-- Jika User Sudah Login, Tampilkan Tombol Reservasi -->
                <a href="{{ route('reservasi-booking') }}"
                   class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100 font-medium transition">
                    Reservasi
                </a>
                <a href="{{ route('history') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                    History
                </a>
                <!-- Tombol Logout -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                        Logout
                    </button>
                </form>
            @else
                <!-- Jika User Belum Login, Tampilkan Tombol Login -->
                <a href="{{ route('login') }}"
                   class="bg-white text-blue-600 px-4 py-2 rounded hover:bg-blue-100 font-medium transition">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- Konten -->
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow rounded-xl">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">
        Selamat Datang Cucu Efren Reyes 🛐
    </h2>

    <div class="flex justify-center">
        <img src="{{ asset('img/gambar-billiard.jpg') }}" alt="Meja Billiard" class="w-96 h-auto rounded-lg shadow-md mb-6">
    </div>

@auth
        <p class="text-gray-600 text-center text-lg">
            Selamat datang, <strong>{{ auth()->user()->name }}</strong>! Silakan klik
            <a href="{{ route('reservasi-booking') }}" class="text-blue-600 font-semibold hover:underline">
                Reservasi
            </a>
            di atas untuk memulai pemesanan meja billiard. Nikmati kemudahan reservasi meja billiard dengan sistem online kami! Pilih ruangan favorit Anda, atur waktu bermain, dan pastikan pengalaman bermain yang nyaman tanpa perlu antre!
        </p>


    @else
        <p class="text-gray-600 text-center text-lg">
            Silakan klik tombol
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">
                Login
            </a>
            untuk melakukan reservasi meja biliar.
        </p>

    @endauth
</div>

</body>
</html>
