@extends('layouts.app')
@section('meta_title', $settings->meta_title)
@section('meta_desc', $settings->meta_description)
@section('meta_keyword', $settings->meta_keyword)
@section('title', 'Experience - ')
@section('content')
    <style>
        .slick-dotted.slick-slider {
            margin-bottom: 30px;
            margin-left: 520px;
        }

        .slick-dots {
            display: none !important;
        }

        @media screen and (max-width: 480px) {
            .slick-dotted.slick-slider {
                margin-left: 0px;
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

    <div class="container welcome my-md-5">
        <div class="content-greeting py-5">
            <h3>Explore bali <br> whit Us</h3>
            <p class="pb-5">
                From majestic mountainscapes to beautiful coastlines, breathtaking <br>
                bali to explore and experience.
            </p>
        </div>
    </div>
    <div class="book-home">
        <div class="container">
            <div class="row pb-5 experience">
                @foreach ($data as $item)
                    <div class="col-md-4 item-slide-experiece">
                        <div class="position-relative">
                            <img src="{{ asset('/img/experience/' . $item->image) }}" alt="{{ $item->title }}"
                                class="img-fluid img-experience pe-5">
                            <div class="title-inner @php if(strlen($item->title) >= 11) {echo 'experience-large';} @endphp">
                                {!! $item->title !!}
                            </div>
                            <div class="loc-inner">
                                {!! $item->location !!}
                            </div>
                            <a href="{{ route('experience.detail', ['slug' => $item->slug]) }}" class="btn-experience">Read More <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
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
            $('.experience').slick({
                dots: true,
                slidesToShow: 2,
                // autoplay: true,
                // autoplaySpeed: 3000,
                responsive: [{
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
            });
        });
    </script>
@endpush
