<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservasi extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ruangan', 'tanggal', 'jam_mulai', 'durasi', 'jam_selesai', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
