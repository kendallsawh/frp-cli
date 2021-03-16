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
            @include('layouts.navigation')

            <div class="content">
                <div class="container-fluid main_content">
                    
                    @yield('content')
                    @include('layouts.footer')
                </div>
            </div>

            
        </div>
    </div>

    <!-- loading modal - just add class 'submit' to button -->
    @include('common.loading_modal')
    @include('common.loading_modal_alt')

    <!-- Scripts -->
    @include('layouts.js')
    @yield('scripts')

   
    <script type="text/javascript">

        /*------------------------------------------*/

        $('[data-toggle="tooltip"]').tooltip();

        // set active navbar item
        @if (isset($nav)) 
            @foreach($nav as $n)
                $('#{{ $n }}').addClass('active');
            @endforeach
        @else
            $("#@yield('nav')").addClass('active'); 
        @endif

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

        

        // sidebar view **********************************************************/
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $(document).on('click', '#minimizeSidebar', function(){
            $.get("{{route('setSidebarMini')}}");
        });
        //************************************************************************/

        // Global Site Tag (gtag.js) - Google Analytics
       /* window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments)};
        gtag('js', new Date());

        gtag('config', 'UA-70106258-6');*/
        $(document).ready(function() {
                
        $('#ind_link').click(function(event){
            event.preventDefault()
            $('.fr-dashboard').detach()
            $("li[id^='nav-']").removeClass('active')
            $.ajax({

                    type : 'get',

                    url : '{{URL::to('/individual/a_list')}}',

                    success:function(data){

                            //console.log(data);
                            if(data){

                              $('.main_content').html(data);

                          }


                      }

            });
        });


        $('#fmr_link').click(function(event){
            event.preventDefault()
            $('.fr-dashboard').detach()
            $("li[id^='nav-']").removeClass('active')
            $.ajax({

                    type : 'get',

                    url : '{{URL::to('/farmer/list')}}',

                    success:function(data){

                            //console.log(data);
                            if(data){

                              $('.main_content').html(data);

                          }


                      }

            });
        });
        
        });
        
    </script>
</body>
</html>
