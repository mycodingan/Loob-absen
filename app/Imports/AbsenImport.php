<?php

namespace App\Imports;

use App\Models\Absen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Carbon\Carbon;

class AbsenImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        $currentDate = Carbon::now();
        $row['No_absen'] = $row['no_absen'];
        $row['Nama_Karyawan'] = $row['nama_karyawan'];
        $row['tahun'] = $currentDate->year;
        $row['Bulan'] = $currentDate->month;


        $existingRecord = Absen::where('No_absen', $row['No_absen'])->first();
        if ($existingRecord) {
            $changesDetected = false;
            foreach ($row as $key => $value) {
                if ($existingRecord->$key != $value) {
                    $changesDetected = true;
                    break;
                }
            }

            if ($changesDetected) {
                $existingRecord->update($row);
            }
        } else {
            Absen::create($row);
        }
    }
}
