(function ($) {
    "use strict";

    jQuery(document).ready(function ($) {
        function envato_product_executeCode() {
            var selectedOption = $('.rainbow-theme-envato-product-select').find('option:selected');

            const product_name              = selectedOption.data('product_name');
            const envato_preview_url        = selectedOption.data('envato_preview_url');
            const envato_product_sale       = selectedOption.data('envato_product_sale');
            const envato_product_url        = selectedOption.data('envato_product_url');
            const product_price             = selectedOption.data('product_price');
            const product_desc_html         = selectedOption.data('product_desc_html');
            const product_desc_raw          = selectedOption.data('product_desc_raw');
            const updated_at                = selectedOption.data('updated_at');
            const published_at              = selectedOption.data('published_at');
            const columns                   = selectedOption.data('columns');
            const avg_rating                = selectedOption.data('avg_rating');
            const total_rating              = selectedOption.data('total_rating');
            const icon_url                  = selectedOption.data('icon_url');

            $('input[name="product_other_info"]').val(selectedOption.data('product_other_info'));
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

            if ($('div#wp-content-wrap').hasClass('tmce-active')) {
                // Check if Gutenberg editor is active
                if (typeof wp !== 'undefined' && wp.data && wp.data.select('core/select')) {
                    console.log('Please enable classic widget');
                } else if (typeof tinymce !== 'undefined' && tinymce.activeEditor) {
                    // Fallback to retrieving description from HTML markup
                    var iframe = $('#postdivrich.woocommerce-product-description #content_ifr');
                    if (iframe.length) {
                        var iframeDoc = iframe[0].contentWindow.document;
                        if (iframeDoc) {
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

            // Check if Gutenberg editor is active
            if (typeof wp !== 'undefined' && wp.data && wp.data.select('core/select')) {
                console.log('Please enable classic widget');
            } else if (typeof tinymce !== 'undefined' && tinymce.activeEditor) {
                var iframe = $('#postexcerpt #excerpt_ifr');
                if (iframe.length) {
                    var iframeDoc = iframe[0].contentWindow.document;
                    if (iframeDoc) {
                        $(iframeDoc).find('body').html(product_desc_raw);
                    } else {
                        console.error('Unable to access iframe document');
                    }
                } else {
                    console.error('TinyMCE iframe not found');
                }
            }

            // Call executeCode function again after 24 hours
            //setTimeout(envato_product_executeCode, 7 * 24 * 60 * 60 * 1000); 
        }

        envato_product_executeCode();
    });


}(jQuery));