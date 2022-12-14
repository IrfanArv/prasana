<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Prasana By Arjani Resorts CMS">
    <meta name="author" content="Webly.id">
    <title>@yield('title') - Prasana by Arjani Resorts</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/ui/prism.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate/animate.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/extensions/sweetalert2.min.css') }}">
    <style>
        dz-image img {
            width: 120px;
            height: 120px;
        }

        .dropzone {
            border: 2px solid rgb(165 134 57);
            border-radius: 10px;
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btn-upload {
            border: 2px solid gray;
            color: gray;
            background-color: white;
            padding: 5px 5px;
            border-radius: 4px;
            font-size: 13px;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }
        .column-count{
            column-count: 4 !important;
        }
        .column-count-2{
            column-count: 2 !important;
        }
    </style>
</head>

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    @include('inc.cms.header')
    @include('inc.cms.sidebar')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        @yield('content')
    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/js/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/ui/prism.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/js/extensions/polyfill.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/components.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/extensions/sweet-alerts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script>
        var SITEURL = '{{ URL::to('') }}';
        $(document).ready(function() {

            $("#checkAll").click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        function readURL(input, id) {
            id = id || '#modal-preview';
            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(id).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
                $('#modal-preview').removeClass('hidden');
                $('#start').hide();
            }
        }
    </script>
    @stack('scripts')
</body>

</html>
