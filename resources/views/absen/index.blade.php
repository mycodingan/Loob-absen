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
                                @for ($i = 1; $i <= $daysInMonth; $i++) <th>hari{{ $i }}</th>
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
                                @for ($i = 1; $i <= $daysInMonth; $i++) <td>
                                    {{ $data['hari' . $i]}}
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
                                        <button class="btn btn-sm btn-primary edit-absen" data-absen_id="{{ $data->id }}">Edit</button>
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
                            </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.edit-absen').click(function() {
            var absen_id = $(this).data('absen_id');
            $(this).closest('tr').find('td').each(function() {
                var field_name = $(this).data('field');
                var field_value = $(this).text();
                var select_html = '<select class="form-control select-hari" data-absen_id="' + absen_id + '" data-field="' + field_name + '">';
                select_html += '<option value="">' + field_value + '</option>';
                select_html += '<option value="1" ' + (field_value === '1' ? 'selected' : '') + '>1</option>';
                select_html += '<option value="2" ' + (field_value === '2' ? 'selected' : '') + '>2</option>';
                select_html += '<option value="ls" ' + (field_value === 'ls' ? 'selected' : '') + '>LS</option>';
                select_html += '<option value="off" ' + (field_value === 'off' ? 'selected' : '') + '>Off</option>';
                select_html += '<option value="cuti" ' + (field_value === 'cuti' ? 'selected' : '') + '>Cuti</option>';
                select_html += '</select>';
                $(this).html(select_html);
            });
            $(this).removeClass('edit-absen').addClass('save-edit-absen').text('Simpan');
        });

        $('body').on('click', '.save-edit-absen', function() {
            var absen_id = $(this).data('absen_id');
            var data = {
                _token: '{{ csrf_token() }}'
                , _method: 'PUT'
            };
            $(this).closest('tr').find('select').each(function() {
                data[$(this).data('field')] = $(this).val();
            });
            $.ajax({
                url: '/absen/' + absen_id
                , type: 'POST'
                , data: data
                , success: function(response) {
                    console.log(response);
                    $('.save-edit-absen').removeClass('save-edit-absen').addClass('edit-absen').text('Edit');
                }
                , error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });

</script>
@endsection

@push('scripts')
@endpush
