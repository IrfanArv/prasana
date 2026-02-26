<div class="container pt-5">
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
        <div class="col-md-8">
            <div class="subscribe-title">
                Don’t miss our update.
                Subscribe us for more info
            </div>
            <form class="row form-subscribe">
                <div class="col-md-8">
                    <input type="text" class="form-control" id="subscribe" placeholder="Enter your email address">
                </div>
                <div class="col-md-4 mt-md-0 mt-3">
                    <button type="submit" class="btn btn-subscribe mb-3">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</div>
<footer>
    <div class="footer-bottom footer mt-auto py-3 bg-white text-center">
        <p>© {{ now()->year }} Prasana by Arjani Resort. All Rights Reserved
        </p>
    </div>
</footer>
