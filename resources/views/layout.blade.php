<!doctype html>
<html lang="nl">
    <head data-enhance="false">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>Dhevak | Experimenteel Webdesign & Culturele Projecten</title>

        <link rel="icon" href="{{ URL::asset('/images/dhevak-logo.png')}}">

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/normalize/css/normalize.css')}}" />
        <script src="{{ URL::asset('plugins/jquery/js/jquery-3.2.1.min.js') }}"></script>

        <script src="{{ URL::asset('plugins/tether/js/tether.min.js')}}"></script>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap/css/bootstrap.css')}}" />
        <script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

        <!-- swipe even libraries -->
        <script src="{{ URL::asset('plugins/hammer/js/hammer.js') }}"></script>
        <!-- superlightweight clipboard copy library -->
        <script src="{{ URL::asset('plugins/clipboard/js/clipboard.min.js') }}"></script>

        <!-- include toasts -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/toastr/css/toastr.min.css') }}">
        <script src="{{ URL::asset('plugins/toastr/js/toastr.min.js')}}"></script>

        <!-- simple animation library -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/animate/css/animate.css') }}" />

        <!-- IE polyfill -->
        <script src="{{ URL::asset('plugins/object-fit-polyfill/js/objectFitPolyfill.min.js') }}"></script>

        @yield('css')

        @yield('js')

        <!-- Minimum CSS -->
        <style>
        .container {
          width: 100vw; /* Or whatever you want it to be */
          height: 100vh; /* Or whatever you want it to be */
        }
        .media {
          width: 100%;
          height: 100%;
          object-fit: fill; /* Or whatever object-fit you want */
        }
        </style>
    </head>
    <body>
        <div class="" style="height: 100vh; width: 100vw;" data-enhance="false" data-role="page">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </body>
</html>
