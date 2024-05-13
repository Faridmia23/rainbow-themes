// (function ($) {
//     "use strict";

//     var $document = $(document),
//         $window = $(window),
//         isEditMode = false;

//     function mybe_note_undefined($selector, $data_atts) {
// 		return ($selector.data($data_atts) !== undefined) ? $selector.data($data_atts) : '';
// 	}

    
//     var reviewsLayout = function () {
//         $('.rbt-layout').isotope({
//             itemSelector: '.rbt-layout-item',
//             percentPosition: true,
//             horizontalOrder: true,
//             masonry: {
//                 columnWidth: '.rbt-layout-item',
//             }
//         });
//     };
    

    
//     /**
//      * lightGallery
//      * @param $scope
//      * @param $
//      * @constructor
//      */
//     var lightGalleryJS = function ($scope, $){
//         lightGallery(document.getElementsByClassName('animated-lightbox')[0], {
//             thumbnail: true,
//             animateThumb: false,
//             showThumbByDefault: false,
//             cssEasing: 'linear'
//         });
//     }


//     // Init 
// 	$(window).on('elementor/frontend/init', function () {
// 	    if(elementorFrontend.isEditMode()) {
// 	        isEditMode = true;
// 	    }
//         elementorFrontend.hooks.addAction('frontend/element_ready/rainbowit-testimonial-widget.default', reviewsLayout);
        
//     });


// }(jQuery));