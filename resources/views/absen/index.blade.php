@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Absen</div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No Absen</th>
                                <th>Nama Karyawan</th>
                                <th>Cabang</th>
                                <th>Posisi Jabatan</th>
                                @for ($i = 1; $i <= $daysInMonth; $i++) <th>Hari {{ $i }}</th>
                                    @endfor
                                    <th>Tahun</th>
                                    <th>Bulan</th>
                                    <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absen as $data)
                            <tr>
                                <td>{{ $data->No_absen }}</td>
                                <td>{{ $data->Nama_Karyawan }}</td>
                                <td>{{ $data->cabang }}</td>
                                <td>{{ $data->posisi_jabatan }}</td>
                                @for ($i = 1; $i <= $daysInMonth; $i++) <td class="editable" data-absen-id="{{ $data->id }}" data-day="{{ $i }}">
                                    <span>{{ $data->{'hari' . $i} }}</span>
                                    </td>
                                    @endfor
                                    <td>{{ $data->tahun }}</td>
                                    <td>{{ $data->Bulan }}</td>
                                    <td>
                                        <form action="{{ route('absen.destroy', $data->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                        </form>
                                        {{-- <a href="{{ route('absen.edit', $data->id) }}" class="btn btn-sm btn-primary">Edit</a> --}}
                                    </td>
                            </tr>
                            @endforeach
                            <tr class="add-row">
                                <form method="POST" action="{{ route('absen.store') }}">
                                    @csrf
                                    <td><input type="text" class="form-control" name="No_absen" required></td>
                                    <td><input type="text" class="form-control" name="Nama_Karyawan" required></td>
                                    <td><input type="text" class="form-control" name="cabang" required></td>
                                    <td><input type="text" class="form-control" name="posisi_jabatan" required></td>
                                    @for ($i = 1; $i <= $daysInMonth; $i++) <td><input type="text" class="form-control" name="hari{{ $i }}"></td>
                                        @endfor
                                        <td><input type="text" class="form-control" name="tahun" required></td>
                                        <td><input type="text" class="form-control" name="Bulan" required></td>
                                        <td><button type="submit" class="btn btn-primary">Tambah Data</button></td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.editable').click(function() {
            var $editable = $(this);
            var absen_id = $editable.data('absen-id');
            var day = $editable.data('day');
            var currentValue = $editable.find('span').text();

            var selectOptions = '<select class="form-control">';
            selectOptions += '<option value="1">1</option>';
            selectOptions += '<option value="2">2</option>';
            selectOptions += '<option value="ls">LS</option>';
            selectOptions += '<option value="off">OFF</option>';
            selectOptions += '<option value="cuti">Cuti</option>';
            selectOptions += '</select>';

            $editable.empty().append(selectOptions);
            $editable.find('select').val(currentValue);

            $editable.find('select').change(function() {
                var selectedValue = $(this).val();
                $.ajax({
                    url: '/Absen/public/absen/' + absen_id
                    , method: 'PUT'
                    , data: {
                        _token: '{{ csrf_token() }}'
                        , _method: 'PUT'
                        , hari: {
                            [day]: selectedValue
                        }
                        , day: day
                    }
                    , success: function(response) {
                        $editable.empty().append('<span>' + selectedValue + '</span>');
                    }
                    , error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

            });
        });
    });

</script>
@endsection
