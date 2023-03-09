<nav class="navbar navbar-expand-lg sticky-top" style="backdrop-filter: blur(5px)">
    <div class="container">
        <a class="navbar-brand fw-semibold" href="{{ route('index') }}">
            <img src="{{ asset('logo.png') }}" alt="Logo" height="24">
            Notes App
        </a>
        @guest
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-dark text-white px-4" href="{{ route('login') }}">Login</a>
                </li>
            </ul>
        @endguest
        @auth
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @if (auth()->user()->nim !== env('ADMIN_USERNAME'))
                        <li class="nav-item">
                            <a class="nav-link @if (app('request')->route()->getName() == 'posts.create') active @endif"
                                href="{{ route('posts.create') }}">Create Note</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link @if (app('request')->route()->getName() == 'posts.index') active @endif"
                            href="{{ route('posts.index') }}">Explore Notes</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Hi, {{ auth()->user()->nickname }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('personal') }}">My Notes</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        @endauth
    </div>
</nav>
