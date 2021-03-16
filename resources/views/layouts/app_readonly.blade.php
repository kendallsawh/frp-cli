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
    <style type="text/css">
        .blink_me {
          animation: blinker 2.5s linear infinite;
      }

      @keyframes blinker {
          50% {
            opacity: 0;
        }
    }
    </style>

</head>
<body class="{{session('view')}}">
    <div class="wrapper" id="app">
        @include('layouts.sidebar')

        <div class="main-panel" id="main-panel">
          

            <div class="content">
                <div class="container-fluid main_content">
                    @if(Carbon\Carbon::parse('02-06-2020')== Carbon\Carbon::today())
                    <div class="row">
                        <div class="col-md-12 text-center blink_me">
                            <h3><strong>This application will be unavailable from 2:30pm today to facilitate necessary updates. Service will resume to normal on the 3rd june 2020</strong></h3>
                            <h5><small>If you require access to this application after the above time please contact Kendall in the Head office IT Department</small></h5>
                        </div>
                    </div>
                    @endif
                    @yield('content')
                    @include('layouts.footer')
                </div>
            </div>

            
        </div>
    </div>



    <!-- Scripts -->
    @include('layouts.js')
    @yield('scripts')
    
    <!-- when tried to do online card -->
    <!--
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
    <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.list_table').DataTable({
                "pagingType": "simple_numbers",
                
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search",
                }

            });

            //alert('hello');
           


        });
        

        $('[data-toggle="tooltip"]').tooltip();

        // set active navbar item
        

        // flashed error notification
        @if (session('flashed'))
            error(session('flashed'));
        @endif

        // flashed success notification
        @if (session('success'))
            success(session('success'));
        @endif

        function success(msg) {
            $.notify({
                icon: "notifications",
                message: msg

            },{
                type: 'success',
                timer: 3000,
                placement: {
                    from: 'top',
                    align: 'center'
                }
            });
        }

        function error(msg) {
            $.notify({
                icon: "warning",
                message: msg

            },{
                type: 'danger',
                timer: 3000,
                placement: {
                    from: 'top',
                    align: 'center'
                }
            });
        }

        
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });


        

       
    </script>
</body>
</html>
