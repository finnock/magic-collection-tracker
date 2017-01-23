<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><i class="ss ss-zen" style="font-size: 30px;"></i>&nbsp;MCT</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" style="margin-right: 80px;">

                <li class="{{ isActive('Set*') }}"><a href="{{ url('Set') }}">Set</a></li>

                <li class="{{ isActive('Collection*') }} dropdown">
                    <a href="/Collection" class="dropdown-toggle" data-toggle="dropdown" role="button">Collection <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ isActive('Collection') }}"><a href="{{ url('/Collection') }}">Show</a></li>
                        <li class="{{ isActive('Collection/Add') }}"><a href="{{ url('/Collection/Add') }}">Add</a></li>
                    </ul>
                </li>

            </ul>


            <div class="nav navbar-nav">
                <div class="navbar-form navbar-left">

                </div>
                <ul class="nav navbar-nav">
                    <li class="{{ isActive('Collection*') }} dropdown">
                        <a href="/Collection" class="dropdown-toggle" data-toggle="dropdown" role="button">Sort <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="padding: 0;">
                            <div class="dropdown-btn-menu">
                                <li><a class="btn btn-sm btn-default" @click="sortFunction = 'sf_sortNumberUp'">Number</a></li>
                                <li><a class="btn btn-sm btn-default" @click="sortFunction = 'sf_sortCmcUp'">Converted Mana Cost</a></li>
                                <li><a class="btn btn-sm btn-default" @click="sortFunction = 'sf_sortColor'">Color</a></li>
                                <li><a class="btn btn-sm btn-default" @click="">Power</a></li>
                                <li><a class="btn btn-sm btn-default" @click="">Toughness</a></li>
                            </div>
                            <div class="dropdown-pill-menu">
                                <div class="img-rounded filter-pill">Color <i class="fa fa-times"></i></div>
                                <div class="img-rounded filter-pill">CMC <i class="fa fa-times"></i></div>
                                <div class="img-rounded filter-pill">Default: Name</i></div>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>


            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li class="{{ isActive('login') }}"><a href="{{ url('/login') }}">Login</a></li>
                    <li class="{{ isActive('register') }}"><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>


        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
