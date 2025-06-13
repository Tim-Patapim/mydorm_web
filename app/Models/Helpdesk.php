<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Helpdesk extends Authenticatable
{
    use HasFactory;

    protected $table = 'helpdesk'; // Nama tabel
    protected $primaryKey = 'helpdesk_id'; // Primary key
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'nip',
        'nama',
        'username',
        'password',
        'gedung_id'
    ];

    public function gedung(): BelongsTo
    {
        return $this->belongsTo(Gedung::class, 'gedung_id', 'gedung_id');
    }
}
