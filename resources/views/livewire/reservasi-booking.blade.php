<div class="min-h-screen bg-blue-100 py-10">
    <h1 class="text-2xl font-bold text-center mb-6">Pesan & Tentukan Tanggal</h1>

    <div class="max-w-md mx-auto bg-white shadow-lg rounded-2xl p-6 space-y-5">
        <h2 class="text-lg font-semibold text-blue-600">Info Booking</h2>

        @if ($showSuccess)
            <div class="bg-green-100 text-green-800 border border-green-300 p-4 rounded">
                ✅ Reservasi berhasil dikirim!
            </div>
        @endif

        <!-- Tipe Ruangan -->
        <div>
            <label class="block mb-1">Tipe Ruangan</label>
            <div class="flex gap-2">
                @foreach (['Reguler', 'VIP'] as $tipe)
                    <button wire:click="$set('tipeRuangan', '{{ $tipe }}')"
                            class="border px-4 py-2 rounded
                            {{ $tipeRuangan === $tipe ? 'bg-blue-500 text-white border-blue-600' : 'text-blue-600 border-blue-400 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition' }}">
                        {{ $tipe }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Tanggal -->
        <div>
            <label class="block mt-4 mb-1">Tanggal</label>
            <input type="date" wire:model="tanggal" class="w-full border rounded px-4 py-2">
        </div>

        <!-- Jam Mulai -->
        <div>
            <label class="block mb-1">Jam Mulai</label>
            <div class="grid grid-cols-4 gap-2">
                @foreach (range(11, 22) as $jam)
                    @php $jamFormatted = str_pad($jam, 2, '0', STR_PAD_LEFT) . ':00'; @endphp
                    <button wire:click="$set('jamMulai', '{{ $jamFormatted }}')"
                            class="border px-3 py-1 rounded text-sm
                                {{ $jamMulai === $jamFormatted ? 'bg-blue-500 text-white border-blue-600' : 'text-blue-600 border-blue-400 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition' }}">
                        {{ $jamFormatted }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Durasi -->
        <div>
            <label class="block mb-1">Durasi</label>
            <div class="flex gap-2">
                @foreach ([1, 2, 3] as $d)
                    <button wire:click="$set('durasi', {{ $d }})"
                            @if ($jamMulai === '22:00' && $d > 1) disabled @endif
                            class="border px-4 py-2 rounded
                                {{ ($jamMulai === '22:00' && $d > 1) ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : ($durasi === $d ? 'bg-blue-500 text-white border-blue-600' : 'text-blue-600 border-blue-400 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition') }}">
                        {{ $d }} Jam
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Jam Selesai -->
        <div>
            <label class="block mb-1">Jam Selesai</label>
            <p class="text-xl font-bold text-blue-800">{{ $jamSelesai }}</p>
        </div>

        <!-- Submit -->
        <div class="text-center pt-4">
            <button wire:click="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded transition font-semibold shadow">
                Submit Reservasi
            </button>
        </div>
        @error('tipeRuangan')
        <div class="bg-red-100 text-red-800 border border-red-300 p-4 rounded">
            {{ $message }}
        </div>
        @enderror

    </div>
</div>
