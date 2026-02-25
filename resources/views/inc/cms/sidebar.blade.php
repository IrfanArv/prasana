<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ url('/dashboard') }}">
                    <div class="brand-logo"></div>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
                        class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary"
                        data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ Request::segment(2) === null ? 'active' : null }} nav-item"><a
                    href="{{ url('/dashboard') }}"><i class="feather icon-home"></i><span class="menu-title"
                        data-i18n="Dashboard">Dashboard</span></a>
            </li>
            @can('villa-list')
                <li
                    class="nav-item has-sub {{ Request::segment(2) === 'villas' ? 'active' : null }} {{ Request::segment(2) === 'villa' ? 'active' : null }}">
                    <a href="#"><i class="feather icon-package"></i><span class="menu-title">Villas</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::segment(2) === 'villa' ? 'active' : null }}"><a
                                href="{{ url('/dashboard/villa') }}"><i></i><span class="menu-item">Villa</span></a>
                        </li>
                        <li class="{{ Request::segment(3) === 'room-feature' ? 'active' : null }}"><a
                                href="{{ url('/dashboard/villas/room-feature') }}"><i></i><span class="menu-item">Room
                                    Feature</span></a>
                        </li>
                        <li class="{{ Request::segment(3) === 'room-service' ? 'active' : null }}"><a
                                href="{{ url('/dashboard/villas/room-service') }}"><i></i><span class="menu-item">Room
                                    Services</span></a>
                        </li>
                    </ul>
                </li>
            @endcan
            {{-- @can('pages')
                <li class="nav-item has-sub">
                    <a href="#"><i class="feather icon-layout"></i><span class="menu-title">Pages</span></a>
                    <ul class="menu-content">
                        <li class=""><a href="#"><i></i><span class="menu-item">Home Pages</span></a>
                        </li>
                        <li class=""><a href="#"><i></i><span class="menu-item">Our Villa
                                    Pages</span></a>
                        </li>
                        <li class=""><a href="#"><i></i><span class="menu-item">Dinings
                                    Pages</span></a>
                        </li>
                        <li class=""><a href="#"><i></i><span class="menu-item">Menka SPA
                                    Pages</span></a>
                        </li>
                        <li class=""><a href="#"><i></i><span class="menu-item">Wedding
                                    Pages</span></a>
                        </li>
                        <li class=""><a href="#"><i></i><span class="menu-item">Offers Pages</span></a>
                        </li>
                        <li class=""><a href="#"><i></i><span class="menu-item">Experience
                                    Pages</span></a>
                        </li>
                        <li class=""><a href="#"><i></i><span class="menu-item">Gallery
                                    Pages</span></a>
                        </li>
                        <li class=""><a href="#"><i></i><span class="menu-item">Contact
                                    Pages</span></a>
                        </li>

                    </ul>
                </li>
            @endcan --}}
            @can('dining')
                <li class=" nav-item {{ Request::segment(2) === 'dining' ? 'active' : null }}"><a
                        href="{{ url('/dashboard/dining') }}"><i class="feather icon-moon"></i><span
                            class="menu-title">Dining</span></a>
                </li>
            @endcan
            @can('experience')
                <li class=" nav-item {{ Request::segment(2) === 'experience' ? 'active' : null }}"><a
                        href="{{ url('/dashboard/experience') }}"><i class="feather icon-wind"></i><span
                            class="menu-title">Experience</span></a>
                </li>
            @endcan
            @can('wedding-offers')
                <li class=" nav-item {{ Request::segment(2) === 'wedding' ? 'active' : null }}"><a
                        href="{{ url('/dashboard/wedding') }}"><i class="feather icon-heart"></i><span
                            class="menu-title">Wedding</span></a>
                </li>
                <li class=" nav-item {{ Request::segment(2) === 'offers' ? 'active' : null }}"><a
                        href="{{ url('/dashboard/offers') }}"><i class="feather icon-sun"></i><span
                            class="menu-title">Offers</span></a>
                </li>
            @endcan
            @can('gallery')
                <li class=" nav-item {{ Request::segment(2) === 'gallery' ? 'active' : null }}"><a
                        href="{{ url('/dashboard/gallery') }}"><i class="feather icon-camera"></i><span
                            class="menu-title">Gallery</span></a>
                </li>
            @endcan
            @can('ratings')
            <li class=" nav-item {{ Request::segment(2) === 'reviews' ? 'active' : null }}"><a
                    href="{{ url('/dashboard/reviews') }}"><i class="feather icon-star"></i><span
                        class="menu-title">Reviews</span></a>
            </li>
            @endcan
            @can('promotions')
            <li class=" nav-item {{ Request::segment(2) === 'promotions' ? 'active' : null }}"><a
                    href="{{ url('/dashboard/promotions') }}"><i class="feather icon-flag"></i><span
                        class="menu-title">Promotions</span></a>
            </li>
            @endcan

            <li
                class="nav-item has-sub {{ Request::segment(2) === 'blog' ? 'active' : null }} {{ Request::segment(2) === 'blog-category' ? 'active' : null }} {{ Request::segment(2) === 'blog-tag' ? 'active' : null }}">
                <a href="#"><i class="feather icon-edit"></i><span class="menu-title">Blog</span></a>
                <ul class="menu-content">
                    <li class="{{ Request::segment(2) === 'blog' ? 'active' : null }}"><a
                            href="{{ url('/dashboard/blog') }}"><i></i><span class="menu-item">Blog Posts</span></a>
                    </li>
                    <li class="{{ Request::segment(2) === 'blog-category' ? 'active' : null }}"><a
                            href="{{ url('/dashboard/blog-category') }}"><i></i><span class="menu-item">Categories</span></a>
                    </li>
                    <li class="{{ Request::segment(2) === 'blog-tag' ? 'active' : null }}"><a
                            href="{{ url('/dashboard/blog-tag') }}"><i></i><span class="menu-item">Tags</span></a>
                    </li>
                </ul>
            </li>

            @can('users-list')
                <li
                    class="nav-item has-sub {{ Request::segment(2) === 'roles' ? 'active' : null }} {{ Request::segment(2) === 'users' ? 'active' : null }}">
                    <a href="#"><i class="feather icon-users"></i><span class="menu-title">Accounts</span></a>
                    <ul class="menu-content">
                        @can('users-list')
                            <li class="{{ Request::segment(2) === 'users' ? 'active' : null }}"><a
                                    href="{{ url('/dashboard/users') }}"><i></i><span class="menu-item">Users</span></a>
                            </li>
                        @endcan
                        @can('role-list')
                            <li class="{{ Request::segment(2) === 'roles' ? 'active' : null }}"><a
                                    href="{{ url('/dashboard/roles') }}"><i></i><span class="menu-item">Roles</span></a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('settings')
                <li class=" nav-item {{ Request::segment(2) === 'settings' ? 'active' : null }}"><a
                        href="{{ url('/dashboard/settings') }}"><i class="feather icon-sliders"></i><span
                            class="menu-title">Settings</span></a>
                </li>
            @endcan
            <li class=" nav-item {{ Request::segment(2) === 'sliders' ? 'active' : null }}"><a
                    href="{{ url('/dashboard/sliders') }}"><i class="feather icon-image"></i><span
                        class="menu-title">Page Sliders</span></a>
            </li>
        </ul>
    </div>
</div>
