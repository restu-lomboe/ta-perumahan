@extends('backend.layouts.master')

@section('title')
    Perumahan {{ $type == 'create' ? 'Create' : 'Update' }}
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card-body bg-white mb-5 shadow-sm rounded d-flex justify-content-between">
            <div class="d-flex" style="align-items: center;">
                <h1 class="h3 text-gray-800 mb-0">{{ $type == 'create' ? 'Tambh' : 'Update' }} Perumahan
                    {{ $type == 'create' ? 'Baru' : $perumahan->name }}</h1>
            </div>
            <div class="">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb bg-transparent mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.perumahan') }}">Daftar Perumahan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $type == 'create' ? 'Tambah' : 'Update' }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Perumahan {{ $type == 'create' ? 'Baru' : 'Update' }}
                </h6>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <form
                    action="{{ route('admin.perumahan.' . ($type == 'create' ? 'store' : 'update'), $type == 'create' ? [] : ['id' => $perumahan->id]) }}"
                    method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama"
                                value="{{ $type == 'update' ? $perumahan->name : old('nama') }}"
                                placeholder="Nama Perumahan" id="nama" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="alamat" class="form-control" id="alamat" placeholder="Alamat Perumahan" cols="30"
                                rows="10" required>{{ $type == 'update' ? $perumahan->address : old('alamat') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <a href="{{ route('admin.perumahan') }}" class="btn btn-secondary mr-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
