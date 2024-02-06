<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use Carbon\Carbon;
use App\Imports\AbsenImport;
use App\Exports\AbsenExport;
use Maatwebsite\Excel\Facades\Excel;

class AbsenController extends Controller
{
    public function index()
    {
        $daysInMonth = Carbon::now()->daysInMonth;
        $absen = Absen::all();
        return view('absen.index', compact('absen', 'daysInMonth'));
    }
    public function export()
    {
        try {
            $absen = Absen::all();
            return Excel::download(new AbsenExport($absen), 'absen.xlsx');
        } catch (\Exception $e) {
            return redirect()->route('absen.index')
                ->with('error', 'Terjadi kesalahan saat mengekspor data: ' . $e->getMessage());
        }
    }
public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new AbsenImport, $request->file('file'));

            return redirect()->route('absen.index')
                ->with('success', 'Data absen berhasil diimport.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return redirect()->route('absen.index')
                ->with('error', 'Terjadi kesalahan validasi: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('absen.index')
                ->with('error', 'Terjadi kesalahan saat mengimport data: ' . $e->getMessage());
        }
    }       
    public function create()
    {
        return view('absen.create');
    }
        public function store(Request $request)
    {
        $request->validate([
            'No_absen' => 'required|unique:absen',
            'Nama_Karyawan' => 'required',
            'cabang' => 'required',
            'posisi_jabatan' => 'required',
            'tahun' => 'required',
            'Bulan' => 'required',
        ]);

        Absen::create($request->all());
        return redirect()->route('absen.index')
            ->with('success', 'Data absen berhasil ditambahkan.');
    }
    
    public function edit(Absen $absen)
    {
        $daysInMonth = Carbon::now()->daysInMonth;
        $absen = Absen::all();

        return view('absen.Index', compact('absen', 'daysInMonth'));
    }
    public function show(Absen $absen)
    {
        $daysInMonth = Carbon::now()->daysInMonth;
        $absen = Absen::all();

        return view('absen.Index', compact('absen', 'daysInMonth'));
    }

    public function update(Request $request, Absen $absen)
    {
        $request->validate([
            'hari' => 'required|array',
        ]);

        try {
            $dataToUpdate = [];

            foreach ($request->hari as $key => $val) {
                $dataToUpdate['hari'.$key] = $val; 
                $absen->update($dataToUpdate);
            }
            // $dataToUpdate['hari'.$]

            return response()->json(['message' => 'Data absen berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
    public function destroy(Absen $absen)
    {
        $absen->delete();

        return redirect()->route('absen.index')
            ->with('success', 'Data absen berhasil dihapus.');
    }
}
