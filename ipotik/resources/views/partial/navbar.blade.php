<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
    <div class="container container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="" srcset=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link text-dark {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="{{ route('index') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark {{ Request::is('post*') ? 'active' : '' }}" href="{{ route('post.index') }}">Artikel</a>
                </li>
                @if (Auth::check() && Auth::user()->role == 'user')
                    <li class="nav-item">
                        <a class="nav-link text-dark {{ Request::is('transaction*') ? 'active' : '' }}" href="{{ route('transaction.index') }}">Status</a>
                    </li>
                @endif
            </ul>
            <div class="d-flex d-sm-inline">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    @if (Auth::check())
                        @if (Auth::user()->role == 'user')
                            <li class="nav-item me-3">
                                <a class="nav-link text-dark" href="{{ route('cart.index') }}"><i class="fa-solid fa-cart-shopping"></i></a>
                            </li>
                        @endif
                        <div class="dropdown text-end align-self-center me-3">
                            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('storage/'.Auth::user()->photo) }}" alt="mdo" width="32" height="32" class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item" href="#">Hi, {{ strtok(Auth::user()->name, " ") }}!</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('user.edit') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <li><button class="dropdown-item" href="#" role="button" type="submit">Sign out</button></li>
                                </form>
                            </ul>
                        </div>
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>