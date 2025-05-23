<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'angkatan',
        'pekerjaan',
        'kontak',
        'kontak_pekerjaan',
        'alamat',
        'alamat_pekerjaan',
        'jurusan',
        'foto',
    ];
}
