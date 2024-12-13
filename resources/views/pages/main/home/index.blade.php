@extends('layouts.app')
@section('meta_title', $settings->meta_title)
@section('meta_desc', $settings->meta_description)
@section('meta_keyword', $settings->meta_keyword)
@section('content')
    <div class="main-sliders">
        <div class="sliders">
            @foreach ($mainSlider->getMedia($mediaCollection) as $media)
                <img src="{{ asset($media->getUrl()) }}" class="img-fluid fit-slider" alt="{{ $mainSlider->title }}">
            @endforeach
        </div>
        <div class="slider-text-main">
            <h1 class="animate__animated animate__fadeInLeft"> {!! $mainSlider->title !!}</h1>
            <p class="animate__animated animate__fadeInUp animate__delay-1s">{{ $mainSlider->sub_title }}</p>
        </div>
        <button id="scrol" class="scrol-main btn btn-transparent shadow-none">
            <img src="{{ asset('/img/scrol.svg' )}}" alt="scrol"
                class="img-fluid animate__animated animate__bounceIn  animate__infinite animate__slower">
        </button>
    </div>
    <div class="container-fluid mt-md-5 welcome">
        <div class="row">
            <div class="col-md-6 p-0">
                <img src="{{ asset('/img/welcome.png') }}" class="content-image-welcome img-fluid"
                    alt="welcome to prasana by arjani resort">
            </div>
            <div
                class="col-md-6 p-md-5 p-4 d-flex flex-grow-1 justify-content-center align-items-center order-first order-md-last">
                <div class="content-greeting">
                    <h5 data-aos="fade-down" data-aos-duration="1000">Welcome TO</h5>
                    <h2 data-aos="fade-left" data-aos-duration="1000">PRASANA</h2>
                    <h4 data-aos="fade-left" data-aos-duration="1000">by arjani resort</h4>
                    <p class="pe-md-5 pe-3" data-aos="fade-down" data-aos-duration="1000">
                        Raised on the land of limitless seclusion, Prasana by Arjani Resorts is contrived to present the
                        haven of bliss through the exquisite simplicity of its elements, utmost purity of its bearer’s
                        culture and unfeigned sincerity of its indulgence.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0 relative">
        <div class="book-home">
            <div class="row content-book">
                <div class="col-md-6">
                    <div class="title-book mt-5" data-aos="fade-down" data-aos-duration="1000">WHY DIRECT BOOK?</div>
                    <ul class="book" data-aos="fade-down" data-aos-duration="1000">
                        <li>Best Rate Guarantee</li>
                        <li>One-way complimentary airport transfer</li>
                        <li>Early check-in and late check-out priority</li>
			<li>Complimentary yoga available every Monday, Wednesday and Friday</li>
                        <li>Repeater Guest Privilege</li>
                        <li>Terms & Conditions Apply</li>
                    </ul>
                </div>
                <div class="col-md-6 d-flex flex-grow-1 justify-content-center align-items-center mt-md-5">
                    <div id="fb-widget-1" class="fb-widget" data-fbConfig="0"></div>
                    <script class="fb-widget-config" data-fbConfig="0" type="application/json">{"params":[{"currency":"IDR","locale":"en_GB","pricesDisplayMode":"normal","offerComputeRule":"lowerMinstay","maxAdults":6,"maxChildren":2,"mainColor":"#b0a06c","themeDark":false,"openFrontInNewTab":true,"property":"idbal31631","title":"Prasana By Arjani Resorts","childrenMaxAge":12,"quicksearch":{"layout":"2","border":"border","layersDirection":"down-left","showAccessCode":true,"showChildrenAges":false,"trackingCode":""},"fbWidget":"Quicksearch"}],"commonParams":{"redirectUrl":"https://redirect.fastbooking.com/DIRECTORY/dispoprice.phtml","showPropertiesList":false,"demoMode":false,"allowGroupSelection":false},"propertyIndex":0,"version":"1.46.0","baseHost":"websdk.fastbooking-services.com"}</script>
                    <link rel="stylesheet" property="stylesheet" href="//websdk.fastbooking-services.com/widgets/app.css">
                    <script type="text/javascript" src="//websdk.fastbooking-services.com/widgets/app.js"></script>
                </div>
            </div>
        </div>
    </div>
    <div class="container p-md-5 p-3">
        <div class="row">
            <div class="slide-villa-home">
                @foreach ($villas as $villa)
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 p-md-5 p-3 d-flex flex-grow-1 justify-content-center align-items-center">
                                <div class="content-greeting text-md-end ps-md-5">
                                    <h5 class="d-none d-md-block">villas</h5>
                                    <h3>{!! $villa->name !!}</h3>
                                    {!! $villa->description !!}
                                    <a href="{{ url('/our-villa/' . $villa->slug) }}"
                                        class="btn btn-book-header mt-3">Explore</a>
                                </div>
                            </div>
                            <div class="col-md-6 order-first order-md-last">
                                @if ($villa->image)
                                    <img src="{{ asset('/img/villas/' . $villa->image) }}" alt="{{ $villa->name }}"
                                        class="img-fluid img-villa-home pe-1">
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="home-sliders">
        @foreach ($homeSlider->getMedia($mediaCollection) as $media)
            <img src="{{ asset($media->getUrl()) }}" class="img-fluid image-two-column">
        @endforeach
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 order-last order-md-first">
                <div class="reviews">
                    @foreach ($ratings as $key => $rating)
                        <div class="wrap-review p-3">
                            @for ($i = 1; $i <= $rating->star_rating; $i++)
                                <i class="fas fa-star text-warning"></i>
                            @endfor
                            @for ($i = $rating->star_rating; $i <= 4; $i++)
                                <i class="far fa-star text-warning"></i>
                            @endfor
                            <p class="comments mt-3">
                                {!! $rating->comments !!}
                            </p>
                            <div class="user-comment">
                                @if ($rating->image)
                                    <img src="{{ asset('/img/user/' . $rating->image) }}" alt="{{ $rating->name }}"
                                        class="rounded-circle avatar">
                                @endif
                                <div class="user-name">
                                    {{ $rating->name }}
                                    <p>{{ $rating->company }}</p>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4 px-4 px-md-3">
                <img src="{{ asset('/img/kutip.svg') }}" class="img-fluid" alt="welcome to prasana by arjani resort">
                <div class="quotes-home">
                    The Best And Recommended Places
                </div>
                <p class="quotes-home">We like to build close relationships with our guests. We believe dynamic
                    collaboration is the only way to get the job done.</p>
            </div>
        </div>
    </div>

    <div class="container mt-md-5">
        <div class="row">
            <div class="col-md-4 p-md-5 p-4 d-flex flex-grow-1 justify-content-center align-items-center">
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
                        <img src="{{ asset($media->getUrl()) }}" class="img-fluid">
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="address p-md-0 p-4">
                    <div class="title">
                        {!! $settings->meta_title !!}
                    </div>
                    <div class=" street ps-0 pe-0 pt-3 pb-3">
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
                        <li> <a href="{!! $settings->facebook !!}" class="btn btn-sosmed" target="_blank"
                                rel="noopener noreferrer"> <img src="{{ asset('/img/fb.svg' )}}" class="img-fluid"
                                    alt="Facebook"> </a></li>
                        <li> <a href="{!! $settings->instagram !!}" class="btn btn-sosmed" target="_blank"
                                rel="noopener noreferrer"> <img src="{{ asset('/img/ig.svg') }}" class="img-fluid"
                                    alt="Instagram"></a></li>
                        <li> <a href="{!! $settings->gplus !!}" class="btn btn-sosmed" target="_blank"
                                rel="noopener noreferrer"> <img src="{{ asset('/img/gp.svg') }}" class="img-fluid"
                                    alt="Google"></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <div class="subscribe-title">
                    Don’t miss our update.
                    Subscribe us for more info
                </div>
                <form class="row form-subscribe">
                    <div class="col-md-8">
                        <input type="text" class="form-control" id="subscribe"
                            placeholder="Enter your email address">
                    </div>
                    <div class="col-md-4 mt-md-0 mt-3">
                        <button type="submit" class="btn btn-subscribe mb-3">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <!-- HOME_PAGE -->
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
        var defaultParams = {"vid":"hot"};
        for(key in defaultParams) { params[key] = defaultParams[key]; };
        for(key in cidParams) { cid.push(params[cidParams[key]]); };
        params.cid = cid.join('|');
        for(key in params) { paramsArr.push(key + '=' + encodeURIComponent(params[key])) };
        pl.type = 'text/html';
        pl.setAttribute('style','height:0; width: 0; display:none;');
        pl.async = true;
        pl.src = 'https://static.sojern.com/cip/w/s?id=205881&f_v=v6_js&p_v=1&' +
        paramsArr.join('&');
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(pl);
      })();
    </script>
    <!-- End Sojern Tag -->

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
            $('.slide-villa-home').slick({
                dots: false,
                infinite: true,
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                arrow: false,
            });
            $('.home-sliders').slick({
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: true,
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

            $('.reviews').slick({
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 5000,
                arrow: false,
                responsive: [{
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }]
            });
            $('.slide-gallery').slick({
                dots: true,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                arrow: false
            });
        });
    </script>
@endpush
