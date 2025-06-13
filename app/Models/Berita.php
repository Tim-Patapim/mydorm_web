<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita'; // Nama tabel
    protected $primaryKey = 'berita_id'; // Primary key
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'judul', 
        'isi', 
        'kategori', 
        'helpdesk_id'
    ];


    public function helpdesk():BelongsTo
    {
        return $this->belongsTo(Helpdesk::class, 'helpdesk_id', 'helpdesk_id');
    }
}
