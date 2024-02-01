<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use Carbon\Carbon;

class AbsenController extends Controller
{
    public function index()
    {
        $daysInMonth = Carbon::now()->daysInMonth;        
            $absen = Absen::all();
            return view('absen.index', compact('absen', 'daysInMonth'));
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
// dd($request);
        return redirect()->route('absen.index')
            ->with('success', 'Data absen berhasil ditambahkan.');
    }
 
    public function edit(Absen $absen)
    {
        return view('absen.edit', compact('absen'));
    }

    public function update(Request $request, Absen $absen)
    {
        $request->validate([
            'No_absen' => 'required',
            'Nama_Karyawan' => 'required',
            'cabang' => 'required',
            'posisi_jabatan' => 'required',
            'tahun' => 'required',
            'Bulan' => 'required',
        ]);
    
        $dataToUpdate = [];
        for ($i = 1; $i <= 31; $i++) {
            $fieldName = 'hari' . $i;
            if ($request->has($fieldName)) {
                $dataToUpdate[$fieldName] = $request->$fieldName;
            }
        }
    
        $absen->update($request->only(['No_absen', 'Nama_Karyawan', 'cabang', 'posisi_jabatan', 'tahun', 'Bulan']) + $dataToUpdate);
    
        return response()->json(['message' => 'Data absen berhasil diperbarui.']);
    }
    
    

    public function destroy(Absen $absen)
    {
        $absen->delete();

        return redirect()->route('absen.index')
            ->with('success', 'Data absen berhasil dihapus.');
    }
}
