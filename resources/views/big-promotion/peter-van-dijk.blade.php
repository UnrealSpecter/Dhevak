<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Peter Van Dijk</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/promotion/peter-van-dijk.css') }}">
        <!-- simple animation library -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/animate/css/animate.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('plugins/bootstrap/css/bootstrap.css')}}" />

    </head>
    <body>
    <div style="height: 100vh; width: 100vw;" data-enhance="false" data-role="page">
        <img class="animated fadeIn background"   style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;" src="{{ asset('/images/promotion/peter-van-dijk/background.jpg') }}" alt="peter-van-dijk-background">
        <img class="d-none building" style="position: fixed; top: 0; left: 0; width: 50%; height: "       src="{{ asset('/images/promotion/peter-van-dijk/building.png') }}" alt="peter-van-dijk-big-building">
        <img class="d-none buildings" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%;" src="{{ asset('/images/promotion/peter-van-dijk/buildings.png') }}" alt="peter-van-dijk-buildings">
        <!-- <img src="{{ asset('/images/promotion/peter-van-dijk/crane.png') }}" alt="peter-van-dijk-crane">
        <img src="{{ asset('/images/promotion/peter-van-dijk/cables.png') }}" alt="peter-van-dijk-crane-cables">
        <img src="{{ asset('/images/promotion/peter-van-dijk/wheel.png') }}" alt="peter-van-dijk-wheel"> -->
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('plugins/tether/js/tether.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('plugins/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{ asset('/js/promotion/peter-van-dijk.js')}}"></script>
    </body>
</html>
