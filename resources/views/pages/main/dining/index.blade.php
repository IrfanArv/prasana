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
            margin: 20px 0;
        }

        .child {
            width: 100%;
        }

        .slide:not(.slick-active) {
            cursor: pointer;
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

            .modal-header {
                left: 0px !important;
                top: 20px !important;
            }
        }
    </style>
    <div class="main-sliders">
        <div class="sliders">
            @foreach ($mainSlider->getMedia($mediaCollection) as $media)
                <img src="{{ $media->getUrl() }}" class="img-fluid fit-slider" alt="{{ $mainSlider->title }}">
            @endforeach
        </div>
        <div class="slider-text-main">
            <p class="animate__animated animate__fadeInUp">{{ $mainSlider->title }}</p>
            <h1 class="animate__animated animate__fadeInLeft"> {!! $mainSlider->sub_title !!}</h1>
        </div>
        <button id="scrol" class="scrol-main btn btn-transparent shadow-none">
            <img src="{{ '/img/scrol.svg' }}" alt="scrol"
                class="img-fluid animate__animated animate__bounceIn  animate__infinite animate__slower">
        </button>
    </div>

    <div class="container welcome my-md-5 text-center">
        <div class="content-greeting">
            <h3>Whim</h3>
            <p class="text-center">
                You can enjoy a meal at Prasana serving the guests of Prasana Villa, or stop in at the snack bar/deli.
                Quench your thirst with your favorite drink at the bar/lounge. Cooked-to-order breakfasts are available
                daily from 7 AM to 1:00 PM for a free.
            </p>
            <button type="button" class="btn book-cope" data-bs-toggle="modal" data-bs-target="#modalchope">
                Reserve Table
            </button>
            <div class="center-slider m-md-5 mt-5">
                @foreach ($whim->getMedia($mediaCollection) as $media)
                    <img src="{{ $media->getUrl() }}" class="img-fluid ms-md-5 me-md-5">
                @endforeach
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 h-100 mt-5" id="petit">
        <div class="row">
            <div class="col-md-4">
                <div class="relative">
                    <img src="{{ '/img/mask.png' }}" class="img-absolute img-fluid p-3" alt="Petit Garçon">
                </div>
            </div>
            <div class="col-md-8 book-home p-5 d-flex flex-grow-1 justify-content-center align-items-center height-100">
                <div class="content-greeting ps-md-5 me-md-5">
                    <h3>Petit Garçon</h3>
                    <p class="me-md-5 pe-md-5">
                        We offer a relaxing and inviting atmosphere with high-end amazing desserts. <br>
                        <br>
                        Our desserts and pastries include seasonal fresh fruit , chocolate croissants, sticky buns, generous
                        cake slices, cheesecakes, and much more.
                        <br>
                        <br>
                        Experience by pushing the boundaries between sweet and savoury with progressive, carefully
                        researched offerings that are as delectable as they are beautiful
                    </p>
                    <a href="https://bookv5.chope.co/booking?rid=whim2208bal&source=rest_prasanabyarjaniresorts.com"
                        target="_blank" class="btn btn-book-header ms-0">Bar Menu</a>
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
        });
    </script>
@endpush
