<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                <i class="fa fa-caret-left  visible-on-sidebar-regular" aria-hidden="true"></i>
                <i class="fa fa-bars  visible-on-sidebar-mini" aria-hidden="true"></i>
            </button>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand"><a href="{{ url('/') }}">{{config('app.name')}}</a></span>
        </div>
        <div class="collapse navbar-collapse">

           

            

            <ul class="nav navbar-nav navbar-right">
                <li class="hide">
                    <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-tachometer" aria-hidden="true"></i>
                        <p class="hidden-lg hidden-md">Dashboard</p>
                    </a>
                </li>
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    
                @endif
                <li class="separator hidden-lg hidden-md"></li>
            </ul>
        </div>
    </div>
</nav>