<ul class="navbar-nav ms-auto">
    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">About</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>

    @if(isset($user))
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/profile') }}">
                Welcome, {{ $user->name }}
            </a>
        </li>
    @endif
</ul>
