$(window).on('load', function(){

    var timeout;
    var twice = 0;

    //basic stuff
    var loaderVideo             = document.getElementById('loader-video');
    var homeIntroVideo          = document.getElementById('intro-video');
    var transitionVideo         = document.getElementById('transition-video');
    var contactIntroVideo       = document.getElementById('contact-intro-video');
    var contactWurstCaseVideo   = document.getElementById('contact-wurst-case-video');
    var transitionBackVideo     = document.getElementById('transition-back-video');

    var loaderSource            = document.createElement('source');
    var homeIntroSource         = document.createElement('source');
    var transitionSource        = document.createElement('source');
    var contactIntroSource      = document.createElement('source');
    var contactWurstCaseSource  = document.createElement('source');
    var transitionBackSource    = document.createElement('source');

    //videos
    var loader                  = '/videos/optimized-h.264/01-loader-1.m4v';
    var homeIntro               = '/videos/optimized-h.264/02-home-intro-1.m4v';
    var transitionHomeContact   = '/videos/optimized-h.264/03-home-contact-transition-1.m4v';
    var contactIntro            = '/videos/optimized-h.264/04-contact-intro-1.m4v';
    var contactWurstCase        = '/videos/optimized-h.264/05-contact-wurst-case-1.m4v';
    var transitionContactHome   = '/videos/optimized-h.264/06-contact-outro-1.m4v';

    //append correct video urls to sources
    loaderSource.setAttribute('src', loader);
    homeIntroSource.setAttribute('src', homeIntro);
    transitionSource.setAttribute('src', transitionHomeContact);
    contactIntroSource.setAttribute('src', contactIntro);
    contactWurstCaseSource.setAttribute('src', contactWurstCase);
    transitionBackSource.setAttribute('src', transitionContactHome);

    //append sources to video players
    loaderVideo.appendChild(loaderSource);
    homeIntroVideo.appendChild(homeIntroSource);
    transitionVideo.appendChild(transitionSource);
    contactIntroVideo.appendChild(contactIntroSource);
    contactWurstCaseVideo.appendChild(contactWurstCaseSource);
    transitionBackVideo.appendChild(transitionBackSource);

    //add eventlistener for ended event
    loaderVideo.addEventListener('ended', isLoaderFinished, false);
    homeIntroVideo.addEventListener('ended', isHomeIntroFinished, false);
    transitionVideo.addEventListener('ended', isTransitionFinished, false);
    contactIntroVideo.addEventListener('ended', isContactIntroFinished, false);
    contactWurstCaseVideo.addEventListener('ended', isWurstCaseFinished, false);
    transitionBackVideo.addEventListener('ended', isTransitionBackFinished, false);

    loaderVideo.play();

    function wurstCase() {
        timeout = setTimeout(function(){
            randomWurstCase();
        }, Math.floor((Math.random() * 20000) + 10000));
    }

    function stopWurstCase() {
        clearTimeout(timeout);
    }

    $('.contact').click(function(){
        $(homeIntroVideo).fadeOut('100');
        $(transitionVideo).fadeIn('100');
        $(transitionBackVideo).fadeOut('100');
        $(contactIntroVideo).fadeIn('100');
        transitionVideo.play();
    });

    $('.home').click(function(){
        stopWurstCase();
        $(this).addClass('animated fadeOut');
        $(contactWurstCaseVideo).fadeOut('100');
        $(contactIntroVideo).fadeOut('100');
        $(transitionBackVideo).fadeIn('100');
        $(homeIntroVideo).fadeOut('100');
        transitionBackVideo.play();
    });

    function isLoaderFinished(e) {
        $('.loader').toggle();
        $(loaderVideo).fadeOut('100');
        homeIntroVideo.play();
    }

    function isHomeIntroFinished(e) {
        // $(homeIntroVideo).fadeOut('100');
        // transitionVideo.play();
    }

    function isTransitionFinished(e) {
        $(transitionVideo).fadeOut('100');
        contactIntroVideo.play();
    }

    function isContactIntroFinished(e) {
        $('.home').removeClass('invisible animated fadeOut').addClass('animated fadeIn');
        wurstCase();
    }

    function isWurstCaseFinished(e) {
        $(contactWurstCaseVideo).fadeOut('100');
        $(contactIntroVideo).fadeIn('100');
    }

    function isTransitionBackFinished(e) {
        $(transitionBackVideo).fadeOut('100');
        $(homeIntroVideo).fadeIn('100');
    }

    function randomWurstCase(){
        $(contactWurstCaseVideo).fadeIn('100');
        $(contactIntroVideo).fadeOut('100');
        contactWurstCaseVideo.play();
    }

});
