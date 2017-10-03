/*=================================================================
	mobile menu
===================================================================*/
function mobileMenu() {
	if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
		var window_width = $(window).width();
		if (window_width <= 768) {
			$('.mobile-icon .hamburger').on('click', function() {
				if($('.main-menu').hasClass("open")) {
					$('.main-menu').slideUp();
				} 
				else {
					$('.main-menu').slideDown();
				}
				$('.main-menu').toggleClass("open");
				$(this).toggleClass('open');
			});
			$('.main-menu li a, .main-menu li h3').on('click', function() {
				if($(this).siblings('ul').hasClass("open")) {
					$(this).siblings('ul').slideUp();
				} 
				else {
					$(this).siblings('ul').slideDown();
				}
				$(this).toggleClass("open");
				$(this).siblings('ul').toggleClass("open");
			});
		}
	}
}

/*=================================================================
	boxed layout
===================================================================*/
function boxLayout() {
	$('.block-progressbar').each(function() {
		if($(this).hasClass('style-2')) {
			$(this).find('.progress-tooltip').text($(this).find('.progressbar').attr('data-transitiongoal') + "%");
		}
		$(this).find('.progressbar').progressbar({ display_text: 'center' });
		$(this).find('.progressbar').css('background-color', $(this).find('.progressbar').attr('data-color'));
	});
}

/*=================================================================
	typed text
===================================================================*/
function typedText() {
	if ($("#typed").length > 0) {
		$("#typed").typed({
			stringsElement: $("#typed-strings"),
			typeSpeed: 30,
			backDelay: 500,
			loop: true,
			contentType: "html", // or text
			loopCount: false,
			cursorChar: "|",
		});
	}
	if ($("#typed-2").length > 0) {
		$("#typed-2").typed({
			stringsElement: $("#typed-strings-2"),
			typeSpeed: 30,
			backDelay: 500,
			loop: true,
			contentType: "html", // or text
			loopCount: false,
			cursorChar: "|",
		});
	}
}

/*=================================================================
	pie chart
===================================================================*/
function pieChart() {
	if($(".piechart").length > 0) {
		$(".piechart").each(function () {
			var $this = $(this);
			var value = Number($this.data("value")) / 100;
			
			var option = {
				strokeWidth: 4,
				trailWidth: 4,
				duration: 1500,
				easing: "linear",
				text: {
					value: "0%"
				},
				step: function (state, bar) {
					bar.setText((bar.value() * 100).toFixed(0) + "%");
				}
			}
			
			var circle = new ProgressBar.Circle($(this)[0], option);
			
			circle.animate(value);
		});
	}
}

/*=================================================================
	count to
===================================================================*/
function countTo() {
	if ($('.counter-wraper').length > 0) {
		$('.counter-wraper').each(function(index) {
			var $this = $(this);
			var waypoint = $this.waypoint({
				handler: function(direction) {
					$this.find('.counter-digit:not(.counted)').countTo().addClass('counted');
				},
				offset: "90%"
			});
		});
	}
}

/*=================================================================
	split slider
===================================================================*/
function splitSlider() {
	if($('#multiScroll').length > 0) {
		if ($(window).width() > 768) {
			$('#multiScroll').multiscroll({
				sectionsColor: [],
				menu: false,
				navigation: true,
				loopBottom: true,
				loopTop: true
			});
			$('#multiscroll-nav > ul > li ').each(function(index) {
				$(this).children('a').attr('href', 'javascript:void()');
			});
		}
	}
}

/*=================================================================
	flip box
===================================================================*/
function flipBox() {
	$('.fb-equal-height').each(function() {
		var a = parseInt($(this).find(".fb-front > div").outerHeight(!0), 10),
			b = parseInt($(this).find(".fb-back > div").outerHeight(!0), 10),
			c = a > b ? a : b;
			
		$(this).find(".fb-front").css({"height": c + "px", "min-height": "180px"});
		$(this).find(".fb-back").css({"height": c + "px", "min-height": "180px"});
		$(this).find(".flip-box-inner").css({"height": c + "px", "min-height": "180px"});
		$(this).find(".flip-box-section").css({"height": c + "px", "min-height": "180px"});
	});
}

