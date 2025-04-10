<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Reservasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; //

#[Layout('layouts.app')]
class ReservasiBooking extends Component
{
    public $ruangan;
    public $tanggal;
    public $jamMulai;
    public $durasi;
    public $jamSelesai = '00:00';
    public $showSuccess = false;

    public function updatedJamMulai($value)
    {
        $this->durasi = null;
        $this->updateJamSelesai();
    }

    public function updatedDurasi($value)
    {
        $this->updateJamSelesai();
    }

    public function updateJamSelesai()
    {
        if ($this->jamMulai && $this->durasi) {
            $start = Carbon::createFromFormat('H:i', $this->jamMulai);
            $this->jamSelesai = $start->copy()->addHours($this->durasi)->format('H:i');
        } else {
            $this->jamSelesai = '00:00';
        }
    }

    public function submit()
    {
        $this->validate([
            'ruangan'    => 'required|in:Reguler,VIP',
            'tanggal'    => 'required|date',
            'jamMulai'   => 'required',
            'durasi'     => 'required|numeric|min:1|max:3',
            'jamSelesai' => 'required',
        ]);

        Reservasi::create([
            'user_id' => Auth::id(),
            'ruangan'     => $this->ruangan,
            'tanggal'     => $this->tanggal,
            'jam_mulai'   => $this->jamMulai,
            'durasi'      => $this->durasi,
            'jam_selesai' => $this->jamSelesai,
        ]);

        $this->showSuccess = true;

        $this->reset([
            'ruangan',
            'tanggal',
            'jamMulai',
            'durasi',
            'jamSelesai',
        ]);

        $this->jamSelesai = '00:00';
    }

    public function render()
    {
        return view('livewire.reservasi-booking');
    }
}
