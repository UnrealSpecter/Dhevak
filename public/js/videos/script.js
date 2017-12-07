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
var navigatingThroughMenu = false;
var order;
var waiting = false;

window.onload = function(){
      window.document.body.onload = loaded(); // note removed parentheses
};

function loaded(){

        //check if we're on a mobile device
        ifMobile();

        player = initializePlayer();

        if(!isMobile){
            $('.pre-loader-wrapper').removeClass('d-none');
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
                if(!projectContentActive && !navOpen){
                    playPreviousOrNext('next');
                }
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
                $('.progress').addClass('d-none');
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

        $('.switch-project').on('click', function(){
            var projectIndex = $(this).attr('data-project-index');
            closeNav();
            setTimeout(function(){
                showProjectDetails(projectIndex);
            }, 1000);
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
             var projectContent = $(this).parent().parent();
             var scrollToSubtitle = projectContent.find('.subtitle-role').offset().top - projectContent.offset().top;
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
        $('.dhevak').on('timeupdate',function() {
            if(waiting === false){
                var videoPlayer = $(this);

                // use parseInt to round to whole seconds
                var currentTime = Math.round(this.currentTime*2)/2;

                //loop situations - post intro right
                if(player.listenFor === 'postIntroRight' && currentTime === player.currentVideo.pieces.postIntroRightEnd){
                    $(videoPlayer).get(0).pause();
                    $(videoPlayer).get(0).currentTime = player.currentVideo.pieces.mainEnd;
                    player.showLoop();
                    wait();
                }

                //post intro left
                if(player.listenFor === 'postIntroLeft' && currentTime === player.currentVideo.pieces.postIntroLeftEnd){
                    $(videoPlayer).get(0).pause();
                    $(videoPlayer).get(0).currentTime = player.currentVideo.pieces.mainEnd;
                    player.showLoop();
                    wait();
                }

                //main intro's end
                if(player.listenFor === 'main' && currentTime === player.currentVideo.pieces.mainEnd){
                    $(videoPlayer).get(0).pause();
                    player.showLoop();
                    wait();
                }

                //outro right
                if(player.listenFor === 'outroRight' && currentTime === player.currentVideo.pieces.outroRightEnd){
                    if(navigatingThroughMenu === false){
                        player.setCurrentVideo(player.currentVideo.order + 1);
                    }
                    else if(navigatingThroughMenu === true){
                        player.setCurrentVideo(order);
                    }

                    if(player.currentVideo.introPlayed === true){
                        player.play(player.currentVideo.pieces.postIntroLeftStart, 'postIntroLeft');
                        wait();
                    }

                    else if(player.currentVideo.introPlayed === false){
                        player.play(player.currentVideo.pieces.mainStart, 'main');
                        player.currentVideo.introPlayed = true;
                        wait();
                    }

                    //reset navigate through menu so that it can be used again
                    if(navigatingThroughMenu === true){
                      navigatingThroughMenu = false;
                    }

                }

                //outro left
                if(player.listenFor === 'outroLeft' && currentTime === player.currentVideo.pieces.outroLeftEnd){
                    if(navigatingThroughMenu === false){
                        player.setCurrentVideo(player.currentVideo.order - 1);
                    }
                    else if(navigatingThroughMenu === true){
                        player.setCurrentVideo(order);
                    }

                    //if intro not played play the pre intro of the page
                    if(player.currentVideo.introPlayed === false){
                        player.currentVideo.introPlayed = true;
                        player.play(player.currentVideo.pieces.mainStart, 'main');
                        wait();
                    }

                    //if the intro has played before then just show the post intro of the page
                    else if(player.currentVideo.introPlayed === true){
                        player.play(player.currentVideo.pieces.postIntroRightStart, 'postIntroRight');
                        wait();
                    }

                    //reset navigate through menu so that it can be used again
                    if(navigatingThroughMenu === true){
                      navigatingThroughMenu = false;
                    }
                }
            }
        });

}

function wait(){
  waiting = true;
  setTimeout(function(){
    waiting = false;
  }, 500);
}

function roundThing(value, step) {
    step || (step = 1.0);
    var inv = 1.0 / step;
    return Math.round(value * inv) / inv;
}

function startLoaderQuoteCycling() {
    //cycle through quotes
    var quotes = $(".quotes");
    var quoteIndex = -1;
    function showNextQuote() {
        ++quoteIndex;
        quotes.eq(quoteIndex % quotes.length)
            .fadeIn(1000)
            .delay(2000)
            .fadeOut(1000, showNextQuote);
    }
    showNextQuote();
}

function loadVideo() {

    //on video load start cycling the quotes
    startLoaderQuoteCycling();

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

            //increment loadedVideos so we can start the intro animation once they are all loaded
            $(videoSelector).get(0).load();

            introAnimation();

        }
    }

    req.onprogress = function(e) {
        if (e.lengthComputable) {

            var value = parseInt((e.loaded / e.total) * 100) + '%';

            $('.progress-bar').css({
                'width': value
            });
        }
    };

    req.onerror = function() {
        console.log('video loading error');
    }

    req.send();
}

//closure function that runs the introduction only once
var executed = false;
function introAnimation() {

    if (!executed) {
        //set executed to true so the fuction only runs once.
        executed = true;
        //at this point the videos are loaded and we can start the intro animation
        $('.loader-text-block').removeClass('fadeInUp').addClass('fadeOut');
        $('.intro-quote-block').removeClass('d-none').addClass('animated fadeIn');

        if(!isMobile){

            setTimeout(function(){
                $('.loader-wrapper').fadeOut('500', function(){
                    player.play(player.currentVideo.pieces.mainStart, 'main');
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

function Player(videos){

    this.videos                         = videos;
    this.currentVideo                   = videos[0];

    this.play = function(time, nextPieceToPlay){

        var videoSelector   = '.dhevak';
        var playerElement   = $(videoSelector).get(0);

        //hide the content
        if($('.' + this.currentVideo.name + '-content').hasClass(this.currentVideo.name + '-content')){
            $('.' + this.currentVideo.name + '-content').addClass('hidden');
        }

        $(playerElement).css({ 'opacity': '1'});

        this.setListenFor(nextPieceToPlay);

        playerElement.currentTime = time;

        playerElement.play();

        isVideoPlaying = true;

    }

    //sets the piece the time functions should be listening for so the overlap doesnt matter.
    this.setListenFor = function(nextPieceOfVideo){
        this.listenFor = nextPieceOfVideo;
    }

    this.showLoop = function(){

        var loop = $('#loop');
        var videoName = player.currentVideo.name;

        isVideoPlaying = false;

        if(!explanationShown){
            $('.explanation-container').removeClass('d-none');
            explanationShown = true;
        }

        if(!explanationConfirmed){
            $('.explanation-container').removeClass('fadeOutDown').addClass('fadeInUp');
        }

        this.makeContentActive(videoName);

        if(isMobile){
            loop.attr('src', '/images/posters/' + videoName + '/' + videoName + '-loop-poster.jpg');
        }

    }

    this.makeContentActive = function(videoName){
        var contentToReveal = $('.' + videoName + '-content');

        //sets the menu item thats currently active
        setActiveMenuItem(this.currentVideo.name);

        //mobile content revealing
        if(!contentToHide && isMobile){
            contentToReveal.removeClass('hidden');
        }
        else if(contentToHide && isMobile) {
            contentToHide.addClass('hidden');
            contentToReveal.removeClass('hidden');
        }

        if(!contentToHide && !isMobile){
            contentToReveal.removeClass('hidden').addClass('animated fadeIn');
        }
        else if(contentToHide && !isMobile) {
            contentToReveal.removeClass('animated fadeOut').removeClass('hidden').addClass('animated fadeIn');
            contentToHide.removeClass('animated fadeIn').addClass('animated fadeOut');
        }

        contentToHide = contentToReveal;
    }

    this.setCurrentVideo = function(orderToPlay){
        this.currentVideo = this.videos[orderToPlay - 1];
    }

    return this;
}

function Video(name, order, introPlayed, pieces) {

    //store all the video's in the properties.
    this.name = name;
    this.order = order;

    //set introPlayed to false so that after the first play we dont ever play the intro again.
    this.introPlayed = introPlayed;

    //array of all the pieces and their names
    this.pieces = pieces;

    return this;
}

//initializes the different video objects and the main player object that will handle them all.
function initializePlayer() {

    var homePieces = {
        postIntroRightStart : 19.5,
        postIntroRightEnd   : 21,

        mainStart           : 0,
        mainEnd             : 17,

        outroRightStart     : 17,
        outroRightEnd       : 19.5
    }

    var projectenPieces = {

        postIntroLeftStart  : 53.25,
        postIntroLeftEnd    : 57,

        postIntroRightStart : 45,
        postIntroRightEnd   : 53,

        mainStart           : 23,
        mainEnd             : 34,

        outroLeftStart      : 57.5,
        outroLeftEnd        : 61.5,

        outroRightStart     : 36.75,
        outroRightEnd       : 45
    }

    var watDoenWijAndersPieces = {

        postIntroLeftStart  : 98,
        postIntroLeftEnd    : 103.5,

        postIntroRightStart : 85,
        postIntroRightEnd   : 91,

        mainStart           : 62,
        mainEnd             : 77,

        outroLeftStart      : 92,
        outroLeftEnd        : 97.5,

        outroRightStart     : 78,
        outroRightEnd       : 85
    }

    var contactPieces = {
        postIntroLeftStart  : 146,
        postIntroLeftEnd    : 155,

        mainStart           : 104,
        mainEnd             : 135,

        outroLeftStart      : 136,
        outroLeftEnd        : 145.5
    }

    var home                = new Video('home',                1, true, homePieces);
    var projecten           = new Video('projecten',           2, false, projectenPieces);
    var watDoenWijAnders    = new Video('wat-doen-wij-anders', 3, false, watDoenWijAndersPieces);
    var contact             = new Video('contact',             4, false, contactPieces);

    var videos = [];

    videos.push(home);
    videos.push(projecten);
    videos.push(watDoenWijAnders);
    videos.push(contact);

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

    initializeOrSetProjectNavigation('next');

    return player;
}

/* helpers */
var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel" //FF doesn't recognize mousewheel as of FF3.x
function scroll(e){
    var evt = window.event || e //equalize event object
    evt = evt.originalEvent ? evt.originalEvent : evt; //convert to originalEvent if possible
    var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta //check for detail first, because it is used by Opera and FF
    var direction = delta;
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
                    if(!explanationConfirmed){
                        $('.explanation-container').removeClass('fadeInUp').addClass('fadeOutDown');
                    }
                    player.play(player.currentVideo.pieces.outroLeftStart, 'outroLeft');
                }
                if(isMobile){
                    player.setCurrentVideo(player.currentVideo.order - 1);
                    player.showLoop();
                }
            }
        }
        else if(direction === 'next'){
            if(setAndCheckPreviousNext('next')){
                if(!isMobile){
                    if(!explanationConfirmed){
                        $('.explanation-container').removeClass('fadeInUp').addClass('fadeOutDown');
                    }
                    player.play(player.currentVideo.pieces.outroRightStart, 'outroRight');
                }
                if(isMobile){
                    player.setCurrentVideo(player.currentVideo.order + 1);
                    player.showLoop();
                }
            }
        }

        if(!isMobile){
            //pause the video if its playing
            explanationVideo.pause();
        }

    }
}

//navigate by using the menu items
function navigateThroughMenu(video){
    order = video.data('order');
    //if there's not a video playing
    if(order !== player.currentVideo.order){
        closeNav();
    }
    if(!isVideoPlaying && !isMobile){
        //go left or right
        var currentVideo = player.currentVideo;
        if(currentVideo.order > order){
            navigatingThroughMenu = true;
            player.play(player.currentVideo.pieces.outroLeftStart, 'outroLeft');
            //pause the video if its playing
            explanationVideo.pause();
        }
        else if(currentVideo.order < order){
            navigatingThroughMenu = true;
            player.play(player.currentVideo.pieces.outroRightStart, 'outroRight');
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
    if(direction === 'next' && projectNavigationIndex < projects.length){
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
