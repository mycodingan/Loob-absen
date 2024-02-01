<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = 'absen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'No_absen',
        'Nama_Karyawan',
        'cabang',
        'posisi_jabatan',
        'hari1', 'hari2', 'hari3', 'hari4', 'hari5', 'hari6', 'hari7', 'hari8', 'hari9', 'hari10',
        'hari11', 'hari12', 'hari13', 'hari14', 'hari15', 'hari16', 'hari17', 'hari18', 'hari19', 'hari20',
        'hari21', 'hari22', 'hari23', 'hari24', 'hari25', 'hari26', 'hari27', 'hari28', 'hari29', 'hari30', 'hari31',
        'tahun',
        'Bulan',
    ];

    // Disabling timestamps
    public $timestamps = false;
}
