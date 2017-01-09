<nav class="navbar navbar-toggleable-md navbar-inverse bg-faded">
    <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">MCT</a>

        <div class="collapse navbar-collapse">
            <div class="navbar-nav mr-auto">
                <a class="nav-item nav-link" href="/Set">Sets</a>
                <a class="nav-item nav-link" href="{{ url('/Collection') }}">Collection</a>
            </div>
            <div class="navbar-nav">
                @if (Auth::guest())
                    <a class="nav-item nav-link" href="{{ url('/login') }}">Login</a>
                    <a class="nav-item nav-link" href="{{ url('/register') }}">Register</a>
                @else
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('/Collection/Add') }}">Add Card</a>
                            <a class="dropdown-item" href="{{ url('/Collection') }}">Collection</a>
                            <a class="dropdown-item" href="{{ url('/logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                @endif
                <a class="nav-item nav-link" href="http://mct.dev/Card/3714ede267ffcc09c389c166282a5ad95e84e993">Test Card</a>
            </div>
        </div>
    </div>
</nav>
