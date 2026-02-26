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
            <p class="text-center">
            Menaka Spa unfolds as a sanctuary of celestial calm, where every ritual is thoughtfully crafted to elevate the senses and restore inner harmony. Settled in infinitely blissful surroundings, the spa embodies a philosophy of nurturing transformation through delicately contemplated purifying rituals, inviting guests to surrender to treatments that are both indulgent and deeply healing. From aromatic scrubs and soothing baths to intuitive massages that melt tension and reawaken vitality, each touch is delivered with grace and intention. Within this tranquil haven, time slows, the mind softens, and the body is guided gently back to balance, allowing every guest to emerge renewed, radiant, and beautifully aligned in body, mind, and spirit.
            </p>
            
            <div class="center-slider m-md-5">
                @foreach ($sliderSpa->getMedia($mediaCollection) as $media)
                    <img src="{{ asset($media->getUrl()) }}" class="img-fluid ms-5 me-5">
                @endforeach
            </div>
            <div class="text-center my-4">
                <a href="{{ asset('pdf/treatment-menu.pdf') }}" target="_blank" rel="noopener noreferrer" class="btn btn-book-header px-4 py-3">Treatment Menu</a>
            </div>
            <p class="text-center mt-3 mb-0">
                To reserve your moment of tranquillity, please reach out to our Spa Therapists, who will graciously assist with every detail: <a href="mailto:menakaspa.prasana@arjaniresorts.com">menakaspa.prasana@arjaniresorts.com</a>.
            </p>
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
