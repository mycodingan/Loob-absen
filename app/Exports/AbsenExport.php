<?php

namespace App\Exports;

use App\Models\Absen;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class AbsenExport implements FromCollection, WithMapping, WithHeadings
{
    protected $absen;

    public function __construct(Collection $absen)
    {
        $this->absen = $absen;
    }

    public function collection()
    {
        return $this->absen;
    }

    public function map($absen): array
    {
        $hariArray = [];
        
        $daysInMonth = Carbon::create($absen->tahun, $absen->Bulan)->daysInMonth;
        
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $hariArray[] = $absen["hari$i"] ?? ''; 
        }
    
        return [
            $absen->No_absen,
            $absen->Nama_Karyawan,
            $absen->cabang,
            $absen->posisi_jabatan,
            $absen->hari1,
            $absen->hari2,
            $absen->hari3,
            $absen->hari4,
            $absen->hari5,
            $absen->hari6,
            $absen->hari7,
            $absen->hari8,
            $absen->hari9,
            $absen->hari10,
            $absen->hari11,
            $absen->hari12,
            $absen->hari13,
            $absen->hari14,
            $absen->hari15,
            $absen->hari16,
            $absen->hari17,
            $absen->hari18,
            $absen->hari19,
            $absen->hari20,
            $absen->hari21,
            $absen->hari22,
            $absen->hari23,
            $absen->hari24,
            $absen->hari25,
            $absen->hari26,
            $absen->hari27,
            $absen->hari28,
            $absen->hari29,
            $absen->hari30,
            $absen->hari31,
            $absen->tahun,
            $absen->Bulan,
        ];
    }


    public function headings(): array
    {
        $firstData = $this->absen->first();
        $month = $firstData->Bulan;
        $year = $firstData->tahun;
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;
    
        $headings = [
            'No Absen',
            'Nama Karyawan',
            'Cabang',
            'Posisi/Jabatan',
        ];
    
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $headings[] = "Hari $i";
        }
        $headings[] = 'Tahun';
        $headings[] = 'Bulan';
    
        return $headings;
    }
}
