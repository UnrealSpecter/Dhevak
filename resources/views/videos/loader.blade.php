@section('css')
    <link rel="stylesheet" type="text/css" href="css/videos/style.css" />
@endsection
@section('js')
    <script type="text/javascript" src="js/videos/script.js"></script>
@endsection
@extends('layout')
@section('content')
@include('navigation.menu')

<div class="landscape-indicator flex">FLIP IT FAGGOT.</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" onclick="openNav()" style="z-index: 200; position: absolute; left: 0; width: 200px; height: 100px; display: flex; flex-flow: row; justify-content: center; align-items: center; background-color: black; color: white;">
  <span class="open-menu-button">menu</span>
</div>

<div class="loader-wrapper flex col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="loader-background"></div>
    <div class="loader-content flex flow-c col-lg-10 col-md-10 col-sm-10 col-xs-10">
        <h1 class="title">Dhèvak</h1>
        <div class="loader-text quotes">Coming up with some witty stuff</div>
        <div class="loader-text quotes">Loading Entertainment</div>
        <div class="loader-text quotes">Oh wacht dit is een nederlandse website</div>
        <div class="loader-text quotes">Het wachten is bijna voorbij</div>
        <div class="loader-text quotes">Of toch niet</div>
        <div class="loader-text quotes">Oh, hallo je hebt me gevonden</div>
        <div class="loader-text quotes">Meer dan 90% van stenen bestaan uit mineralen</div>
        <div class="loader-text quotes">Ik ken een mop over een bloem, maar in het engels is hij flower</div>
        <div class="loader-text quotes">100% van de mensen die water drinken gaan dood</div>
        <div class="loader-text quotes">Dhèvak heeft net zoveel wk's gewonnen als het nederlands elftal</div>
        <div class="loader-text quotes">Het geheime ingredient van coca-cola is Dhèvak</div>
        <div class="loader-text quotes">De biopic over ons leven komt uit in 2045</div>
        <div class="loader-text quotes">Dhèvak. De eerste, de echte.</div>
        <div class="loader-text quotes">Beter een Dhèvak in je hand dan je tien bij je concurent</div>
        <div class="loader-text quotes">Collect moments not things. But also things.</div>
    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 video-wrapper">
    <!-- <video autoplay muted class="loader-video" data-current-video="loader" id="player">
        <source id="source" class="source" src="">
    </video> -->
    <video autoplay muted class="player" id="pre-intro-left" poster="{{ URL::asset('/images/posters/contact/contact-pre-intro-left-poster.jpg') }}">
        <source id="pre-intro-left-source" src="">
    </video>
    <video autoplay muted class="player" id="pre-intro-right">
        <source id="pre-intro-right-source" src="">
    </video>
    <video autoplay muted class="player" id="post-intro-left" poster="{{ URL::asset('/images/posters/contact/contact-post-intro-left-poster.jpg') }}">
        <source id="post-intro-left-source" src="">
    </video>
    <video autoplay muted class="player" id="post-intro-right">
        <source id="post-intro-right-source" src="">
    </video>
    <video autoplay muted class="player" id="main" poster="{{ URL::asset('/images/posters/contact/contact-main-poster.jpg') }}">
        <source id="main-source" src="">
    </video>
    <video preload="auto" loop autoplay muted class="player" id="loop" poster="{{ URL::asset('/images/posters/contact/contact-loop-poster.jpg') }}">
        <source id="loop-source" src="">
    </video>
    <video autoplay muted class="player" id="outro-left" posters="{{ URL::asset('/images/posters/contact/contact-outro-left-poster.jpg') }}">
        <source id="outro-left-source" src="">
    </video>

    <video autoplay muted class="player" id="outro-right">
        <source id="outro-right-source" src="">
    </video>
 </video>
</div>

<div class="arrow-container">
    <div class="arrow prev" data-direction=""></div>
    <div class="arrow next" data-direction="projecten"></div>
</div>
@endsection
