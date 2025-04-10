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
</body>
</html>
