<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dormitizen extends Model
{
    use HasFactory;
    
    protected $table = 'dormitizen'; // Nama tabel
    protected $primaryKey = 'dormitizen_id'; // Primary key
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'nim',
        'nama',
        'prodi',
        'agama',
        'no_hp',
        'no_hp_ortu',
        'alamat_ortu',
        'gambar',
        'kamar_id', // kolom untuk relasi dengan kamar
    ];

    public function kamar():BelongsTo
    {
        return $this->belongsTo(Kamar::class, 'kamar_id', 'kamar_id');
    }
}
