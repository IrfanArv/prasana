<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{url('/')}}" target="_blank"><i class="ficon feather icon-monitor"></i></a></li>
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                            href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span
                                    class="user-name text-bold-600">{{ Auth::user()->name }}</span>
                                    <span class="user-status">
                                        {{ Auth::user()->email }}
                                    </span>
                            </div>
                            <span>
                                @if(Auth::user()->image)
                                <img id="preview" class="img-40 rounded-circle" height="40" width="40" src="{{ ('/img/user/'.Auth::user()->image) }}" alt="{{ Auth::user()->name }}">
                                @else
					 <img id="preview"
                                        src="https://api.dicebear.com/9.x/initials/svg?seed={{ Auth::user()->name }}"
                                        class="img-40 rounded-circle" height="40" width="40">
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <i class="feather icon-power"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
