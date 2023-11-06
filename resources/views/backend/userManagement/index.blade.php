@extends('backend.layouts.master')

@section('title')
    Daftar Pengguna
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card-body bg-white mb-5 shadow-sm rounded">
            <div class="d-flex justify-content-between">
                <div class="d-flex" style="align-item: center">
                    <h1 class="h3 text-gray-800 mb-0">Daftar Pengguna</h1>
                </div>
                <div class="">
                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#TambahPenggunaModal">
                        <i class="fas fa-plus-circle"></i> Tambah Pengguna
                    </a>
                </div>
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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Didaftarkan Pada</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ date('Y-m-d', strtotime($user->created_at)) }}</td>
                                    <td>
                                        @if ($user->role_id == 1)
                                            <span class="badge badge-warning">Admin</span>
                                        @elseif ($user->role_id == 2)
                                            <span class="badge badge-primary">Pimpinan</span>
                                        @else
                                            <span class="badge badge-success">User</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:" class="btn btn-warning btn-sm update"
                                            data-id="{{ $user->id }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Create Modal-->
    <div class="modal fade" id="TambahPenggunaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('admin.usermanagement.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Formulir Penambahan User</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-4 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="phone" id="phone" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" id="password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="passwordConfirmation" class="col-sm-4 col-form-label">Password Confirmation</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="passwordConfirmation" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <select name="role" class="custom-select custom-select-sm role" id="role" required>
                                    <option selected disabled>-- Pilih --</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Pimpinan</option>
                                    <option value="3">User</option>
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

    <!-- update Modal-->
    <div class="modal fade" id="UpdatePenggunaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form id="formUpdate" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Formulir Update User</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="nameUpdate" class="col-sm-4 col-form-label">Nama</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nameUpdate" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="emailUpdate" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="email" id="emailUpdate" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phoneUpdate" class="col-sm-4 col-form-label">Phone Number</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="phone" id="phoneUpdate" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="passwordUpdate" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password" id="passwordUpdate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="passwordConfirmationUpdate" class="col-sm-4 col-form-label">Password
                                Confirmation</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" name="password_confirmation"
                                    id="passwordConfirmationUpdate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="roleUpdate" class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <select name="role" class="custom-select custom-select-sm role" id="roleUpdate"
                                    required>
                                    <option selected disabled>-- Pilih --</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Pimpinan</option>
                                    <option value="3">User</option>
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
            $('#UpdatePenggunaModal').modal('show');
            $.ajax({
                url: `{{ route('admin.usermanagement.detail.json') }}?id=${idValue}`, // The URL to which the request is sent
                type: 'GET', // The request type (GET, POST, PUT, DELETE, etc.)
                dataType: 'json', // The data type expected from the server
                success: function(response) {
                    // Handle the successful response from the server.
                    $('#nameUpdate').val(response.name);
                    $('#emailUpdate').val(response.email);
                    $('#phoneUpdate').val(response.phone);
                    $('#roleUpdate').val(response.role_id);

                    $('#formUpdate').attr('action',
                        "{{ route('admin.usermanagement.update') }}?id=" + idValue)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle any errors that occur.
                    console.error('AJAX Error: ' + textStatus, errorThrown);
                }
            });
        })
    </script>
@endsection
