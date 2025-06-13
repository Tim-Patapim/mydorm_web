<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $table = 'pelanggaran'; // Nama tabel
    protected $primaryKey = 'pelanggaran_id'; // Primary key
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'kategori',
        'waktu',
        'gambar',
        'senior_resident_id',
        'dormitizen_id'
    ];

    public function seniorResident(): BelongsTo
    {
        return $this->belongsTo(SeniorResident::class, 'senior_resident_id', 'senior_resident_id');
    }

    public function dormitizen(): BelongsTo
    {
        return $this->belongsTo(Dormitizen::class, 'dormitizen_id', 'dormitizen_id');
    }
}
