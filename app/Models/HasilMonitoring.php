<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilMonitoring extends Model
{
    protected $guarded = [
        'id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    protected static function booted()
    {
        static::updating(function ($model) {
            $dirty = array_keys($model->getDirty());
            $allowed = ['tinggi_shoulder', 'sudut_tangan', 'kecepatan', 'mode', 'mode_tangan'];

            // Simpan nama field terakhir yang berubah (kalau termasuk 5 field yang diperhatikan)
            $changed = array_intersect($dirty, $allowed);

            $model->last_changed_field = $changed ? implode(',', $changed) : $model->last_changed_field;
        });
    }
}
