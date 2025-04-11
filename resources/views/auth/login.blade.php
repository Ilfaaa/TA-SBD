<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
<div class="w-full max-w-md bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold text-center text-blue-600">Billzecue Login</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 p-3 rounded mt-3">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="mt-4">
        @csrf
        <div>
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" class="w-full px-4 py-2 border rounded mt-1" required>
        </div>

        <div class="mt-3">
            <label class="block text-gray-700">Password</label>
            <input type="password" name="password" class="w-full px-4 py-2 border rounded mt-1" required>
        </div>

        <button class="w-full bg-blue-600 text-white px-4 py-2 rounded mt-4 hover:bg-blue-700">Login</button>
    </form>

    <p class="mt-4 text-center">
        Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar</a>
    </p>
</div>

<!-- Running Text -->
<div class="absolute bottom-0 w-full bg-white py-3 shadow overflow-hidden">
    <p id="runningText" class="text-gray-700 text-xl font-semibold text-center"></p>
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
                runningText.style.transition = "transform 20s linear"; // **Memperlambat animasi**
                runningText.style.transform = "translateX(-100%)"; // Geser ke kiri
            }, 300); // Delay agar transisi terlihat

            index = (index + 1) % texts.length; // Loop ke teks berikutnya
        }, 700); // **Memperlambat waktu jeda sebelum teks muncul**
    }

    setInterval(showText, 18000); // **Memperlambat interval antar teks**
    showText(); // Jalankan pertama kali
</script>

<style>
    #runningText {
        position: relative;
        white-space: nowrap;
        opacity: 1;
        transition: opacity 1.2s ease-in-out;
    }
</style>

</body>
</html>
