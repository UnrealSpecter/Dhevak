//wait till all resources are loaded
var player;
var playerToHide;
var nextVideo;
var previousVideo;
var playNext = false;
var playPrevious = false;

$(window).on('load', function() {
        //cycle through quotes
        var quotes = $(".quotes");
        var quoteIndex = -1;
        function showNextQuote() {
            ++quoteIndex;
            quotes.eq(quoteIndex % quotes.length)
                .fadeIn(1000)
                .delay(1000)
                .fadeOut(1000, showNextQuote);
        }
        showNextQuote();
        player = initializePlayer();
        player.play(player.currentVideo.name, 'loop');



});

//seemless loop playin
$(document).ready(function(){

    var $video = $("#loop");
    var $clone = $video.clone();
    $video.after($clone);

    var video = $video[0];
    var clone = $clone[0];

    clone.hidden = true;
    $(clone).addClass('clone');
    clone.pause();
    clone.currentTime = 0;

    video.ontimeupdate = function() {
        if (video.currentTime >= video.duration - .1) {
            clone.play();
            video.hidden = true;
            clone.hidden = false;
            video.pause();
            video.currentTime = 0;
        }
    }

    clone.ontimeupdate = function() {
        if (clone.currentTime >= clone.duration - .1) {
            video.play();
            clone.hidden = true;
            video.hidden = false;
            clone.pause();
            clone.currentTime = 0;
        }
    }
});

//function that checks if the video is finished playing.
function isFinished(e) {

    var video = $(e.target).attr('id');

    console.log(video);

    if(video == 'main'){
        player.play(player.currentVideo.name, 'loop');
    }
    if(video == 'loop' && !playNext && !playPrevious){
        player.play(player.currentVideo.name, 'loop');
    }
    if(video == 'loop' && playNext){
        console.log('entering playnext')
        player.play(player.currentVideo.name, 'outroRight', nextVideo);
        playNext = false;
    }
    if(video == 'loop' && playPrevious) {
        console.log('entering playPreivous');
        console.log('previousVideo var: ' + playPrevious )
        player.play(player.currentVideo.name, 'outroLeft', previousVideo);
    }
    if(video == 'outro-right') {
        player.play(player.currentVideo.name, 'preIntroLeft');
    }
    if(video == 'outro-left') {
        player.play(player.currentVideo.name, 'postIntroRight');
    }
    if(video == 'pre-intro-left') {
        player.play(player.currentVideo.name, 'main');
    }

}

