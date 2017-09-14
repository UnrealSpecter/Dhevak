<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head data-enhance="false">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dhevak Redesign</title>

        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/normalize/css/normalize.css')}}" />
        <script type="text/javascript" src="{{ URL::asset('plugins/jquery/js/jquery-3.2.1.min.js') }}"></script>

        <script type="text/javascript" src="{{ URL::asset('plugins/tether/js/tether.min.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap/css/bootstrap.css')}}" />
        <script type="text/javascript" src="{{ URL::asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

        <!-- <link href="{{ URL::asset('plugins/videojs/css/video-js.css') }}" rel="stylesheet">
        <script src="{{ URL::asset('plugins/videojs/js/videojs-ie8.js') }}"></script>
        <script src="{{ URL::asset('plugins/videojs/js/video.js') }}"></script> -->

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/animate/css/animate.css') }}" />
        @yield('css')

        @yield('js')

    </head>
    <body>
        <div class="container container-fluid" style="width: 100vw;" data-enhance="false" data-role="page">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </body>
</html>
