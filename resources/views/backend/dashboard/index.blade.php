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
                <div class="">
                    <h1 class="h3 text-gray-800">Dashboard</h1>
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

    </div>
    <!-- /.container-fluid -->
@endsection