/*=================================================================
	portfolio
===================================================================*/
function portfolio() {
	$(".pc-show").on('click', function() {
		$(this).parent('.content').toggleClass("show");
	});
	$('.portfolio-grid > .masonry-item').each(function() {
		var imgHeight = $(this).find('img').outerHeight();
		$(this).find('.portfolio-media.style-19').css('height', imgHeight - 30);
	});
	
	if($('.image-gallery-inner').length > 0 || $('.slider-single').length > 0) {
		slideSlick();
	}
}

/*=================================================================
	toggles
===================================================================*/
function toggles() {
	/* search close button */
	$('.kameleon-search-closer').on('click', function() {
		$('.fullscreen-search, .wide-search, .topfixed-search, .small-search, .dropdown-search').toggleClass('show');
		
		//fullscreen menu
		$(".full-screen-menu .sub-menu").removeClass("active").removeClass("open");
		$(".full-screen-menu").children("ul.menu").removeClass('open');
		$('.hamburger').toggleClass('open');
	});
	
	/* search */
	$('.search-link').on('click', function() {
		$('.fullscreen-search, .wide-search, .topfixed-search, .small-search, .dropdown-search').toggleClass('show');
	});
	
	/* widgets */
	$('.widgetarea-link .menu-bar').on('click', function() {
		$(this).toggleClass('shown');
		$('.site, .widget-area').toggleClass('shown');
	});
	$('.widget-area-closer').on('click', function() {
		$('.widgetarea-link .menu-bar').removeClass('shown');
		$('.site, .widget-area').toggleClass('shown');
	});
	
	/* fullscreen menu */
	$('.popup-menu-link .menu-bar, .kameleon-search-closer, .mobile-icon .hamburger').on('click', function() {
		$('.fullscreen-menu').toggleClass('show');
	});
	$('.full-screen-menu li a').on('click', function() {
		if($(this).siblings("ul.sub-menu").size() > 0) {
			$(this).parents('ul.menu').addClass('open');
			$(this).parent("li").parent('ul.sub-menu').removeClass('active').addClass("open");
			$(this).siblings('ul.sub-menu').addClass('active');
		}
	});
	$('.menu-back-home').on('click', function() {
		$(".full-screen-menu .sub-menu").removeClass("active").removeClass("open");
		$(".full-screen-menu").children("ul.menu").removeClass('open');
	});
	$('.menu-back-icon').on('click', function() {
		$(this).parents(".menu-back").parent(".sub-menu").removeClass("active");
		var parent_menu = $(this).parents(".menu-back").parent(".sub-menu").parent("li").parent("ul");
		if(parent_menu.hasClass("sub-menu")) {
			parent_menu.removeClass("open").addClass("active");
		} else {
			parent_menu.removeClass("open");
		}
	});
	
	/* sidebar menu */
	$('.closer-icon').on('click', function() {
		$('.header-5, .sidebar-menu-icon').toggleClass('open');
		$('.sidebar-menu-link .menu-bar').toggleClass('shown');
	});
	$('.closer-icon.alt').on('click', function() {
		$('.site').toggleClass('shown-left');
	});
	$('.sidebar-menu-button').on('click', function() {
		$('.sidebar-menu-icon, .header-5').toggleClass('open');
	});
	$('.sidebar-menu-link .menu-bar').on('click', function() {
		$('.header-5').toggleClass('open');
		$('.sidebar-menu-link .menu-bar').toggleClass('shown');
		$('.site').toggleClass('shown-left');
	});
}

/*=================================================================
	progress bars
===================================================================*/
function progressBar() {
	$('.block-progressbar').each(function() {
		if($(this).hasClass('style-2')) {
			$(this).find('.progress-tooltip').text($(this).find('.progressbar').attr('data-transitiongoal') + "%");
		}
		$(this).find('.progressbar').progressbar({ display_text: 'center' });
		$(this).find('.progressbar').css('background-color', $(this).find('.progressbar').attr('data-color'));
	});
}

/*=================================================================
	pricing
===================================================================*/
function pricing() {
	$('.pricing').each(function() {
		if(!$(this).hasClass("style-6")) {
			$(this).css('background-color', $(this).attr('data-bg-color'));
		}
		if($(this).hasClass("style-1")) {
			$(this).children('.button').children('a').css('background-color', $(this).attr('data-bg-color'));
		}
		if($(this).hasClass("style-6")) {
			$(this).children('.heading').css('background-color', $(this).attr('data-bg-color'));
			$(this).children('.price').css('background-color', $(this).attr('data-bg-color'));
			$(this).children('.button').children('a').css('background-color', $(this).attr('data-bg-color'));
		}
	});
}

