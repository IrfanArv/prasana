@extends('layouts.app')
@section('meta_title', $settings->meta_title)
@section('meta_desc', $settings->meta_description)
@section('meta_keyword', $settings->meta_keyword)
@section('title', 'Weddings - ')
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
        <div class="row">
            @foreach ($data as $item)
                <div class="col-md-6 col-sm-12 mt-md-5 mt-md-3">
                    <div class="products">
                        @if ($item->image)
                            <img src="{{ asset('/img/products/' . $item->image) }}" alt="{{ $item->title }}"
                                class="img-fluid">
                        @endif
                        <div class="content-greeting">
                            <h3 class="mt-3"> <a href="{{ route('weddings.detail', ['slug' => $item->slug]) }}">
                                    {!! $item->title !!}</a></h3>
                            
                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-md-start justify-content-center p-0">
                                    <a href="{{ route('weddings.detail', ['slug' => $item->slug]) }}"
                                        class="btn btn-full-info shadow-none">Full Info <i
                                            class="fas fa-chevron-right"></i></a>
                                </div>
                                <div
                                    class="col-md-6 d-flex justify-content-md-end justify-content-center my-md-0 my-3 p-0 pe-md-3">
                                    @if ($item->send_to === 'email')
                                        <button type="button"
                                            class="btn btn-book-header shadow-none book-offer submitOffers"
                                            data-title="{!! $item->title !!}">
                                            Book Now
                                        </button>
                                    @else
                                        <a href="https://api.whatsapp.com/send?phone={{ $settings->wa_reciver }}&text=Hello%20Admin%20Prasana%20Resorts%20I%20would%20like%20to%20book%20a%20{!! Str::lower($item->title) !!}%20?"
                                            target="_blank"
                                            class="btn btn-book-header shadow-none me-3 d-none d-md-block">Book Now</a>
                                    @endif
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
