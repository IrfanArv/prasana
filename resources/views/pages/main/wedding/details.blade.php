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
            <img src="{{ asset('/img/scrol.svg') }}" alt="scrol"
                class="img-fluid animate__animated animate__bounceIn  animate__infinite animate__slower">
        </button>
    </div>
    <div class="container welcome my-md-5 my-4">
        <div class="content-greeting">
            <h3>{!! $data->title !!}</h3>
            {!! $data->description !!}
        </div>
        <div class="d-flex justify-content-start my-5">
            @if ($data->send_to === 'email')
                <button type="button" class="btn btn-book-header shadow-none book-offer submitOffers"
                    data-title="{!! $data->title !!}">
                    Book Now
                </button>
            @else
                <a href="https://api.whatsapp.com/send?phone={{ $settings->wa_reciver }}&text=Hello%20Admin%20Prasana%20Resorts%20I%20would%20like%20to%20book%20a%20{!! Str::lower($data->title) !!}%20?"
                    target="_blank" class="btn btn-book-header shadow-none me-3 d-none d-md-block">Book Now</a>
            @endif
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
