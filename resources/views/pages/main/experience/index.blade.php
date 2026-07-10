@extends('layouts.app')
@section('meta_title', $settings->meta_title)
@section('meta_desc', $settings->meta_description)
@section('meta_keyword', $settings->meta_keyword)
@section('title', 'Experience - ')
@section('content')
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
            <img src="{{ asset('/img/scrol.svg') }}" alt="scrol"
                class="img-fluid animate__animated animate__bounceIn  animate__infinite animate__slower">
        </button>
    </div>

    <div class="container welcome my-md-5">
        <div class="content-greeting py-5">
            <h3>Experiences at Prasana Villas Uluwatu</h3>
            <p class="pb-5">
                t Prasana Villas Uluwatu, every moment is designed to feel meaningful, personal, and beautifully connected
                to the spirit of Bali. Our curated collection of experiences invites you to slow down, explore, and
                indulge—whether through immersive cultural encounters, refined culinary journeys, or serene wellness rituals
                set against Uluwatu’s dramatic natural landscape.
                From hands‑on Balinese cooking classes and golden‑hour degustation dinners at Whim Bar & Restaurant, to
                tranquil yoga sessions, sound‑healing ceremonies, and artisanal Petit Garçon dessert rituals, each
                experience is thoughtfully crafted to enrich your stay with authenticity and artistry.
                Venture beyond your villa to discover iconic beaches, world‑class surf breaks, clifftop temples, and
                exclusive nightlife partnerships, or retreat inward with private in‑villa dining, floating breakfasts, and
                bespoke romantic celebrations.
                Every experience at Prasana is an invitation—to connect, to savour, and to create unforgettable memories in
                one of Bali’s most captivating destinations.
            </p>
        </div>
    </div>

    <div class="container welcome my-md-5">
        <div class="row g-4">
            @foreach ($data as $item)
                <div class="col-md-6 col-sm-12 ">
                    <div class="products">
                        @if ($item->image)
                            <img src="{{ asset('/img/experience/' . $item->image) }}" alt="{{ $item->title }}"
                                class="img-fluid img-products">
                        @endif
                        <div class="content-greeting">
                            <h3 class="mt-3"> <a href="{{ route('experience.detail', ['slug' => $item->slug]) }}">
                                    {!! $item->title !!}</a></h3>

                            @if ($item->location)
                                <div class="mb-2 text-muted fw-bold" style="font-size: 0.9rem;">
                                    <i class="fas fa-map-marker-alt me-1"></i> {!! $item->location !!}
                                </div>
                            @endif

                            {!! Str::limit(strip_tags($item->description), 70) !!}

                            <div class="row mt-2">
                                <div class="col-md-6 d-flex justify-content-md-start justify-content-center p-0">
                                    <a href="{{ route('experience.detail', ['slug' => $item->slug]) }}"
                                        class="btn btn-full-info shadow-none">Full Info <i
                                            class="fas fa-chevron-right"></i></a>
                                </div>
                                <div
                                    class="col-md-6 d-flex justify-content-md-end justify-content-center my-md-0 my-3 p-0 pe-md-3">
                                    <a href="https://api.whatsapp.com/send?phone={{ $settings->wa_reciver }}&text=Hello%20Admin%20Prasana%20Resorts%20I%20would%20like%20to%20book%20a%20{!! Str::lower($item->title) !!}%20?"
                                        target="_blank" class="btn btn-book-header shadow-none me-3 px-4">Book</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
        });
    </script>
@endpush
