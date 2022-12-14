@extends('layouts.app')
@section('meta_title', $settings->meta_title)
@section('meta_desc', $settings->meta_description)
@section('meta_keyword', $settings->meta_keyword)
@section('title', 'Menaka Spa - ')
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
        @media screen and (max-width: 480px) {
            .slick-center {
                transform: none;
            }

            .slick-slide:not(.slick-active) {
                margin: 0px;
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

    <div class="container welcome my-md-5 text-center">
        <div class="content-greeting">
            <h3>Menaka Spa</h3>
            <p class="text-center">Settled in infinitely blissful surroundings, Menaka Spa is envisioned to nurture the
                celestial transformation
                through its delicately contemplated purifying rituals
            </p>
            <div class="center-slider m-md-5">
                @foreach ($sliderSpa->getMedia($mediaCollection) as $media)
                    <img src="{{ asset($media->getUrl()) }}" class="img-fluid ms-5 me-5">
                @endforeach
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
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 1
                    }
                }]
            });
        });
    </script>
@endpush
