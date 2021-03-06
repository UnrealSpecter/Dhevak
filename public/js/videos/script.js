//wait till all resources are loaded
var player;
var playerToHide;
var contentToHide;
var nextVideo;
var previousVideo;
var playNext = false;
var playPrevious = false;
var isVideoPlaying = true;
var isMobile = false; //initiate as false
var explanationVideo;
var projectContentActive = false;
var projectNavigation = [];
var projectCount;
var explanationShown = false;
var explanationConfirmed = false;
var skipTransitions = false;
var scrollAllowed = true;

window.onload = function(){
      window.document.body.onload = loaded(); // note removed parentheses
};

$(window).ready(function(){

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

});

<<<<<<< HEAD
function loaded(){

=======

function loaded(){

        //play the intro animation
        introAnimation();

>>>>>>> dd6a54399e1998ff4732e1618dd6e691fe2278fe
        //check if we're on a mobile device
        ifMobile();

        player = initializePlayer();

        if(!isMobile){
<<<<<<< HEAD
            $('.pre-loader-wrapper').removeClass('d-none');
=======
            // player.play(player.currentVideo.name, 'main');
            player.loadVideos();
>>>>>>> dd6a54399e1998ff4732e1618dd6e691fe2278fe
        }else if(isMobile) {
            //show content loops only on mobile without the video's.
            introAnimation();
        };


        $('.arrow').on('click', function(e){
            var arrow = $(e.target);
            if(arrow.hasClass('next')){
                playNext = true;
            }
            if(arrow.hasClass('prev')){
                playPrevious = true;
            }
        });

        //set contact copy elements
        var clipboard = new Clipboard('.btn');
        clipboard.on('success', function(e) {
            var toastrText = e.text;
            var clickedElement = $(e.trigger);
            toastr.remove();
            if(clickedElement.hasClass('email-button')){
                toastr.info('Mail ons! Voed onze netwerk verslaving: ' + toastrText + ' (Email gekopieerd)');
            }
            else if(clickedElement.hasClass('phone-number-button')){
                toastr.info('Dit is de voicemail van dhevak, spreek uw boodschap in na de <span style="font-style: italic;"> piep </span> (' + toastrText + ' nummer gekopieerd)');
            }
            e.clearSelection();
        });

        //navigate with arrows
        $('.arrow').on('click', function(){
            arrowNavigation($(this));
        });

        //activate swipe only on mobile devices.
        if(isMobile){

            //initiate hammer.js this way otherwise chrome touch events dont work.
            var swipeManager = new Hammer.Manager(window, {
                touchAction: 'auto',
                inputClass: Hammer.SUPPORT_POINTER_EVENTS ? Hammer.PointerEventInput : Hammer.TouchInput,
                recognizers: [
                    [
                        Hammer.Swipe, {
                            direction: Hammer.DIRECTION_HORIZONTAL
                        }
                    ]
                ]
            });

            swipeManager.on('swipeleft', function(ev) {
<<<<<<< HEAD
                if(!projectContentActive && !navOpen){
                    playPreviousOrNext('next');
                }
=======
                playPreviousOrNext('previous');
>>>>>>> dd6a54399e1998ff4732e1618dd6e691fe2278fe
            });

            swipeManager.on('swiperight', function(ev){
                if(!projectContentActive && !navOpen){
                    playPreviousOrNext('previous');
                }
            });
        }

        //remove explanation when the confirm is clicked. / ++ this needs functionality so that it doesnt pop every time. ++ /
        $('.explanation-confirm').on('click', function(){
            $('.explanation-container').removeClass('fadeInUp').addClass('fadeOutDown');
            explanationConfirmed = true;
        });

        //explanation functions -> if ismobile dont show the explanation at all.
        if(isMobile){
            $('.mobile-explanation').removeClass('d-none');
        }
        else if(!isMobile){
            $('.non-mobile-explanation').removeClass('d-none');
        }

        //simpel version of the website or the complete version
        $('.dhevak-experience, .simple-experience').on('click', function(){
            var choice = $(this).attr('data-choice');
            $('.pre-loader-wrapper').addClass('d-none');
            if(choice === 'dhevak-experience'){
                loadVideo();
            }
            if(choice === 'simple-experience'){
                setTimeout(function(){
                    isMobile = true;
                    introAnimation();
                }, 1000);
            }

        });

        //give the user the ability to use the simple version of the site.
        $('.explanation-skip-transitions').on('click', function(){
            var border = $(this);
            var text = border.children('span');
            if(isMobile){
                border.removeClass('dont-skip').addClass('skip');
                text.removeClass('dont-skip').addClass('skip');
                isMobile = false;
            }
            else if(!isMobile){
                border.removeClass('skip').addClass('dont-skip');
                text.removeClass('skip').addClass('dont-skip');
                isMobile = true;
            }
        });

        //menu navigation
        $('.overlay-content > a').on('click', function(){
            var video = $(this);
            navigateThroughMenu(video);
        });

        // project details on frame click
        $('.projecten-left, .projecten-middle, .projecten-right').on('click', function(e){
            var project = $(e.target).parent().attr('data-project-thumbnail');
            if(canShowNextProject){
                showProjectDetails(project);
            }
        });

        //scroll events
        $(window).bind(mousewheelevt, function(e){
            if(!projectContentActive && scrollAllowed){
                scrollAllowed = false;
                scroll(e);
                setTimeout(function(){
                    scrollAllowed = true;
                }, 750);
            }
        });

        // project navigation
        $('.cycle-projects').on('click', function(e){
            var direction = $(e.target).attr('data-direction');
            initializeOrSetProjectNavigation(direction);
        });

        // scroll to certain element
        $('.scroll-down-button').on('click', function() {
             var projectOverlay = $(this).parent().parent().parent();
             var scrollToSubtitle = projectOverlay.scrollTop() + projectOverlay.find('.subtitle-role').offset().top;
             $('.project-overlay').animate({
                scrollTop: scrollToSubtitle
            }, 1500);
        });

        //close project details on escape button press.
        $(document).keydown(function(e) {
            if (e.keyCode == 27) { // escape key maps to keycode `27`
                closeNav();
            }
        });

        // set event listener to execute on timeupdate. This gets invoked every ~250ms or so
        var lastFired;
        $('.dhevak').on('timeupdate',function() {

            var videoPlayer = $(this);

            // use parseInt to round to whole seconds
            var currentTime = parseInt(this.currentTime);
            console.log(currentTime);
            //perform action every second.
            if(currentTime === player.currentVideo.pieces.mainEnd && lastFired !== player.currentVideo.pieces.mainEnd){
                $(videoPlayer).get(0).pause();
                player.showLoop();
                lastFired = player.currentVideo.pieces.mainEnd;
            }
            if(currentTime === player.currentVideo.pieces.outroRightEnd){
                player.setCurrentVideo(player.currentVideo.order + 1);
                if(player.currentVideo.introPlayed){
                    player.play(player.currentVideo.postIntroRightStart);
                }
                else if(!player.currentVideo.introPlayed){
                    player.play(player.currentVideo.mainStart)
                }
            }
            // console.log(player.currentVideo.pieces);
            if(currentTime === player.currentVideo.pieces.outroLeftEnd){
                console.log(player.currentVideo);
                player.setCurrentVideo(player.currentVideo.order - 1);
                console.log(player.currentVideo.introPlayed);
                if(player.currentVideo.introPlayed === false){
                    player.showLoop();
                        console.log('intro not played');
                }
                else if(player.currentVideo.introPlayed === true){
                    player.play(player.currentVideo.pieces.mainStart);
                    console.log('intro not played');
                }
            }

        });

}

function loadVideo() {

    //cross browser
    window.URL = window.URL || window.webkitURL;

    var req = new XMLHttpRequest();
    req.open('GET', '/videos/dhevak/dhevak-video.mp4', true);
    req.responseType = 'blob';

    req.onload = function() {

        // Onload is triggered even on 404 // so we need to check the status code
        if (this.status === 200 || this.status === 206) {

            var videoSelector = '.' + 'dhevak' + '.' + 'main';
            var videoBlob = this.response;
            var vid = URL.createObjectURL(videoBlob); // IE10+

            // Video is now downloaded // and we can set it as source on the video element and the poster
            $(videoSelector + '> source').attr('src', vid);

            //set the video poster maybe this should be dynamic aswell?
            // $(videoSelector).attr('poster', '/images/posters/' + video.name + '/' + video.name + '-' + piece + '-poster.jpg');

            //increment loadedVideos so we can start the intro animation once they are all loaded
            $(videoSelector).get(0).load();

            introAnimation();

        }
    }

    req.onerror = function() {
        console.log('video loading error');
    }

    req.send();


}

//closure function that runs the introduction only once
var executed = false;
function introAnimation() {

    if (!executed) {
        console.log('ismobile');
        //set executed to true so the fuction only runs once.
        executed = true;
        //at this point the videos are loaded and we can start the intro animation
        $('.loader-text-block').removeClass('fadeInUp').addClass('fadeOut');
        $('.intro-quote-block').removeClass('d-none').addClass('animated fadeIn');

        if(!isMobile){

            setTimeout(function(){
                $('.loader-wrapper').fadeOut('500', function(){
                    player.play(player.currentVideo.pieces.mainStart);
                });
            }, 2000);
        }
        else if(isMobile){
            $('.loader-text-block').addClass('d-none');
            setTimeout(function(){
                $('.loader-wrapper').fadeOut('500', function(){
                     player.showLoop();
                });
            }, 2000);
        }
    }
};

//check if we're on mobile.
function ifMobile(){
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;
}

//function that checks if the video is finished playing.
// function isFinished(e) {
//
//     var video = $(e.target);
//
//     if(video.hasClass('pre-intro-left')) {
//         player.play(player.currentVideo.name, 'main');
//     }
//
//     if(video.hasClass('main')){
//         player.currentVideo.introPlayed = true;
//         player.showLoop();
//     }
//
//     if(video.hasClass('outro-right')) {
//         if(player.currentVideo.introPlayed === false){
//             player.play(player.currentVideo.name, 'preIntroLeft');
//         }
//         else {
//             player.play(player.currentVideo.name, 'postIntroLeft');
//         }
//     }
//     if(video.hasClass('outro-left')) {
//         if(player.currentVideo.introPlayed === false){
//             player.play(player.currentVideo.name, 'preIntroLeft');
//         }
//         else {
//             player.play(player.currentVideo.name, 'postIntroRight');
//         }
//     }
//
//     if(video.hasClass('post-intro-right') || video.hasClass('post-intro-left')){
//         player.showLoop();
//     }
//
// }

function Player(videos){

    //array of videos [loader, home, projecten, watDoenWijAnders, contact]
    this.videos                         = videos;
    this.currentVideo                   = videos[1];
    // this.currentVideoPiece              = 'main';
    // this.loadedVideos                   = 0;

    //players
    // this.preIntroLeftPlayerElement      = document.getElementsByClassName('pre-intro-left');
    // this.postIntroLeftPlayerElement     = document.getElementsByClassName('post-intro-left');
    // this.postIntroRightPlayerElement    = document.getElementsByClassName('post-intro-right');
    // this.mainPlayerElement              = document.getElementsByClassName('main');
    // this.outroLeftPlayerElement         = document.getElementsByClassName('outro-left');
    // this.outroRightPlayerElement        = document.getElementsByClassName('outro-right');

    //sources
<<<<<<< HEAD
    // this.preIntroLeftSource             = document.getElementById('pre-intro-left-source');
    // this.postIntroLeftSource            = document.getElementById('post-intro-left-source');
    // this.postIntroRightSource           = document.getElementById('post-intro-right-source');
    // this.mainSource                     = document.getElementById('main-source');
    // this.outroLeftSource                = document.getElementById('outro-left-source');
    // this.outroRightSource               = document.getElementById('outro-right-source');

    // this.addEventListenerToPlayers = function(){
    //
    //     var propertyCount = 0;
    //     for (var key in this) {
    //         if (Object.prototype.hasOwnProperty.call(this, key)) {
    //             var val = this[key];
    //             //whenever an extra property is added to the player class check this.
    //             if(propertyCount >= 4 && propertyCount < 10){
    //                 $.each(val, function(index, playerElement){
    //                     playerElement.addEventListener('ended', isFinished, false);
    //                 });
    //             }
    //             propertyCount++;
    //         }
    //     }
    // }

    this.play = function(time){

        var videoSelector   = '.dhevak';
        var playerElement   = $(videoSelector).get(0);
=======
    this.preIntroLeftSource             = document.getElementById('pre-intro-left-source');
    this.postIntroLeftSource            = document.getElementById('post-intro-left-source');
    this.postIntroRightSource           = document.getElementById('post-intro-right-source');
    this.mainSource                     = document.getElementById('main-source');
    this.outroLeftSource                = document.getElementById('outro-left-source');
    this.outroRightSource               = document.getElementById('outro-right-source');

    //keep track of loaded videos
    this.loadVideos = function(){
        var count = 0;
        var loadedVideos = 0;
        console.log('loading');

        $.each(this.videos, function(videoIndex, video){
            $.each(video.pieces, function(pieceIndex, piece){
                var videoSelector = '.' + video.name + '#' + piece;
                //get(0) gets the native dom element.
                $(videoSelector).get(0).load();
            });
        });

        var players = document.getElementsByClassName('player');
        $.each(players, function(index, player){
            if(!$(player).hasClass('home')) {
                console.log($(player).attr('id'));
            }
            player.oncanplaythrough = function() {
                loadedVideos++;
                console.log(loadedVideos);
            };
        });

    }

    this.play = function(videoName, pieceName, direction){

        var video           = this.getVideo(videoName);
        var piece           = this.getPiece(video, pieceName);
        var source          = video.returnSource(piece);
        var sourceElement   = this.getSource(pieceName);
        var playerElement   = this.getPlayerElement(pieceName);
>>>>>>> dd6a54399e1998ff4732e1618dd6e691fe2278fe

        //hide the content
        if($('.' + this.currentVideo.name + '-content').hasClass(this.currentVideo.name + '-content')){
            $('.' + this.currentVideo.name + '-content').addClass('hidden');
        }

<<<<<<< HEAD
        $(playerElement).css({ 'opacity': '1'});
        // this.switchPlayer($(playerElement));

        playerElement.currentTime = time;
        console.log(playerElement.currentTime, time);
=======
        sourceElement.setAttribute('src', source);
        this.switchPlayer(playerElement);
        // playerElement.load();
>>>>>>> dd6a54399e1998ff4732e1618dd6e691fe2278fe
        playerElement.play();

        isVideoPlaying = true;

    }

    this.showLoop = function(){

        var loop = $('#loop');
        var videoName = player.currentVideo.name;

        if(videoName === 'projecten'){
            initializeOrSetProjectNavigation('next');
        }

        isVideoPlaying = false;

        if(!isMobile){
            // this.switchPlayer(loop);
        }

        if(!explanationShown){
            $('.explanation-container').removeClass('d-none');
            explanationShown = true;
        }

        if(!explanationConfirmed){
            $('.explanation-container').removeClass('fadeOutDown').addClass('fadeInUp');
        }

        this.makeContentActive('home');

        // loop.attr('src', '/images/posters/' + videoName + '/' + videoName + '-loop-poster.jpg');
    }

    this.makeContentActive = function(videoName){
        var contentToReveal = $('.' + videoName + '-content');

        //sets the menu item thats currently active
        setActiveMenuItem(this.currentVideo.name);

        if(!contentToHide){
            contentToReveal.removeClass('hidden');
        }
        else if(contentToHide) {
            contentToHide.addClass('hidden');
            contentToReveal.removeClass('hidden');
        }
        contentToHide = contentToReveal;
    }

    this.switchPlayer = function(playerElement){

        var playerToReveal = $(playerElement);
        //set the poster before switching the player

        // playerToReveal.attr('poster', '/images/posters/' + this.currentVideo.name + '/' + this.currentVideo.name + '-' + this.currentVideoPiece + '-poster.jpg' );

        //if there isnt a player to hide it means its the first playthrough so just reveal the player and play.
        if(!playerToHide) {
            playerToReveal.animate({ opacity: 1 }, 100);
            playerToHide = playerToReveal;
        }
        //if there is a player and its not the same player as the previous one then swap them out.
        else if(playerToHide){
            playerToReveal.css({
                'opacity' : '1',
                'z-index': '1'
            });
            playerToHide.css({
                'z-index' : '2'
            });
            playerToHide.animate({
                'opacity' : '0'
            }, 500);
            playerToHide = playerToReveal;
        }
    }

    // this.getPlayerElement = function(pieceName){
    //     var playerElement = pieceName + 'PlayerElement';
    //     for(var name in player) {
    //         var value = player[name];
    //         if(name == playerElement){
    //             return value;
    //         }
    //     }
    // }

    // this.getSource = function(pieceName) {
    //     //capitalizes the first letter to
    //     var sourceName = pieceName + 'Source';
    //     for(var name in player) {
    //         var value = player[name];
    //         if(name == sourceName){
    //             return value;
    //         }
    //     }
    // }
    //
    // this.getPiece = function(video, pieceName){
    //     for(var name in video) {
    //         var value = video[name];
    //         if(name == pieceName){
    //             player.setCurrentVideoPiece(value);
    //             return value;
    //         }
    //     }
    // }
    //
    // this.setCurrentVideoPiece = function(piece){
    //     this.currentVideoPiece = piece;
    // }

    // this.getVideo = function(videoName){
    //     var correctVideo;
    //     $.each(this.videos, function(index, video){
    //         if(video.name == videoName) {
    //             correctVideo = video;
    //         }
    //     });
    //     return correctVideo;
    // }

    this.setCurrentVideo = function(orderToPlay){
        this.currentVideo = this.videos[orderToPlay - 1];
    }

    //add eventlistener to players
    // this.addEventListenerToPlayers();

    return this;
}

function Video(name, order, introPlayed, pieces) {

    // this.videoSource   = document.createElement('source');
    // this.src = '/videos/' + name;


    //store all the video's in the properties.
    this.name = name;
    this.order = order;

    //inrij shots
    // this.preIntroLeft      = preIntroLeft;
    // this.preIntroRight     = preIntroRight;
    //
    // //post intro inrij shots
    // this.postIntroLeft     = postIntroLeft;
    // this.postIntroRight    = postIntroRight
    //
    // // outro's
    // this.outroLeft         = outroLeft;
    // this.outroRight        = outroRight;
    //
    // //main intro and loop
    // this.main              = main;
    // this.loop              = loop;

    //set introPlayed to false so that after the first play we dont ever play the intro again.
    this.introPlayed = introPlayed;

    //array of all the pieces and their names
    this.pieces = pieces;

    return this;
}

//initializes the different video objects and the main player object that will handle them all.
function initializePlayer() {

    var homePieces = {
        postIntroRightStart : 18,
        postIntroRightEnd   : 20,
        mainStart           : 0,
        mainEnd             : 16,
        outroRight          : 16,
        outroRightEnd       : 18
    }

    var projectenPieces = {
        preIntroLeft        : 20,
        preIntroRight       : 0,
        postIntroLeftStart  : 0,
        postIntroLeftEnd    : 0,
        postIntroRightStart : 42,
        postIntroRightEnd   : 50,
        mainStart           : 28,
        mainEnd             : 32,
        loop                : 0,
        outroLeftStart      : 55,
        outroLeftEnd        : 59,
        outroRightStart     : 34,
        outroRightEnd       : 41
    }

    var home                = new Video('home', 1, true, homePieces);
    var projecten           = new Video('projecten', 2, false, projectenPieces);
    // var watDoenWijAnders    = new Video('watDoenWijAnders', 3, false, watDoenWijAndersPieces);
    // var contact             = new Video('contact', 4, false, contactPieces);


    //projecten video object
    // var projecten = new Video('projecten',
    //     2,
    //     'pre-intro-left',
    //     null,
    //     'post-intro-left',
    //     'post-intro-right',
    //     'outro-left',
    //     'outro-right',
    //     'main',
    //     null,
    //     false
    // );

    //wat-doen-wij-anders
    // var watDoenWijAnders = new Video('wat-doen-wij-anders',
    //     3,
    //     'pre-intro-left',
    //     null,
    //     'post-intro-left',
    //     'post-intro-right',
    //     'outro-left',
    //     'outro-right',
    //     'main',
    //     null,
    //     false
    // );

    //contact
    // var contact = new Video('contact',
    //     4,
    //     'pre-intro-left',
    //     null,
    //     'post-intro-left',
    //     null,
    //     'outro-left',
    //     null,
    //     'main',
    //     null,
    //     false
    // );

    var videos = [];

    videos.push(home);
    videos.push(projecten);
    // videos.push(watDoenWijAnders);
    // videos.push(contact);

    var player = new Player(videos);

    //set next and previous
    prev = $('.prev').data('direction');
    next = $('.next').data('direction');

    //set up toast options
    toastr.options.positionClass = 'toast-top-full-width';
    toastr.options.preventDuplicates = true;
    toastr.options.progressBar = true;

    //set explanation video element
    explanationVideo = document.getElementById("explanation-video");

    // store all project elements in an array for use in navigateUpOrDownThroughProjects
    $('.project').each(function(index, project){
        projectNavigation.push(project);
    });

    //store the amount of projects we have.
    projectCount = 0;
    $('.project-content').each(function(index, project){
        projectCount++;
    });

    return player;
}

/* helpers */
var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel" //FF doesn't recognize mousewheel as of FF3.x
function scroll(e){
    var evt = window.event || e //equalize event object
    evt = evt.originalEvent ? evt.originalEvent : evt; //convert to originalEvent if possible
    var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta //check for detail first, because it is used by Opera and FF
    var direction = delta;
    if(!explanationConfirmed){
        $('.explanation-container').removeClass('fadeInUp').addClass('fadeOutDown');
    }
    if(direction > 0){
        closeNav();
        playPreviousOrNext('previous');
    }
    else{
        closeNav();
        playPreviousOrNext('next');
    }
}

/* NAVIGATION BY USING THE ARROWS AT THE BOTTOM OF THE SCREEN */
function arrowNavigation(element){

    var arrow = $(element);

    if(arrow.hasClass('next')){
        playPreviousOrNext('next');
    }
    else if (arrow.hasClass('previous')) {
        playPreviousOrNext('previous');
    }
}


function playPreviousOrNext(direction){
    if(!isVideoPlaying){
        if(direction === 'previous') {
            if(setAndCheckPreviousNext('previous')){
                if(!isMobile){
                    player.play(player.currentVideo.pieces.outroLeftStart);
                }
            }
        }
        else if(direction === 'next'){
            if(setAndCheckPreviousNext('next')){
                if(!isMobile){
                    player.play(player.currentVideo.pieces.outroRightStart);
                }
            }
        }
        if(!isMobile){
            //pause the video if its playing
            explanationVideo.pause();
        }

        if(isMobile){
            player.showLoop();
        }
    }
}

//navigate by using the menu items
function navigateThroughMenu(video){
    var order = video.data('order');
    //if there's not a video playing
    if(order !== player.currentVideo.order){
        closeNav();
    }
    if(!isVideoPlaying && !isMobile){
        //go left or right
        var currentVideo = player.currentVideo;
        if(currentVideo.order > order){
            player.play(player.currentVideo.name, 'outroLeft');
            player.setCurrentVideo(order);
            //pause the video if its playing
            explanationVideo.pause();
        }
        else if(currentVideo.order < order){
            player.play(player.currentVideo.name, 'outroRight');
            player.setCurrentVideo(order);
            //pause the video if its playing
            explanationVideo.pause();
        }
    }
    else if(isMobile){
        player.setCurrentVideo(order);
        player.showLoop();
    }

}

function setActiveMenuItem(name){
    var element = $('.menu-' + name);
    $('.current-video').removeClass('current-video');
    element.addClass('current-video');
}

//check if there's a previous video
function setAndCheckPreviousNext(action){
    if(action === 'previous' && player.currentVideo.order > 1 || player.currentVideo.order < 4 && action === 'next'){
        return true;
    }else {
        return false;
    }
}

// NAVIGATION FUNCTIONS
var navOpen = false;
function openNav() {
    navOpen = true;
    $('.closebtn').removeClass('animated fadeOut d-none').addClass('animated fadeIn');
    if(!projectContentActive){
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

}

/* Close */
function closeNav() {
    navOpen = false;
    $('.closebtn').removeClass('animated fadeIn').addClass('animated fadeOut d-none');
    if(!projectContentActive){
        $('.overlay').css('height', '0%');
        $('.overlay-content > a').each(function(index) {
            var $this = $(this);
            $this.removeClass('animated slideInLeft').addClass('invisible');
        });
    }
    else {
        hideProjectDetails();
    }
}

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

// PROJECTEN
var projectNavigationIndex = 0;
function initializeOrSetProjectNavigation(direction) {
    //store projects for further use
    var projects = document.getElementsByClassName('project');
    if(direction === 'next' && projectNavigationIndex <= projects.length){
        for(counter = 3; counter >= 1; counter--){
            var project = projects[projectNavigationIndex];
            //unhide the projectthumbnail if it exists
            if($('[data-project-thumbnail='+ (projectNavigationIndex + 1) +']')){
                $('[data-project-thumbnail='+ (projectNavigationIndex + 1) +']').removeClass('d-none');
            }
            //hide the previous project if it exists.
            if($('[data-project-thumbnail='+ (projectNavigationIndex - 2) +']')){
                $('[data-project-thumbnail='+ (projectNavigationIndex - 2) +']').addClass('d-none');
            }
            //increment index so we can use it to count
            projectNavigationIndex++;
        }
    }
    else if(direction === 'previous' && projectNavigationIndex > 3){
        var project = projects[projectNavigationIndex];
        for(counter = 3; counter >= 1; counter--){
            if($('[data-project-thumbnail='+ (projectNavigationIndex - 3) +']')){
                $('[data-project-thumbnail='+ (projectNavigationIndex - 3) +']').removeClass('d-none');
            }
            if($('[data-project-thumbnail='+ (projectNavigationIndex) +']')){
                $('[data-project-thumbnail='+ (projectNavigationIndex) +']').addClass('d-none');
            }
            projectNavigationIndex--;
        }
    }
}

var canShowNextProject = true;
var projectToShow;
var projectToHide;
function showProjectDetails(project){
    $('.project-content').each(function(index, element){
        projectToShow = $(element);
        if(projectToShow.attr('data-project') == project){
            $('.project-overlay').removeClass('d-none animated slideOutUp').addClass('animated slideInDown');
            $('.project-overlay').scrollTop(0);
            if(!projectToHide){
                projectToShow.removeClass('d-none');
            }
            else if(projectToHide && $(projectToHide).attr('data-project') !== $(projectToShow).attr('data-project')){
                projectToShow.removeClass('d-none');
                projectToHide.addClass('d-none');
            }
            projectToHide = projectToShow;
        }
    });

    //show the close button in a fixed position its used from the nav.
    projectContentActive = true;
    canShowNextProject = false;
    openNav();

}

// hide the project details
function hideProjectDetails(){
    $('.myCarousel').carousel('pause');
    $('.project-overlay').removeClass('animated slideInDown').addClass('animated slideOutUp');
    setTimeout(function(){
        $('.project-overlay').addClass('d-none');
        canShowNextProject = true;
    }, 1000);
    projectContentActive = false;
}

// switch projects that are visible on the project page. Up or Down based on direction.
// function navigateUpOrDownThroughProjects(direction){
//
//     var modifier;
//     if(direction === 'previous-projects'){
//         modifier = 3;
//     }
//     else if(direction === 'next-projects') {
//         modifier = -3;
//     }
//
//     $.each(projectNavigation, function(index, project){
//
//         var projectId = parseInt($(project).attr('data-project'));
//         var newProjectValue = (projectId + modifier);
//
//         if(newProjectValue > projectCount || newProjectValue < 0){
//             newProjectValue = "";
//         }
//
//         $(project).attr('data-project', newProjectValue);
//
//     });
// }
