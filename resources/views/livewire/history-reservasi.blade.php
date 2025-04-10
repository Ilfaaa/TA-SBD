<div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow rounded-xl">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">History Reservasi</h2>

    @if($reservasi->isEmpty())
        <p class="text-gray-600">Belum ada reservasi.</p>
    @else
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
            <tr class="bg-blue-500 text-white">
                <th class="py-2 px-4 border">#</th>
                <th class="py-2 px-4 border">Tanggal</th>
                <th class="py-2 px-4 border">Ruangan</th>
                <th class="py-2 px-4 border">Waktu</th>
                <th class="py-2 px-4 border">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reservasi as $index => $item)
                <tr class="border">
                    <td class="py-2 px-4 text-center">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 text-center">{{ $item->tanggal }}</td>
                    <td class="py-2 px-4 text-center">{{ $item->ruangan }}</td>
                    <td class="py-2 px-4 text-center">
                        {{ date('H:i', strtotime($item->jam_mulai)) }} - {{ date('H:i', strtotime($item->jam_selesai)) }}
                    </td>
                    <td class="py-2 px-4 text-center">
                        @if($item->status == 'pending')
                            <span class="text-yellow-500">Menunggu</span>
                        @elseif($item->status == 'approved')
                            <span class="text-green-500">Disetujui</span>
                        @else
                            <span class="text-red-500">Ditolak</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
