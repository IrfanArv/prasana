@extends('layouts.app')
@section('meta_title', $data->meta_title)
@section('meta_desc', $data->meta_desc)
@section('meta_keyword', $data->meta_keyword)
@section('title', strip_tags($data->name) . ' - ')
@section('content')
    <div class="main-sliders">
        <div class="sliders">
            <img src="{{ '/img/villas/' . $data->image }}" alt="{{ $data->name }}" class="img-fluid fit-slider">
        </div>
        <div class="slider-text-main">
            <p class="animate__animated animate__fadeInUp">Villas</p>
            <h1 class="animate__animated animate__fadeInLeft"> {!! $data->name !!}</h1>
        </div>
        <button id="scrol" class="scrol-main btn btn-transparent shadow-none">
            <img src="{{ '/img/scrol.svg' }}" alt="scrol"
                class="img-fluid animate__animated animate__bounceIn  animate__infinite animate__slower">
        </button>
    </div>
    <div class="container welcome my-md-5 my-3">
        <div class="content-greeting">
            <h3>{!! $data->name !!}</h3>
            <div class="icon-villa mb-md-3">
                <img src="{{ '/img/person.svg' }}" class="img-fluid me-2">
                <p> {!! $data->capacity !!} Guest</p>
                <img src="{{ '/img/area.svg' }}" class="img-fluid me-2 ms-3">
                <p> {!! $data->building_area !!} sqm</p>
            </div>
            {!! $data->description !!}
            <div class="row mt-md-5">
                <div class="col-md-6">
                    <div class="title-main">
                        ROOM FEATURE
                    </div>
                    <ul class="feature mt-md-3">
                        @foreach ($featureVilla as $value)
                            @if (in_array($value->id, $featureActive))
                                <li>{{ $value->name }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="title-main">
                        SERVICES
                    </div>
                    <ul class="feature mt-md-3">
                        @foreach ($serviceVilla as $value)
                            @if (in_array($value->id, $serviceActive))
                                <li>{{ $value->name }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-start my-5">
            {!! $settings->widget_book !!}
        </div>
    </div>
    <div class="home-sliders mb-5">
        @foreach ($data->getMedia($mediaCollection) as $media)
            <img src="{{ $media->getUrl() }}" class="img-fluid image-two-column">
        @endforeach
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.home-sliders').slick({
                infinite: true,
                dots: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 3000,
                arrow: false,
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
