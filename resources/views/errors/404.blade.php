<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

</head>
<body class="{{session('view')}}">
    <div class="wrapper" id="app">
        @include('layouts.sidebar')

        <div class="main-panel" id="main-panel">

            <div class="content">
                <div class="container-fluid">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-primary panel-white" style="padding-bottom: 20px; background-color: white;">
                            <div class="content">
                                <div class="row">
                                    <h1 class="text-center">Are you lost?</h1>
                                    <div class="col-md-6 col-md-offset-3">
                                        <img src="{{ url('/img/lost.jpeg') }}" alt="Are you lost?" class="img-responsive">
                                    </div>
                                    <div class="col-md-12 text-center" style="padding: 20px">
                                        <p>
                                            <a href="{{ url('/') }}" class="btn btn-default"><i class="fa fa-home" aria-hidden="true"></i> Click Here</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('layouts.footer')
        </div>
    </div>

    <!-- Scripts -->
    @include('layouts.js')
    @yield('scripts')
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-70106258-6"></script>

    <script type="text/javascript">
        // Global Site Tag (gtag.js) - Google Analytics
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments)};
        gtag('js', new Date());

        gtag('config', 'UA-70106258-6');

        
    </script>
</body>
</html>
