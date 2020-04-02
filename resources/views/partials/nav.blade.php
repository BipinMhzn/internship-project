<header class="fixed-top">
    <nav class="nav navbar navbar-expand col-light px-0 bg-white">
        <div class="w-250 d-flex px-2 align-items-center">
            <a href="javascript:void(0);" class="nav-toggle">
                <i class="fa fa-bars"></i>
            </a>
            <figure class="brand ml-3 mb-0">
                <h2>WYESHR</h2>
            </figure>

        </div>
        <div class="d-flex align-items-center justify-content-end ml-auto mr-4">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @else
                <div class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle user-image rounded-circle my-0 ml-5 mx-4 text-center d-inline-block" id="dropdown-user-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu shadow border-0 rounded-0 text-right" aria-labelledby="dropdown-user-menu">
                        <a class="dropdown-item" href="/profile">
                            <i class="fa fa-user"></i> <span>Profile</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logout-modal"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i> <span> {{ __('Logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </nav>
</header>
