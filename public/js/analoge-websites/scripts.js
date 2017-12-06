$(window).on('load', function(){

    //once the page has finished loading remove the loader
    $('.loader-wrapper').addClass('loaded');

    if( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        window.location.replace("http://dhevak.nl/mobile_index.php#analoge-websites-werkwijze");
    }

    $('#fullpage').fullpage({
		sectionsColor: ['black', 'black', 'black', 'black', 'black', 'black'],
		anchors: ['analoge-websites', 'introductie-analoge-websites', 'analoge-websites-werkwijze', 'wie-zijn-we-frank', 'wie-zijn-we-tomi', 'wie-zijn-we-amber', 'analoge-websites-contact'],
		menu: '#menu',
		navigation: true,
		scrollingSpeed: 1000,
		afterLoad: function(anchorLink, index){
			var loadedSection = $(this);
			//check url for anchors and then play video's according
			//play intro video
                        if(anchorLink == 'analoge-websites'){
			    $('#binnenkomer').get(0).play();
			}
                        //play the werkwijze video.
			if(anchorLink == 'analoge-websites-werkwijze'){
			    $('#werkwijze').get(0).play();
    			var video = document.getElementById("werkwijze");
				video.onended = function() {
					this.className = 'werkwijze-video hide';
					$('.dhevak-het-moet-achtergrond').fadeIn(2000);
				};
                        }
                        //fade frank foto
                        if(anchorLink == 'wie-zijn-we-frank'){
			    $('.frank-foto').fadeOut(3000);
			}
                        //fade tomi foto
                        if(anchorLink == 'wie-zijn-we-tomi'){
			    $('.tomi-foto').fadeOut(3000);
			}
                        //fade amber foto
                        if(anchorLink == 'wie-zijn-we-amber'){
			    $('.amber-foto').fadeOut(3000);
			}
		},
                onLeave: function(index, nextIndex, direction){
                    //after leaving section frank
                    if(index == 4){
                        $('.frank-foto').fadeIn(1000);
                    }
                    //after leaving section tomi
                    else if(index == 5){
                        $('.tomi-foto').fadeIn(1000);
                    }
                    //after leaving section amber
                    else if(index == 6){
                        $('.amber-foto').fadeIn(1000);
                    }
                }
	});

	$(".replay").on("click", function() {
		$('#werkwijze').get(0).play();
		$('.dhevak-het-moet-achtergrond').fadeOut(2000, function(video){
			document.getElementById("werkwijze").className = 'werkwijze-video';
		});
	});

	// Input Lock
	$('textarea').blur(function () {
	    $('#hire textarea').each(function () {
	        $this = $(this);
	        if ( this.value != '' ) {
	          $this.addClass('focused');
	          $('textarea + label + span').css({'opacity': 1});
	        }
	        else {
	          $this.removeClass('focused');
	          $('textarea + label + span').css({'opacity': 0});
	        }
	    });
	});

	$('#hire .field:first-child input').blur(function () {
	    $('#hire .field:first-child input').each(function () {
	        $this = $(this);
	        if ( this.value != '' ) {
	          $this.addClass('focused');
	          $('.field:first-child input + label + span').css({'opacity': 1});
	        }
	        else {
	          $this.removeClass('focused');
	          $('.field:first-child input + label + span').css({'opacity': 0});
	        }
	    });
	});

	$('#hire .field:nth-child(2) input').blur(function () {
	    $('#hire .field:nth-child(2) input').each(function () {
	        $this = $(this);
	        if ( this.value != '' ) {
	          $this.addClass('focused');
	          $('.field:nth-child(2) input + label + span').css({'opacity': 1});
	        }
	        else {
	          $this.removeClass('focused');
	          $('.field:nth-child(2) input + label + span').css({'opacity': 0});
	        }
	    });
	});
});