/*=================================================================
	countdown function
===================================================================*/
function Countdown() {
	if ($(".pl-clock").length > 0) {
		$(".pl-clock").each(function() {
			var time = $(this).attr("data-time");
			$(this).countdown(time, function(event) {
				var $this = $(this).html(event.strftime('' + '<div class="countdown-item"><div class="countdown-item-value">%D</div><div class="countdown-item-label">Days</div></div>' + '<div class="countdown-item"><div class="countdown-item-value">%H</div><div class="countdown-item-label">Hours</div></div>' + '<div class="countdown-item"><div class="countdown-item-value">%M</div><div class="countdown-item-label">Minutes</div></div>' + '<div class="countdown-item"><div class="countdown-item-value">%S</div><div class="countdown-item-label">Seconds</div></div>'));
			});
		});
	}
}

/*=================================================================
	portfolio popup function
===================================================================*/
function portfolioPopup() {
	//Ajax popup
	if ($(".popup").length > 0) {
		$('.popup').magnificPopup({
			type: 'ajax',
			// Delay in milliseconds before popup is removed
			removalDelay: 300,

			// Class that is added to popup wrapper and background
			// make it unique to apply your CSS animations just to this exact popup
			mainClass: 'mfp-fade'
		});
	}
}

/*=================================================================
	fullscreen section function
===================================================================*/
function fullScreenHeight() {
	var wh = $(window).height();
	$('.section-fullscreen').css({ height: wh });
}

/*=================================================================
	rotator text function
===================================================================*/

function initRotationText() {
	if ($('#js-rotating').length > 0) {
		$("#js-rotating").Morphext({
			animation: "slideInUp",
			// An array of phrases to rotate are created based on this separator. Change it if you wish to separate the phrases differently (e.g. So Simple | Very Doge | Much Wow | Such Cool).
			separator: ",",
			// The delay between the changing of each phrase in milliseconds.
			speed: 2000,
			complete: function() {
				// Called after the entrance animation is executed.
			}
		});
	}
}

/*=================================================================
	owl carousel slider function
===================================================================*/
function owlCarousel(){
	if ($(".testimonial-carousel").length > 0) {
		$(".testimonial-carousel").each(function(){
			$(this).owlCarousel({
				items: 1,
				loop: true,
				mouseDrag: true,
				navigation: false,
				dots: true,
				pagination: true,
				autoplay: true,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				itemsDesktop: [1199, 1],
				itemsDesktopSmall: [979, 1],
				itemsTablet: [768, 1],
				itemsMobile: [479, 1]
			});
		});
	}
	if ($(".client-carousel").length > 0) {
		$(".client-carousel").each(function(){
			var autoplay = ($(this).attr("data-auto-play") === "true") ? true : false;
			$(this).owlCarousel({
				items: $(this).attr("data-desktop"),
				loop: true,
				mouseDrag: true,
				navigation: false,
				dots: false,
				pagination: false,
				autoPlay: autoplay,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				itemsDesktop: [1199, $(this).attr("data-desktop")],
				itemsDesktopSmall: [979, $(this).attr("data-laptop")],
				itemsTablet: [768, $(this).attr("data-tablet")],
				itemsMobile: [479, $(this).attr("data-mobile")]
			});
		});
	}
	if ($(".team-carousel").length > 0) {
		$(".team-carousel").each(function(){
			var autoplay = ($(this).attr("data-auto-play") === "true") ? true : false;
			$(this).owlCarousel({
				items: $(this).attr("data-desktop"),
				loop: true,
				mouseDrag: true,
				navigation: false,
				dots: false,
				pagination: true,
				autoPlay: autoplay,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				itemsDesktop: [1199, $(this).attr("data-desktop")],
				itemsDesktopSmall: [979, $(this).attr("data-laptop")],
				itemsTablet: [768, $(this).attr("data-tablet")],
				itemsMobile: [479, $(this).attr("data-mobile")]
			});
		});
	}
	if ($(".team-carousel-2").length > 0) {
		$(".team-carousel-2").each(function(){
			var autoplay = ($(this).attr("data-auto-play") === "true") ? true : false;
			$(this).owlCarousel({
				items: $(this).attr("data-desktop"),
				loop: true,
				mouseDrag: true,
				navigation: true,
				dots: false,
				pagination: false,
				autoPlay: autoplay,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				smartSpeed: 1000,
				autoplayHoverPause: true,
				navigationText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
				itemsDesktop: [1199, $(this).attr("data-desktop")],
				itemsDesktopSmall: [979, $(this).attr("data-laptop")],
				itemsTablet: [768, $(this).attr("data-tablet")],
				itemsMobile: [479, $(this).attr("data-mobile")]
			});
		});
	}
}

