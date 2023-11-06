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
       
    </div>


    <!-- Marketing messaging and featurettes
                                                                                                                                                                                                                ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
        <h1 class="text-center mb-5">Daftar Blok {{ $house->name }}</h1>

        <div class="list-block mb-5 px-5 pb-5">

            <div class="row">
                {{-- @for ($i = 1; $i < 20; $i++)
                    <div class="col-md-1 mb-3 {{ $i }} @if ($i % 2 == 0) pl-0 @else pr-0 @endif">
                        <div class="block-card text-center">
                            <div class="block border p-2 bg-secondary">
                                <h1 class="mb-0 text-white">A</h1>
                            </div>
                            <div class="block border p-2 bg-secondary">
                                <h1 class="mb-0 text-white">{{ $i < 10 ? '0' . $i : $i }}</h1>
                            </div>
                        </div>
                    </div>
                @endfor --}}
                @foreach ($house->blocks as $item)
                    <div class="col-md-2 mb-3 @if ($loop->iteration % 2 == 0) pl-0 @else pr-0 @endif">
                        <div class="block-card text-center">
                            <div
                                class="block border p-5 {{ checkHouseStatus($house->id, $item->id) ? (checkHouseStatus($house->id, $item->id)->status == 0 ? 'bg-warning' : 'bg-success') : 'bg-secondary' }}">
                                <h6 class="mb-0 text-white">{{ $item->name }}-{{ $item->no }}</h6>
                            </div>
                            {{-- <div
                                class="block border p-5 {{ checkHouseStatus($house->id, $item->id) ? (checkHouseStatus($house->id, $item->id)->status == 0 ? 'bg-warning' : 'bg-success') : 'bg-secondary' }}">
                                <h6 class="mb-0 text-white">{{ $item->no }}</h6>
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- <div class="block-card text-center">
                <div class="block border p-2 bg-secondary"> 
                    <h1 class="mb-0 text-white">A</h1>
                </div>
                <div class="block border p-2 bg-secondary">
                    <h1 class="mb-0 text-white">01</h1>
                </div>
            </div>
            <div class="block-card text-center">
                <div class="block border p-2 bg-secondary">
                    <h1 class="mb-0 text-white">A</h1>
                </div>
                <div class="block border p-2 bg-secondary">
                    <h1 class="mb-0 text-white">02</h1>
                </div>
            </div>
            <div class="divider-vertical"></div> --}}
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="block-card text-center">
                <div
                    class="block border p-1 bg-success">
                    <h4 class="mb-0 text-white"> Terjual</h4>
                </div>
                <div
                    class="block border p-1 bg-warning">
                    <h4 class="mb-0 text-white"> Booking Fee</h4>
                </div>
                <div
                    class="block border p-1 bg-secondary">
                    <h4 class="mb-0 text-white"> Ready</h4>
                </div>
                
            </div>
        </div>



        <hr class="featurette-divider mt-3">
        <!-- /END THE FEATURETTES -->
    </div><!-- /.container -->
@endsection
