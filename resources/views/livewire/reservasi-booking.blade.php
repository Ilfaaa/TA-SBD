<div class="min-h-screen bg-blue-100 py-10">
    <h1 class="text-2xl font-bold text-center mb-6">Pesan & Tentukan Tanggal</h1>

    <div class="max-w-md mx-auto bg-white shadow-lg rounded-2xl p-6 space-y-5">
        <h2 class="text-lg font-semibold text-blue-600">Info Booking</h2>

        <!-- Success Popup -->
        @if ($showSuccess)
            <div class="bg-green-100 text-green-800 border border-green-300 p-4 rounded">
                ✅ Reservasi berhasil dikirim!
            </div>
        @endif

        <!-- Pilih Ruangan -->
        <div>
            <label class="block mb-1">Ruangan</label>
            <div class="flex gap-2">
                <button wire:click="$set('ruangan', 'Reguler')"
                        class="border px-4 py-2 rounded
                        {{ $ruangan === 'Reguler' ? 'bg-blue-500 text-white border-blue-600' : 'text-blue-600 border-blue-400 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition' }}">
                    Reguler
                </button>
                <button wire:click="$set('ruangan', 'VIP')"
                        class="border px-4 py-2 rounded
                        {{ $ruangan === 'VIP' ? 'bg-blue-500 text-white border-blue-600' : 'text-blue-600 border-blue-400 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition' }}">
                    VIP
                </button>
            </div>
        </div>

        <!-- Tanggal -->
        <div>
            <label class="block mb-1">Tanggal</label>
            <input type="date" wire:model="tanggal" class="w-full border rounded px-4 py-2">
        </div>

        <!-- Jam Mulai -->
        <div>
            <label class="block mb-1">Jam Mulai</label>
            <div class="grid grid-cols-4 gap-2">
                @foreach ([11,12,13,14,15,16,17,18,19,20,21,22] as $jam)
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
                <button wire:click="$set('durasi', 1)"
                        class="border px-4 py-2 rounded
                            {{ $durasi === 1 ? 'bg-blue-500 text-white border-blue-600' : 'text-blue-600 border-blue-400 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition' }}">
                    1 Jam
                </button>

                <button wire:click="$set('durasi', 2)"
                        @if ($jamMulai === '22:00') disabled @endif
                        class="border px-4 py-2 rounded
                            {{ $jamMulai === '22:00' ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : ($durasi === 2 ? 'bg-blue-500 text-white border-blue-600' : 'text-blue-600 border-blue-400 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition') }}">
                    2 Jam
                </button>

                <button wire:click="$set('durasi', 3)"
                        @if ($jamMulai === '22:00') disabled @endif
                        class="border px-4 py-2 rounded
                            {{ $jamMulai === '22:00' ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : ($durasi === 3 ? 'bg-blue-500 text-white border-blue-600' : 'text-blue-600 border-blue-400 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition') }}">
                    3 Jam
                </button>
            </div>
        </div>

        <!-- Jam Selesai -->
        <div>
            <label class="block mb-1">Jam Selesai</label>
            <p class="text-xl font-bold text-blue-800">{{ $jamSelesai }}</p>
        </div>

        <!-- Tombol Submit -->
        <div class="text-center pt-4">
            <button wire:click="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded transition font-semibold shadow">
                Submit Reservasi
            </button>
        </div>
    </div>
</div>
