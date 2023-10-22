@extends('backend.layouts.master')

@section('title')
    Daftar Perumahan
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card-body bg-white mb-5 shadow-sm rounded">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h1 class="h3 text-gray-800">Daftar Perumahan</h1>
                </div>
                <div class="">
                    <a href="{{ route('admin.perumahan.form', 'create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Tambah Perumahan
                    </a>
                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Perumahan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Perumahan</th>
                                <th>Ditambahkan Pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($perumahan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ date('Y-m-d', strtotime($item->created_at)) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.perumahan.detail', ['id' => $item->id]) }}"
                                            class="btn btn-primary btn-sm" title="detail"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.perumahan.form', ['update', 'id' => $item->id]) }}"
                                            class="btn btn-warning btn-sm" title="update"><i class="fas fa-edit"></i></a>
                                        {{-- <a href="{{ route('admin.perumahan.delete', ['id' => $item->id]) }}"
                                            class="btn btn-danger btn-sm" title="delete"><i
                                                class="fas fa-trash-alt"></i></a> --}}
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
@endsection
