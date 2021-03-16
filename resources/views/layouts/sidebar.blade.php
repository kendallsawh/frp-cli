@if (Auth::guest())
<div class="sidebar" data-active-color="{{config('global.colour')}}" data-background-color="white">
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
    </div>
</div>
@else
<div class="sidebar" data-active-color="{{config('global.colour')}}" data-background-color="white">
    <div class="logo">
        <a href="{{url('/changePassword')}}" class="simple-text">
            {!! Auth::user()? Auth::user()->name : 'Default User' !!}
        </a>
    </div>
    <div class="logo logo-mini text-center">
        <a href="{{url('/')}}" style="font-size: smaller;">
            
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="{{asset('/img/coat_of_arms.png')}}" alt="Coat of Arms"/>
            </div>
            <div class="info">
                <a href="{{url('http://agriculture.gov.tt')}}">
                    Ministry of Agriculture, Land &amp; Fisheries
                </a>
            </div>
        </div>
        <ul class="nav">
            
            @if(Auth::user())
            <li id="nav-dash" class="loading-modal">
                <a href="{{route('home')}}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            @if(Auth::user())
                <li id="nav-funct">
                    <a data-toggle="collapse" href="#collapse-funct">
                        <i class="fa fa-leaf" aria-hidden="true"></i>
                        <p>
                            Farmers
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{isset($navFunctIn) && !session()->has('view')? $navFunctIn : ''}} " id="collapse-funct">
                        <ul class="nav">
                            <li id="nav-funct-1" class="loading-modal">
                                <a href="{{route('farmerRegister')}}">Farmer Registration</a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                <li id="nav-appl">
                    <a data-toggle="collapse" href="#collapse-appl">
                        <i class="fa fa-file-text" aria-hidden="true"></i>
                        <p>
                            Farmer Applications
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class=" {{isset($navApplIn) && !session()->has('view')? $navApplIn : ''}} loading-modal" id="collapse-appl">
                        <ul class="nav">
                            @if(\Auth::user()->userapplication)
                            <li id="nav-appl-1">
                                <a href="{{url('/application/view/'.\Auth::user()->userapplication->application_id)}}">Your Application</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                
            @endif
            
            @endif
        </ul>
    </div>
</div>
@endif

