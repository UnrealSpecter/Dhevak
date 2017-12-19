<!doctype html>
<html lang="nl">
    <head data-enhance="false">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-90310031-5"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-90310031-5');
        </script>
        @yield('css')

        @yield('js')
    </head>
    <body>
        <div style="height: 100vh; width: 100%;" data-enhance="false" data-role="page">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </body>
</html>