/*=================================================================
	google map function
===================================================================*/
function GoogleMap() {
	// When the window has finished loading create our google map below
	var marker_image = "../images/map-marker.png";

	if ($('#map').length > 0) {
		if ($('#map').attr('data-marker-image') != undefined) {
			marker_image = $('#map').attr('data-marker-image')
		}
		google.maps.event.addDomListener(window, 'load', init);
	}

	function init() {
		// Basic options for a simple Google Map
		// For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
		var mapOptions = {
			// How zoomed in you want the map to start at (always required)
			zoom: 11,
			scrollwheel: false,

			// The latitude and longitude to center the map (always required)
			center: new google.maps.LatLng(40.6000, -73.9400), // New York

			// How you would like to style the map.
			// This is where you would paste any style found on Snazzy Maps.
			styles: [{
				"featureType": "water",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#e9e9e9"
					},
					{
						"lightness": 17
					}
				]
			},
			{
				"featureType": "landscape",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#f5f5f5"
					},
					{
						"lightness": 20
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "geometry.fill",
				"stylers": [
					{
						"color": "#ffffff"
					},
					{
						"lightness": 17
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "geometry.stroke",
				"stylers": [
					{
						"color": "#ffffff"
					},
					{
						"lightness": 29
					},
					{
						"weight": 0.2
					}
				]
			},
			{
				"featureType": "road.arterial",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#ffffff"
					},
					{
						"lightness": 18
					}
				]
			},
			{
				"featureType": "road.local",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#ffffff"
					},
					{
						"lightness": 16
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#f5f5f5"
					},
					{
						"lightness": 21
					}
				]
			},
			{
				"featureType": "poi.park",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#dedede"
					},
					{
						"lightness": 21
					}
				]
			},
			{
				"elementType": "labels.text.stroke",
				"stylers": [
					{
						"visibility": "on"
					},
					{
						"color": "#ffffff"
					},
					{
						"lightness": 16
					}
				]
			},
			{
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"saturation": 36
					},
					{
						"color": "#333333"
					},
					{
						"lightness": 40
					}
				]
			},
			{
				"elementType": "labels.icon",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "transit",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#f2f2f2"
					},
					{
						"lightness": 19
					}
				]
			},
			{
				"featureType": "administrative",
				"elementType": "geometry.fill",
				"stylers": [
					{
						"color": "#fefefe"
					},
					{
						"lightness": 20
					}
				]
			},
			{
				"featureType": "administrative",
				"elementType": "geometry.stroke",
				"stylers": [
					{
						"color": "#fefefe"
					},
					{
						"lightness": 17
					},
					{
						"weight": 1.2
					}
				]
			}]
		};

		// Get the HTML DOM element that will contain your map
		// We are using a div with id="map" seen below in the <body>
		var mapElement = document.getElementById('map');
		// Create the Google Map using our element and options defined above
		var map = new google.maps.Map(mapElement, mapOptions);

		// Let's also add a marker while we're at it
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(40.6000, -73.9400),
			map: map,
			title: 'Location 1',
			icon: marker_image
		});

	}
}

