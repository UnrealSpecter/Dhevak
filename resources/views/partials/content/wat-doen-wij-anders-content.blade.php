<!-- wat-doen-wij-anders-partial -->
<div id="content-wrapper" class="wat-doen-wij-anders-content animated fadeIn hidden">
    <div class="theater-ambiance animated fadeIn"></div>
    <div class="wat-doen-wij-anders-explanation-video">
        <video controls preload="auto" class="explanation-video" id="explanation-video" poster="{{ URL::asset('/images/posters/wat-doen-wij-anders/wat-doen-wij-anders-explanation-video-poster.jpg') }}">
            <source id="pre-intro-left-source" src="{{ URL::asset('/videos/wat-doen-wij-anders/wat-doen-wij-explanation-video.mp4')}}">
        </video>
    </div>
    <div class="video-controls flex">
        <!-- wat-doen-wij-anders menu -->
        <div class="col-12 wat-doen-wij-anders-menu flex">
            <img src="{{ URL::asset('/images/social-media/dhevak-hamburger-icon.jpg') }}" alt="menu-button" class="img-fluid" style="height: 100%;" onclick="openNav()">
        </div>
    </div>
</div>