function Player(videos){

    //array of videos [loader, home, projecten, watDoenWijAnders, contact]
    this.videos                         = videos;
    this.currentVideo                   = videos[4];

    //players
    this.preIntroLeftPlayerElement      = document.getElementById('pre-intro-left');
    this.preIntroRightPlayerElement     = document.getElementById('pre-intro-right');
    this.postIntroLeftPlayerElement     = document.getElementById('post-intro-left');
    this.postIntroRightPlayerElement    = document.getElementById('post-intro-right');
    this.mainPlayerElement              = document.getElementById('main');
    this.loopPlayerElement              = document.getElementById('loop');
    this.outroLeftPlayerElement         = document.getElementById('outro-left');
    this.outroRightPlayerElement        = document.getElementById('outro-right');

    //playerEnded events
    this.preIntroLeftPlayerElement      .addEventListener('ended', isFinished, false);
    this.preIntroRightPlayerElement     .addEventListener('ended', isFinished, false);
    this.postIntroLeftPlayerElement     .addEventListener('ended', isFinished, false);
    this.postIntroRightPlayerElement    .addEventListener('ended', isFinished, false);
    this.mainPlayerElement              .addEventListener('ended', isFinished, false);
    this.loopPlayerElement              .addEventListener('ended', isFinished, false);
    this.outroLeftPlayerElement         .addEventListener('ended', isFinished, false);
    this.outroRightPlayerElement        .addEventListener('ended', isFinished, false);

    //sources
    this.preIntroLeftSource             = document.getElementById('pre-intro-left-source');
    this.preIntroRightSource            = document.getElementById('pre-intro-right-source');
    this.postIntroLeftSource            = document.getElementById('post-intro-left-source');
    this.postIntroRightSource           = document.getElementById('post-intro-right-source');
    this.mainSource                     = document.getElementById('main-source');
    this.loopSource                     = document.getElementById('loop-source');
    this.outroLeftSource                = document.getElementById('outro-left-source');
    this.outroRightSource               = document.getElementById('outro-right-source');

    this.play = function(videoName, pieceName, direction){

        var video           = this.getVideo(videoName);
        var piece           = this.getPiece(video, pieceName);
        var source          = video.returnSource(piece);
        var sourceElement   = this.getSource(pieceName);
        var playerElement   = this.getPlayerElement(pieceName);

        sourceElement.setAttribute('src', source);
        this.switchPlayer(playerElement);
        playerElement.load();
        playerElement.play();

        if(pieceName == 'loop'){
            document.getElementsByClassName('clone')[0].setAttribute('src', source);
        }

        if(direction){
            console.log('logging direction' + direction);
            this.setCurrentVideo(directionToGo);
        }

    }

    this.switchPlayer = function(playerElement){

        var playerToReveal = $(playerElement);
        console.log(playerToReveal[0].id);
        // console.log(playerToHide[0].id);

        //if there isnt a player to hide it means its the first playthrough so just reveal the player and play.
        if(!playerToHide) {
            playerToReveal.animate({ opacity: 1 }, 100);
            playerToHide = $(playerElement);
        }
        //if there is a player and its not the same player as the previous one then swap them out.
        else if(playerToHide && playerToHide[0].id !== playerToReveal[0].id){
            playerToReveal.animate({ opacity: 1 }, 100);
            playerToHide.animate({ opacity: 0 }, 100);
            playerToHide = playerToReveal;
        }
    }

    this.getPlayerElement = function(pieceName){
        var playerElement = pieceName + 'PlayerElement';
        for(var name in player) {
            var value = player[name];
            if(name == playerElement){
                return value;
            }
        }
    }

    this.getSource = function(pieceName) {
        //capitalizes the first letter to
        var sourceName = pieceName + 'Source';
        for(var name in player) {
            var value = player[name];
            if(name == sourceName){
                return value;
            }
        }
    }

    this.getPiece = function(video, pieceName){
        for(var name in video) {
            var value = video[name];
            if(name == pieceName){
                return value;
            }
        }
    }

    this.getVideo = function(videoName){
        var correctVideo;
        $.each(this.videos, function(index, video){
            if(video.name == videoName) {
                correctVideo = video;
            }
        });
        return correctVideo;
    }

    this.returnVideos = function(){
        console.log("The added video's are: ");
        $.each(this.videos, function(index, video) {
            console.log(video.name);
        });
    };

    this.returnCurrentVideo = function() {
        console.log('The currently selected video is: ' + player.current.name);
    };

    this.setCurrentVideo = function(direction){
        $.each(this.videos, function(index, video) {
            if(video.name == directionToGo){
                console.log(video.name);
                this.currentVideo = video;
            }
        });
    }

    return this;
}

function Video(name, order, preIntroLeft, preIntroRight, postIntroLeft, postIntroRight, outroLeft, outroRight, main, loop) {

    this.videoSource   = document.createElement('source');
    this.src = '/videos/' + name;

    //store all the video's in the properties.
    this.name = name;
    this.order = order;

    //inrij shots
    this.preIntroLeft      = preIntroLeft;
    this.preIntroRight     = preIntroRight;

    //post intro inrij shots
    this.postIntroLeft     = postIntroLeft;
    this.postIntroRight    = postIntroRight

    // outro's
    this.outroLeft         = outroLeft;
    this.outroRight        = outroRight;

    //main intro and loop
    this.main              = main;
    this.loop              = loop;

    //set introPlayed to false so that after the first play we dont ever play the intro again.
    this.introPlayed = false;

    this.returnSource = function(video){
        var source = this.src + '/' + video + '.mp4';
        return source;
    }

    return this;
}

