<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="index, follow" />
    <meta name="title" content="@yield('meta_title')" />
    <meta name="description" content="@yield('meta_desc')">
    <meta name="author" content="Era Digital Media">
    <meta name="keywords" content="@yield('meta_keyword')" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="@yield('meta_title')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="@yield('meta_image', secure_url(asset('img/welcome.png')))" />
    <meta property="og:image:secure_url" content="@yield('meta_image', secure_url(asset('img/welcome.png')))" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:site_name" content="@yield('meta_title')" />
    <meta property="og:description" content="@yield('meta_desc')" />
    <title>@yield('title')Prasana by Arjani Resorts</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/main/style.css') }} ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />


    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script defer src="{{ asset('assets/main/main.js') }}"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '580573388961615');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=580573388961615&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PCNNH4GM');</script>
<!-- End Google Tag Manager -->

<!-- Google tag (gtag.js) --> <script async src="https://www.googletagmanager.com/gtag/js?id=G-T82TG8H2DY"></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-T82TG8H2DY'); </script>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PCNNH4GM"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=G-T82TG8H2DY"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    @include('inc.main.header')
    @yield('content')
    @include('inc.main.footer')
    <div class="modal fade" id="modalSubmit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content modal-offers">
                <div class="modal-header modal-offers">
                    <h4 class="modal-title text-center" id="title"></h4>
                    <div class="position-relative">
                        <button type="button" class="btn-close shadow-none close-absolute" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                </div>
                <form id="formOffers" name="formOffers" class="form-horizontal p-md-2">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label>Full Name </label>
                                    <input type="hidden" name="booking_value" id="booking_value">
                                    <input id="name" name="name" type="text" placeholder="Full Name"
                                        class="form-control" required>
                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label>Email </label>
                                    <input id="email" name="email" type="text" placeholder="Email"
                                        class="form-control" required>
                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label>Phone (Include Country Code)</label>
                                    <input id="phone" name="phone" type="number" placeholder="Phone"
                                        class="form-control" required>
                                </div>

                                <div class="form-group col-md-12 mt-3">
                                    <label>Country of Resindence</label>
                                    <select id="country-select" name="country" class="form-control"
                                        placeholder="Select a country" required>
                                        <option value="" disabled selected>Select country of resindence
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-12">
                                    <label>Number of Guest </label>
                                    <input id="guest" name="guest" type="number"
                                        placeholder="Number of Guest" class="form-control" required>
                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label class="form-label">Event Start Date</label>
                                    <div class="input-group date" data-provide="datepicker"
                                        data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control" id="start_date" name="start_date"
                                            placeholder="Start Date" required>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label">Event End Date</label>
                                    <div class="input-group date" data-provide="datepicker"
                                        data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control" id="end_date" name="end_date"
                                            placeholder="End Date" required>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label>Additional Request </label>
                                    <textarea class="form-control" name="additional" id="additional"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-book-header mt-3 ms-0 rounded" id="btn-save"
                                value="create">INQUIRY</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="promotion" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-promo" role="document">
            <div class="modal-content modal-transparent">
                <div class="modal-body" id="content-promosi">
                    <button type="button" class="btn btn-transparent shadow-none float-end"
                        data-bs-dismiss="modal"><i class="fas fa-times text-white"></i></button>
                    <a href="" class="btn btn-transparent shadow-none" id="urls-banner" target="_blank"
                        rel="noopener noreferrer">
                        <img class="img-fluid rounded" id="modal-image" src="">
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- kirim --}}
    <div class="modal fade" id="sending" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_txpagpud.json"
                        background="transparent" speed="1" loop autoplay></lottie-player>
                </div>
            </div>
        </div>
    </div>
    {{-- berhasil --}}
    <div class="modal fade" id="done" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <lottie-player src="https://assets4.lottiefiles.com/packages/lf20_pqnfmone.json"
                        background="transparent" speed="1" loop autoplay></lottie-player>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
        AOS.init();
        var SITEURL = '{{ URL::to('') }}';
        var SEGMENT = '{{ Request::segment(1) }}';
        $(document).ready(function() {
            $('.datepicker').datepicker();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.submitOffers').click(function() {
                var title = $(this).data('title');
                $('#booking_value').val(title);
                $('#btn-save').val("send-submit");
                $('#title').html('BOOK ' + title);
                $('#modalSubmit').modal('show');
            });

            $.ajax({
                type: "get",
                url: SITEURL + "/get-banner",
                success: function(data) {
                    var posisi = data.data.position;
                    var loadUrl = ''
                    if (posisi === 'home') {
                        loadUrl = ''
                    } else {
                        loadUrl = posisi
                    }
                    if (loadUrl === SEGMENT) {
                        $('#promotion').modal('show');
                        $('#urls-banner').attr('href', data.data.urls);
                        $('#modal-image').attr('src', '{{ URL::to('/img/user') }}' + '/' + data.data
                            .image);
                    }
                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });

            const countrySelect = document.getElementById('country-select');
            const apiUrl = 'https://restcountries.com/v3.1/all';
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    data.forEach(country => {
                        const option = document.createElement('option');
                        option.value = country.name.common;
                        option.text = country.name.common;
                        countrySelect.add(option);
                    });
                })
                .catch(error => console.error(error));

        });
        $('body').on('submit', '#formOffers', function(e) {
            e.preventDefault();
            var actionType = $('#btn-save').val();
            $('#btn-save').html('Sending..');
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: SITEURL + "/send-mail",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#sending').modal('show');
                    $('#formOffers').trigger("reset");
                    $('#modalSubmit').modal('hide');
                },
                success: (data) => {
                    $('#sending').modal('hide');
                    $('#formOffers').trigger("reset");
                    $("#done").modal("show");
                    setTimeout(function() {
                        $("#done").modal("hide");
                    }, 3000);
                },
            });
        });
    </script>
    @stack('scripts')

    @if(Route::is('villa') || Route::is('dining') || Route::is('spa') || Route::is('wedding') || Route::is('offers') || Route::is('experience') || Route::is('gallery') || Route::is('contact'))
        <!-- TRACKING -->
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
            pl.src = 'https://static.sojern.com/cip/w/s?id=205885&f_v=v6_js&p_v=1&' +
            paramsArr.join('&');
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(pl);
          })();
        </script>
        <!-- End Sojern Tag -->
    @endif
</body>

</html>
