<style>
    header nav {
        padding: 15px 100px !important;
    }
</style>
<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand font-weight-bold" href="/">
            <img src="{{ asset('assets/img/logo-rumah.png') }}" alt="" width="50" height="50"
                style="object-fit: contain;">
            PT PRIMA INTI NUSA
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#marketing">House</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/#about">About</a>
                </li>
            </ul>
            <div class="form-inline mt-2 mt-md-0">
                @if (Route::has('login'))
                    <div class="p-6 text-right z-10">
                        @auth
                            <a href="{{ url('/home') }}" class="">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>
</header>
