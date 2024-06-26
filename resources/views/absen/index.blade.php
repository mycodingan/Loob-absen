@extends('layout.app')

@section('content')
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-footer .btn {
        padding: 10px 24px;
        background-color: #337ab7;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .modal-footer .btn-secondary {
        background-color: #aaa;
    }

    table {
        width: 100%;
    }

    th,
    td {
        padding: 2px;
        text-align: left;
    }

    tbody tr:nth-child(even) {
        background-color: #66768a;
        color: white;
        border-color: black;
    }

    tbody tr:nth-child(odd) {
        background-color: #dcdde1;
    }

    @media screen and (max-width: 600px) {
        table {
            border: 0;
        }

        table thead {
            display: none;
        }

        table tr {
            margin-bottom: 10px;
            display: block;
            border-bottom: 2px solid #ccc;
        }

        table td {
            display: block;
            text-align: right;
            font-size: 13px;
        }

        table td::before {
            content: attr(data-label);
            float: left;
            font-weight: bold;
        }
    }

</style>
<div class=" container-fluid">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Import Data Absen</div>

                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                        <form id="searchForm" action="{{ route('absen.index') }}" method="GET">
                            <div class="form-group mr-2">
                                <label for="search_branch" class="mr-2">Cabang :</label>
                                <select id="search_branch" name="search_branch" class="form-control" onchange="submitForm()">
                                    <option value="">All Branches</option>
                                    @foreach($branches as $branch)
                                    <option value="{{ $branch }}" @if($branch==$searchBranch) selected @endif>{{ $branch }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <button type="button" class="btn btn-primary" id="importBtn">Import Data</button>
                        <a href="{{ route('absen.export') }}" class="btn btn-primary">export </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Data Absen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="importForm" action="{{ route('absen.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="file">Pilih File Excel:</label>
                            <input type="file" class="form-control-file" id="file" name="file">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" form="importForm" class="btn btn-primary">Import Data</button>
                </div>
            </div>
        </div>
    </div>
    <div class=" container-fluid">
        <div class=" w-100">
            <div class="card w-100">
                <div class="card-header w-100">Absen</div>
                <div class="card-body w-100">
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    {{-- <th>Edit</th> --}}
                                    <th>No Absen</th>
                                    <th>Nama Karyawan</th>
                                    <th>Cabang</th>
                                    <th>Posisi Jabatan</th>
                                    @for ($i = 1; $i <= $daysInMonth; $i++) <th>Hari {{ $i }}</th>
                                        @endfor
                                        <th>Shift 1</th>
                                        <th>Shift 2</th>
                                        <th>Shift ls</th>
                                        <th> 1 (jm)</th>
                                        <th> 2 (jm)</th>
                                        <th> ls (jm)</th>
                                        <th>Total (JT)</th>
                                        <th>Tahun</th>
                                        <th>Bulan</th>
                                        <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absen as $data)
                                <tr>
                                    {{-- <td>
                                        <p type="button" class="btn btn-transparent btn-outline-warning" onclick="edit_data('{{ $data->id }}', '{{ $data->Nama_Karyawan }}','{{ $data->cabang }}','{{ $data->posisi_jabatan }}')">📝</p>
                                    </td> --}}
                                    <td>{{ $data->No_absen }}</td>
                                    <td onclick="edit_data('{{ $data->id }}', '{{ $data->Nama_Karyawan }}','{{ $data->cabang }}','{{ $data->posisi_jabatan }}')">{{ $data->Nama_Karyawan }}</td>
                                    <td onclick="edit_data('{{ $data->id }}', '{{ $data->Nama_Karyawan }}','{{ $data->cabang }}','{{ $data->posisi_jabatan }}')"{{ $data->Nama_Karyawan }}>{{ $data->cabang }}</td>
                                    <td onclick="edit_data('{{ $data->id }}', '{{ $data->Nama_Karyawan }}','{{ $data->cabang }}','{{ $data->posisi_jabatan }}')"{{ $data->Nama_Karyawan }}>{{ $data->posisi_jabatan }}</td>
                                    @php
                                    $total_shift_1 = null;
                                    $total_shift_2 = null;
                                    $total_shift_ls = null;
                                    @endphp
                                    @for ($i = 1; $i <= $daysInMonth; $i++) <td class="editable" data-absen-id="{{ $data->id }}" data-day="{{ $i }}">
                                        @php
                                        if ($data->{'hari' . $i} == 1) {
                                        $total_shift_1++;
                                        }
                                        if ($data->{'hari' . $i} == 2) {
                                        $total_shift_2++;
                                        }
                                        if ($data->{'hari' . $i} == 'ls') {
                                        $total_shift_ls++;
                                        }
                                        @endphp
                                        <span>{{ $data->{'hari' . $i} }}</span>
                                        </td>
                                        @endfor
                                        <td>{{ $total_shift_1 }}</td>
                                        <td>{{ $total_shift_2 }}</td>
                                        <td>{{ $total_shift_ls }}</td>
                                        <td id="total_shift_1_jt">{{ $total_shift_1 * 7 }}</td>
                                        <td id="total_shift_2_jt">{{ $total_shift_2 * 7 }}</td>
                                        <td id="total_shift_ls">{{ $total_shift_ls * 8 }}</td>
                                        <td id="total_jt">{{ ($total_shift_1 * 7) + ($total_shift_2 * 7) + ($total_shift_ls * 8) }}</td>
                                        <td>{{ $data->tahun }}</td>
                                        <td>{{ $data->Bulan }}</td>
                                        <td>
                                            <form action="{{ route('absen.destroy', $data->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                                            </form>
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
                                            <td><input type="text" name="tahun" value="{{ \Carbon\Carbon::now()->year }}"></td>
                                            <td><input type="text" name="Bulan" value="{{ \Carbon\Carbon::now()->month }}"></td>
                                            <td><button type="submit" class="btn btn-primary">Tambah Data</button></td>
                                    </form>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        {{ $absen->links() }}
    </div>
