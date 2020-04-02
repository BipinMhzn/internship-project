<aside class="nav nav-sidebar w-250 nav-fixed-left h-100" id="sidebar">
    <nav class="navbar sidebar-nav bg-white d-block p-0 w-100 h-100">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link sidebar-nav-item p-3 {{ Request::is('home') ? 'active':''}}" href="{{ url('home') }}">
                    <i class="fa fa-tachometer"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-nav-item p-3 {{ Request::is('women') ? 'active':'' || Request::is('women/*') ? 'active':'' }}" href="/women">
                    <i class="fa fa-line-chart"></i>Survey
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-nav-item p-3 {{ Request::is('event') ? 'active':'' || Request::is('event/*') ? 'active':'' }}" href="/event">
                    <i class="fa fa-calendar"></i>Events
                </a>
            </li>
            @if(Auth::user()->role == 1)
                <li class="nav-item">
                    <a class="nav-link sidebar-nav-item p-3 {{ Request::is('users') ? 'active':'' || Request::is('users/*') ? 'active':'' }}" href="/users">
                        <i class="fa fa-users" aria-hidden="true"></i>Users
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</aside>
