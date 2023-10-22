@extends('backend.layouts.master')

@section('title')
    Daftar Pengguna
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card-body bg-white mb-5 shadow-sm rounded d-flex justify-content-between">
            <div class="">
                <h1 class="h3 text-gray-800">Daftar Pengguna</h1>
            </div>
            <div class="">
                <a href="" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Tambah Pengguna
                </a>
            </div>
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
                                    <td class="text-center">
                                        <a href="" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
