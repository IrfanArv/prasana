<div class="site-footer">
    <div class="container py-5">
        <div class="row g-4">
            {{-- Left: Google Maps --}}
            <div class="col-lg-7 col-md-12">
                <div class="footer-map">
                 
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3942.482639847479!2d115.1423772!3d-8.8345757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd25b208e23461d%3A0x7abf5c9792539b46!2sPrasana%20Villas%20by%20Arjani%20Resorts!5e0!3m2!1sen!2sid!4v1774581129110!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            {{-- Right: Footer Content --}}
            <div class="col-lg-5 col-md-12">
                <div class="footer-content">
                    {{-- Subscribe Section --}}
                    <div class="footer-subscribe-section">
                        <p class="footer-subscribe-label">SIGN UP FOR EXCLUSIVE OFFERS AND NEWS</p>
                        <form class="footer-subscribe-form">
                            <input type="email" class="footer-subscribe-input" placeholder="Email Address">
                            <button type="submit" class="footer-subscribe-btn">SUBSCRIBE</button>
                        </form>
                    </div>

                    {{-- Address Section --}}
                    <div class="footer-info-section">
                        <h4 class="footer-brand-name">Prasana by Arjani Resorts Official</h4>
                        <p class="footer-brand-tagline">A Secluded Haven in Bali</p>

                        <div class="footer-address">
                            <p>{!! $settings->address !!}</p>
                        </div>
                        <div class="footer-contact-info">
                            <p>T. {!! $settings->phone !!}</p>
                            <p>E. {!! $settings->email !!}</p>
                        </div>
                    </div>

                    {{-- Social & Badges --}}
                    <div class="footer-social-section">
                        <p class="footer-follow-label">Follow Us</p>
                        <div class="footer-social-row">
                            <div class="footer-social-icons">
                                <a href="{!! $settings->facebook !!}" target="_blank" rel="noopener noreferrer" class="footer-social-link">
                                    <img src="{{ asset('/img/fb.svg') }}" alt="Facebook">
                                </a>
                                <a href="{!! $settings->instagram !!}" target="_blank" rel="noopener noreferrer" class="footer-social-link">
                                    <img src="{{ asset('/img/ig.svg') }}" alt="Instagram">
                                </a>
                                <a href="{!! $settings->gplus !!}" target="_blank" rel="noopener noreferrer" class="footer-social-link">
                                    <img src="{{ asset('/img/gp.svg') }}" alt="Google">
                                </a>
                            </div>
                            <div class="footer-badges">
                                {{-- Google Review badge placeholder --}}
                                <div class="footer-badge-item" id="footer-google-review">
                                    <a href="https://www.google.com/travel/search?q=prasana%20by%20arjani%20resort%20google%20reviews&g2lb=2502548%2C2503771%2C2503781%2C4258168%2C4270442%2C4284970%2C4291517%2C4306835%2C4597339%2C4757164%2C4814050%2C4850738%2C4864715%2C4874190%2C4886480%2C4893075%2C4920132%2C4924070%2C4965990%2C4985712%2C4990494%2C72248281%2C72256471%2C72271034%2C72271797%2C72272556%2C72276044%2C72280387%2C72281254&hl=en-SG&gl=sg&ssta=1&ts=CAEaGhIYEhIKBwjqDxADGB0SBwjqDxADGB4yAggAKgcKBToDSURS&qs=CAAgACgAMidDaGtJeHJiT2t2bVMxOTk2R2cwdlp5OHhNV0ozTlhaaWFGOWlFQUVIAA&ap=KigKEgnNPzyDsKshwBGObAKwFslcQBISCfha3X_qqiHAEY5sgroiyVxAMAC6AQdyZXZpZXdz&ictx=1&sa=X" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset('/img/google-reviews-logo2.png') }}" alt="Google Reviews">
                                    </a>
                                </div>
                                <div class="footer-badge-item" id="footer-tripadvisor">
                                    <a href="https://www.tripadvisor.com.sg/Hotel_Review-g1219108-d9623334-Reviews-Prasana_Villas_By_Arjani_Resorts-Ungasan_Bukit_Peninsula_Bali.html?m=19905" target="_blank" rel="noopener noreferrer">
                                        <img src="{{ asset('/img/tripadvisor-logo.png') }}" alt="TripAdvisor">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <footer>
    <div class="footer-bottom footer mt-auto py-3 bg-white text-center">
        <p>© {{ now()->year }} Prasana by Arjani Resort. All Rights Reserved
        </p>
    </div>
</footer> -->
