@extends('layouts.app')
@section('meta_title', $settings->meta_title)
@section('meta_desc', $settings->meta_description)
@section('meta_keyword', $settings->meta_keyword)
@section('title', 'Weddings - ')
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

    <div class="container welcome my-md-5">
        <div class="row">
            @foreach ($data as $item)
                <div class="col-md-6 col-sm-12 mt-md-5 mt-md-3">
                    <div class="products">
                        @if ($item->image)
                            <img src="{{ '/img/products/' . $item->image }}" alt="{{ $item->title }}" class="img-fluid">
                        @endif
                        <div class="content-greeting">
                            <h3 class="mt-3"> <a href="{{ route('weddings.detail', ['slug' => $item->slug]) }}">
                                    {!! $item->title !!}</a></h3>
                            {!! Str::limit($item->description, 70) !!}
                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-md-start justify-content-center p-0">
                                    <a href="{{ route('weddings.detail', ['slug' => $item->slug]) }}"
                                        class="btn btn-full-info">Full Info <i class="fas fa-chevron-right"></i></a>
                                </div>
                                <div
                                    class="col-md-6 d-flex justify-content-md-end justify-content-center my-md-0 my-3 p-0 pe-md-3">
                                    <button type="button" class="btn btn-book-header shadow-none book-offer" data-bs-toggle="modal"
                                        data-bs-target="#modalSubmit">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="modal fade" id="modalSubmit" tabindex="-1" aria-labelledby="modalSubmitLabel"
                data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-capitalize" id="modalSubmitLabel">BOOK {!! $item->title !!}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                  </div>
                                  <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                  </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
