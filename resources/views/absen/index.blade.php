@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                                @for ($i = 1; $i <= $daysInMonth; $i++)
                                    <th>Hari {{ $i }}</th>
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
                                @for ($i = 1; $i <= $daysInMonth; $i++)
                                    <td class="editable" data-absen-id="{{ $data->id }}" data-day="{{ $i }}">
                                        <input type="hidden" class="form-control" name="hari{{ $i }}" value="{{ $data->{'hari' . $i} }}">
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
                                    <input type="checkbox" class="edit-checkbox" data-absen-id="{{ $data->id }}"> Edit
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
                                    @for ($i = 1; $i <= $daysInMonth; $i++)
                                        <td><input type="text" class="form-control" name="hari{{ $i }}"></td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>

<script>
    $(document).ready(function() {
        $('.edit-checkbox').change(function() {
            var $row = $(this).closest('tr');
            if ($(this).is(":checked")) {
                $row.find('.editable').each(function() {
                    var $input = $('<input type="text" class="form-control">').val($(this).find('span').text());
                    $(this).empty().append($input);
                });
            } else {
                $row.find('.editable').each(function() {
                    var $span = $('<span>').text($(this).find('input').val());
                    $(this).empty().append($span);
                });
            }
        });

        $(document).on('keypress', '.editable input', function(event) {
            if (event.which === 13) {
                var $editable = $(this).closest('.editable');
                var absen_id = $editable.data('absen-id');
                var day = $editable.data('day');
                var value = $(this).val();
                $.ajax({
                    url: '/Absen/public/absen/' + absen_id
                    , method: 'PUT'
                    , data: {
                        _token: '{{ csrf_token() }}'
                        , hari: value
                        , day: day
                    }
                    , success: function(response) {
                        $editable.empty().append('<span>' + value + '</span>');
                    }
                    , error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

            }
        });
    }); 
</script>   
@endsection
