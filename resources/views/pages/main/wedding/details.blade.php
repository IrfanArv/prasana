@extends('layouts.app')
@section('meta_title', $data->meta_title)
@section('meta_desc', $data->meta_desc)
@section('meta_keyword', $data->meta_keyword)
@section('title', strip_tags($data->title) . ' - ')
@section('content')
    <div class="main-sliders">
        <div class="sliders">
            <img src="{{ asset('/img/products/' . $data->image) }}" alt="{{ $data->title }}" class="img-fluid fit-slider">
        </div>
        <div class="slider-text-main @php if(strlen($data->title) >= 23) {echo 'left-long';} @endphp">
            <p class="animate__animated animate__fadeInUp">Weddings</p>
            <h1 class="animate__animated animate__fadeInLeft"> {!! $data->title !!}</h1>
        </div>
        <button id="scrol" class="scrol-main btn btn-transparent shadow-none">
            <img src="{{ asset('/img/scrol.svg' )}}" alt="scrol"
                class="img-fluid animate__animated animate__bounceIn  animate__infinite animate__slower">
        </button>
    </div>
    <div class="container welcome my-md-5 my-4">
        <div class="content-greeting">
            <h3>{!! $data->title !!}</h3>
            {!! $data->description !!}
        </div>
        <div class="d-flex justify-content-start my-5">
            <button type="button" class="btn btn-book-header shadow-none book-offer submitOffers" data-title="{!! $data->title !!}">
                Book Now
            </button>
        </div>
    </div>
    <div class="home-sliders mb-5">
        @foreach ($data->getMedia($mediaCollection) as $media)
            <img src="{{ asset($media->getUrl()) }}" class="img-fluid image-two-column">
        @endforeach
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.home-sliders').slick({
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
        });
    </script>
@endpush
