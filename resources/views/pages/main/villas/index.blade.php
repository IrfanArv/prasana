@extends('layouts.app')
@section('meta_title', $settings->meta_title)
@section('meta_desc', $settings->meta_description)
@section('meta_keyword', $settings->meta_keyword)
@section('title', 'Our Villa - ')
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
            <img src="{{ asset('/img/scrol.svg' )}}" alt="scrol"
                class="img-fluid animate__animated animate__bounceIn  animate__infinite animate__slower">
        </button>
    </div>

    <div class="container h-100 welcome my-md-5">
        <div class="row">
            @foreach ($data as $key => $villa)
                <div class="col-md-12 py-4"
                    data-aos="@php if($villa->id%2==0){echo 'fade-up';}else{echo 'fade-down';} @endphp"
                    data-aos-duration="1000">
                    <div class="row">
                        <div class="col-md-6 @php if($villa->id%2==0){ echo 'order-md-2';} @endphp">
                            @if ($villa->image)
                                <img src="{{ asset('/img/villas/') . $villa->image }}" alt="{{ $villa->name }}" class="img-fluid">
                            @endif
                        </div>
                        <div class="col-md-6 p-md-5 p-3 d-flex flex-grow-1 justify-content-center align-items-center">
                            <div
                                class="content-greeting @php if($villa->id%2==0){echo 'text-md-end ps-6';}else{echo 'text-md-start pe-6';} @endphp">
                                <h3 class="@php if($villa->id%2==0){echo 'ps-md-5';}else{echo 'pe-md-5';} @endphp">
                                    {!! $villa->name !!}</h3>
                                <div
                                    class="icon-villa d-flex p-0 @php if($villa->id%2==0){echo 'justify-content-md-end';}else{echo 'justify-content-md-start';} @endphp">
                                    <img src="{{ asset('/img/person.svg') }}" class="img-fluid me-2">
                                    <p> {!! $villa->capacity !!} Guest</p>
                                    <img src="{{ asset('/img/area.svg') }}" class="img-fluid me-2 ms-3">
                                    <p> {!! $villa->building_area !!} sqm</p>
                                </div>
                                {!! $villa->description !!}
                                <div class="row">
                                    <div class="col-md-6 d-flex justify-content-md-start justify-content-center p-0">
                                        <a href="{{ route('villa.detail', ['slug' => $villa->slug]) }}"
                                            class="btn btn-full-info">Full Info <i class="fas fa-chevron-right"></i></a>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3 p-0">
                                        {!! $settings->widget_book !!}
                                    </div>
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
