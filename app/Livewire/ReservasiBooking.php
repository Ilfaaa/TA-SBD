<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Reservasi;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReservasiBooking extends Component
{
    public $tipeRuangan;
    public $tanggal;
    public $jamMulai;
    public $durasi;
    public $jamSelesai = '00:00';
    public $showSuccess = false;

    public function mount()
    {
        $this->tipeRuangan = 'Reguler'; // default
    }

    public function updatedJamMulai()
    {
        $this->durasi = null;
        $this->updateJamSelesai();
    }

    public function updatedDurasi()
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
            'tipeRuangan' => 'required',
            'tanggal'     => 'required|date',
            'jamMulai'    => 'required',
            'durasi'      => 'required|numeric|min:1|max:3',
        ]);

        $this->jamSelesai = Carbon::createFromFormat('H:i', $this->jamMulai)
            ->addHours($this->durasi)
            ->format('H:i');

        $ruangans = Ruangan::where('tipe', $this->tipeRuangan)->get();

        foreach ($ruangans as $ruangan) {
            $bentrok = Reservasi::where('ruangan_id', $ruangan->id)
                ->where('tanggal', $this->tanggal)
                ->where(function ($query) {
                    $query->whereBetween('jam_mulai', [$this->jamMulai, $this->jamSelesai])
                        ->orWhereBetween('jam_selesai', [$this->jamMulai, $this->jamSelesai])
                        ->orWhere(function ($q) {
                            $q->where('jam_mulai', '<=', $this->jamMulai)
                                ->where('jam_selesai', '>=', $this->jamSelesai);
                        });
                })
                ->exists();

            if (! $bentrok) {
                Reservasi::create([
                    'user_id'     => Auth::id(),
                    'ruangan_id'  => $ruangan->id, // ✅ inilah yang wajib ada!
                    'tanggal'     => $this->tanggal,
                    'jam_mulai'   => $this->jamMulai,
                    'durasi'      => $this->durasi,
                    'jam_selesai' => $this->jamSelesai,
                ]);

                $this->showSuccess = true;

                $this->reset([
                    'tanggal',
                    'jamMulai',
                    'durasi',
                    'jamSelesai',
                ]);

                $this->jamSelesai = '00:00';

                return;
            }
        }

        $this->addError('tipeRuangan', 'Semua ruangan ' . $this->tipeRuangan . ' sedang penuh di jam tersebut.');
    }


    public function render()
    {
        return view('livewire.reservasi-booking')->layout('layouts.app');
    }
}
