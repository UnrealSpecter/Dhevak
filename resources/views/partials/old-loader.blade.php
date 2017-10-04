@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/videos/old-style.css')}}" />
@endsection
@section('js')
    <script src="bower_components/fabric.js"></script>
    <script src="bower_components/dist/fabric-brush.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/videos/old-script.js') }}"></script>
@endsection
@extends('layout')
@section('content')
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 video-wrapper">
    <div class="loader"></div>
    <!-- <img class="loader-img" src="{{ URL::asset('images/posters/01-loader.png')}}" style="position: fixed; top: 0; left: 0; height: 100%; width: 100%;"> -->
    <video autoplay muted poster="{{ URL::asset('images/posters/01-loader.png') }}" id="loader-video" class="video"></video>
    <video autoplay muted poster="{{ URL::asset('images/posters/01-loader.png') }}" id="intro-video"  class="video"></video>
    <video autoplay muted id="transition-video"            class="video"></video>
    <video autoplay muted id="contact-intro-video"         class="video"></video>
    <video autoplay muted id="contact-wurst-case-video"    class="video"></video>
    <video autoplay muted id="transition-back-video"       class="video"></video>
    <div class="contact"></div>
    <div class="home invisible">HOME</div>
    <a class="facebook" href="https://www.facebook.com/dhevakart/" target="_blank"></a>
    <a class="mail" href="mailto:info@dhevak.nl?subject=hoiDhevak!"></a>
</div>
@endsection
