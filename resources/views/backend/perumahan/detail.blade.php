@extends('backend.layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card-body bg-white mb-5 shadow-sm rounded">
            <div class="d-flex justify-content-between">
                <div class="d-flex" style="align-items: center;">
                    <h1 class="h3 text-gray-800 mb-0">{{ $perumahan->name }}</h1>
                </div>
                <div class="">
                    <nav aria-label="breadcrumb ">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.perumahan') }}">Daftar Perumahan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Daftar Blok Perumahan
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <p class="w-50 text-justify">{{ $perumahan->address }}</p>
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
                <div class="d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary d-flex" style="align-items: center;">Daftar Blok Perumahan
                    </h6>
                    <div class="">
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#TambahBlokModal">
                            <i class="fas fa-plus-circle"></i> Tambah Blok Perumahan
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width: 70px;">No</th>
                                <th>Blok</th>
                                <th>No Rumah</th>
                                <th style="width: 100px;">Status</th>
                                <th style="width: 200px;">Ditambahkan Pada</th>
                                <th style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_perumahan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->no }}</td>
                                    <td class="text-center">
                                        @if ($status = checkHouseStatus($perumahan->id, $item->id))
                                            @if ($status->status == 0)
                                                <span class="badge badge-warning">Booking</span>
                                            @else
                                                <span class="badge badge-primary">Deal</span>
                                            @endif
                                        @else
                                            <span class="badge badge-success">Ready</span>
                                        @endif

                                    </td>
                                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                    <td class="text-center">
                                        <button type="button" data-id="{{ $item->id }}"
                                            class="btn btn-warning btn-sm update"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Create Modal-->
    <div class="modal fade" id="TambahBlokModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.perumahan.store.block', ['id' => $perumahan->id]) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Formulir Tambah Blok Perumahan</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="blok" class="col-sm-3 col-form-label">Blok</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="blok" value="{{ old('blok') }}"
                                    placeholder="Blok Perumahan" id="blok" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="noRumah" class="col-sm-3 col-form-label">No Rumah</label>
                            <div class="col-sm-9">
                                <input type="number" min="1" class="form-control" name="no_rumah"
                                    value="{{ old('no_rumah') }}" placeholder="No Perumahan" id="noRumah" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blok" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select name="status" class="custom-select custom-select-sm" required>
                                    <option selected>-- Pilih --</option>
                                    <option value="1">Ready</option>
                                    <option value="2">Booking</option>
                                    <option value="3">Deal</option>
                                </select>
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

    <!-- Create Modal-->
    <div class="modal fade" id="UpdateBlokModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="" id="formUpdate" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Formulir Tambah Blok Perumahan</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="blok" class="col-sm-3 col-form-label">Blok</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="blok" placeholder="Blok Perumahan"
                                    id="blokUpdate" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="noRumah" class="col-sm-3 col-form-label">No Rumah</label>
                            <div class="col-sm-9">
                                <input type="number" min="1" class="form-control" name="no_rumah"
                                    placeholder="No Perumahan" id="noRumahUpdate" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="blok" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select name="status" class="custom-select custom-select-sm" id="status" required>
                                    <option selected>-- Pilih --</option>
                                    <option value="1">Ready</option>
                                    <option value="2">Booking</option>
                                    <option value="3">Deal</option>
                                </select>
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
@endsection

@section('script')
    <script>
        $(document).on('click', '.update', function() {
            const idValue = $(this).attr('data-id');

            $.ajax({
                url: `{{ route('admin.perumahan.detail.block') }}?id=${idValue}`, // The URL to which the request is sent
                type: 'GET', // The request type (GET, POST, PUT, DELETE, etc.)
                dataType: 'json', // The data type expected from the server
                success: function(response) {
                    // Handle the successful response from the server
                    $('#UpdateBlokModal').modal('show')
                    $('#blokUpdate').val(response.name)
                    $('#noRumahUpdate').val(response.no)
                    $('#status').val(response.status == 'ready' ? 1 : (response.status == 'booking' ?
                        2 : 3))

                    $('#formUpdate').attr('action',
                        "{{ route('admin.perumahan.update.block', ['id' => '']) }}" + response.id);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle any errors that occur.
                    console.error('AJAX Error: ' + textStatus, errorThrown);
                }
            });
        })
    </script>
@endsection
