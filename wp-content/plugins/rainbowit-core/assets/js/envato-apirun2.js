(function ($) {
    "use strict";

    jQuery(document).ready(function ($) {
        function envato_product_executeCode() {
            var selectedOption = $('.rainbow-theme-envato-product-select').find('option:selected');

            const envato_product_sale       = selectedOption.data('envato_product_sale');
            const product_price             = selectedOption.data('product_price');
            const updated_at                = selectedOption.data('updated_at');
            const published_at              = selectedOption.data('published_at');
            const avg_rating                = selectedOption.data('avg_rating');
            const total_rating              = selectedOption.data('total_rating');
            const template_type             = selectedOption.data('template_type');
            $('input[name="_regular_price"]').val(product_price);
            $('input[name="_envato_product_total_sales"]').val(envato_product_sale);
            $('input[name="_envato_product_last_update"]').val(updated_at);
            $('input[name="_envato_product_published_date"]').val(published_at);
            $('input[name="_envato_product_avg_rating"]').val(avg_rating);
            $('input[name="_envato_product_total_rating"]').val(total_rating);
            $('input[name="_envato_product_template_type"]').val(template_type);
        }

        envato_product_executeCode();
    });


}(jQuery));