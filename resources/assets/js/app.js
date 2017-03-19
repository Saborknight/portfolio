
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
	 * Make sure sidebar (if exists) stretches to the full extent
	 * of the la... I mean document
	 */
	if ($('#timeline-wrapper').length > 0) {
		var height = $j(document).height();
		var extension = parseFloat($j('body').css('font-size')) * 3;

		var height = height + extension;

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
});
