<div class="container pt-5">
    <div class="row align-items-center">
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
                            rel="noopener noreferrer"> <img src="{{ asset('/img/fb.svg') }}" class="img-fluid"
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
        <div class="col-md-4 d-flex align-items-center justify-content-center">
            <div class="review-badges p-md-0 p-4 text-center w-100">
                <div class="title mb-3">
                    Our Reviews
                </div>
                <div class="d-flex flex-row align-items-center justify-content-center gap-3">
                    <div class="badge-item">
                        <a href="https://www.google.com/search?q=prasana+by+arjani+resorts&oq=prasana+by+&gs_lcrp=EgZjaHJvbWUqDggAEEUYJxg7GIAEGIoFMg4IABBFGCcYOxiABBiKBTIGCAEQRRg5MgcIAhAAGIAEMgcIAxAAGIAEMgcIBBAAGIAEMgYIBRBFGEEyBggGEEUYPDIGCAcQRRg80gEIMjM0NmowajeoAgCwAgA&sourceid=chrome&ie=UTF-8"
                           target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('/img/google-review.png') }}" class="img-fluid" alt="Google 4.7 Star Rating"
                                style="max-width: 140px; max-height: 70px; object-fit: contain;">
                        </a>
                    </div>
                    <div class="badge-item">
                        <a href="https://www.tripadvisor.com.au/Hotel_Review-g1219108-d9623334-Reviews-Prasana_Villas_By_Arjani_Resorts-Ungasan_Bukit_Peninsula_Bali.html"
                           target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('/img/tripadvisor-award.png') }}" class="img-fluid"
                                alt="Tripadvisor Travellers Choice Awards Best of the Best 2026"
                                style="max-width: 100px; max-height: 100px; object-fit: contain;">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-md-0 p-4">
                <div class="subscribe-title" style="font-size: 1.25rem; line-height: 1.6; margin-left: 0; margin-bottom: 1.5rem;">
                    Don’t miss our update.<br>Subscribe us for more info
                </div>
                <form class="form-subscribe" style="margin-left: 0;">
                    <input type="text" class="form-control mb-3" id="subscribe" placeholder="Enter your email address">
                    <button type="submit" class="btn btn-subscribe mb-3">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="footer-bottom footer mt-auto py-3 bg-white text-center">
        <p>© {{ now()->year }} Prasana by Arjani Resort. All Rights Reserved
        </p>
    </div>
</footer>
