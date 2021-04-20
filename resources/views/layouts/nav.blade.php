<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand mb-0" href="{{ route('home') }}">Timetable</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navber">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
        @if (Auth::check())
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{ \Request::route()->getName() === 'home' ? 'active' : '' }}"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ \Request::route()->getName() === 'incidents' ? 'active' : '' }}"
                        href="{{ route('incidents') }}">Incidents</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ \Request::route()->getName() === 'incident-statuses' ? 'active' : '' }}"
                        href="{{ route('incident-statuses') }}">Incident Statuses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ \Request::route()->getName() === 'totals' ? 'active' : '' }}"
                        href="{{ route('totals', ['scope' => 'day']) }}">Totals</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ \Request::route()->getName() === 'charts' ? 'active' : '' }}"
                        href="{{ route('charts') }}">Charts</a>
                </li> --}}
            </ul>
        @endif
        
        <ul class="navbar-nav ml-auto">
            <span class="navbar-text">
                Week {{ (new DateTime())->format('W') }} &nbsp;|
            </span>

            @if (Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('user/contacts') }}">Contacts</a>
                        <a class="dropdown-item" href="{{ route('user/settings') }}">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log
                            out</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link {{ \Request::route()->getName() === 'login' ? 'active' : '' }}"
                        href="{{ route('login') }}">
                        Log in
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
