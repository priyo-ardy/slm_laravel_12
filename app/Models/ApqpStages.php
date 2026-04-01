<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ApqpStages extends Model
{
    protected $table = 'm_apqp_stages';

    protected $fillable = ['code', 'name', 'status'];

    // 1. Relasi ke tahapan-tahapan yang menjadi syarat/induknya
    public function prerequisites(): BelongsToMany
    {
        return $this->belongsToMany(
            ApqpStages::class,
            'm_stage_dependencies',
            'stage_id',
            'prerequisite_id'
        );
    }

    // 2. FUNGSI AJAIB KITA: Mengecek apakah tahap ini boleh dimulai
    public function isReadyToStart(): bool
    {
        // Cari apakah ada 'prerequisite' (syarat) yang statusnya BELUM 'completed'
        $uncompletedPrerequisites = $this->prerequisites()
            ->where('status', '!=', 'completed')
            ->count();

        // Jika jumlah yang belum selesai adalah 0, berarti SIAP dimulai (return true)
        return $uncompletedPrerequisites === 0;
    }
}
