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

function loaded(){

        //play the intro animation
        introAnimation();

        //check if we're on a mobile device
        ifMobile();

        setTimeout(function(){
            player = initializePlayer();
            player.play(player.currentVideo.name, 'main');
        }, 1000);

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
            if(clickedElement.hasClass('email-button')){
                toastr.info('Dhevak email gekopieerd. Mail ons! Geef ons een reden om weer even een kopje thee te drinken. : ' + toastrText);
            }
            else if(clickedElement.hasClass('phone-number-button')){
                toastr.info('Dhevak 06 gekopieerd. Bel ons & we babbelen graag! : ' + toastrText);
            }
            e.clearSelection();
        });

        //navigate with arrows
        $('.arrow').on('click', function(){
            arrowNavigation($(this));
        });

        //activate swipe only on mobile devices.
        if(isMobile){ //test this thing on a tablet aswell. I dont know if that's considered mobile.
            var swipeManager = new Hammer(window);
            swipeManager.on('swipeleft', function(ev) {
                    playPreviousOrNext('previous');
            });
            swipeManager.on('swiperight', function(ev){
                playPreviousOrNext('next');
            });
        }

        //remove explanation when the confirm is clicked. / ++ this needs functionality so that it doesnt pop every time. ++ /
        $('.explanation-confirm').on('click', function(){
            $('.explanation-container').removeClass('fadeInUp').addClass('fadeOutDown');
        });

        //menu navigation
        $('.overlay-content > a').on('click', function(){
            var videoToPlay = $(this).data('order');
            navigateThroughMenu(videoToPlay);
        });

        // project details on frame click
        $('.projecten-left, .projecten-middle, .projecten-right').on('click', function(e){
            var project = $(e.target).parent().attr('data-project');
            showProjectDetails(project);
        });

        //scroll events
        $(window).bind(mousewheelevt, function(e){
            if(!projectContentActive){
                scroll(e);
            }
        });

        // project navigation
        $('.arrow-up, .arrow-down').on('click', function(e){
            var direction = $(e.target).attr('data-direction');
            navigateUpOrDownThroughProjects(direction);
        });
}


function introAnimation(){
    $('.title').fadeOut();
    $('.loader-content').fadeOut();
}

var projectToShow;
var projectToHide;
function showProjectDetails(project){
    $('.project-content').each(function(index, element){
        projectToShow = $(element);
        if(projectToShow.attr('data-project') == project){
            $('.project-overlay').removeClass('invisible animated slideOutUp').addClass('animated slideInDown');
            if(!projectToHide){
                projectToShow.removeClass('d-none');
            }
            else if(projectToHide){
                projectToShow.removeClass('d-none');
                projectToHide.addClass('d-none');
            }
            projectToHide = projectToShow;
        }
    });
    projectContentActive = true;
}

// hide the project details
function hideProjectDetails(){
    $('.myCarousel').carousel('pause');
    $('.project-overlay').removeClass('animated slideInDown').addClass('animated slideOutUp');
    projectContentActive = false;
}

// switch projects that are visible on the project page. Up or Down based on direction.
function navigateUpOrDownThroughProjects(direction){
    var modifier;
    if(direction === 'previous-projects'){
        modifier = 3;
    }
    else if(direction === 'next-projects') {
        modifier = -3;
    }
    $.each(projectNavigation, function(index, project){
        var projectId = parseInt($(project).attr('data-project'));
        var newProjectValue = (projectId + modifier);
        if(newProjectValue > projectCount || newProjectValue < 0){
            newProjectValue = "";
        }
        $(project).attr('data-project', newProjectValue);

    });
}

//check if we're on mobile.
function ifMobile(){
    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
        || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;
}

