@extends('frontend.layouts.master')

@section('content')
    <!-- carousel -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/bg-kantor.jpg') }}"
                    alt="">

                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1>PT. PRIMA INTI NUSA</h1>
                        <p>Jl. Flamboyan I Komplek Taman Asoka Asri Blok B-3B Medan 20134.</p>
                        <p><a class="btn btn-lg btn-primary" href="{{ route('register') }}">Sign up today</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/bg-rumah.jpg') }}"
                    alt="">

                <div class="container">
                    <div class="carousel-caption text-left">
                    <h1>PT. PRIMA INTI NUSA</h1>
                        <p>Jl. Flamboyan I Komplek Taman Asoka Asri Blok B-3B Medan 20134.</p>
                        <p><a class="btn btn-lg btn-primary" href="{{ route('register') }}">Sign up today</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('assets/img/bg-rumah1.jpg') }}"
                    alt="">

                <div class="container">
                    <div class="carousel-caption text-left">
                    <h1>PT. PRIMA INTI NUSA</h1>
                        <p>Jl. Flamboyan I Komplek Taman Asoka Asri Blok B-3B Medan 20134.</p>
                        <p><a class="btn btn-lg btn-primary" href="{{ route('register') }}">Sign up today</a></p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-target="#myCarousel" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#myCarousel" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </button>
    </div>


    <!-- Marketing messaging and featurettes
                                                                                                                    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing" id="marketing">
        <h1 class="text-center mb-5">Daftar Perumahan</h1>
        <!-- Three columns of text below the carousel -->
        <div class="d-flex justify-content-around">
            @foreach ($houses as $house)
                <div class="card border-0 text-center" style="width: 300px">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/img/rumah1.jpg') }}"
                            width="200px" height="200px" class="rounded-circle border" alt="{{ $house->name }}" style="object-fit: cover;">
                    </div>

                    <h4>{{ $house->name }}</h4>
                    <p>{{ $house->address }}</p>
                    <h3>Rp. {{number_format($house->price,0,',','.')  }}</h3>
                    <p><a class="btn btn-primary" href="{{ route('perumahan.detail', encryptId($house->id)) }}">View details
                            &raquo;</a></p>
                </div>
            @endforeach
        </div>
        <hr>

        <div class="row featurette" id="about">
            <div class="col-md-12">
                <h2 class="featurette-heading">VISI MISI</h2>
                <ol>
                    <li>Visi</li>
                    Menjadi perusahaan pengembang (developer) properti terbaik dan terpercaya yang mampu bersaing di tingkat nasional sesuai dengan kelasnya.
                    <li>Misi</li>
                        <ul>
                            <li>Memberikan pelayanan terbaik dan membuat produk yang berkualitas, lingkungan yang nyaman, aman dan sehat.</li>
                            <li>Membangun manajemen perusahaan yang profesional serta menjaga kesinambungan pertumbuhan perusahaan.</li>
                            <li>Menjalin hubungan kerja sama dengan mitra usaha yang saling menguntungkan dan  berkelanjutan.</li>
                            <li>Memaksimalkan potensi setiap properti yang dikembangkan melalui pengembangan terintegrasi untuk memberi nilai tambah yang tinggi.</li>
                            <li>Menciptakan lingkungan kerja yang profesional dan meningkatkan produktivitas perusahaan.</li>
                        </ul>
                </ol>
                
                <ol>
                    
                </ol>
                
            </div>
        
        </div>
        <hr class="featurette-divider">

    </div><!-- /.container -->
@endsection