//initializes the different video objects and the main player object that will handle them all.
function initializePlayer() {

    var loader = new Video('loader', 0, null, null, null, null, null, null, null, 'loader-loop');

    var home = new Video('home',
        1,
        null,
        null,
        null,
        'home-post-intro-right',
        null,
        'home-outro-right',
        'home-main',
        'home-loop'
    );

    //projecten video object
    var projecten = new Video('projecten',
        2,
        'projecten-pre-intro-left',
        'projecten-pre-intro-right',
        'projecten-post-intro-left',
        'projecten-post-intro-right',
        'projecten-outro-left',
        'projecten-outro-right',
        'projecten-main',
        'projecten-loop'
    );

    //wat-doen-wij-anders
    var watDoenWijAnders = new Video('wat-doen-wij-anders',
        3,
        'watDoenWijAnders-pre-intro-left',
        'watDoenWijAnders-pre-intro-right',
        'watDoenWijAnders-post-intro-left',
        'watDoenWijAnders-post-intro-right',
        'watDoenWijAnders-outro-left',
        'watDoenWijAnders-outro-right',
        'watDoenWijAnders-main',
        'watDoenWijAnders-loop'
    );

    //contact
    var contact = new Video('contact',
        4,
        'contact-pre-intro-left',
        'contact-pre-intro-right',
        'contact-post-intro-left',
        'contact-post-intro-right',
        'contact-outro-left',
        'contact-outro-right',
        'contact-main',
        'contact-loop'
    );

    var videos = [];

    videos.push(loader);
    videos.push(home);
    videos.push(projecten);
    videos.push(watDoenWijAnders);
    videos.push(contact);

    var player = new Player(videos);

    //set next and previous
    prev = $('.prev').data('direction');
    next = $('.next').data('direction');

    //hide loader
    $('.loader-wrapper').addClass('invisible');

    return player;
}

/* helpers */
var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel" //FF doesn't recognize mousewheel as of FF3.x
$(window).bind(mousewheelevt, function(e){

    var evt = window.event || e //equalize event object
    evt = evt.originalEvent ? evt.originalEvent : evt; //convert to originalEvent if possible
    var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta //check for detail first, because it is used by Opera and FF

    if(delta > 0) {
        // console.log('scroll prev');
        // player.play(player.currentVideo.name, 'outroLeft', previousVideo);
        playPrevious = true;
    }
    else{
        // console.log('scroll')
        // player.play(player.currentVideo.name, 'outroRight', nextVideo);
        playNext = true;
    }

});

function setNextPrevious(currentVideo){

    //on menu button click the correct next/prev needs to be set
    //on scroll the correct next previous needs to be set.
    if(currentVideo == 'home'){
        prev = null;
        next = 'projecten';
    }
    if(currentVideo == 'projecten'){
        prev = 'home';
        next = 'wat-doen-wij-anders';
    }
    if(currentVideo == 'wat-doen-wij-anders'){
        prev = 'projecten';
        next = 'contact';
    }
    if(currentVideo == 'contact'){
        prev = 'wat-doen-wij-anders';
        next = null;
    }

}

/* Open */
function openNav() {

    $('.overlay').css('height', '100%');
    setTimeout(function(){
        $(".overlay-content > a").each(function(index) {
            var $this = $(this);
            var t = setTimeout(function() {
                $this.addClass('animated slideInLeft').removeClass('invisible');
            }, 250 * index++);
        });
    }, 250);

}

/* Close */
function closeNav() {
    $('.overlay').css('height', '0%');
    $(".overlay-content > a").each(function(index) {
        var $this = $(this);
        $this.removeClass('animated slideInLeft').addClass('invisible');
    });
}
