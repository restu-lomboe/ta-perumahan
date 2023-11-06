@extends('frontend.layouts.master')

@section('css')
    <style>
        .list-block {
            border-right: 30px solid grey;
            border-left: 30px solid grey;
            border-bottom: 30px solid grey;
        }

        .block-card {
            /* width: fit-content; */
        }

        .block-card .block {
            /* width: 200px; */
            /* height: 80px;
                                                                        display: flex;
                                                                        justify-content: center;
                                                                        align-items: center; */
        }

        .divider-vertical {
            margin: 20px;
        }
    </style>
@endsection

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
                <img src="https://img.freepik.com/free-photo/luxury-pool-villa-spectacular-contemporary-design-digital-art-real-estate-home-house-property-ge_1258-150749.jpg?w=1060&t=st=1698236909~exp=1698237509~hmac=31911ef40eba454050c61429b05fb5cf25fd167ee50ed6c210f32dbcd7baafe7"
                    alt="">

                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1>Example headline.</h1>
                        <p>Some representative placeholder content for the first slide of the carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://img.freepik.com/free-photo/luxury-pool-villa-spectacular-contemporary-design-digital-art-real-estate-home-house-property-ge_1258-150749.jpg?w=1060&t=st=1698236909~exp=1698237509~hmac=31911ef40eba454050c61429b05fb5cf25fd167ee50ed6c210f32dbcd7baafe7"
                    alt="">

                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1>Example headline.</h1>
                        <p>Some representative placeholder content for the first slide of the carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://img.freepik.com/free-photo/luxury-pool-villa-spectacular-contemporary-design-digital-art-real-estate-home-house-property-ge_1258-150749.jpg?w=1060&t=st=1698236909~exp=1698237509~hmac=31911ef40eba454050c61429b05fb5cf25fd167ee50ed6c210f32dbcd7baafe7"
                    alt="">

                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1>Example headline.</h1>
                        <p>Some representative placeholder content for the first slide of the carousel.</p>
                        <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
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

    <div class="container marketing">
        <h1 class="text-center mb-5">Daftar Blok {{ $house->name }}</h1>

        <div class="list-block mb-5 px-5 pb-5">

            <div class="row">
                @php
                    $total_ready = 0;
                    $total_booking = 0;
                    $total_deal = 0;
                @endphp
                @foreach ($house->blocks as $item)
                    @php
                        $color = '';
                        if (checkHouseStatus($house->id, $item->id)) {
                            if (checkHouseStatus($house->id, $item->id)->status == 7) {
                                $color = 'bg-secondary';
                                $total_ready++;
                            } elseif (checkHouseStatus($house->id, $item->id)->status == 6) {
                                $color = 'bg-success';
                                $total_deal++;
                            } else {
                                $color = 'bg-warning';
                                $total_booking++;
                            }
                        } else {
                            if ($item->status == 'booking') {
                                $color = 'bg-warning';
                                $total_booking++;
                            } elseif ($item->status == 'ready') {
                                $color = 'bg-secondary';
                                $total_ready++;
                            } else {
                                $color = 'bg-success';
                                $total_deal++;
                            }
                        }
                    @endphp
                    <div class="col-md-2 mb-3 @if ($loop->iteration % 2 == 0) pl-0 @else pr-0 @endif">
                        <div class="block-card text-center">
                            <div class="block border p-2 {{ $color }}">
                                <h1 class="mb-0 text-white">{{ $item->name }}-{{ $item->no }}</h1>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <div class="block-card text-left">
                    <div class="block border pl-3 p-2 bg-success">
                        <h4 class="mb-0 text-white d-flex justify-content-between">
                            <span>Terjual:</span>
                            <span>{{ $total_deal }}</span>
                        </h4>
                    </div>
                    <div class="block border pl-3 p-2 bg-warning">
                        <h4 class="mb-0 text-white d-flex justify-content-between">
                            <span>Booking:</span>
                            <span>{{ $total_booking }}</span>
                        </h4>
                    </div>
                    <div class="block border pl-3 p-2 bg-secondary">
                        <h4 class="mb-0 text-white d-flex justify-content-between">
                            <span>Ready:</span>
                            <span>{{ $total_ready }}</span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block-card text-left">
                    <div class="block border pl-3 p-2 bg-secondary">
                        <h4 class="mb-0 text-white d-flex justify-content-between">
                            <span>Total Block:</span>
                            <span>{{ $house->blocks->count() }}</span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <hr class="featurette-divider mt-3">
        <!-- /END THE FEATURETTES -->
    </div><!-- /.container -->
@endsection
