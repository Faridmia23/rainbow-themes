(function ($) {
    "use strict";

    jQuery(document).ready(function ($) {
        // const {ajax_nonce, ajax_url} = rainbowit_portfolio_ajax;

        $('.rainbow-theme-envato-product-select').on( 'change', function() {

            var selectedOption = $(this).find('option:selected');

            const product_name          = selectedOption.data('product_name');
            const envato_preview_url    = selectedOption.data('envato_preview_url');
            const envato_product_sale   = selectedOption.data('envato_product_sale');
            const envato_product_url    = selectedOption.data('envato_product_url');
            const product_price         = selectedOption.data('product_price');
            const product_desc_html     = selectedOption.data('product_desc_html');
            const product_desc_raw      = selectedOption.data('product_desc_raw');
            const updated_at            = selectedOption.data('updated_at');
            const published_at          = selectedOption.data('published_at');
            const columns               = selectedOption.data('columns');
            const avg_rating            = selectedOption.data('avg_rating');
            const total_rating          = selectedOption.data('total_rating');
            const icon_url              = selectedOption.data('icon_url');


            $('input[name="product_other_info"').val(selectedOption.data('product_other_info'))
            $('input[name="post_title"]').val(product_name);
            $('input[name="_regular_price"]').val(product_price);
            $('input[name="_envato_product_preview_url"]').val(envato_preview_url);
            $('input[name="_envato_product_total_sales"]').val(envato_product_sale);
            $('input[name="_product_url"]').val(envato_product_url);
            $('input[name="_envato_product_last_update"]').val(updated_at);
            $('input[name="_envato_product_published_date"]').val(published_at);
            $('input[name="_envato_product_column"]').val(columns);
            $('input[name="_envato_product_avg_rating"]').val(avg_rating);
            $('input[name="_envato_product_total_rating"]').val(total_rating);
            $('input[name="_envato_product_preview_icon_url"]').val(icon_url);

            /**
             * Change product content value
             */
            if( $('div#wp-content-wrap').hasClass('tmce-active') ) {
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
            } else {
                $('div#wp-content-wrap textarea').text(product_desc_html);
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

        } );
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

        // Function to execute your code
       
    });


    $('.ajax-order-now-product').on('click', function () {
        const productId = $(this).data('product_id');
        const redirect = $(this).data('redirect_url');
        $.ajax({
            type: 'post',
            url: rainbowit_portfolio_ajax.ajax_url,
            data: {
                action: 'rbt_ajax_product_order_now',
                productId: productId,
                orderNonce: rainbowit_portfolio_ajax.ajax_nonce
            },
            beforeSend: () => {

            },
            success: (response) => {
                // Redirect to the cart page
                window.location.href = redirect;
            },
            complete: () => {
            },
            error: () => {

            }
        })
    });

    $('.envato-product-update').on('click', function () {
        $.ajax({
            type: 'post',
            url: rainbowit_portfolio_ajax.ajax_url,
            data: {
                action: 'rbt_ajax_envato_api_product',
                orderNonce: rainbowit_portfolio_ajax.ajax_nonce
            },
            beforeSend: () => {

            },
            success: (response) => {
                // Redirect to the cart page
            },
            complete: () => {
            },
            error: () => {

            }
        })
    });

}(jQuery));
