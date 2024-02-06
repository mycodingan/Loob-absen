<?php

namespace App\Imports;

use App\Models\Absen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Throwable;
use Carbon\Carbon;


class AbsenImport implements ToModel, WithHeadingRow
{
    use Importable;
    public function model(array $row)
    {
        //ini menggunakan array asosiatif
        $currentDate = Carbon::now();
        $row['No_absen'] = $row['no_absen'];
        $row['Nama_Karyawan'] = $row['nama_karyawan'];
        $row['tahun'] = $currentDate->year;
        $row['Bulan'] = $currentDate->month;
        Absen::create($row);
            // dd($row);
            // try {
                // $currentDate = Carbon::now();
                // $timestamp = $currentDate->timestamp; 
            
                // return new Absen([
                //     'No_absen'      => 'AUTO_' . $timestamp,
                //     'Nama_Karyawan' => $row['nama_karyawan'] ?? null,
                //     'cabang'        => $row['cabang'] ?? null,
                //     'posisi_jabatan'=> $row['posisi_jabatan'] ?? null,
                //     'tahun'         => $currentDate->year,
                //     'Bulan'         => $currentDate->month,
                // ]);           
            // } catch (Throwable $j) {
            //     Absen::create($row);        
            // }
    
    }
}


