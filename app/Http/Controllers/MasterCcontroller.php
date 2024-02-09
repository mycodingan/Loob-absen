<?php

namespace App\Http\Controllers;

use App\Models\MasterUser;
use Illuminate\Http\Request;

class MasterCcontroller extends Controller
{
    public function index()
    {
        $master = MasterUser::all();

        return view('master.index', compact('master'));
    }
    public function store(request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required',
            'nama_cabang' => 'required',
        ]);

     MasterUser::create($request->all());
     return redirect()->route('master.index')
     ->with('success', 'Data absen master ditambahkan.');
    }
    public function create()
    {
        return view('master.index');
    }
    public function edit()
    {
        $master = MasterUser::all();
        return view('master.index', compact('master'));
    }
    public function update(request $request, MasterUser $master)
    {
        $request->validate([
            'nama_karyawan',
            'nama_cabang',
        ]);
        $master->update($request->all());
        return redirect()->route('master.index')
            ->with('sukses', 'sabar absen anda sudah di update');
    }
    public function destroy(MasterUser $master)
    {
        $master->delete();

        return  redirect()->route('master.index')
            ->with('success', 'Data master berhasil dihapus.');
    }
}
