@extends('backend.layouts.master')

@section('title')
    Report Pemesanan
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card-body bg-white mb-5 shadow-sm rounded">
            <div class="d-flex justify-content-between">
                <div class="d-flex" style="align-item: center;">
                    <h1 class="h3 text-gray-800 mb-0">Report Pemesanan</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pemesanan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.report.download') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-1">
                            <h5>Filter:</h5>
                        </div>
                        <div class="col-md-5">
                            <label for="perumahan" class="form-label">Pilih Perumahan</label>
                            <select name="perumahan" class="custom-select custom-select-sm" id="perumahan" required>
                                <option selected disabled>-- Pilih --</option>
                                @foreach ($perumahan as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="month" class="form-label">Pilih Perumahan</label>
                            <input type="month" class="form-control" name="month" id="month" required>
                        </div>
                        <div class="col-md-2 d-flex pt-4 mt-1" style="align-items: center;">
                            <button type="submit" class="btn btn-primary w-100">Download</button>
                        </div>
                    </div>
                </form>
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
                                        <img src="{{ asset('uploads/' . $item->payment) }}" width="100px" alt="">
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script></script>
@endsection
