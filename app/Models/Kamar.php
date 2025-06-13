<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kamar extends Model
{
    use HasFactory;

    protected $table = 'kamar'; // Nama tabel
    protected $primaryKey = 'kamar_id'; // Primary key
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
  
    protected $fillable = [
        'nomor',
        'status',
        'gedung_id',
    ];

    public function gedung():BelongsTo
    {
        return $this->belongsTo(Gedung::class, 'gedung_id', 'gedung_id');
    }

    public function dormitizens():HasMany
    {
        return $this->hasMany(Dormitizen::class, 'kamar_id', 'kamar_id');
    }
}
