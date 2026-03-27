@extends('layouts.app')
@section('meta_title', $settings->meta_title)
@section('meta_desc', $settings->meta_description)
@section('meta_keyword', $settings->meta_keyword)
@section('title', 'Gallery - ')
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

    <div class="container mt-md-5 mb-5">
        <div class="masonry-gallery">
            @foreach ($gallery as $item)
                @foreach ($item->getMedia('photo') as $media)
                    <div class="masonry-item">
                        <img src="{{ asset($media->getUrl()) }}" alt="{{ $item->title }}" class="img-fluid" loading="lazy">
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>

    {{-- Lightbox --}}
    <div class="gallery-lightbox" id="galleryLightbox">
        <button class="lightbox-close" id="lightboxClose" aria-label="Close">&times;</button>
        <button class="lightbox-arrow lightbox-prev" id="lightboxPrev" aria-label="Previous">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="lightbox-arrow lightbox-next" id="lightboxNext" aria-label="Next">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="lightbox-content">
            <img src="" alt="" id="lightboxImage">
        </div>
        <div class="lightbox-counter" id="lightboxCounter"></div>
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
            // Lightbox
            var galleryImages = [];
            var currentIndex = 0;

            function buildImageGallery(selector) {
                galleryImages = [];
                $(selector).each(function() {
                    galleryImages.push($(this).attr('src'));
                });
            }

            $('.masonry-gallery').on('click', '.masonry-item img', function() {
                buildImageGallery('.masonry-item img');
                var src = $(this).attr('src');
                currentIndex = galleryImages.indexOf(src);
                showLightbox(currentIndex);
            });

            function showLightbox(index) {
                if (index < 0 || index >= galleryImages.length) return;
                currentIndex = index;
                $('#lightboxImage').attr('src', galleryImages[currentIndex]);
                $('#lightboxCounter').text((currentIndex + 1) + ' / ' + galleryImages.length);
                $('#galleryLightbox').addClass('active');
                $('body').css('overflow', 'hidden');
            }

            function closeLightbox() {
                $('#galleryLightbox').removeClass('active');
                $('body').css('overflow', '');
            }

            $('#lightboxClose').on('click', closeLightbox);
            $('#lightboxPrev').on('click', function() {
                showLightbox((currentIndex - 1 + galleryImages.length) % galleryImages.length);
            });
            $('#lightboxNext').on('click', function() {
                showLightbox((currentIndex + 1) % galleryImages.length);
            });

            // Close on backdrop click
            $('#galleryLightbox').on('click', function(e) {
                if ($(e.target).is('#galleryLightbox') || $(e.target).is('.lightbox-content')) {
                    closeLightbox();
                }
            });

            // Keyboard nav
            $(document).on('keydown', function(e) {
                if (!$('#galleryLightbox').hasClass('active')) return;
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowLeft') $('#lightboxPrev').click();
                if (e.key === 'ArrowRight') $('#lightboxNext').click();
            });
        });
    </script>
@endpush