function GoogleMap2() {
	// When the window has finished loading create our google map below
	var marker_image = "../images/map-marker.png";

	if ($('#map2').length > 0) {
		if ($('#map2').attr('data-marker-image') != undefined) {
			marker_image = $('#map2').attr('data-marker-image')
		}
		google.maps.event.addDomListener(window, 'load', init);
	}

	function init() {
		// Basic options for a simple Google Map
		// For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
		var mapOptions = {
			// How zoomed in you want the map to start at (always required)
			zoom: 11,
			scrollwheel: false,

			// The latitude and longitude to center the map (always required)
			center: new google.maps.LatLng(40.6000, -73.9400), // New York

			// How you would like to style the map.
			// This is where you would paste any style found on Snazzy Maps.
			styles: [{
				"featureType": "all",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"saturation": 36
					},
					{
						"color": "#000000"
					},
					{
						"lightness": 40
					}
				]
			},
			{
				"featureType": "all",
				"elementType": "labels.text.stroke",
				"stylers": [
					{
						"visibility": "on"
					},
					{
						"color": "#000000"
					},
					{
						"lightness": 16
					}
				]
			},
			{
				"featureType": "all",
				"elementType": "labels.icon",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "administrative",
				"elementType": "geometry.fill",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 20
					}
				]
			},
			{
				"featureType": "administrative",
				"elementType": "geometry.stroke",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 17
					},
					{
						"weight": 1.2
					}
				]
			},
			{
				"featureType": "landscape",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 20
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 21
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "geometry.fill",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 17
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "geometry.stroke",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 29
					},
					{
						"weight": 0.2
					}
				]
			},
			{
				"featureType": "road.arterial",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 18
					}
				]
			},
			{
				"featureType": "road.local",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 16
					}
				]
			},
			{
				"featureType": "transit",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 19
					}
				]
			},
			{
				"featureType": "water",
				"elementType": "geometry",
				"stylers": [
					{
						"color": "#000000"
					},
					{
						"lightness": 17
					}
				]
			}]
		};

		// Get the HTML DOM element that will contain your map
		// We are using a div with id="map" seen below in the <body>
		var mapElement = document.getElementById('map2');
		// Create the Google Map using our element and options defined above
		var map = new google.maps.Map(mapElement, mapOptions);

		// Let's also add a marker while we're at it
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(40.6000, -73.9400),
			map: map,
			title: 'Location 1',
			icon: marker_image
		});

	}
}
function Map() {
	$('.maps').on('click', function() {
		$('.maps iframe').css("pointer-events", "auto");
	});
	$('.maps').on('mouseleave', function() {
	  $('.maps iframe').css("pointer-events", "none"); 
	});
}

/*=================================================================
	slick slider
===================================================================*/

function slideSlick() {
	/* sync Horizontal */
	$('.image-gallery-inner').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		dots: false,
		infinite: false,
		asNavFor: '.image-gallery-nav',
		responsive: [
			{
				breakpoint: 480,
				settings: {
					dots: true
				}
			}
		]
	});
	
	$('.image-gallery-nav').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		asNavFor: '.image-gallery-inner',
		arrows: true,
		dots: false,
		infinite: false,
		focusOnSelect: true,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 4
				}
			},
		]
	});
	
	$('.slider-single').slick({
		prevArrow: '<div class="slick-prev"><i class="fa fa-long-arrow-left"></i></div>',
		nextArrow: '<div class="slick-next"><i class="fa fa-long-arrow-right"></i></div>',
	});
}

/*=================================================================
	main menu
===================================================================*/
function menu_touched_side(){
	var $menu = $('.main-menu');
	$menu.children('ul').children('li').each(function(){
		var $submenu = $(this).children('ul.sub-menu');
		$submenu.children('li').each(function(){
			var $sub_submenu = $(this).children('ul');
			if($sub_submenu.length > 0){
				if($sub_submenu.offset().left + $sub_submenu.width() > $(window).width()){
					$sub_submenu.parents('ul.sub-menu').addClass('back');
				} else if($sub_submenu.offset().left < 0){
					$sub_submenu.parents('ul.sub-menu').addClass('back');
				}
			}            
		});            
	});
}

