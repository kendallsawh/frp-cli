
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" type="image/png" href="{{url('/img/coat_of_arms.png')}}" />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if(isset($title))
        {{ $title }}
        @else
        {{ config('app.name', 'Laravel') }}
        @endif
    </title>

    <!-- Styles -->
    @include('layouts.css')

    <link href="{{ asset('css/material-kit.min3f71.css') }}" rel="stylesheet" />

</head>

<body class="login-page">
    <div class="wizard-card" data-color="{{config('global.colour')}}">
        <div class="page-header header-filter" style="background-image: url('img/16-9-Blurred-Background-15.jpg'); background-size: cover; background-position: top center;">
            <div class="container">
                <div class="row" style="margin-top: -110px;">
                    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                        <div class="text-center">
                            <img class="login-ico" src="img/coat_of_arms.png" alt="Coat of Arms">
                        </div>
                        <div class="card card-signup  data-color="{{config('global.colour')}}">
                            <form id="farm_lg" class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}


                                <div class="header header-success text-center">
                                    <h4 class="card-title">Log In</h4>
                                </div>
                                <div class="card-content">

                                    
                                    @if ($errors->has('username'))
                                        <span class="help-block text-danger text-center" style="font-size: large; margin-bottom: 0;">
                                            <strong><small>{{ $errors->first('username') }}</small></strong>
                                        </span>
                                    @endif

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">face</i>
                                        </span>
                                        <div class="form-group is-empty">

                                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" autofocus placeholder="username">

                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                        <div class="form-group is-empty">
                                            <input id="password" type="password" class="form-control" name="password" required placeholder="password">

                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                             @if ($errors->has('validate'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('validate') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>

                                    <div class="footer text-center">
                                        <!-- <a href="#pablo" class="btn btn-success btn-simple btn-wd btn-lg">Login</a> -->
                                        <button style="z-index: 8;" type="submit" class="btn btn-success loading-modal" form="farm_lg">
                                            Login
                                        </button>

                                        <a class="btn btn-link
                                        " href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>

                                        <a class="btn btn-link btn-info" href="{{ route('register') }}">Register</a>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container">
                    <div class="copyright text-center">
                        <h4>Ministry of Agriculture, Land and Fisheries</h4>
                    </div>
                </div>
            </footer>

        </div>
    </div>

</body>
</html>
@include('common.loading_modal')
@include('layouts.js')


