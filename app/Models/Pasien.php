<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pasien extends Model
{
    protected $guarded = [
        'id'
    ];

    protected $casts = [
        'tanggal_sakit' => 'date',
        'tanggal_mulai_terapi' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function hasilMonitorings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HasilMonitoring::class, 'pasien_id', 'id');
    }
}