//function that checks if the video is finished playing.
function isFinished(e) {
    var video = $(e.target).attr('id');

    if(video == 'pre-intro-left') {
        player.play(player.currentVideo.name, 'main');
    }

    if(video == 'main'){
        player.currentVideo.introPlayed = true;
        player.showLoop();
    }

    if(video == 'outro-right') {
        if(player.currentVideo.introPlayed === false){
            player.play(player.currentVideo.name, 'preIntroLeft');
        }
        else {
            player.play(player.currentVideo.name, 'postIntroLeft');
        }
    }
    if(video == 'outro-left') {
        if(player.currentVideo.introPlayed === false){
            player.play(player.currentVideo.name, 'preIntroLeft');
        }
        else {
            player.play(player.currentVideo.name, 'postIntroRight');
        }
    }

    if(video == 'post-intro-right' || video == 'post-intro-left'){
        player.showLoop();
    }

}

function Player(videos){

    //array of videos [loader, home, projecten, watDoenWijAnders, contact]
    this.videos                         = videos;
    this.currentVideo                   = videos[2];
    this.currentVideoPiece              = 'main';

    //players
    this.preIntroLeftPlayerElement      = document.getElementById('pre-intro-left');
    // this.preIntroRightPlayerElement     = document.getElementById('pre-intro-right');
    this.postIntroLeftPlayerElement     = document.getElementById('post-intro-left');
    this.postIntroRightPlayerElement    = document.getElementById('post-intro-right');
    this.mainPlayerElement              = document.getElementById('main');
    this.loopPlayerElement              = document.getElementById('loop');
    this.outroLeftPlayerElement         = document.getElementById('outro-left');
    this.outroRightPlayerElement        = document.getElementById('outro-right');

    //playerEnded events
    this.preIntroLeftPlayerElement      .addEventListener('ended', isFinished, false);
    // this.preIntroRightPlayerElement     .addEventListener('ended', isFinished, false);
    this.postIntroLeftPlayerElement     .addEventListener('ended', isFinished, false);
    this.postIntroRightPlayerElement    .addEventListener('ended', isFinished, false);
    this.mainPlayerElement              .addEventListener('ended', isFinished, false);
    // this.loopPlayerElement              .addEventListener('ended', isFinished, false);
    this.outroLeftPlayerElement         .addEventListener('ended', isFinished, false);
    this.outroRightPlayerElement        .addEventListener('ended', isFinished, false);

    //sources
    this.preIntroLeftSource             = document.getElementById('pre-intro-left-source');
    // this.preIntroRightSource            = document.getElementById('pre-intro-right-source');
    this.postIntroLeftSource            = document.getElementById('post-intro-left-source');
    this.postIntroRightSource           = document.getElementById('post-intro-right-source');
    this.mainSource                     = document.getElementById('main-source');
    // this.loopSource                     = document.getElementById('loop-source');
    this.outroLeftSource                = document.getElementById('outro-left-source');
    this.outroRightSource               = document.getElementById('outro-right-source');

    this.play = function(videoName, pieceName, direction){

        var video           = this.getVideo(videoName);
        var piece           = this.getPiece(video, pieceName);
        var source          = video.returnSource(piece);
        var sourceElement   = this.getSource(pieceName);
        var playerElement   = this.getPlayerElement(pieceName);

        //hide the content
        if($('.' + this.currentVideo.name).hasClass(this.currentVideo.name)){
            $('.' + this.currentVideo.name).addClass('hidden');
        }

        sourceElement.setAttribute('src', source);
        this.switchPlayer(playerElement);
        playerElement.load();
        playerElement.play();

    }

    this.showLoop = function(){
        var loop = $('#loop');
        var videoName = player.currentVideo.name;

        isVideoPlaying = false;

        this.switchPlayer(loop);
        this.makeContentActive(videoName);

        loop.attr('src', '/images/posters/' + videoName + '/' + videoName + '-loop-poster.jpg');
    }

    this.makeContentActive = function(videoName){

        var contentToReveal = $('.' + videoName);

        //sets the menu item thats currently active
        setActiveMenuItem(this.currentVideo.name);

        if(!contentToHide){
            $('.explanation-container').removeClass('hidden');
            contentToReveal.removeClass('hidden');
            contentToHide = contentToReveal;
        }
        else if(contentToHide) {
            $('.explanation-container').addClass('hidden');
            contentToHide.addClass('hidden');
            contentToReveal.removeClass('hidden');
        }
    }

    this.switchPlayer = function(playerElement){
        var playerToReveal = $(playerElement);
        //set the poster before switching the player
        playerToReveal.attr('poster', '/images/posters/' + this.currentVideo.name + '/' + this.currentVideoPiece + '-poster.jpg' );
        //if there isnt a player to hide it means its the first playthrough so just reveal the player and play.
        if(!playerToHide) {
            playerToReveal.animate({ opacity: 1 }, 100);
            playerToHide = playerToReveal;
        }
        //if there is a player and its not the same player as the previous one then swap them out.
        else if(playerToHide && playerToHide[0].id !== playerToReveal[0].id){
            playerToReveal.animate({ opacity: 1 }, 500);
            playerToHide.animate({ opacity: 0 }, 1000);
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
                player.setCurrentVideoPiece(value);
                return value;
            }
        }
    }

    this.setCurrentVideoPiece = function(piece){
        this.currentVideoPiece = piece;
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

    this.setCurrentVideo = function(orderToPlay){
        this.currentVideo = this.videos[orderToPlay];
    }

    return this;
}

