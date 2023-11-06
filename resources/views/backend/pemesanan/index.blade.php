@extends('backend.layouts.master')

@section('title')
    Daftar Pemesanan
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card-body bg-white mb-5 shadow-sm rounded">
            <div class="d-flex justify-content-between">
                <div class="d-flex" style="align-item: center;">
                    <h1 class="h3 text-gray-800 mb-0">Daftar Pemesanan</h1>
                </div>
                @if (auth()->user()->role_id == 3)
                    @if ($bookings->isEmpty())
                        <div class="">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#TambahPemesananModal">
                                <i class="fas fa-plus-circle"></i> Tambah Pemesanan
                            </a>
                        </div>
                    @endif
                @else
                    <div class="">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#TambahPemesananModal">
                            <i class="fas fa-plus-circle"></i> Tambah Pemesanan
                        </a>
                    </div>
                @endif

            </div>
            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mt-3">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pemesanan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pemesan</th>
                                <th>Nama Perumahan</th>
                                <th>Blok dan No Rumah</th>
                                <th>Pembayaran</th>
                                <th>Pemesanan Pada</th>
                                <th>Status</th>
                                <th>Note</th>
                                @if (auth()->user()->role_id == 1)
                                    <th>Aksi</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->perumahan->name }}</td>
                                    <td>{{ $item->perumahanBlok->name }} - {{ $item->perumahanBlok->no }}</td>
                                    <td>
                                        <a href="javascript:;" class="viewImage"
                                            data-src="{{ asset('uploads/' . $item->payment) }}">
                                            <img src="{{ asset('uploads/' . $item->payment) }}" width="100px"
                                                alt="">
                                        </a>
                                    </td>
                                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                    <td>
                                        @switch($item->status)
                                            @case(0)
                                                <span class="badge badge-warning">Booking</span>
                                            @break

                                            @case(1)
                                                <span class="badge badge-warning">Masuk Berkas</span>
                                            @break

                                            @case(2)
                                                <span class="badge badge-warning">Wawancara</span>
                                            @break

                                            @case(3)
                                                <span class="badge badge-warning">Survey</span>
                                            @break

                                            @case(4)
                                                <span class="badge badge-warning">SP3K</span>
                                            @break

                                            @case(5)
                                                <span class="badge badge-warning">BTN + Notaris</span>
                                            @break

                                            @case(6)
                                                <span class="badge badge-success">Akad</span>
                                            @break

                                            @case(7)
                                                <span class="badge badge-danger">Gagal</span>
                                            @break

                                            <span class="badge badge-warning">Booking</span>

                                            @default
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($item->status)
                                            @case(0)
                                                <span class="text-danger">silahkan tunggu 1x24 jam untuk proses
                                                    selanjutnya</span>
                                            @break

                                            @case(1)
                                                <span class="text-danger">silahkan antar berkas berikut ke kantor Prima Inti
                                                    nusa di Jl. Flamboyan I Komplek Taman Asoka Asri Blok
                                                    B-3B Medan 20134</span>
                                            @break

                                            @case(2)
                                                <span class="text-danger">Silahkan Datang Ke Kantor untuk proses wawancara</span>
                                            @break

                                            @case(3)
                                                <span class="text-danger">-</span>
                                            @break

                                            @case(4)
                                                <span class="text-danger">Silahkan Datang Ke Kantor untuk proses SP3K</span>
                                            @break

                                            @case(5)
                                                <span class="text-danger">Silahkan Datang Ke Kantor untuk proses BTN +
                                                    Notaris</span>
                                            @break

                                            @case(6)
                                                <span class="text-success">Silahkan Datang Ke Kantor untuk mengambil kunci</span>
                                            @break

                                            @case(7)
                                                <span class="text-danger">Pemesanan Gagal</span>
                                            @break

                                            <span class="text-danger"></span>

                                            @default
                                        @endswitch
                                    </td>
                                    @if (auth()->user()->role_id == 1)
                                        <td class="text-center">
                                            <a href="javascript:" class="btn btn-warning btn-sm update"
                                                data-id="{{ $item->id }}" title="update"><i
                                                    class="fas fa-edit"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal-->
    <div class="modal fade" id="TambahPemesananModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('admin.pemesanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Formulir Pemesanan</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (auth()->user()->role_id != 3)
                            <div class="form-group row">
                                <label for="sales" class="col-sm-4 col-form-label">Nama Pemesan</label>
                                <div class="col-sm-8">
                                    <select name="sales" class="custom-select custom-select-sm" id="sales" required>
                                        <option selected disabled>-- Pilih --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="noRumah" class="col-sm-4 col-form-label">Perumahan</label>
                            <div class="col-sm-8">
                                <select name="perumahan_id" class="custom-select custom-select-sm selectPerumahan"
                                    id="perumahan" required>
                                    <option selected disabled>-- Pilih --</option>
                                    @foreach ($perumahan as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blok" class="col-sm-4 col-form-label">Blok dan No Rumah</label>
                            <div class="col-sm-8">
                                <select name="blok_id" class="custom-select custom-select-sm blokNumber" id="blokNo"
                                    required>
                                    <option selected disabled>-- Pilih --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pembayaran" class="col-sm-4 col-form-label">Bukti Pembayaran Booking Fee</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" name="pembayaran" id="pembayaran" required>
                                <small>Note: Silahkan Transfer Pembayaran Booking Fee Melalui Rekening BTN dengan Nomor 00003-01-30-000801-5 Atas Nama PT. Prima Inti Nusa</small>
                                <br>
                                <small>Nominal Pembayaran Booking Fee Rp 2.000.000</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Modal-->
    <div class="modal fade" id="updatePemesananModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="formUpdate" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Formulir Update Pemesanan</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (auth()->user()->role_id != 3)
                            <div class="form-group row">
                                <label for="salesUpdate" class="col-sm-4 col-form-label">Nama Pemesan</label>
                                <div class="col-sm-8">
                                    <select name="sales" class="custom-select custom-select-sm" id="salesUpdate"
                                        required>
                                        <option selected disabled>-- Pilih --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="perumahanUpdate" class="col-sm-4 col-form-label">Perumahan</label>
                            <div class="col-sm-8">
                                <select name="perumahan_id" class="custom-select custom-select-sm selectPerumahan"
                                    id="perumahanUpdate" required>
                                    <option selected disabled>-- Pilih --</option>
                                    @foreach ($perumahan as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blokNoUpdate" class="col-sm-4 col-form-label">Blok dan No Rumah</label>
                            <div class="col-sm-8">
                                <select name="blok_id" class="custom-select custom-select-sm blokNumber"
                                    id="blokNoUpdate" required>
                                    <option selected disabled>-- Pilih --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pembayaran" class="col-sm-4 col-form-label">Bukti Pembayaran Booking Fee</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" name="pembayaran" id="pembayaran">
                                <small>Note: Silahkan lakukan pembayaran ke no rekening berikut 0122224455</small>
                                <br>
                                <small>Minimal Pembayaran Booking Fee Rp 2.000.000</small>
                            </div>
                        </div>
                        @if (auth()->user()->role_id != 3)
                            <div class="form-group row">
                                <label for="blok" class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    <select name="status" class="custom-select custom-select-sm" id="status"
                                        required>
                                        <option selected disabled>-- Pilih --</option>
                                        <option value="0">Booking</option>
                                        <option value="1">Masuk Berkas</option>
                                        <option value="2">Wawancara</option>
                                        <option value="3">Survey</option>
                                        <option value="4">SP3K</option>
                                        <option value="5">BTN + Notaris</option>
                                        <option value="6">Akad</option>
                                        <option value="7">Gagal</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ciew image -->
    <div class="modal fade" id="viewImageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" class="modal-img" width="100%">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('change', '.selectPerumahan', function() {
            const idValue = $(this).val();
            $.ajax({
                url: `{{ route('admin.perumahan.detail.json') }}?id=${idValue}`, // The URL to which the request is sent
                type: 'GET', // The request type (GET, POST, PUT, DELETE, etc.)
                dataType: 'json', // The data type expected from the server
                success: function(response) {
                    // Handle the successful response from the server.
                    var options = '<option selected>-- Pilih --</option>';
                    $.each(response, function(index, option) {
                        options += '<option value="' + option.id + '">' + option.name + '-' +
                            option.no + '</option>';
                    });
                    $('.blokNumber').html(options);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle any errors that occur.
                    console.error('AJAX Error: ' + textStatus, errorThrown);
                }
            });
        })

        $(document).on('click', '.update', function() {
            const idValue = $(this).attr('data-id');
            $('#updatePemesananModal').modal('show');
            $.ajax({
                url: `{{ route('admin.pemesanan.detail.json') }}?id=${idValue}`, // The URL to which the request is sent
                type: 'GET', // The request type (GET, POST, PUT, DELETE, etc.)
                dataType: 'json', // The data type expected from the server
                success: function(response) {
                    // Handle the successful response from the server.
                    $('#perumahanUpdate').val(response.house_id)
                    $('#blokNoUpdate').html('<option value="' + response.house_block_id + '">' +
                        response.perumahan_blok.name + ' - ' + response.perumahan_blok.no +
                        '</option>')

                    $('#status').val(response.status);
                    $('#salesUpdate').val(response.user_id);

                    $('#formUpdate').attr('action',
                        "{{ route('admin.pemesanan.update') }}?id=" + idValue)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle any errors that occur.
                    console.error('AJAX Error: ' + textStatus, errorThrown);
                }
            });
        })

        $(document).on('click', '.viewImage', function() {
            const imageUrl = $(this).attr('data-src')
            $('#viewImageModal').modal('show')
            $('.modal-img').attr('src', imageUrl)
        })
    </script>
@endsection
