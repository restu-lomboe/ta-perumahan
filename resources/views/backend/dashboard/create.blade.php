@extends('backend.layouts.master')

@section('title')
    Create
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card-body bg-white mb-5 shadow-sm rounded d-flex justify-content-between">
            <div class="d-flex" style="align-items: center;">
                <h1 class="h3 text-gray-800 mb-0">Tambah Perumahan Baru</h1>
            </div>
            <div class="">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb bg-transparent mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.perumahan') }}">Daftar Perumahan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Perumahan Baru</h6>
            </div>
            <div class="card-body">

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
