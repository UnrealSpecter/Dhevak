<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gevangenis Museum</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/promotion/gevangenis-museum.css') }}">
    </head>
    <body>
    <div class="fullPage">
        <img src="{{ asset('/images/promotion/gevangenis-museum/slot.png') }}" alt="" class="Slot" >
        <img src="{{ asset('/images/promotion/gevangenis-museum/tralies.png') }}" alt="" class="Tralies">
        <img src="{{ asset('/images/promotion/gevangenis-museum/menu.png') }}" alt="" class="menubalk">
        <img src="{{ asset('/images/promotion/gevangenis-museum/kaartje.png') }}" style="opacity:0" id="test" alt="" class="kaartje">
        <img src="{{ asset('/images/promotion/gevangenis-museum/plattegrond.png') }}" id="a" alt="" usemap="#image-map" class="Plattegrond" >
        <map name="image-map">
            <area class="area" target="" alt="" title=""  coords="1249,940,40" shape="circle">
            <area class="area" target="" alt="" title=""  coords="1333,1440,40" shape="circle">
            <area class="area" target="" alt="" title=""  coords="1550,2780,40" shape="circle">
            <area class="area" target="" alt="" title=""  coords="1750,500,40" shape="circle">
            <area class="area" target="" alt="" title=""  coords="3265,550,40" shape="circle">
            <area class="area" target="" alt="" title=""  coords="2662,1160,40" shape="circle">
            <area class="area" target="" alt="" title=""  coords="3591,1585,40" shape="circle">
            <area class="area" target="" alt="" title=""  coords="2276,2736,40" shape="circle">
            <area class="area" target="" alt="" title=""  coords="2596,2859,40" shape="circle">
            <area class="area" target="" alt="" title=""  coords="2478,3139,40" shape="circle">
        </map>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ asset('plugins/imageMapResizer/js/imageMapResizer.min.js') }}" type="text/javascript"></script>
    <script>

        $('map').imageMapResize();
          $('.area').on('mouseover', function(){
            var toast = $('#test');

            toast.css({'opacity': 1});
            var coords = $(this).attr('coords');
            var top = coords.split(",");
            var left = coords.split(",");
            var toastWidth = toast.width();
            var toastHeight = toast.height();
            toast.offset({ top: top[1] - toastHeight + 20 , left: left[0] - toastWidth + 20});

          });
          $('.area').on('mouseout', function(){
            var toast = $('#test');

            toast.css({'opacity': 0});
            var coords = $(this).attr('coords');
            var top = coords.split(",");
            var left = coords.split(",")
            toast.offset({ top: top[1] , left: left[0] });



          });

      </script>
    </body>
</html>
