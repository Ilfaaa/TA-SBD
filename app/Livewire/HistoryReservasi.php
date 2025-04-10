<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservasi;
use Illuminate\Support\Facades\Auth;

class HistoryReservasi extends Component
{
    public function render()
    {
        // Ambil reservasi hanya untuk user yang sedang login
        $reservasi = Reservasi::where('user_id', Auth::id())->latest()->get();

        return view('livewire.history-reservasi', [
            'reservasi' => $reservasi
        ])->layout('layouts.app'); // Sesuaikan dengan layout yang tersedia
    }
}
