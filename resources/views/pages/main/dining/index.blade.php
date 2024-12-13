@extends('layouts.app')
@section('meta_title', $settings->meta_title)
@section('meta_desc', $settings->meta_description)
@section('meta_keyword', $settings->meta_keyword)
@section('title', 'Dining - ')
@section('content')
    <style>
        .slick-center {
            transform: scale(1.09);
        }

        .slick-slide:not(.slick-active) {
            /*margin: 20px 0;*/
        }

        .child {
            width: 100%;
        }

        .slide:not(.slick-active) {
            cursor: pointer;
        }

        .slick-arrow {
            display: none !important;
        }

        .container-slide {
            position: absolute;
            top: 50%;
            right: -40px;
            padding-left: 80px;
            width: 100%;
            height: auto;
            -webkit-transform: translate(0, -50%);
            transform: translate(0, -50%);
        }

        .modal-header {
            border: none !important;
            position: relative !important;
            left: -100px;
            top: 45px;
            z-index: 999 !important;
        }

        @media screen and (max-width: 480px) {
            .slick-center {
                transform: none;
            }

            .slick-slide:not(.slick-active) {
                margin: 0px;
            }

            .container-slide {
                position: initial;
                padding: 50px 20px 20px 20px;
                -webkit-transform: none;
                transform: none;
            }

            .modal-header {
                left: 0px !important;
                top: 20px !important;
            }
        }
    </style>
    <div class="main-sliders">
        <div class="sliders">
            @foreach ($mainSlider->getMedia($mediaCollection) as $media)
                <img src="{{ asset($media->getUrl()) }}" class="img-fluid fit-slider" alt="{{ $mainSlider->title }}">
            @endforeach
        </div>
        <div class="slider-text-main">
            <p class="animate__animated animate__fadeInUp">{{ $mainSlider->title }}</p>
            <h1 class="animate__animated animate__fadeInLeft"> {!! $mainSlider->sub_title !!}</h1>
        </div>
        <button id="scrol" class="scrol-main btn btn-transparent shadow-none">
            <img src="{{ asset('/img/scrol.svg' )}}" alt="scrol"
                class="img-fluid animate__animated animate__bounceIn  animate__infinite animate__slower">
        </button>
    </div>
    <br />
    <div class="container welcome my-md-5 text-center">
        <div class="content-greeting">
            <h3 class="mb-3">@php echo $data[0]->title @endphp</h3>
            @php echo $data[0]->description @endphp
            {{-- <button type="button" class="btn book-cope" data-bs-toggle="modal" data-bs-target="#modalchope">
                Reserve Table
            </button> --}}
            <a href="@php echo $data[0]->url @endphp" target="_blank" class="btn btn-book-header mt-4 ms-0">Reserve Table</a>
            {{-- <div class="center-slider m-md-5 mt-5"> --}}
                {{-- @foreach ($whim->getMedia($mediaCollection) as $media) --}}
                    {{-- <img src="{{ asset('/img/dining/' . $data[0]->image) }}" class="img-fluid ms-md-5 me-md-5"> --}}
                {{-- @endforeach --}}
            {{-- </div> --}}
        </div>
    </div>
    <br />
    <div class="container-fluid p-0 h-100 mt-2" id="whim">
        <div class="slide-dining-1">
            @foreach ($data[0]->getMedia($mediaCollection) as $media)
                <img src="{{ asset($media->getUrl()) }}" class="img-fluid image-two-column">
            @endforeach
        </div>
    </div>
    <div class="container-fluid p-0 h-100" id="petit">
        <div class="row">
            <div class="col-md-4 relative">
                <div class="container-slide">
                    <div class="slide-dining-2">
                        @foreach ($data[1]->getMedia($mediaCollection) as $media)
                            <img src="{{ asset($media->getUrl()) }}" class="img-fluid">
                        @endforeach
                    </div>
                </div>
                {{-- <div class="relative">
                    <img src="{{ asset('/img/dining/' . $data[1]->image) }}" class="img-absolute img-fluid p-3" alt="Petit Garçon">
                </div> --}}
            </div>
            <div class="col-md-8 book-home p-5 d-flex flex-grow-1 justify-content-center align-items-center height-100">
                <div class="content-greeting ps-md-5 me-md-5">
                    <h3>@php echo $data[1]->title @endphp</h3>
                    @php echo $data[1]->description @endphp
                    <a href="@php echo $data[1]->url @endphp" target="_blank" class="btn btn-book-header ms-0">Bar Menu</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalchope" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-transparent">
                <div class="modal-header">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <iframe class="chope"
                        src="https://bookv5.chope.co/booking?rid=whim2208bal&source=rest_prasanabyarjaniresorts.com"
                        name="frame1" scrolling="auto" frameborder="no" align="center">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.sliders').slick({
                dots: false,
                infinite: true,
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 8000,
                arrow: false

            });
            $('.center-slider').slick({
                centerMode: true,
                centerPadding: '250px',
                slidesToShow: 1,
                infinite: true,
                arrows: true,
                dots: false,
                autoplay: true,
                autoplaySpeed: 3000,
                responsive: [{
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: false,
                        centerPadding: '0px',
                        slidesToShow: 1
                    }
                }]
            });
            $('.slide-dining-1').slick({
                infinite: true,
                dots: false,
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: false,
                arrow: false,
                responsive: [{
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
            });
            $('.slide-dining-2').slick({
                infinite: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrow: false,
                dots: true,
                autoplay: true,
                autoplaySpeed: 3000,

            });
        });
    </script>
@endpush
