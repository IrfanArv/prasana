@extends('layouts.app')
@section('meta_title', $settings->meta_title)
@section('meta_desc', $settings->meta_description)
@section('meta_keyword', $settings->meta_keyword)
@section('title', 'Gallery - ')
@section('content')

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

    <div class="container welcome mt-md-5">
        <div class="row">
            <div class="col-md-4 p-5 d-flex flex-grow-1 justify-content-center align-items-center">
                <div class="content-list">
                    <div class="title">
                        Gallery
                    </div>
                    <ul class="gallery mt-md-3">
                        <li> <button class="btn item-gallery shadow-none"> All</button></li>
                        @foreach ($gallery as $item)
                            <li> <button class="btn item-gallery shadow-none"> {{ $item->title }}</button></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-8 mb-5">
                <div class="slide-gallery">
                    @foreach ($slide->getMedia($mediaCollection) as $media)
                        <img src="{{ $media->getUrl() }}" class="img-fluid">
                    @endforeach
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
            $('.slide-gallery').slick({
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
