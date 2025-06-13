<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gedung extends Model
{
    use HasFactory;

   
    protected $table = 'gedung'; // Nama tabel
    protected $primaryKey = 'gedung_id'; // Primary key
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'kode',
        'nama',
    ];

    public function kamar():HasMany
    {
        return $this->hasMany(Kamar::class, 'gedung_id', 'gedung_id');
    }
}
