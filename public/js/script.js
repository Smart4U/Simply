(function (window, document, $) {
	"use strict";
	
	$(window).on('load', function () {
		/* loader */
		$(".noo-spinner").fadeOut(500, function(){
            $(".noo-spinner").remove();
        });
								   
		/* fullscreen touching menu */
		menu_touched_side();
		
		/* mobile menu */
		mobileMenu();
	});
	
	$(window).on('resize', function (event, ui) {
		/* boxed layout */
		boxLayout();
		
		/* fullscreen touching menu */
		menu_touched_side();
	});
	
	$(document).ready(function($) {
		"use strict";
		
		//SingleNav
		if ($('.dotted-navigation').length > 0) $('.dotted-navigation').children(".menu").singlePageNav({ 'offset': 0, 'filter': '.onepage' });
		
		//Toggles
		toggles();
		
		//Progress Bars
		progressBar();
		
		//JScrollPane
		$('.widget-area-content').jScrollPane();
		
		//Pricing Item
		pricing();
		
		/* boxed layout */
		boxLayout();
		
		/* typed text */
		typedText();
		
		/* pie chart */
		pieChart();
		
		/* count to */
		countTo();
		
		/* split slider */
		splitSlider();
		
		/* flip box */
		flipBox();
		
		/* portfolio */
		portfolio();
		
		/* carousel slider */
		owlCarousel();
		
		/* google map */
		Map();
		if($('#map').length > 0) {
			GoogleMap();
		}
		if($('#map2').length > 0) {
			GoogleMap2();
		}
		
		/* rotator text */
		initRotationText();
		
		/* fullscreen section */
		fullScreenHeight();
		
		/* portfolio popup */
		portfolioPopup();
		
		/* equal heights */
		if ($('.equalheight').length > 0) $('.equalheight').equalHeights();
		if ($('.ms-section').length > 0) $('.ms-section').equalHeights();
		
		/* widget portfolio background image */
		$('.recent-work .widg-folio').each(function() {
			$(this).css('background-image', 'url("' + $(this).attr("data-src") + '")');
		});
		
		/* alert close */
		$('.alert-box-close').on('click', function() {
			$(this).parent('.alert-box').fadeOut();
		});
		
		//Box Banner Background
		$('.box-info').each(function() {
			$(this).parents('.section').find('.box-banner').css('background-image', 'url("' + $(this).parents('.section').find('.box-banner').attr("data-src") + '")');
		});
		
		//Hover Dir
		if($('.grid-hover-dir').length > 0) {
			$('.grid-hover-dir > .masonry-item').each( function() { $(this).hoverdir(); } );
		}
		
		//Before - After Photo
		if($(".twentytwenty-container").length > 0) {
			$(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({default_offset_pct: 0.7});
			$(".twentytwenty-container[data-orientation='vertical']").twentytwenty({default_offset_pct: 0.3, orientation: 'vertical'});
		}
		
		//Animated Modal
		$(".md-trigger, .md-close").on('click', function() {
			$(".md-overlay").toggleClass("show");
		});
		
		//Fitvids
		if($(".fluid-video").length > 0) {
			$(".fluid-video").fitVids();
		}
		
		//Cover Banner
		$('.cover').each(function() {
			var areaHoverHeight = $('.cover').find('.cover-area-hover').outerHeight();
			$('.cover').find('.cover-area').css('height', areaHoverHeight);
			$(this).css('height', areaHoverHeight);
		});
		
		$(window).scroll(function() {
			if ($(this).scrollTop() > 500) {
				$("#backtotop").addClass("on");
			} else {
				$("#backtotop").removeClass("on");
			}
			if ($(this).scrollTop() > 150) {
				$('.header-fix, .header-static').addClass('on-scroll');
			} else {
				$('.header-fix, .header-static').removeClass('on-scroll');
			}
			menu_touched_side();
		});
		
		$('body').on('click', '#backtotop', function() {
			$("html, body").animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		
		/* countdown */
		Countdown();
		
		/* init revolution slider */
		if ($("#rev_slider_1").length > 0) {
			RevolutionInit();
		}
		if ($("#rev_slider_2").length > 0) {
			RevolutionInit2();
		}
		if ($("#rev_slider_3").length > 0) {
			RevolutionInit3();
		}
		if ($("#rev_slider_4").length > 0) {
			RevolutionInit4();
		}
		if ($("#rev_slider_5").length > 0) {
			RevolutionSidebarInit();
		}
	});

})(window, document, jQuery);