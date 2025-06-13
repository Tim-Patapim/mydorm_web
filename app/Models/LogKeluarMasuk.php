<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogKeluarMasuk extends Model
{
    use HasFactory;

    protected $table = 'log_keluar_masuk'; // Nama tabel
    protected $primaryKey = 'log_keluar_masuk_id'; // Primary key
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'waktu', 
        'aktivitas', 
        'status', 
        'dormitizen_id', 
        'senior_resident_id', 
        'helpdesk_id'
    ];
    
    public function dormitizen():BelongsTo
    {
        return $this->belongsTo(Dormitizen::class, 'dormitizen_id', 'dormitizen_id');
    }

    public function seniorResident():BelongsTo
    {
        return $this->belongsTo(SeniorResident::class, 'senior_resident_id', 'senior_resident_id');
    }

    public function helpdesk():BelongsTo
    {
        return $this->belongsTo(Helpdesk::class, 'helpdesk_id', 'helpdesk_id');
    }
}
