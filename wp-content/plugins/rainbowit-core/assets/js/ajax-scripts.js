(function ($) {
    "use strict";
    jQuery(document).ready(function ($) {
        const {ajax_nonce, ajax_url} = rainbowit_portfolio_ajax;


        $('.rainbow-theme-envato-product-select').on( 'change', function() {
            var selectedOption = $(this).find('option:selected');
            const product_name = selectedOption.data('product_name');
            const product_price = selectedOption.data('product_price');
            const product_desc_html = selectedOption.data('product_desc_html');
            const product_desc_raw = selectedOption.data('product_desc_raw');
            $('input[name="product_other_info"').val(selectedOption.data('product_other_info'))
            $('input[name="post_title"]').val(product_name);
            $('input[name="_regular_price"]').val(product_price);
            
            /**
             * Change product content value
             */

            // Check if Gutenberg editor is active
            if (typeof wp !== 'undefined' && wp.data && wp.data.select('core/select')) {
               console.log('Please enable classic widget');
            } else if (typeof tinymce !== 'undefined' && tinymce.activeEditor) {
               // Fallback to retrieving description from HTML markup
               var iframe = $('#postdivrich.woocommerce-product-description #content_ifr');
                // Check if the iframe exists
                if (iframe.length) {
                    // Get the document object of the iframe
                    var iframeDoc = iframe[0].contentWindow.document;

                    // Check if the document object exists
                    if (iframeDoc) {
                        // Set the new content
                        $(iframeDoc).find('body').html(product_desc_html);
                    } else {
                        console.error('Unable to access iframe document');
                    }
                } else {
                    console.error('TinyMCE iframe not found');
                }
            }

            /**
             * Change product excerpt value
             */

            // Check if Gutenberg editor is active
            if (typeof wp !== 'undefined' && wp.data && wp.data.select('core/select')) {
               console.log('Please enable classic widget');
            } else if (typeof tinymce !== 'undefined' && tinymce.activeEditor) {
               // Fallback to retrieving description from HTML markup
               var iframe = $('#postexcerpt #excerpt_ifr');
                // Check if the iframe exists
                if (iframe.length) {
                    // Get the document object of the iframe
                    var iframeDoc = iframe[0].contentWindow.document;

                    // Check if the document object exists
                    if (iframeDoc) {
                        // Set the new content
                        $(iframeDoc).find('body').html(product_desc_raw);
                    } else {
                        console.error('Unable to access iframe document');
                    }
                } else {
                    console.error('TinyMCE iframe not found');
                }
            }
            
        } )
        $(document).on("click", ".upload_image_button", function (e) {
           e.preventDefault();
           var $button = $(this);
           // Create the media frame.
           var file_frame = wp.media.frames.file_frame = wp.media({
              title: 'Select or upload image',
              library: { // remove these to show all
                 type: 'image' // specific mime
              },
              button: {
                 text: 'Select'
              },
              multiple: false  // Set to true to allow multiple files to be selected
           });
           // When an image is selected, run a callback.
           file_frame.on('select', function () {
              // We set multiple to false so only get one image from the uploader
      
              var attachment = file_frame.state().get('selection').first().toJSON();
      
              $button.siblings('input').val(attachment.url);
      
           });
      
           // Finally, open the modal
           file_frame.open();
        });
     });

}(jQuery));