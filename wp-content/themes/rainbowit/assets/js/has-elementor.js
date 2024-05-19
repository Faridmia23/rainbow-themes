(function() {
	'use strict';

	var $ = jQuery;

	function _typeof(obj) {
		"@babel/helpers - typeof";

		if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
			_typeof = function(obj) {
				return typeof obj;
			};
		} else {
			_typeof = function(obj) {
				return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
			};
		}

		return _typeof(obj);
	}
    var rbt = {
        i: function (e) {
            rbt.d();
            rbt.methods();
        },

        d: function (e) {
            this._window = $(window),
                this._document = $(document),
                this._body = $('body'),
                this._html = $('html'),
                this.sideNav = $('.rbt-search-dropdown')
        },
        methods: function (e) {
          
            rbt.bannerIconShuffle();
            rbt.counterUp();
            rbt.swiperSlider();
            rbt.showTeamMember();
            rbt.stopInputAutofill();
            rbt.selectPicker();
            rbt.onePageNav();
            rbt.imageMoveAnimation();
            rbt._clickDoc();
            rbt.salActive();
            rbt.courseActionBottom();
            rbt.progressReadTime();
        },

        // banner icon shuffle active
        bannerIconShuffle: () => {
            var teamMemberWrapper = $('.banner-icon-wrapper');
            teamMemberWrapper.each(function () {
                $('.banner-icon-wrapper').serialshuffle({
                    folder: '/wp-content/themes/rainbowit/assets/images/banner2/',
                    shuffle: [
                        'icon1.png',
                        'icon2.png',
                        'icon3.png',
                        'icon4.png',
                        'icon5.png',
                        'icon6.png',
                        'icon7.png',
                        'icon8.png',
                        'icon9.png',
                        'icon10.png',
                        'icon11.png',
                        'icon12.png',
                        'icon13.png',
                        'icon14.png',
                        'icon15.png',
                        'icon16.png',
                        'icon17.png',
                        'icon18.png',
                        'icon19.png',
                        'icon20.png',
                        'icon21.png',
                        'icon22.png',
                        'icon23.png',
                    ],
                    speed: 1000,
                });
            })
        },

        // odometer for customer count
        counterUp: function () {
            var odo = $('.odometer');
            odo.each(function () {
                $('.odometer').appear(function (e) {
                    var countNumber = $(this).attr('data-count');
                    $(this).html(countNumber);
                });
            });
        },

        // templates swipper
        swiperSlider: function () {
            // slider for home page
            var swiper = new Swiper('.rbt-swiper-carousel', {
                autoplay: false,
                slidesPerView: 'auto',
                grabCursor: true,
                freeMode: true,
                loop: true,
                allowTouchMove: true,
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.rbt-navigate-next',
                    prevEl: '.rbt-navigate-prev',
                }
            });

            // slider for custom service page
            var swiper2 = new Swiper('.rbt-swiper-corousel-2', {
                autoplay: true,
                slidesPerView: 5,
                spaceBetween: 24,
                freeMode: true,
                pagination: {
                    el: '.swiper-pagination',
                    type: 'bullets',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.rbt-navigate-next',
                    prevEl: '.rbt-navigate-prev',
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        autoplay: true,
                    },
                    575: {
                        slidesPerView: 2,
                        autoplay: true,
                    },
                    992: {
                        slidesPerView: 3,
                    },
                    1200: {
                        slidesPerView: 4,
                        autoplay: false,
                    },
                    1600: {
                        slidesPerView: 5,
                        autoplay: false,
                    },
                }

            })

            // slider for brand section
            var swiper3 = new Swiper('.rbt-brand-group', {
                speed: 8000,
                autoplay:
                {
                    delay: 0,
                },
                loop: true,
                slidesPerView: 3,
                spaceBetween: 24,
                freeMode: true,
                breakpoints: {
                    320: {
                        speed: 8000,
                        autoplay:
                        {
                            delay: 0,
                        },
                        loop: true,
                        slidesPerView: 2,
                        spaceBetween: 24,
                        freeMode: true,
                    },
                    768: {
                        speed: 8000,
                        autoplay:
                        {
                            delay: 0,
                        },
                        loop: true,
                        slidesPerView: 3,
                        spaceBetween: 24,
                        freeMode: true,
                    },
                    992: {
                        speed: 0,
                        autoplay: false,
                        loop: false,
                        slidesPerView: 5,
                        spaceBetween: 44,
                        freeMode: true,
                    }
                }
            });
        },


        // random team member img to show
        showTeamMember: () => {
            var teamMemberWrapper = $('.rbt-team-wrapper');
            teamMemberWrapper.each(function () {
                $('.rbt-team-wrapper').serialshuffle({
                    folder: '/wp-content/themes/rainbowit/assets/images/we-are/',
                    shuffle: [
                        '1.png',
                        '2.png',
                        '3.png',
                        '4.png',
                        '5.png',
                        '6.png',
                        '7.png',
                        '8.png',
                        '9.png',
                        '10.png',
                        '11.png',
                        '12.png',
                        '13.png',
                        '14.png',
                        '15.png',
                        '16.png',
                    ],
                    speed: 1000,
                });
            })
        },

        // function for stop default browser input autofill style 
        stopInputAutofill: () => {
            $('input').on('focus', function () {
                $(this).css({
                    'background-color': 'transparent',
                    'transition': 'background-color 5000s ease-in-out 0s'
                });
            }).on('blur', function () {
                $(this).css({
                    'background-color': 'transparent',
                    'transition': 'background-color 5000s ease-in-out 0s'
                });
            });
        },

        // bootstrap select picker
        selectPicker: function () {
            $('select').selectpicker();
        },

        // onepage navigation
        onePageNav: function () {
            $('.rbt-onepagenav').onePageNav({
                currentClass: 'current',
                changeHash: false,
                scrollSpeed: 500,
                scrollThreshold: 0.2,
                filter: '',
                easing: 'swing',
            });
        },


        // Image move animation
        imageMoveAnimation: function () {
            $('.scene').each(function () {
                new Parallax($(this)[0]);
            });
        },

        //input field focus
        _clickDoc: function () {
            var inputblur, inputFocus, openSideNav, closeSideNav;
            inputblur = function (e) {
                if (!$(this).val()) {
                    $(this).parent('.single-field').removeClass('focused');
                }
            };
            inputFocus = function (e) {
                $(this).parents('.single-field').addClass('focused');
            };
            openSideNav = function (e) {
                e.preventDefault();
                eduJs.sideNav.addClass('active');
                $('.search-trigger-active').addClass('open');
                eduJs._html.addClass('side-nav-opened');
            };

            closeSideNav = function (e) {
                if (!$('.rbt-search-dropdown, .rbt-search-dropdown *:not(".search-trigger-active, .search-trigger-active *")').is(e.target)) {
                    eduJs.sideNav.removeClass('active');
                    $('.search-trigger-active').removeClass('open');
                    eduJs._html.removeClass('side-nav-opened');
                }
            };
            rbt._document
                .on('blur', 'input,textarea,select', inputblur)
                .on('focus', 'input:not([type="radio"]),input:not([type="checkbox"]),textarea,select', inputFocus)
                .on('click', '.search-trigger-active', openSideNav)
                .on('click', '.side-nav-opened', closeSideNav)
        },

        // sal animation activate
        salActive: function () {
            sal();
        },

        // course action bottom
        courseActionBottom: function () {
            var scrollBottom = $('.rbt-course-action-bottom'),
                targetPossition = $(document).height() + 500;
            $(window).scroll(function () {
                $('.rbt-course-action-bottom').toggleClass('rbt-course-action-active', $(this).scrollTop() > 700 && $(this).scrollTop() < targetPossition)
            })
        },

        // progressReadTime
        progressReadTime: () => {
            $(document).ready(function () {
                $(window).scroll(function () {
                    var scroll = $(window).scrollTop();
                    var documentHeight = $(document).height();
                    var windowHeight = $('.rbt-blogs-details').height();
                    var scrollPercentage = (scroll / (documentHeight - windowHeight)) * 100;
                    $('progress').attr('value', scrollPercentage);
                });
            });
        },



    }

	function _defineProperty(obj, key, value) {
		if (key in obj) {
			Object.defineProperty(obj, key, {
				value: value,
				enumerable: true,
				configurable: true,
				writable: true
			});
		} else {
			obj[key] = value;
		}

		return obj;
	}

	var ThemeHelper = {
		
        
	};

	function widthgen() {
		$(window).on('load resize', elementWidth);

		function elementWidth() {
			$('.elementwidth').each(function() {
				var $container = $(this),
					width = $container.outerWidth(),
					classes = $container.attr("class").split(' ');
				var classes1 = startWith(classes, 'elwidth');
				classes1 = classes1[0].split('-');
				classes1.splice(0, 1);
				var classes2 = startWith(classes, 'elmaxwidth');
				classes2.forEach(function(el) {
					$container.removeClass(el);
				});
				classes1.forEach(function(el) {
					var maxWidth = parseInt(el);

					if (width <= maxWidth) {
						$container.addClass('elmaxwidth-' + maxWidth);
					}
				});
			});
		}


		function startWith(item, stringName) {
			return $.grep(item, function(elem) {
				return elem.indexOf(stringName) == 0;
			});
		}
	}

	
	widthgen();
	

	
    function content_ready_scripts() {
        rbt.i();
         
	}

	function content_load_scripts() {	
		rbt.i();
         
       
	}

	$(document).ready(function() {
		content_ready_scripts();	

	});

	$(window).on('load', function() {
		content_load_scripts();	
	 
	});

	$(window).on('load resize', function() {			
		content_load_scripts();
	});	



	$(window).on('elementor/frontend/init', function() {
		if (elementorFrontend.isEditMode()) {
			elementorFrontend.hooks.addAction('frontend/element_ready/widget', function() {
				content_ready_scripts();
				content_load_scripts();

			});
		}
	});


    var change_elementor_options = function() {
        if ( typeof elementorFrontend === 'undefined' ) {
            return;
        }
    
        elementorFrontend.on( 'components:init', function() {
            elementorFrontend.utils.anchors.setSettings( 'selectors.targets', '.dummy-selector' );
        } );
    };
    
    $( window ).on( 'elementor/frontend/init', change_elementor_options );

}());

