<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan'; // Nama tabel
    protected $primaryKey = 'laporan_id'; // Primary key
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'judul', 
        'isi', 
        'dormitizen_id', 
        'helpdesk_id'
    ];

    public function dormitizen():BelongsTo
    {
        return $this->belongsTo(Dormitizen::class, 'dormitizen_id', 'dormitizen_id');
    }

    public function helpdesk():BelongsTo
    {
        return $this->belongsTo(Helpdesk::class, 'helpdesk_id', 'helpdesk_id');
    }
}
