@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Data Absen</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('absen.update', $absen->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="No_absen">No Absen</label>
                            <input type="text" class="form-control" id="No_absen" name="No_absen" value="{{ $absen->No_absen }}" required>
                        </div>

                        <div class="form-group">
                            <label for="Nama_Karyawan">Nama Karyawan</label>
                            <input type="text" class="form-control" id="Nama_Karyawan" name="Nama_Karyawan" value="{{ $absen->Nama_Karyawan }}" required>
                        </div>

                        <div class="form-group">
                            <label for="cabang">Cabang</label>
                            <input type="text" class="form-control" id="cabang" name="cabang" value="{{ $absen->cabang }}" required>
                        </div>

                        <div class="form-group">
                            <label for="posisi_jabatan">Posisi Jabatan</label>
                            <input type="text" class="form-control" id="posisi_jabatan" name="posisi_jabatan" value="{{ $absen->posisi_jabatan }}" required>
                        </div>

                        @for ($i = 1; $i <= 31; $i++)
                            <div class="form-group">
                                <label for="hari{{ $i }}">Hari {{ $i }}</label>
                                <input type="text" class="form-control" id="hari{{ $i }}" name="hari{{ $i }}" value="{{ $absen['hari' . $i] ?? '' }}">
                            </div>
                        @endfor

                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" value="{{ $absen->tahun }}" required>
                        </div>

                        <div class="form-group">
                            <label for="Bulan">Bulan</label>
                            <input type="text" class="form-control" id="Bulan" name="Bulan" value="{{ $absen->Bulan }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
