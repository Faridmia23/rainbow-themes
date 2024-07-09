(function (window, document, $, undefined) {
    'use strict';

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
            rbt.headerSticy();
            rbt.megamenuHover();
            rbt.mobileMenuActive();
            rbt.backdropVisible();
          // rbt.bannerIconShuffle();
            rbt.counterUp();
            rbt.swiperSlider();
            rbt.themesGallery();
            rbt.stickyElementModiy();
            rbt.reviewsLayout();
            rbt.tabActivation();
            rbt.tabActivationTwo();
            rbt.showTeamMember();
            rbt.stopInputAutofill();
            rbt.selectPicker();
            rbt.onePageNav();
            rbt.imageMoveAnimation();
            rbt._clickDoc();
            rbt.salActive();
            rbt.courseActionBottom();
            rbt.progressReadTime();
            rbt._searchDoc();
        },

        // header sticky
        headerSticy: () => {
            $(window).scroll(function () {
                $('.rbt-header-wrapper').toggleClass('sticky', $(this).scrollTop() > 0)
            })
        },

        // Mega menu hover tabs
        megamenuHover: () => {
            var dropShadow = $('#products-tab[data-mouse="hover"] a');
            dropShadow.each(function () {
                $('#products-tab[data-mouse="hover"] a').appear(function (e) {
                    $('#products-tab[data-mouse="hover"] a').click(function () {
                        $(this).tab('show');
                    });
                    $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
                        var target = $(e.relatedTarget).attr('href');
                        $(target).removeClass('active');
                    })
                })
            })
        },

        _searchDoc: function () {
            var inputblur, inputFocus, openSideNav, closeSideNav;
            inputblur = function (e) {
				if (!$(this).val()) {
					$(this).parent('.form-group').removeClass('focused');
				}
            };
            inputFocus = function (e) {
				$(this).parents('.form-group').addClass('focused');
            };
            openSideNav = function (e) {
                e.preventDefault();
                rbt.sideNav.addClass('active');
                $('.search-trigger-active').addClass('open');
                rbt._html.addClass('side-nav-opened');
            };

            closeSideNav = function (e) {
				if (!$('.rbt-search-dropdown, .rbt-search-dropdown *:not(".search-trigger-active, .search-trigger-active *")').is(e.target)) {
                    rbt.sideNav.removeClass('active');
                    $('.search-trigger-active').removeClass('open');
                    rbt._html.removeClass('side-nav-opened');
                }
            };
            rbt._document
            .on('blur', 'input,textarea,select', inputblur)
            .on('focus', 'input:not([type="radio"]),input:not([type="checkbox"]),textarea,select', inputFocus)
            .on('click', '.search-trigger-active', openSideNav)
            .on('click', '.side-nav-opened', closeSideNav)
        },

        // mobile menu active
        mobileMenuActive: () => {
            $('.hamberger-button').on('click', function (e) {
                $('.popup-mobile-menu').addClass('active');
            });

            $('.close-menu-btn').on('click', function (e) {
                $('.popup-mobile-menu').removeClass('active');
                $('.popup-mobile-menu .mainmenu .has-dropdown > a, .popup-mobile-menu .mainmenu .with-megamenu > a').siblings('.submenu, .rbt-megamenu').removeClass('active').slideUp('400');
                $('.popup-mobile-menu .mainmenu .has-dropdown > a, .popup-mobile-menu .mainmenu .with-megamenu > a').removeClass('open');
            });

            $('.popup-mobile-menu .mainmenu .has-dropdown > a, .popup-mobile-menu .mainmenu .with-megamenu > a').on('click', function (e) {
                e.preventDefault();
                $(this).siblings('.submenu, .rbt-megamenu').toggleClass('active').slideToggle('400');
                $(this).toggleClass('open');
            })

            $('.popup-mobile-menu, .popup-mobile-menu .mainmenu.onepagenav li a').on('click', function (e) {
                e.target === this && $('.popup-mobile-menu').removeClass('active') && $('.popup-mobile-menu .mainmenu .has-dropdown > a, .popup-mobile-menu .mainmenu .with-megamenu > a').siblings('.submenu, .rbt-megamenu').removeClass('active').slideUp('400') && $('.popup-mobile-menu .mainmenu .has-dropdown > a, .popup-mobile-menu .mainmenu .with-megamenu > a').removeClass('open');
            });
        },

        // Backdrop visible
        backdropVisible: () => {
            $('.has-megamenu').mouseenter(function () {
                $('.backdrop-shadow').addClass('backdrop-shadow-visible');
            })
            $('.has-megamenu').mouseleave(function () {
                $('.backdrop-shadow').removeClass('backdrop-shadow-visible');
            })
        },

       // banner icon shuffle active
        // bannerIconShuffle: () => {
        //     var teamMemberWrapper = $('.banner-icon-wrapper');
        //     teamMemberWrapper.each(function () {
        //         $('.banner-icon-wrapper').serialshuffle({
        //             folder: '/wp-content/themes/rainbowit/assets/images/banner2/',
        //             shuffle: [
        //                 'icon1.webp',
        //                 'icon2.webp',
        //                 'icon3.webp',
        //                 'icon4.webp',
        //                 'icon5.webp',
        //                 'icon6.webp',
        //                 'icon7.webp',
        //                 'icon8.webp',
        //                 'icon9.webp',
        //                 'icon10.webp',
        //                 'icon11.webp',
        //                 'icon12.webp',
        //                 'icon13.webp',
        //                 'icon14.webp',
        //                 'icon15.webp',
        //                 'icon16.webp',
        //                 'icon17.webp',
        //                 'icon18.webp',
        //                 'icon19.webp',
        //                 'icon20.webp',
        //                 'icon21.webp',
        //                 'icon22.webp',
        //                 'icon23.webp',
        //             ],
        //             speed: 1000,
        //         });
        //     })
        // },

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

        // masonary and image load
        themesGallery: function () {
            var masonary = $('.rbt-theme-masonary');
            masonary.each(function () {
                $('.rbt-theme-masonary').imagesLoaded(() => {
                    $('.rbt-theme-masonary').masonry({
                        itemSelector: '.rbt-masonary-item',
                        horizontalOrder: true,
                    });
                })
            })
        },

        // themes gallery sticky element
        stickyElementModiy: function () {
            var stickyElement = $('.rbt-sticky-section');
            stickyElement.each(function () {
                $('.rbt-sticky-section').appear(function (e) {
                    var offset = stickyElement.offset().top;

                    $(window).scroll(function () {
                        if ($(window).scrollTop() >= offset) {
                            stickyElement.addClass('scaled');
                        } else {
                            stickyElement.removeClass('scaled');
                        }
                    });
                })
            })
        },

        // isotope mationary for reviews section
        reviewsLayout: function () {
            $('.rbt-layout').isotope({
                itemSelector: '.rbt-layout-item',
                percentPosition: true,
                horizontalOrder: true,
                masonry: {
                    columnWidth: '.rbt-layout-item',
                }
            });
        },

        // tab activation 1 (this tab in home page)
        tabActivation: function () {
            $('.rbt-tabs-active-2').imagesLoaded(() => {
                $('.rbt-tabs-active').isotope({
                    itemSelector: '.rbt-tab-item',
                });

                $('.rbt-tabs li').click(function () {
                    $('.rbt-tabs li').removeClass('active');
                    $(this).addClass('active');

                    var selector = $(this).attr('data-filter');
                    $('.rbt-tabs-active').isotope({
                        filter: selector
                    });
                    return false;
                });
            })
        },

        // tab activation 2 (this tab in blog page)
        tabActivationTwo: function () {
            $('.rbt-tabs-active-2').imagesLoaded(() => {
                $('.rbt-tabs-active-2').isotope({
                    itemSelector: '.rbt-tab-item-2',
                });

                $('.tabs-3 li').click(function () {
                    $('.tabs-3 li').removeClass('active');
                    $(this).addClass('active');

                    var selector = $(this).attr('data-filter2');
                    $('.rbt-tabs-active-2').isotope({
                        filter: selector
                    });
                    return false;
                })
            })
        },


        // random team member img to show
        showTeamMember: () => {
            var teamMemberWrapper = $('.rbt-team-wrapper');
            teamMemberWrapper.each(function () {
                $('.rbt-team-wrapper').serialshuffle({
                    folder: '/wp-content/themes/rainbowit/assets/images/we-are/',
                    shuffle: [
                        '1.webp',
                        '2.webp',
                        '3.webp',
                        '4.webp',
                        '5.webp',
                        '6.webp',
                        '7.webp',
                        '8.webp',
                        '9.webp',
                        '10.webp',
                        '11.webp',
                        '12.webp',
                        '13.webp',
                        '14.webp',
                        '15.webp',
                        '16.webp',
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
                rbt.sideNav.addClass('active');
                $('.search-trigger-active').addClass('open');
                rbt._html.addClass('side-nav-opened');
            };

            closeSideNav = function (e) {
                if (!$('.rbt-search-dropdown,.search-trigger-close-icon, .rbt-search-dropdown *:not(".search-trigger-active, .search-trigger-active *")').is(e.target)) {
                    rbt.sideNav.removeClass('active');
                    $('.search-trigger-active').removeClass('open');
                    rbt._html.removeClass('side-nav-opened');
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
    
    rbt.i();

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Simulate loading time with a timeout (remove or adjust in production)
        var elements = document.getElementsByClassName('brand-wrapper-preloader');

        if (elements.length > 0) {

            for (var i = 0; i < elements.length; i++) {
                elements[i].style.position = 'relative';
            }
            setTimeout(function() {
                // Hide preloader

                var preloader = document.getElementById('rainbowit-preloader');
                if (preloader) {
                    preloader.style.display = 'none';
                } 
            
                var mainContent = document.getElementsByClassName('counter-wrapper');
                // Show main content
                // Check if any elements were found
                if (mainContent.length > 0) {
                    // Loop through each element and set display to 'block'
                    for (var i = 0; i < mainContent.length; i++) {
                        mainContent[i].style.display = 'flex';
                    }
                }

                // Initialize odometer (assuming you're using the Odometer library)
                var odometerElement = document.querySelector('.odometer');
                var odometerValue = odometerElement.getAttribute('data-count');
                odometerElement.innerHTML = odometerValue;
                var elements2 = document.getElementsByClassName('brand-wrapper-preloader');
                for (var i = 0; i < elements2.length; i++) {
                    elements2[i].style.position = 'relative';
                }
            }, 2000); // Adjust the timeout duration as needed
        }
            
    });

   $('.search-trigger-close-icon').on("click",function(e) {
        e.preventDefault();
        rbt.sideNav.removeClass('active');
        $('.search-trigger-active').removeClass('open');
        rbt._html.removeClass('side-nav-opened');
        
    });

  



})(window, document, jQuery);