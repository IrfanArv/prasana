@extends('layouts.app')
@section('meta_title', $data->meta_title)
@section('meta_desc', $data->meta_desc)
@section('meta_keyword', $data->meta_keyword)
@section('title', strip_tags($data->name) . ' - ')
@section('content')
    <div class="main-sliders">
        <div class="sliders">
            <img src="{{ asset('/img/villas/' . $data->image) }}" alt="{{ $data->name }}" class="img-fluid fit-slider">
        </div>
        <div class="slider-text-main">
            <p class="animate__animated animate__fadeInUp">Villas</p>
            <h1 class="animate__animated animate__fadeInLeft"> {!! $data->name !!}</h1>
        </div>
        <button id="scrol" class="scrol-main btn btn-transparent shadow-none">
            <img src="{{ asset('/img/scrol.svg' )}}" alt="scrol"
                class="img-fluid animate__animated animate__bounceIn  animate__infinite animate__slower">
        </button>
    </div>
    <div class="container welcome my-md-5 my-3">
        <div class="content-greeting">
            <h3>{!! $data->name !!}</h3>
            <div class="icon-villa mb-md-3">
                <img src="{{ asset('/img/person.svg' )}}" class="img-fluid me-2">
                <p> {!! $data->capacity !!} Guest</p>
                <img src="{{ asset('/img/area.svg') }}" class="img-fluid me-2 ms-3">
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
            <img src="{{ asset($media->getUrl()) }}" class="img-fluid image-two-column">
        @endforeach
    </div>
@endsection
@push('scripts')
    <!-- PRODUCT -->
    <!-- Sojern Tag v6_js, Pixel Version: 10 -->
    <script src="https://static.sojern.com/utils/sjrn_autocx.js"></script>
    <script>
      (function () {
        /* Please fill the following values. */
        var params = {
          hd1: "", /* Check In Date. Format yyyy-mm-dd. Ex: 2015-02-14 */
          hd2: "", /* Check Out Date. Format yyyy-mm-dd. Ex: 2015-02-14 */
          hc1: "", /* Destination City */
          hs1: "", /* Destination State or Region */
          hn1: "", /* Destination Country */
          hpr: "", /* Hotel Property */
          hr: "", /* Number of Rooms */
          hsr: "", /* Hotel Star Rating */
          hpid: "", /* Property ID */
          t: "", /* Number of Travelers */
          hp: "", /* Purchase Price */
          hcu: "", /* Purchase Currency */
          hconfno: "", /* Confirmation Number */
          hdc: "", /* Discount Code */
          sha256_eml: "", /* Hashed Email SHA256 */
          sha1_eml: "", /* Hashed Email SHA1 */
          md5_eml: "", /* Hashed Email MD5 */
          ccid: "", /* Client Cookie id */
          ffl: "" /* Loyalty Status */
        };

        /* Please do not modify the below code. */
        try{params = Object.assign({}, sjrn_params, params);}catch(e){}
        var cid = [];
        var paramsArr = [];
        var cidParams = [];
        var pl = document.createElement('iframe');
        var defaultParams = {"vid":"hot","et":"hpr"};
        for(key in defaultParams) { params[key] = defaultParams[key]; };
        for(key in cidParams) { cid.push(params[cidParams[key]]); };
        params.cid = cid.join('|');
        for(key in params) { paramsArr.push(key + '=' + encodeURIComponent(params[key])) };
        pl.type = 'text/html';
        pl.setAttribute('style','height:0; width: 0; display:none;');
        pl.async = true;
        pl.src = 'https://static.sojern.com/cip/w/s?id=205882&f_v=v6_js&p_v=1&' +
        paramsArr.join('&');
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(pl);
      })();
    </script>
    <!-- End Sojern Tag -->

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
