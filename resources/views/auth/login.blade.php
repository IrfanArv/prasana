<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Prasana By Arjani Resorts CMS">
    <meta name="author" content="Webly.id">
    <title>Login CMS - Prasana by Arjani Resorts</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon/apple-touch-icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon/favicon-16x16.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/themes/semi-dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/authentication.css') }}">

</head>

<body
    class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page"
    data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center p-5">
                                    <img class="img-fluid p-5" src="{{ asset('img/logo.png') }}" alt="branding logo">
                                </div>
                                <div class="col-lg-6 col-12 py-3 bg-white">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">Hi! Welcome</h4>
                                            </div>
                                        </div>
                                        <p class="px-2">CMS Prasana by Arjani Resorts</p>
                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                                                    <fieldset
                                                        class="form-label-group form-group position-relative has-icon-left">
                                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                                            placeholder="Email" name="email"
                                                            value="{{ old('email') }}" required autocomplete="email"
                                                            autofocus>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-mail"></i>
                                                        </div>
                                                        <label for="user-name">Email</label>
                                                    </fieldset>

                                                    <fieldset class="form-label-group position-relative has-icon-left">
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                            id="password" name="password" required autocomplete="current-password" placeholder="Password">
                                                        <div class="form-control-position">
                                                            <i class="feather icon-lock"></i>
                                                        </div>
                                                        <label for="user-password">Password</label>
                                                    </fieldset>
                                                    <div
                                                        class="form-group d-flex justify-content-between align-items-center">
                                                        <div class="text-left">
                                                            <fieldset class="checkbox">
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" name="remember"
                                                                        id="remember"
                                                                        {{ old('remember') ? 'checked' : '' }}>
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="">Remember me</span>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary float-right btn-inline">Login</button>
                                                    </div>
                                                    @error('email')
                                                        <div class="alert alert-danger alert-dismissible fade show"
                                                            role="alert">
                                                            <p class="mb-0">
                                                                {{ $message }}
                                                            </p>
                                                            <button type="button" class="close" data-dismiss="alert"
                                                                aria-label="Close">
                                                                <span aria-hidden="true"><i
                                                                        class="feather icon-x-circle"></i></span>
                                                            </button>
                                                        </div>
                                                    @enderror
                                                    @error('password')
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                        role="alert">
                                                        <p class="mb-0">
                                                            {{ $message }}
                                                        </p>
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true"><i
                                                                    class="feather icon-x-circle"></i></span>
                                                        </button>
                                                    </div>
                                                @enderror
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/components.js') }}"></script>
</body>

</html>
