<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, follow" />
    <meta name="title" content="@yield('meta_title')" />
    <meta name="description" content="@yield('meta_desc')">
    <meta name="author" content="Era Digital Media">
    <meta name="keywords" content="@yield('meta_keyword')" />
    <meta name="og:title" content="@yield('meta_title')" />
    <meta name="og:url" content="{{ url('/') }}" />
    <meta name="og:image" content="{{ asset('img/whitelogo.svg') }}" />
    <meta name="og:site_name" content="@yield('meta_title')" />
    <meta name="og:description" content="@yield('meta_desc')" />
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
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script defer src="{{ asset('assets/main/main.js') }}"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>

<body>
    @include('inc.main.header')
    @yield('content')
    @include('inc.main.footer')
    <div class="modal fade" id="modalSubmit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
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
                                <label>Phone </label>
                                <input id="phone" name="phone" type="number" placeholder="Phone"
                                    class="form-control" required>
                            </div>
                            <div class="form-group col-md-12 mt-3">
                                <label>Additional Request </label>
                                <textarea class="form-control" name="additional" id="additional" cols="10" rows="8"></textarea>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-book-header mt-3 ms-0 rounded" id="btn-save"
                                value="create">Submit</button>
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
    <script type="text/javascript">
        AOS.init();
        var SITEURL = '{{ URL::to('') }}';
        var SEGMENT = '{{ Request::segment(1) }}';
        $(document).ready(function() {
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
</body>

</html>
