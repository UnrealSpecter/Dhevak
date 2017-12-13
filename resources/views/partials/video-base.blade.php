@section('css')
    <link rel="stylesheet" type="text/css" href="css/videos/style.css" />
@endsection
@section('js')
    <script src="js/videos/script.js"></script>
@endsection
@extends('layout')
@section('content')
@include('navigation.menu')

    <!-- video elements -->
    <div class="container">
        @include('partials.videos.dhevak-video')
    </div>

    <!-- misc/helpers -->
    @include('partials.content.landscape-indicator-content')
    @include('partials.content.pre-loader-choice-content')
    @include('partials.content.loader-content')
    @include('partials.content.explanation-content')

    <!-- content partials -->
    @include('partials.content.home-content')
    @include('partials.content.projecten-content')
    @include('partials.content.wat-doen-wij-anders-content')
    @include('partials.content.contact-content')

@endsection
