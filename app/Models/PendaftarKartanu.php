<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftarKartanu extends Model
{
    use HasFactory;

    protected $table = 'pendaftar_kartanus';

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_whatsapp',
        'alamat_lengkap',
        'desa_ranting',
        'foto_ktp',
        'pas_foto',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}
