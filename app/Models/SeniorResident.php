<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeniorResident extends Model
{
    use HasFactory;

    protected $table = 'senior_resident'; // Nama tabel
    protected $primaryKey = 'senior_resident_id'; // Primary key
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'dormitzen_id', // kolom untuk relasi dengan dormitizen
    ];

    public function dormitizen():BelongsTo
    {
        return $this->belongsTo(Dormitizen::class, 'dormitzen_id', 'dormitizen_id');
    }
}