</div>
{{-- Modal untuk edit data --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                        <input type="hidden" class="form-control" id="edit_id_Karyawan" name="ID_Karyawan" value="" required>

                    <div class="form-group">
                        <label for="edit_Nama_Karyawan">Nama Karyawan</label>
                        <input type="text" class="form-control" id="edit_Nama_Karyawan" name="Nama_Karyawan" value="" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_cabang">Cabang</label>
                        <input type="text" class="form-control" id="edit_cabang" name="cabang" value="" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_posisi_jabatan">Posisi Jabatan</label>
                        <input type="text" class="form-control" id="edit_posisi_jabatan" name="posisi_jabatan" value="" required>
                    </div>

                    <div class="modal-footer">
                        <p style="color: #888"><small>silahkan clik enter untuk mengubah data yang sudah di perbarui mupun belum</small></p>
                        <button id="hillang" type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>

    //untuk melakukan sebuah edit data pada modal  | menggunakan sebuah ajaxa
$(document).ready(function() {
    $('#editForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var absen_id = $('#edit_id_Karyawan').val();
        var url = '{{ route('absen.index') }}/' + absen_id;
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            success: function(response) {
                console.log(response);
                location.reload(true);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
});
//untuk perintah di bawah ini saya membuat nya untuk menghilan kan button update data
document.getElementById("hillang").style.display = "none";
// syntax di bawah init sebuk code ajaxjyang di gunakan untuk  menerima data saat proses update
function edit_data(id, Nama_Karyawan, cabang, posisi_jabatan) {
    $('#edit_id').val(id);
    $('#edit_id_Karyawan').val(id);
    $('#edit_Nama_Karyawan').val(Nama_Karyawan);
    $('#edit_cabang').val(cabang);
    $('#edit_posisi_jabatan').val(posisi_jabatan);
    $('#exampleModal').modal('show');
}
//script dibawah ini saya gunakan untk modal yang terdapat pada import data dari excel
    document.addEventListener('DOMContentLoaded', function() {
        var importBtn = document.getElementById('importBtn');
        var importModal = document.getElementById('importModal');
        var closeBtn = document.querySelector('.close');

        importBtn.addEventListener('click', function() {
            importModal.style.display = 'block';
        });

        closeBtn.addEventListener('click', function() {
            importModal.style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target == importModal) {
                importModal.style.display = 'none';
            }
        });
    });


    //code ini di gunakan untuk  agar saat kita melakukan sebuah searchcing bisa langsung searc tampa harus menggunkan button untuk me refresh
    function submitForm() {
        document.getElementById("searchForm").submit();
    }
    //jika code yang ini saya gunakan untuk membuat sebua pemasukan data pada colom hari ini sebenar nya sebuah edit dengan saya ubah tipedata hari menjadi nulable
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
            selectOptions += '</select>';

            $editable.empty().append(selectOptions);
            $editable.find('select').val(currentValue);
            $editable.find('select').val(currentValue);

            $editable.find('select').change(function() {
                var selectedValue = $(this).val();
                $.ajax({
                    url: '{{ route('absen.index') }}/' + absen_id
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
    //ini systax java script untuk melakuan search data yang sudah ada utnuk mempermudah pencarian pada setiap cabang
    document.getElementById('searchQuery').addEventListener('change', function() {
        var query = this.value;
        if (query.trim() !== '') {
            var formData = new FormData();
            formData.append('query', query);
            fetch('{{ route("absen.search") }}', {
                    method: 'GET'
                    , body: formData
                })
                .then(response => response.text())
                .then(data => {
                    document.open();
                    document.write(data);
                    document.close();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });



</script>

@endsection
