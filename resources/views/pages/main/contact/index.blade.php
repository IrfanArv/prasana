@extends('layouts.app')
@section('meta_title', $settings->meta_title)
@section('meta_desc', $settings->meta_description)
@section('meta_keyword', $settings->meta_keyword)
@section('title', 'Contact Us - ')
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

    <div class="container welcome my-5">
        <div class="content-greeting">
            <h3>get in touch</h3>
            <p>With a stay at Prasana Villa in Ungasan, you’ll be 3.5 mi (5.6 km) from Melasti Beach and 5 mi (8.1 km) from Uluwatu Temple. This 4-star villa is 5.5 mi (8.8 km) from Jimbaran Beach and 5.5 mi (8.9 km) from Balangan Beach.</p>
        </div>
    </div>
    <div class="container-fluid p-0 mb-5">
        <div class="row p-0">
            <div class="col-md-6 frame p-0">
                {!! $settings->maps !!}
            </div>
            <div class="col-md-6 book-home p-0">
                <div class="address">
                    <div class="title">
                        {!! $settings->meta_title !!}
                    </div>
                    <div class="street">
                        {!! $settings->address !!}
                    </div>
                    <div class="contact">
                        <p class="m-0">T. {!! $settings->phone !!}</p>
                        <p>E. {!! $settings->email !!}</p>
                    </div>
                    <div class="title">
                        Follow Us
                    </div>
                    <ul class="sosmed">
                        <li> <a href="{!! $settings->facebook !!}" class="btn btn-sosmed" target="_blank" rel="noopener noreferrer"> <img src="{{ asset('/img/fb.svg') }}" class="img-fluid" alt="Facebook"> </a></li>
                        <li> <a href="{!! $settings->instagram !!}" class="btn btn-sosmed" target="_blank" rel="noopener noreferrer"> <img src="{{ asset('/img/ig.svg') }}" class="img-fluid" alt="Instagram"></a></li>
                        <li> <a href="{!! $settings->gplus !!}" class="btn btn-sosmed" target="_blank" rel="noopener noreferrer"> <img src="{{ asset('/img/gp.svg') }}" class="img-fluid" alt="Google"></a></li>
                    </ul>
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
        });
    </script>
@endpush
