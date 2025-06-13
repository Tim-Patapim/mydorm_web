<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'paket'; // Nama tabel
    protected $primaryKey = 'paket_id'; // Primary key
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'status_pengambilan', 
        'waktu_tiba', 
        'waktu_diambil', 
        'dormitizen_id', 
        'penerima_paket', 
        'gambar',
        'penyerahan_paket'
    ];

    public function dormitizen():BelongsTo
    {
        return $this->belongsTo(Dormitizen::class, 'dormitizen_id', 'dormitizen_id');
    }

    public function penerimaPaket():BelongsTo
    {
        return $this->belongsTo(Helpdesk::class, 'penerima_paket', 'helpdesk_id');
    }

    public function penyerahanPaket():BelongsTo
    {
        return $this->belongsTo(Helpdesk::class, 'penyerahan_paket', 'helpdesk_id');
    }
}
