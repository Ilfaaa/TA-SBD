<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
<div class="w-full max-w-md bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold text-center text-blue-600">Register</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST" class="mt-4">
        @csrf
        <div>
            <label class="block text-gray-700">Nama</label>
            <input type="text" name="name" class="w-full px-4 py-2 border rounded mt-1" required>
        </div>

        <div class="mt-3">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full px-4 py-2 border rounded mt-1" required>
        </div>

        <div class="mt-3">
            <label class="block text-gray-700">Password</label>
            <input type="password" name="password" class="w-full px-4 py-2 border rounded mt-1" required>
        </div>

        <div class="mt-3">
            <label class="block text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded mt-1" required>
        </div>

        <button class="w-full bg-blue-600 text-white px-4 py-2 rounded mt-4 hover:bg-blue-700">Daftar</button>
    </form>

    <p class="mt-4 text-center">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
    </p>
</div>

<!-- Running Text -->
<div class="absolute bottom-0 w-full bg-white py-3 shadow overflow-hidden">
    <p id="runningText" class="text-gray-700 text-lg font-semibold text-center"></p>
</div>

<script>
    const texts = [
        "🎱 Selamat datang di Billzecue! Nikmati pengalaman bermain biliar terbaik. 🎱",
        "🔥 Reservasi sekarang untuk ruangan Reguler atau VIP! 🔥",
        "🏆 Turnamen biliar segera hadir! Siapkan keahlianmu! 🏆"
    ];

    let index = 0;
    const runningText = document.getElementById("runningText");

    function showText() {
        runningText.style.opacity = "0"; // Sembunyikan teks sebelum ganti
        setTimeout(() => {
            runningText.innerText = texts[index]; // Ganti teks
            runningText.style.opacity = "1"; // Munculkan teks
            runningText.style.transform = "translateX(100%)"; // Mulai dari kanan

            setTimeout(() => {
                runningText.style.transition = "transform 12s linear"; // **Memperlambat animasi berjalan**
                runningText.style.transform = "translateX(-100%)"; // Geser ke kiri
            }, 300); // Delay agar transisi terlihat

            index = (index + 1) % texts.length; // Loop ke teks berikutnya
        }, 500); // **Memperlambat waktu jeda sebelum teks muncul**
    }

    setInterval(showText, 10000); // **Memperlambat interval antar teks**
    showText(); // Jalankan pertama kali
</script>

<style>
    #runningText {
        position: relative;
        white-space: nowrap;
        opacity: 1;
        transition: opacity 1s ease-in-out;
    }
</style>


</body>
</html>
