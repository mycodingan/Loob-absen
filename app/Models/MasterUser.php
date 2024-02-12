<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_karyawan',
        'nama_cabang',
    ];

    public function absens()
    {
        return $this->hasMany(Absen::class, 'Nama_Karyawan', 'nama_karyawan');
    }
}
