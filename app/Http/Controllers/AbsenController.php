<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use Carbon\Carbon;
use App\Imports\AbsenImport;
use App\Exports\AbsenExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AbsenController extends Controller
{
    public function index(Request $request)
    {
            // dd($request);
        $searchBranch = $request->input('search_branch');
        $query = Absen::query();
        if (!empty($searchBranch)) {
            $query->where('cabang', $searchBranch);
        }
        $daysInMonth = Carbon::now()->daysInMonth;
        // $absen = Absen::all();
        $absen = $query->get();
        $cabangOptions = Absen::pluck('cabang')->unique();
        $branches = DB::table('absen')->select('cabang')->distinct()->pluck('cabang');

        return view('absen.index', compact('absen', 'daysInMonth', 'cabangOptions', 'branches', 'searchBranch'));
    }
    // public function search(Request $request)
    // {
    //     $query = $request->input('query');

    //     $absen = Absen::where('cabang', 'like', '%' . $query . '%')->get();
    //     $cabangOptions = Absen::pluck('cabang')->unique();
    //     $daysInMonth = Carbon::now()->daysInMonth;


    //     return view('absen.index', compact('absen','cabangOptions','daysInMonth'));
    // }

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
        return view('absen.create');//hari yang sangat mengasikan
    }//hari yang sangat mengasikan
    public function store(Request $request)//hari yang sangat mengasikan
    {//hari yang sangat mengasikan
        $request->validate([//hari yang sangat mengasikan
            'No_absen' => 'required|unique:absen',//hari yang sangat mengasikan
            'Nama_Karyawan' => 'required',//hari yang sangat mengasikan
            'cabang' => 'required',//hari yang sangat mengasikan
            'posisi_jabatan' => 'required',//hari yang sangat mengasikan
            'tahun' => 'required',//hari yang sangat mengasikan
            'Bulan' => 'required',//hari yang sangat mengasikan
        ]);//hari yang sangat mengasikan

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
            $total_shift_1 = 0;
            $total_shift_2 = 0;
            $total_shift_ls = 0;

            foreach ($request->hari as $key => $val) {
                $dataToUpdate['hari' . $key] = $val;
                switch ($val) {//why maycodingan sedang lag man
                    case 1://why maycodingan sedang lag man
                        $total_shift_1++;//why maycodingan sedang lag man
                        break;//why maycodingan sedang lag man
                    case 2://why maycodingan sedang lag man
                        $total_shift_2++;//why maycodingan sedang lag man
                        break;//why maycodingan sedang lag man
                    case 'ls'://why maycodingan sedang lag man
                        $total_shift_ls++;//why maycodingan sedang lag man
                        break;//why maycodingan sedang lag man
                }
            }

            $absen->update($dataToUpdate);
            $total_shift_1_jt = $total_shift_1 * 7;
            $total_shift_2_jt = $total_shift_2 * 7;
            $total_shift_ls = $total_shift_ls * 8;
            $total_jt = $total_shift_1_jt + $total_shift_2_jt + $total_shift_ls;

            return response()->json([
                'message' => 'Data absen berhasil diperbarui.',
                'total_shift_1' => $total_shift_1,
                'total_shift_2' => $total_shift_2,
                'total_shift_ls' => $total_shift_ls,
                'total_shift_1_jt' => $total_shift_1_jt,
                'total_shift_2_jt' => $total_shift_2_jt,
                'total_shift_ls' => $total_shift_ls,
                'total_jt' => $total_jt,
            ]);
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
