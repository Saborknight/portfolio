/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
// 	el: '#app'
// });

var $j = jQuery.noConflict();

$j(document).ready(function() {
	/**
	 * Index Scroll position button re-enabler
	 */
	$(document).on('scroll', function() {
		if($(this).scrollTop()>=$('.go-downward-wrapper').position().top){

			$j('.go-downward-wrapper').removeClass('fadeOut');
		}
	});

	/**
	 * Index Hero
	 */
	$j('.go-downward-wrapper a').click(function(e) {
		e.preventDefault();

		scrollToElement('.parse-area');
	});
	wholeScreen();

	$j(window).resize(function() {
		wholeScreen();
	});

	/**
	 * Vimeo controllers
	 */
	if ($('.container').data('section') === 'projects-single') {
		if ($('.vimeoPlayer').length > 0) {
			vimeo();
		}
	}

	/**
	 * Youtube controllers
	 */
	// if ($('.youtubePlayer').length > 0) {
	// 	onYouTubeIframeAPIReady();
	// }

	/**
	 * Make sure sidebar (if exists) stretches to the full extent
	 * of the la... I mean document
	 */
	if ($('#timeline-wrapper').length > 0) {
		var doc = $j(document).height();
		var extension = parseFloat($j('body').css('font-size')) * 3;

		var height = doc + extension;

		$('#timeline-wrapper, .timeline').addClass('no-transition');

		$('#timeline-wrapper, .timeline').css('height', height);

		$('#timeline-wrapper, .timeline').removeClass('no-transition');

		console.log('Timeline found!', height, extension);
	}

	/**
	 * Toggle the main navigation menu on the left
	 */
	$j('#menu-toggle').click(function(e) {
		e.preventDefault();
		$j('#menu-wrapper').toggleClass('toggled');
		// Bars begin down
		$j('#menu-toggle').toggleClass('drop-bars');

		if ( $('#menu-toggle').prop('class') !== 'move-right') {
			// Move-right!
			setTimeout(function() {
				$('#menu-toggle').toggleClass('move-right');

				setTimeout(function() {
					// Bars down
					$('#menu-toggle').toggleClass('drop-bars');
				},500);
			}, 500);
		} else {
			$j('#menu-toggle').removeClass('move-right');
			$j('#menu-toggle').addClass('drop-bars');
			$j('#menu-wrapper').removeClass('toggled');
		}
	});

	/**
	 * Toggle the sidebar menu on the right on hover
	 */
	$j('#timeline-wrapper').hover(function() {
		$(this).toggleClass('hovered');
	});

	/**
	 * Move header out of the way once there is indication that there is focus
	 * on the feature
	 */
	if ($('.container').data('section') === 'projects-single') {
		$j('.featured-image-project, featured-video-project iframe').hover(function() {
			$j('.header-project').toggleClass('shift-left');
		});
	}

	/**
	 * Calculate the top position to put the project single header group on
	 * taking into account viewport width and feature height
	 */
	shiftHeader();
});

/**
 * Calculates amount to shift header down
 * @return void
 */
function shiftHeader() {
	if ($j(window).width() >= 1400) {
		var imageHeight = $j('.featured-image-project, .featured-video-project iframe').height();
		var headerHeight = $j('.header-project').height();

		var calc = (imageHeight * 0.25) - (headerHeight/2);

		$j('.header-project').css('top', calc);
	}
}

/**
 * Figure out how tall it needs to be
 * Then initiate the downward button
 */
function wholeScreen() {
	var height = $j(window).height();
	$j('.hero-logo').css('height', height);

	$j('body').css('height', height * 2);
}

/**
 * Executes scroll animation
 * @param  {string} $element target element to scroll to
 * @return {void}          scrolls to the target element
 */
function scrollToElement($element) {
	$j('.go-downward-wrapper').addClass('fadeOut');
	// var height = $(document).height();
	var height = $j($element).offset().top;
	$j('html, body').animate({ scrollTop: height }, 700);
}

/**
 * Sort Vimeo out
 */
function vimeo() {
	var iframe = $j('.featured-video-project.vimeoPlayer iframe');
	var player = new Vimeo.Player(iframe);

	player.ready().then(function() {
		shiftHeader();
	});

	player.on('play', function() {
		$j('.header-project').addClass('featured-focus');
		$j('.featured-video-project iframe').css('opacity', 1);
	});

	player.on('pause', function() {
		$j('.header-project').removeClass('featured-focus');
		$j('.featured-video-project iframe').css('opacity', 0.4);
	});

	player.on('ended', function() {
		$j('.header-project').removeClass('featured-focus');
		$j('.featured-video-project iframe').css('opacity', 0.4);
	});

	console.log($j('.tag-project').css('color'));

	player.setColor($j('.tag-project').css('color')).then(function(color) {
		console.log('Vimeo color set:', color);
	});
}

/**
 * Sort youtube out
 */
// var player;
// function onYouTubeIframeAPIReady() {
// 	console.log('We\'re live');
// 	player = new YT.Player('player', {
// 		events: {
// 			onReady: onPlayerReady,
// 			onStateChange: onPlayerStateChange
// 		}
// 	});
// }

// function onPlayerReady(event) {
// 	shiftHeader();
// }

// function onPlayerStateChange(event) {
// 	console.log('State:', event);
// 	var state = event.data;
// 	if (state === 0) {
// 		// ended
// 		$j('.header-project').removeClass('featured-focus');
// 		$j('.featured-video-project iframe').css('opacity', 0.4);
// 	} else if (status === 1) {
// 		// playing
// 		$j('.header-project').addClass('featured-focus');
// 		$j('.featured-video-project iframe').css('opacity', 1);
// 	} else if (status === 2) {
// 		// paused
// 		$j('.header-project').removeClass('featured-focus');
// 		$j('.featured-video-project iframe').css('opacity', 0.4);
// 	}
// }
