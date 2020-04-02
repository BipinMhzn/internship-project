@include('partials.head')

@if (Auth::user())
    @if (Auth::user())
        @include('partials.nav')
        @include('partials.sidebar')
    @endif
    @yield('content')
@else
    @yield('content')
@endif

@include('partials.foot')
