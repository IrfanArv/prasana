@extends('layouts.app')
@section('meta_title', $settings->meta_title)
@section('meta_desc', $settings->meta_description)
@section('meta_keyword', $settings->meta_keyword)
@section('title', 'Dining - ')
@section('content')
    <style>
        .slick-center {
            transform: scale(1.09);
        }

        .slick-slide:not(.slick-active) {
            /*margin: 20px 0;*/
        }

        .child {
            width: 100%;
        }

        .slide:not(.slick-active) {
            cursor: pointer;
        }

        .slick-arrow {
            display: none !important;
        }

        .container-slide {
            position: absolute;
            top: 50%;
            right: -40px;
            padding-left: 80px;
            width: 100%;
            height: auto;
            -webkit-transform: translate(0, -50%);
            transform: translate(0, -50%);
        }

        .modal-header {
            border: none !important;
            position: relative !important;
            left: -100px;
            top: 45px;
            z-index: 999 !important;
        }

        /* Dining page sections */
        .dining-section {
            padding: 60px 0;
        }

        .dining-section .dining-img {
            width: 100%;
            height: 450px;
            object-fit: cover;
        }

        .dining-section .content-greeting p {
            text-transform: none;
        }

        .dining-section .content-greeting h3 {
            margin-bottom: 15px;
        }

        .dining-section .btn-group-dining {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .dining-section .btn-group-dining .btn {
            margin-left: 0;
        }

        .dining-section-alt {
            background-color: #f9f6f0;
        }

        /* Chef section */
        .chef-section {
            padding: 80px 0;
            background-color: #f9f6f0;
        }

        .chef-section .chef-photo {
            width: 100%;
            height: 550px;
            object-fit: cover;
        }

        .chef-section .content-greeting h3 {
            margin-bottom: 15px;
        }

        .chef-section .content-greeting p {
            text-transform: none;
        }

        .chef-bio-text {
            font-family: "Avenir-Light";
            font-weight: 300;
            font-size: 16px;
            line-height: 22px;
            text-align: justify;
            color: #828282;
        }

        .hero-dishes {
            padding: 60px 0;
        }

        .hero-dishes .content-greeting p {
            text-transform: none;
        }

        .hero-dishes h4 {
            font-family: "Avenir";
            font-weight: 500;
            font-size: 20px;
            line-height: 27px;
            letter-spacing: 0.1em;
            color: #a58639;
            margin-bottom: 10px;
        }

        .hero-dish-card {
            margin-bottom: 30px;
        }

        @media screen and (max-width: 480px) {
            .slick-center {
                transform: none;
            }

            .slick-slide:not(.slick-active) {
                margin: 0px;
            }

            .container-slide {
                position: initial;
                padding: 50px 20px 20px 20px;
                -webkit-transform: none;
                transform: none;
            }

            .modal-header {
                left: 0px !important;
                top: 20px !important;
            }

            .dining-section {
                padding: 30px 0;
            }

            .dining-section .dining-img {
                height: 250px;
                margin-bottom: 20px;
            }

            .chef-section {
                padding: 40px 0;
            }

            .chef-section .chef-photo {
                height: 350px;
                margin-bottom: 20px;
            }

            .hero-dishes {
                padding: 30px 0;
            }
        }
    </style>

    {{-- Hero Slider (with text overlay) --}}
    <div class="main-sliders">
        <div class="sliders">
            @foreach ($mainSlider->getMedia($mediaCollection) as $media)
                <img src="{{ asset($media->getUrl()) }}" class="img-fluid fit-slider" alt="{{ $mainSlider->title }}">
            @endforeach
        </div>
        <div class="slider-text-main">
            <h1 class="animate__animated animate__fadeInUp">{{ $mainSlider->title }}</h1>
            <h1 class="animate__animated animate__fadeInLeft"> {!! $mainSlider->sub_title !!}</h1>
            <p class="animate__animated animate__fadeInRight">Dining at Prasana is shaped by a thoughtful blend of creativity, quality and a sense of occasion, brought to life through two distinctive culinary experiences. Whim Bar & Restaurant offers contemporary Western and Asian flavours in an elegant open‑air setting, while Petit Garçon introduces a playful yet refined world of French‑inspired patisserie. Together, they create a dining journey that feels both elevated and effortlessly welcoming.</p>
        </div>
        <button id="scrol" class="scrol-main btn btn-transparent shadow-none">
            <img src="{{ asset('/img/scrol.svg') }}" alt="scrol"
                class="img-fluid animate__animated animate__bounceIn  animate__infinite animate__slower">
        </button>
    </div>
    <!-- <div class="container-fluid p-0 h-100 mt-2" id="whim">
        <div class="slide-dining-1">
            @foreach ($data[0]->getMedia($mediaCollection) as $media)
                <img src="{{ asset($media->getUrl()) }}" class="img-fluid image-two-column">
            @endforeach
        </div>
    </div> -->

    {{-- ============================================== --}}
    {{-- WHIM BAR & RESTAURANT --}}
    {{-- ============================================== --}}

    {{-- Section 1: Roasted Duck (image left, text right) --}}
    <div class="dining-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('/img/dining/roasted-duck.jpg') }}" alt="Roasted Duck"
                        class="img-fluid dining-img">
                </div>
                <div class="col-md-6">
                    <div class="content-greeting ps-md-4">
                        <!-- <h3>Whim Bar & Restaurant</h3> -->
                        <p>Discover Whim Bar & Restaurant, the premier fine-casual dining destination at Prasana by
                            Arjani Resorts in the tranquil highlands of Uluwatu, Bali. Showcasing an innovative fusion
                            of Western and Asian cuisine, the menu is a celebration of flavour, complemented by
                            panoramic views of the Indian Ocean. Guided by a farm-to-table philosophy, the culinary team
                            meticulously sources premium imported meats and locally grown Balinese produce to craft
                            contemporary dishes with a refined sense of place.</p>
                        <div class="btn-group-dining">
                            <a href="{{ asset('img/dining/In House Breakfast.pdf') }}" target="_blank"
                                class="btn btn-book-header ms-0">Our Menu</a>
                            <a href="@php echo $data[0]->url @endphp" target="_blank"
                                class="btn btn-book-header ms-0">Reserve Your Table</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Section 2: Black Cod (text left, image right) --}}
    <div class="dining-section dining-section-alt">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-first order-last">
                    <div class="content-greeting pe-md-4">
                        <p>From our Whim Signature Mains, featuring succulent Black Cod with curry velouté and
                            Ribeye Steak with dashi butter, to our exclusive French-inspired dégustation menus,
                            every dish is crafted to elevate your intimate dining experience. Whether you are
                            joining us for a lush garden breakfast, a sophisticated afternoon tea, or bespoke
                            cocktails crafted by our resident mixologist at sunset, Whim offers an enchanting
                            open-air enclave for cherished moments in South Bali.</p>
                    </div>
                </div>
                <div class="col-md-6 order-md-last order-first">
                    <img src="{{ asset('/img/dining/black-cod.jpg') }}" alt="Black Cod"
                        class="img-fluid dining-img">
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================== --}}
    {{-- PETIT GARÇON PÂTISSERIE --}}
    {{-- ============================================== --}}

    {{-- Section 3: Petit Garçon (image left, text right) --}}
    <div class="dining-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
 @foreach ($data[1]->getMedia($mediaCollection) as $media)
                            <img src="{{ asset($media->getUrl()) }}" class="img-fluid">
                        @endforeach
                </div>
                <div class="col-md-6">
                    <div class="content-greeting ps-md-4">
                        <h3>Petit Garçon Pâtisserie</h3>
                        <p>Indulge in the whimsical world of Petit Garçon, an exquisite French-inspired dessert bar
                            where the exuberance of a child in a sweet shop meets sophisticated culinary artistry.
                            Translating to <em>little boy</em>, Petit Garçon is dedicated to transforming classic
                            treats into an unforgettable sensory journey. The menu features a curated selection of
                            artisanal desserts with contemporary twists, offering guests the choice of a diverse à
                            la carte selection or a structured dessert-tasting experience.</p>
                        <div class="btn-group-dining">
                            <a href="{{ asset('img/dining/petit garçon collection 2024-2.pdf') }}" target="_blank"
                                class="btn btn-book-header ms-0">Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Section 4: Petit Garçon detail (text left, image right) --}}
    <div class="dining-section dining-section-alt">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-first order-last">
                    <div class="content-greeting pe-md-4">
                        <p>Every creation is meticulously handcrafted using a blend of premium imported chocolate
                            and the finest locally sourced Balinese ingredients. To elevate the experience, our
                            in-house mixologist prepares expertly crafted cocktails designed to complement the
                            flavour profiles of each patisserie. Whether celebrating a birthday, anniversary, or
                            special occasion, our bespoke cakes and tarts are crafted to make every moment
                            extraordinary. For those wishing to enjoy our flavours at home, a tempting takeaway
                            menu offers elegant dessert jars, petite cakes, and whole celebration cakes.</p>
                        <!-- <div class="btn-group-dining">
                            <a href="@php echo $data[1]->url ?? '#' @endphp" target="_blank"
                                class="btn btn-book-header ms-0">Menu</a>
                        </div> -->
                    </div>
                </div>
                <div class="col-md-6 order-md-last order-first">
                    <img src="{{ asset('/img/dining/petit-garcon-dessert.jpg') }}"
                        alt="Petit Garçon Dessert" class="img-fluid dining-img">
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================== --}}
    {{-- CHEF ANDIKA ADAM --}}
    {{-- ============================================== --}}

    {{-- Section 5: Chef Andika (image left, bio right) --}}
    <div class="chef-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <img src="{{ asset('/img/dining/chef-andika.jpg') }}" alt="Chef Andika Adam"
                        class="img-fluid chef-photo">
                </div>
                <div class="col-md-7">
                    <div class="content-greeting ps-md-4">
                        <h3>Chef Andika Adam</h3>
                        <p>Chef Andika Adam leads the culinary direction at WHIM Restaurant & Bar at Prasana by
                            Arjani Resorts.</p>
                        <p>With a strong foundation in international hospitality, his culinary journey began with
                            hotel management studies in Switzerland, where he spent five years working across a
                            range of restaurants from casual dining to five-star hotels. He later refined his skills
                            in French cuisine and pastry at Le Cordon Bleu Paris, followed by professional
                            experience in Paris before returning to Indonesia.</p>
                        <p>Chef Andika joined Arjani Resorts as part of its pre-opening team and, in 2022, took on
                            the role of helming Whim Restaurant following its rebranding. His vision centers on
                            creating a relaxed yet intimate dining experience that blends contemporary Western and
                            Asian cuisine with modern, innovative touches, always prioritizing quality ingredients
                            sourced from local farmers and artisans.</p>
                        <p>A pastry chef by training, Chef Andika also brings his passion project,
                            <strong>Petit Garçon</strong>, to Prasana, an artisanal patisserie born during the
                            lockdown period and now complementing WHIM's dining experience. Known for his
                            dedication, discipline, and leadership, he believes passion is the key to success in
                            the culinary world and continues to draw inspiration from his mentors, global
                            experience, and meaningful connections with guests.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Section 6: Hero Dishes --}}
    <div class="hero-dishes">
        <div class="container">
            <!-- <div class="content-greeting text-center mb-5">
                <h3>Hero Dish(es)</h3>
            </div> -->
            <div class="row">
                <div class="col-md-6">
                    <div class="hero-dish-card">
                        <div class="content-greeting">
                            <h4>Ribeye Steak</h4>
                            <p>One of Chef Andika Adam's signature hero dishes is the <strong>Ribeye Steak</strong>,
                                a refined expression of comfort and technique. Perfectly grilled and richly
                                flavoured, the ribeye is served with Dijon potato purée, charred onion, dashi butter
                                mushrooms, soy beef reduction, peas, and herb oil. The dish reflects Chef Andika's
                                philosophy of balancing bold flavours with thoughtful composition, combining classic
                                Western elements with subtle Asian influences for a deeply satisfying and memorable
                                dining experience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="hero-dish-card">
                        <div class="content-greeting">
                            <h4>WHIM Fried Chicken</h4>
                            <p>A comforting yet elevated take on a classic favourite. Crispy, golden buttermilk-fried
                                chicken is paired with aromatic shichimi, zesty yuzu mayonnaise, fresh mixed herbs,
                                and a touch of black tobiko for added texture and depth. The result is a harmonious
                                balance of crunch, umami, and brightness, familiar, yet unmistakably refined,
                                reflecting Chef Andika Adam's modern approach to casual dining.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chope Modal --}}
    <div class="modal fade" id="modalchope" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-transparent">
                <div class="modal-header">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <iframe class="chope"
                        src="https://bookv5.chope.co/booking?rid=whim2208bal&source=rest_prasanabyarjaniresorts.com"
                        name="frame1" scrolling="auto" frameborder="no" align="center">
                    </iframe>
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
              $('.center-slider').slick({
                centerMode: true,
                centerPadding: '250px',
                slidesToShow: 1,
                infinite: true,
                arrows: true,
                dots: false,
                autoplay: true,
                autoplaySpeed: 3000,
                responsive: [{
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: false,
                        centerPadding: '0px',
                        slidesToShow: 1
                    }
                }]
            });
            $('.slide-dining-1').slick({
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
