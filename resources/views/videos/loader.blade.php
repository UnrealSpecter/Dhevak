@section('css')
    <link rel="stylesheet" type="text/css" href="css/videos/style.css" />
@endsection
@section('js')
    <script type="text/javascript" src="js/videos/script.js"></script>
@endsection
@extends('layout')
@section('content')
@include('navigation.menu')
<!-- landscape-indicator -->
<div class="landscape-indicator flex">FLIP IT FAGGOT.</div>

<!-- loader-wrapper -->
<div class="loader-wrapper flex col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <div class="loader-content flex flow-c col-lg-11 col-md-11 col-sm-11 col-xs-11">
        <h1 class="title">Dhèvak</h1>
        <div class="loader-text quotes">Loading Entertainment</div>
        <div class="loader-text quotes">Oh wacht dit is een nederlandse website</div>
        <div class="loader-text quotes">Het wachten is bijna voorbij</div>
        <div class="loader-text quotes">Of toch niet</div>
        <div class="loader-text quotes">Hier wat totaal niet nutteloze feitjes</div>
        <div class="loader-text quotes">Oh, hallo je hebt me gevonden</div>
        <div class="loader-text quotes">Meer dan 90% van stenen bestaan uit mineralen</div>
        <div class="loader-text quotes">Ik ken een mop over een bloem, maar in het engels is hij flower</div>
        <div class="loader-text quotes">100% van de mensen die water drinken gaan dood</div>
        <div class="loader-text quotes">Dhèvak heeft net zoveel WK's gewonnen als het nederlands elftal</div>
        <div class="loader-text quotes">Het geheime ingredient van coca-cola is Dhèvak</div>
        <div class="loader-text quotes">De biopic over ons leven komt uit in 2045</div>
        <div class="loader-text quotes">Dhèvak. De eerste, de echte.</div>
        <div class="loader-text quotes">Beter een Dhèvak in je hand dan je tien bij je concurent</div>
        <div class="loader-text quotes">Collect moments not things. But also things.</div>
    </div>
</div>

<!-- video elements -->
<video autoplay muted class="player" id="loader-video">
    <source id="source" class="source" src="">
</video>
<video autoplay muted class="player" id="pre-intro-left">
    <source id="pre-intro-left-source" src="">
</video>
<video autoplay muted class="player" id="pre-intro-right">
    <source id="pre-intro-right-source" src="">
</video>
<video autoplay muted class="player" id="post-intro-left">
    <source id="post-intro-left-source" src="">
</video>
<video autoplay muted class="player" id="post-intro-right">
    <source id="post-intro-right-source" src="">
</video>
<video autoplay muted class="player" id="main">
    <source id="main-source" src="">
</video>
<video autoplay muted class="player" id="outro-left">
    <source id="outro-left-source" src="">
</video>
<video autoplay muted class="player" id="outro-right">
    <source id="outro-right-source" src="">
</video>

<!-- loop poster element -->
<img src="{{ URL::asset('/images/posters/home/home-main-poster.jpg') }}" class="loop-poster" id="loop"/>

<!-- explanation-container -->
<div class="explanation-container animated fadeInUp hidden">
    <div class="arrow previous"></div>
    <div class="arrow next"></div>
    <div class="scroll-indicator">
        <div class="animated fadeInDown"> Navigeer door te scrollen </div>
        <div class="animated fadeInUp explanation-confirm">Ok, Ik snap het</div>
        <div class="animated fadeInUp explanation-help">
            <a href="https://www.google.nl/search?q=hoe+moet+ik+scrollen+op+een+website%3F" target="_blank">Ik snap het niet help</a>
        </div>
    </div>
</div>

@include('videos.home-partial')
@include('videos.projecten-partial')
@include('videos.wat-doen-wij-anders-partial')
@include('videos.contact-partial')

@endsection