function Video(name, order, preIntroLeft, preIntroRight, postIntroLeft, postIntroRight, outroLeft, outroRight, main, loop, introPlayed) {

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
    this.introPlayed = introPlayed;

    this.returnSource = function(video){
        var source = this.src + '/' + video + '.mp4';
        return source;
    }

    return this;
}

//initializes the different video objects and the main player object that will handle them all.
function initializePlayer() {

    var loader = new Video('loader', 0, null, null, null, null, null, null, null, 'loader-loop', null);

    var home = new Video('home',
        1,
        null,
        null,
        null,
        'home-post-intro-right',
        null,
        'home-outro-right',
        'home-main',
        'home-loop',
        true
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
        'projecten-loop',
        false
    );

    //wat-doen-wij-anders
    var watDoenWijAnders = new Video('wat-doen-wij-anders',
        3,
        'wat-doen-wij-anders-pre-intro-left',
        'wat-doen-wij-anders-pre-intro-right',
        'wat-doen-wij-anders-post-intro-left',
        'wat-doen-wij-anders-post-intro-right',
        'wat-doen-wij-anders-outro-left',
        'wat-doen-wij-anders-outro-right',
        'wat-doen-wij-anders-main',
        'wat-doen-wij-anders-loop',
        false
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
        'contact-loop',
        false
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
    if(direction > 0){
        closeNav();
        playPreviousOrNext('previous');
    }
    else{
        closeNav();
        playPreviousOrNext('next');
    }
}

function arrowNavigation(element){

    var arrow = $(element);
    console.log(arrow);
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
                player.play(player.currentVideo.name, 'outroLeft');
                player.setCurrentVideo(player.currentVideo.order - 1);
            }
        }
        else if(direction === 'next'){
            if(setAndCheckPreviousNext('next')){
                player.play(player.currentVideo.name, 'outroRight');
                player.setCurrentVideo(player.currentVideo.order + 1);
            }
        }
        //set video playing attribute
        isVideoPlaying = true;
        //pause the video if its playing
        explanationVideo.pause();
    }
}

//navigate by using the menu items
function navigateThroughMenu(order){
    //if there's not a video playing
    if(!isVideoPlaying){
        //go left or right
        var currentVideo = player.currentVideo;
        if(currentVideo.order > order){
            player.play(player.currentVideo.name, 'outroLeft');
            player.setCurrentVideo(order);
            //pause the video if its playing
            explanationVideo.pause();
            closeNav();
        }
        else if(currentVideo.order < order){
            player.play(player.currentVideo.name, 'outroRight');
            player.setCurrentVideo(order);
            //pause the video if its playing
            explanationVideo.pause();
            closeNav();
        }
    }
}

function setActiveMenuItem(name){
    var element = $('.' + name);
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
