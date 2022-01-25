/*-----------------------------------------------------------------------------------
	Template Name: Seeva - Medical and Dental HTML Template
	Template URI: https://webtend.net/demo/html/qolle/
	Author: WebTend
	Author URI:  https://webtend.net/
	Version: 1.1

	Note: This is Main Js file
-----------------------------------------------------------------------------------
	Js INDEX
	===================
	##. Main Menu
	##. Sticky Header
	##. Hero Slider
	##. Slider Animation
	##. Testimonials Slider One
	##. Testimonials Slider Two
	##. Testimonials Slider Three
	##. Nice Select
	##. Latest Blog Button Effect
	##. Doctor Boxes Hover
	##. Accordion Class Toggle
	##. Counter
	##. Logo Slider
	##. Service Slider
	##. Doctors Slider Two
	##. Product Gallery
	##. Gallery Filter
	##. Gallery Popup
	##. Video Popup
	##. Progress Bar
	##. Progress Carousel
	##. Preloader
	##. Back To Top

-----------------------------------------------------------------------------------*/
(function ($) {
	"use strict";

	// ===== Main Menu
	function mainMenu() {
		const navbarToggler = $(".navbar-toggler"),
			siteMenu = $(".site-menu"),
			mobilePanel = $(".mobile-slide-panel"),
			mobilePanelMenu = $(".mobile-menu"),
			panelOverly = $(".panel-overlay"),
			navClose = $(".panel-close"),
			canvasBtn = $(".off-canvas-btn"),
			canvasPanel = $(".off-canvas-panel");
		// Panel Click Event
		navbarToggler.on("click", function (e) {
			e.preventDefault();
			mobilePanel.toggleClass("show-panel");
		});
		canvasBtn.on("click", function (e) {
			e.preventDefault();
			canvasPanel.toggleClass("show-panel");
		});
		navClose.on("click", function (e) {
			e.preventDefault();
			mobilePanel.removeClass("show-panel");
			canvasPanel.removeClass("show-panel");
		});
		panelOverly.on("click", function (e) {
			e.preventDefault();
			mobilePanel.removeClass("show-panel");
			canvasPanel.removeClass("show-panel");
		});
		// Adds toggle button to li items that have children
		siteMenu.find("li a").each(function () {
			if ($(this).next().length > 0) {
				$(this).append('<span class="dd-trigger"><i class="far fa-plus"></i></span>');
			}
		});
		mobilePanelMenu.find("li a").each(function () {
			if ($(this).next().length > 0) {
				$(this).append('<span class="dd-trigger"><i class="fas fa-angle-down"></i></span>');
			}
		});
		// Expands the dropdown menu on each click
		mobilePanelMenu.find(".dd-trigger").on("click", function (e) {
			e.preventDefault();
			$(this).parent().parent("li").children("ul.sub-menu").stop(true, true).slideToggle(350);
			$(this).toggleClass("sub-menu-opened");
		});
	}

	// ==== Sticky Header
	function stickyHeader() {
		const scroll_top = $(window).scrollTop(),
			siteHeader = $('.template-header');
		if (siteHeader.hasClass('sticky-header')) {
			if (scroll_top < 110) {
				siteHeader.removeClass('sticky-on');
			} else {
				siteHeader.addClass('sticky-on');
			}
		}
	}

	// ===== Hero Slider
	function heroSlider() {
		const heroSlider = $(".hero-slider");
		heroSlider.each(function () {
			const slider = $(this).find(".hero-slider-active"),
				sliderFirst = slider.find(".single-hero-slider:first-child"),
				sliderArrow = $(this).find(".hero-slider-arrow");
			slider.on("init", function (e, slick) {
				var firstAnimatingElements = sliderFirst.find("[data-animation]");
				slideanimate(firstAnimatingElements);
			});
			slider.on("beforeChange", function (e, slick, currentSlide, nextSlide) {
				var animatingElements = $('div.slick-slide[data-slick-index="' + nextSlide + '"]').find("[data-animation]");
				slideanimate(animatingElements);
			});
			slider.slick({
				infinite: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: false,
				autoplaySpeed: 5000,
				speed: 500,
				arrows: true,
				fade: false,
				dots: false,
				swipe: true,
				nextArrow: '<button class="slick-arrow next-arrow"><i class="far fa-angle-right"></i></button>',
				prevArrow: '<button class="slick-arrow prev-arrow"><i class="far fa-angle-left"></i></button>',
				appendArrows: sliderArrow,
				responsive: [{
					breakpoint: 768,
					settings: {
						arrows: false,
					},
				},],
			});
		});
	}

	// ===== Slider Animation
	function slideanimate(elements) {
		var animationEndEvents = "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
		elements.each(function () {
			var $this = $(this);
			var animationDelay = $this.data("delay");
			var animationType = "animated " + $this.data("animation");
			$this.css({
				"animation-delay": animationDelay,
				"-webkit-animation-delay": animationDelay,
			});
			$this.addClass(animationType).one(animationEndEvents, function () {
				$this.removeClass(animationType);
			});
		});
	}

	// ===== Testimonials Slider One
	function testimonialSliderOne() {
		const slider = $(".testimonial-slider-one");
		slider.slick({
			infinite: true,
			dots: true,
			arrows: false,
			speed: 500,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 5000,
		});
	}

	// ===== Testimonials Slider Two
	function testimonialSliderTwo() {
		const slider = $(".testimonial-slider-two"),
			sliderArrow = $(".testimonial-slider-arrow");
		slider.slick({
			infinite: true,
			dots: false,
			arrows: true,
			speed: 500,
			slidesToShow: 2,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			nextArrow: '<button class="slick-arrow next-arrow"><i class="far fa-angle-right"></i></button>',
			prevArrow: '<button class="slick-arrow prev-arrow"><i class="far fa-angle-left"></i></button>',
			appendArrows: sliderArrow,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 1,
				},
			},],
		});
	}

	// ===== Testimonials Slider Three
	function testimonialSliderThree() {
		const sliderWrap = $(".testimonial-slider-three"),
			contentSlider = sliderWrap.find(".content-wrapper"),
			thumbSlider = sliderWrap.find(".thumb-wrapper"),
			sliderArrow = sliderWrap.find(".slider-arrows");
		thumbSlider.slick({
			infinite: true,
			dots: false,
			arrows: false,
			speed: 500,
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			asNavFor: contentSlider,
			centerMode: true,
			centerPadding: '0',
			focusOnSelect: true
		});
		contentSlider.slick({
			infinite: true,
			dots: false,
			arrows: true,
			speed: 500,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			nextArrow: '<button class="slick-arrow next-arrow"><i class="far fa-angle-right"></i></button>',
			prevArrow: '<button class="slick-arrow prev-arrow"><i class="far fa-angle-left"></i></button>',
			asNavFor: thumbSlider,
			appendArrows: sliderArrow,
			responsive: [{
				breakpoint: 768,
				settings: {
					arrows: false,
				},
			},],
		});
	}

	// ==== Nice Select
	function activeNiceSelect() {
		$("select").niceSelect();
	}

	// ===== A function For Content How on Hover
	function contentShowHover(mainElement, hoverElement) {
		mainElement.each(function () {
			var $this = $(this),
				effectItem = $this.find(hoverElement);
			effectItem.hide();
			$this.hover(function () {
				effectItem.slideDown(300);
			}, function () {
				effectItem.slideUp(300);
			});
		});
	}

	// ===== Latest Blog Button Effect
	function latestBlogButtonEffect() {
		var mainElement = $(".latest-blog-one"),
			buttonArea = $(".btn-area");
		contentShowHover(mainElement, buttonArea);
	}

	// ===== Doctor Boxes Hover
	function doctorBoxesHover() {
		var mainElement = $(".doctor-box-one"),
			buttonArea = $(".social-links");
		contentShowHover(mainElement, buttonArea);
	}

	// ===== Accordion Class Toggle
	function accordionClassToggle() {
		$(".accordion .accordion-header").on("click", function (event) {
			$(".accordion .active-accordion").removeClass("active-accordion");
			$(this).parent().addClass("active-accordion");
			event.preventDefault();
		});
	}

	// ==== Counter
	function counterUp() {
		$(".counter-item").on("inview", function (event, isInView) {
			if (isInView) {
				$(this).find(".counter").each(function () {
					$(this).prop("Counter", 0).animate({
						Counter: $(this).text(),
					}, {
						duration: 4000,
						easing: "swing",
						step: function (now) {
							$(this).text(Math.ceil(now));
						},
					});
				});
				$(this).unbind("inview");
			}
		});
	}

	// ===== Logo Slider
	function logoSlider() {
		const slider = $(".partner-logo-slider");
		slider.slick({
			infinite: true,
			dots: false,
			arrows: false,
			speed: 500,
			slidesToShow: 5,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 3,
				},
			}, {
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
				},
			}, {
				breakpoint: 425,
				settings: {
					slidesToShow: 1,
				},
			},],
		});
	}

	// ===== Service Slider
	function serviceSlider() {
		const slider = $(".service-slider");
		slider.slick({
			infinite: true,
			dots: false,
			arrows: false,
			speed: 500,
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			responsive: [{
				breakpoint: 1400,
				settings: {
					slidesToShow: 3,
				},
			}, {
				breakpoint: 992,
				settings: {
					slidesToShow: 2,
				},
			}, {
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
				},
			},],
		});
	}

	// ===== Doctors Slider Two
	function doctorSliderTwo() {
		const slider = $(".doctors-slider-two");
		slider.slick({
			infinite: true,
			dots: false,
			arrows: false,
			speed: 500,
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 2,
				},
			}, {
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
				},
			},],
		});
	}

	// ===== Product Gallery
	function productGallery() {
		const sliderWrap = $(".product-gallery-wrapper"),
			mainSlider = sliderWrap.find(".main-gallery"),
			thumbSlider = sliderWrap.find(".thumb-gallery");
		thumbSlider.slick({
			infinite: true,
			dots: false,
			arrows: false,
			speed: 500,
			slidesToShow: 3,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			asNavFor: mainSlider,
			centerMode: false,
			focusOnSelect: true
		});
		mainSlider.slick({
			infinite: true,
			dots: false,
			arrows: false,
			speed: 500,
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			asNavFor: thumbSlider,
		});
	}

	// ===== Gallery Filter
	function galleryFilter() {
		$('.gallery-section').imagesLoaded(function () {
			const items = $('.gallery-filter-item').isotope();
			// items on button click
			$('.gallery-filter').on('click', 'li', function (e) {
				const filterValue = $(this).attr('data-filter');
				items.isotope({
					filter: filterValue
				});
			});
			// menu active class
			$('.gallery-filter li').on('click', function (event) {
				$('.gallery-filter .active').removeClass('active');
				$(this).addClass('active');
				event.preventDefault();
			});
		});
	}

	// ===== Gallery Popup
	function galleryPopup() {
		$('.plus-icon').magnificPopup({
			type: 'image',
			gallery: {
				enabled: true
			},
		});
	}

	// ===== Video Popup
	function videoPopup() {
		$('.video-popup').magnificPopup({
			type: 'iframe',
		});
	}

	// ===== Progress Bar
	function progressBar() {
		$(".progress-bar-wrapper").each(function () {
			const percentage = $(this).data('percentage'),
				progressLineWrap = $(this).find('.progress-line-wrap'),
				progressLine = $(this).find('.progress-line'),
				progressLineWidth = percentage + '%',
				progressLineBg = $(this).data('line-bg'),
				progressLineColor = $(this).data('line-color');
			progressLineWrap.css("background-color", progressLineBg);
			progressLine.css("background-color", progressLineColor);
			$(this).on("inview", function (event, isInView) {
				if (isInView) {
					progressLine.css("width", progressLineWidth);
					$(this).unbind("inview");
				}
			});
		});
	}

	// ===== Progress Carousel
	function productCarousel() {
		const slider = $('.product-carousel'),
			sliderArrow = $('.product-carousel-arrows');
		slider.slick({
			infinite: true,
			dots: true,
			arrows: true,
			speed: 500,
			slidesToShow: 4,
			slidesToScroll: 1,
			autoplay: false,
			autoplaySpeed: 5000,
			nextArrow: '<button class="slick-arrow next-arrow"><i class="far fa-angle-right"></i></button>',
			prevArrow: '<button class="slick-arrow prev-arrow"><i class="far fa-angle-left"></i></button>',
			appendArrows: sliderArrow,
			responsive: [{
				breakpoint: 992,
				settings: {
					slidesToShow: 2,
				},
			}, {
				breakpoint: 576,
				settings: {
					slidesToShow: 1,
				},
			},],
		});
	}

	// ===== Back To Top
	function backToTop() {
		$('.back-to-top').on('click', function (event) {
			event.preventDefault();
			$('html, body').animate({
				scrollTop: 0,
			}, 1500);
		});
	}

	// ==== Preloader
	function preloader() {
		$('#preloader').delay(300).fadeOut(400);
	}

	/*---------------------
	=== Document Ready  ===
	----------------------*/
	$(document).ready(function () {
		mainMenu();
		heroSlider();
		activeNiceSelect();
		testimonialSliderOne();
		testimonialSliderTwo();
		testimonialSliderThree();
		latestBlogButtonEffect();
		doctorBoxesHover();
		accordionClassToggle();
		counterUp();
		logoSlider();
		serviceSlider();
		doctorSliderTwo();
		productGallery();
		galleryFilter();
		galleryPopup();
		videoPopup();
		progressBar();
		productCarousel();
		backToTop();
	});

	/*---------------------
	=== Window Scroll  ===
	----------------------*/
	$(window).on("scroll", function () {
		// ===== Show Back to Top
		if ($(this).scrollTop() > 600) {
			$('.back-to-top').addClass('active')
		} else {
			$('.back-to-top').removeClass('active')
		}
		stickyHeader()
	});

	/*------------------
	=== Window Load  ===
	--------------------*/
	$(window).on('load', function () {
		preloader();
		new WOW().init();
	});

})(jQuery);