/*=================================================================
	revolution slider function
===================================================================*/
function RevolutionInit() {
	var overlay = $("#rev_slider_1").attr("data-overlay");
	$("#rev_slider_1").show().revolution({
		sliderLayout:"fullscreen",
		dottedOverlay:overlay,
		delay:15000,
		navigation: {
			keyboardNavigation:"off",
			keyboard_direction: "horizontal",
			mouseScrollNavigation:"off",
			mouseScrollReverse:"default",
			onHoverStop:"off",
			arrows: {
				style:"zeus",
				enable:true,
				hide_onmobile:false,
				hide_onleave:true,
				hide_delay:200,
				hide_delay_mobile:1200,
				tmp:'<div class="tp-title-wrap">  	<div class="tp-arr-imgholder"></div> </div>',
				left: {
					h_align:"left",
					v_align:"center",
					h_offset:20,
					v_offset:0
				},
				right: {
					h_align:"right",
					v_align:"center",
					h_offset:20,
					v_offset:0
				}
			}
		},
		responsiveLevels:[1240,1024,778,480],
		visibilityLevels:[1240,1024,778,480],
		gridwidth:[1240,1024,778,480],
		gridheight:[868,768,960,720],
		lazyType:"none",
		parallax: {
			type:"mouse",
			origo:"enterpoint",
			speed:400,
			levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,55],
			type:"mouse",
		},
		shadow:0,
		spinner:"spinner0",
		stopLoop:"off",
		stopAfterLoops:-1,
		stopAtSlide:-1,
		shuffle:"off",
		autoHeight:"off",
		fullScreenAutoWidth:"off",
		fullScreenAlignForce:"off",
		fullScreenOffsetContainer: "",
		fullScreenOffset: "",
		disableProgressBar:"on",
		hideThumbsOnMobile:"off",
		hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		debugMode:false,
		fallbacks: {
			simplifyAll:"off",
			nextSlideOnWindowFocus:"off",
			disableFocusListener:false,
		}
	});
}
function RevolutionInit2() {
	var overlay = $("#rev_slider_2").attr("data-overlay");
	$("#rev_slider_2").show().revolution({
		sliderType:"standard",
		sliderLayout:"fullscreen",
		dottedOverlay:overlay,
		delay:30000,
		navigation: {
			keyboardNavigation:"off",
			keyboard_direction: "horizontal",
			mouseScrollNavigation:"off",
			mouseScrollReverse:"default",
			onHoverStop:"off",
			touch:{
				touchenabled:"on",
				swipe_threshold: 75,
				swipe_min_touches: 50,
				swipe_direction: "horizontal",
				drag_block_vertical: false
			}
			,
			bullets: {
				enable:true,
				hide_onmobile:true,
				hide_under:600,
				style:"ares",
				hide_onleave:true,
				hide_delay:200,
				hide_delay_mobile:1200,
				direction:"vertical",
				h_align:"right",
				v_align:"center",
				h_offset:30,
				v_offset:0,
				space:5,
				tmp:'<span class="tp-bullet-title">{{title}}</span>'
			}
		},
		responsiveLevels:[1240,1024,778,480],
		visibilityLevels:[1240,1024,778,480],
		gridwidth:[1920,1024,778,480],
		gridheight:[868,768,760,620],
		lazyType:"none",
		parallax: {
			type:"mouse",
			origo:"slidercenter",
			speed:2000,
			levels:[2,3,4,5,6,7,12,16,10,50,47,48,49,50,51,55],
			type:"mouse",
		},
		shadow:0,
		spinner:"off",
		stopLoop:"on",
		stopAfterLoops:0,
		stopAtSlide:1,
		shuffle:"off",
		autoHeight:"off",
		fullScreenAutoWidth:"off",
		fullScreenAlignForce:"off",
		fullScreenOffsetContainer: "",
		fullScreenOffset: "",
		disableProgressBar:"on",
		hideThumbsOnMobile:"on",
		hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		debugMode:false,
		fallbacks: {
			simplifyAll:"off",
			nextSlideOnWindowFocus:"off",
			disableFocusListener:false,
		}
	});
}
function RevolutionInit3() {
	var overlay = $("#rev_slider_3").attr("data-overlay");
	$("#rev_slider_3").show().revolution({
		sliderType:"standard",
		sliderLayout:"fullwidth",
		dottedOverlay: overlay,
		delay:15000,
		navigation: {
			keyboardNavigation:"off",
			keyboard_direction: "horizontal",
			mouseScrollNavigation:"off",
			mouseScrollReverse:"default",
			onHoverStop:"off",
			arrows: {
				style:"gyges",
				enable:true,
				hide_onmobile:false,
				hide_onleave:true,
				hide_delay:200,
				hide_delay_mobile:1200,
				tmp:'',
				left: {
					h_align:"left",
					v_align:"center",
					h_offset:20,
					v_offset:0
				},
				right: {
					h_align:"right",
					v_align:"center",
					h_offset:20,
					v_offset:0
				}
			}
		},
		responsiveLevels:[1240,1024,778,480],
		visibilityLevels:[1240,1024,778,480],
		gridwidth:[1240,1024,778,480],
		gridheight:[860,768,560,520],
		lazyType:"none",
		parallax: {
			type:"mouse",
			origo:"enterpoint",
			speed:400,
			levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,55],
			type:"mouse",
		},
		shadow:5,
		spinner:"off",
		stopLoop:"off",
		stopAfterLoops:-1,
		stopAtSlide:-1,
		shuffle:"off",
		autoHeight:"off",
		disableProgressBar:"on",
		hideThumbsOnMobile:"off",
		hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		debugMode:false,
		fallbacks: {
			simplifyAll:"off",
			nextSlideOnWindowFocus:"off",
			disableFocusListener:false,
		}
	});
}
function RevolutionInit4() {
	var overlay = $("#rev_slider_4").attr("data-overlay");
	$("#rev_slider_4").show().revolution({
		sliderType:"standard",
		sliderLayout:"fullwidth",
		dottedOverlay: overlay,
		delay:9000,
		navigation: {
			onHoverStop:"off",
		},
		responsiveLevels:[1240,1024,778,480],
		visibilityLevels:[1240,1024,778,480],
		gridwidth:[1240,1024,778,480],
		gridheight:[700,700,560,520],
		lazyType:"none",
		parallax: {
			type:"mouse",
			origo:"enterpoint",
			speed:400,
			levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,55],
			type:"mouse",
		},
		shadow:0,
		spinner:"spinner0",
		stopLoop:"off",
		stopAfterLoops:-1,
		stopAtSlide:-1,
		shuffle:"off",
		autoHeight:"off",
		disableProgressBar:"on",
		hideThumbsOnMobile:"off",
		hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		debugMode:false,
		fallbacks: {
			simplifyAll:"off",
			nextSlideOnWindowFocus:"off",
			disableFocusListener:false,
		}
	});
}
function RevolutionSidebarInit() {
	var overlay = $("#rev_slider_5").attr("data-overlay");
	$("#rev_slider_5").show().revolution({
		sliderType:"standard",
		dottedOverlay:overlay,
		delay:15000,
		navigation: {
			keyboardNavigation:"off",
			keyboard_direction: "horizontal",
			mouseScrollNavigation:"off",
			mouseScrollReverse:"default",
			onHoverStop:"off",
			arrows: {
				style:"zeus",
				enable:true,
				hide_onmobile:false,
				hide_onleave:true,
				hide_delay:200,
				hide_delay_mobile:1200,
				tmp:'<div class="tp-title-wrap">  	<div class="tp-arr-imgholder"></div> </div>',
				left: {
					h_align:"left",
					v_align:"center",
					h_offset:20,
					v_offset:0
				},
				right: {
					h_align:"right",
					v_align:"center",
					h_offset:20,
					v_offset:0
				}
			}
		},
		responsiveLevels:[1240,1024,778,480],
		visibilityLevels:[1240,1024,778,480],
		gridwidth:1543,
		gridheight:1080,
		lazyType:"none",
		parallax: {
			type:"mouse",
			origo:"enterpoint",
			speed:400,
			levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,55],
			type:"mouse",
		},
		shadow:0,
		spinner:"spinner0",
		stopLoop:"off",
		stopAfterLoops:-1,
		stopAtSlide:-1,
		shuffle:"off",
		autoHeight:"off",
		fullScreenAutoWidth:"off",
		fullScreenAlignForce:"off",
		fullScreenOffsetContainer: "",
		fullScreenOffset: "",
		disableProgressBar:"on",
		hideThumbsOnMobile:"off",
		hideSliderAtLimit:0,
		hideCaptionAtLimit:0,
		hideAllCaptionAtLilmit:0,
		debugMode:false,
		fallbacks: {
			simplifyAll:"off",
			nextSlideOnWindowFocus:"off",
			disableFocusListener:false,
		}
	});
}