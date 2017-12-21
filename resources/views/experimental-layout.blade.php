<!doctype html>
<html lang="en" class="no-js">
    <head data-enhance="false">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Dhevak | Experimental</title>
        <link rel="icon" href="{{ URL::asset('/images/dhevak-logo.png')}}">
        <!-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/normalize/css/normalize.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap/css/bootstrap.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/animate/css/animate.css') }}" /> -->
        @yield('css')
    </head>
    <body class="demo-3">
        @yield('content')
        <!-- <script src="{{ URL::asset('plugins/jquery/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ URL::asset('plugins/tether/js/tether.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
        <script src="{{ URL::asset('plugins/hammer/js/hammer.js') }}"></script> -->
        @yield('js')
    </body>
</html>
