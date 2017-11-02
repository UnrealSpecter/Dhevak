<!-- wat-doen-wij-anders-partial -->
<div id="content-wrapper" class="wat-doen-wij-anders-content animated fadeIn hidden">
    <div class="theater-ambiance animated fadeIn" style="background-color: black; opacity: 0.4; height: 100%; with: 100%;"></div>
    <div class="wat-doen-wij-anders-explanation-video">
        <video controls preload="auto" class="explanation-video" id="explanation-video" poster="{{ URL::asset('/images/posters/wat-doen-wij-anders/wat-doen-wij-anders-explanation-video-poster.jpg') }}">
            <source id="pre-intro-left-source" src="{{ URL::asset('/videos/wat-doen-wij-anders/wat-doen-wij-explanation-video.mp4')}}">
        </video>
    </div>
    <div class="video-controls flex">
        <!-- wat-doen-wij-anders menu -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wat-doen-wij-anders-menu">
            <img src="{{ URL::asset('/images/social-media/dhevak-hamburger-icon.jpg') }}" alt="menu-button" class="img-fluid" style="height: 100%;" onclick="openNav()">
        </div>
    </div>
</div>
