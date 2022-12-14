<header>
    <nav id="header" class="navbar navbar-expand-md fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand ms-3" href="{{ url('/') }}" title="Prasana by Arjani Resort" rel="home">
                <img id="logoimage" class="img-fluid" src="{{ '/img/whitelogo.svg' }}" alt="Prasana by Arjani Resort" />
            </a>
            <a href="https://www.book-secure.com/index.php?s=results&amp;property=idbal31631&amp;arrival=2022-08-22&amp;departure=2022-08-23&amp;adults1=2&amp;children1=0&amp;locale=en_GB&amp;currency=IDR&amp;stid=e3bukzedt&amp;arrivalDateValue=2022-08-22&amp;fromyear=2022&amp;frommonth=8&amp;fromday=22&amp;nbdays=2&amp;nbNightsValue=2&amp;redir=BIZ-so5523q0o4&amp;Clusternames=ASIAIDHTLPrasanaByAr&amp;rt=1661163722&amp;connectName=ASIAIDHTLPrasanaByAr&amp;cname=ASIAIDHTLPrasanaByAr&amp;Hotelnames=Asia-Id-Prasana-By-Arjani-Resorts&amp;hname=Asia-Id-Prasana-By-Arjani-Resorts&amp;cluster=ASIAIDHTLPrasanaByAr" target="_blank" class="btn btn-book-header-mobile d-block d-md-none">Book Now</a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false">
                <span id="burger1" class="icon-bar top-bar color-nav-white"></span>
                <span id="burger2" class="icon-bar middle-bar color-nav-white"></span>
                <span id="burger3" class="icon-bar bottom-bar color-nav-white"></span>
            </button>

            <div id="navbar" class="collapse navbar-collapse justify-content-end">
                <ul id="menu-header" class="navbar-nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) === null ? 'active' : null }}" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) === 'our-villa' ? 'active' : null }}" href="{{ url('/our-villa') }}">Our Villa</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ Request::segment(1) === 'dinings' ? 'active' : null }}" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Dining
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('/dinings') }}">Whim</a></li>
                            <li><a class="dropdown-item" href="{{ url('/dinings') }}#petit">Petit Garçon</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) === 'menaka-spa' ? 'active' : null }}" href="{{ url('/menaka-spa') }}">Menaka Spa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) === 'weddings' ? 'active' : null }}" href="{{ url('/weddings') }}">Wedding</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) === 'offers' ? 'active' : null }}" href="{{ url('/offers') }}">Offers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) === 'experience' ? 'active' : null }}" href="{{ url('/experience') }}">Experience</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) === 'gallery' ? 'active' : null }}" href="{{ url('/gallery') }}">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::segment(1) === 'contact-us' ? 'active' : null }}" href="{{ url('/contact-us') }}">Contact</a>
                    </li>
                </ul>
                <a href="https://www.book-secure.com/index.php?s=results&amp;property=idbal31631&amp;arrival=2022-08-22&amp;departure=2022-08-23&amp;adults1=2&amp;children1=0&amp;locale=en_GB&amp;currency=IDR&amp;stid=e3bukzedt&amp;arrivalDateValue=2022-08-22&amp;fromyear=2022&amp;frommonth=8&amp;fromday=22&amp;nbdays=2&amp;nbNightsValue=2&amp;redir=BIZ-so5523q0o4&amp;Clusternames=ASIAIDHTLPrasanaByAr&amp;rt=1661163722&amp;connectName=ASIAIDHTLPrasanaByAr&amp;cname=ASIAIDHTLPrasanaByAr&amp;Hotelnames=Asia-Id-Prasana-By-Arjani-Resorts&amp;hname=Asia-Id-Prasana-By-Arjani-Resorts&amp;cluster=ASIAIDHTLPrasanaByAr" target="_blank" class="btn btn-book-header  me-3 d-none d-md-block">Book Now</a>
            </div>
        </div>
    </nav>
</header>
<a href="https://api.whatsapp.com/send?phone={{$settings->wa_number}}&text={{$settings->wa_message}}" class="float" target="_blank">
    <img src="{{ '/img/wa.svg' }}">
</a>
