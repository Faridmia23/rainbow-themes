(function ($) {
    "use strict";

    $(function () {
        const { ajax_nonce, ajax_url } = rainbowit_portfolio_ajax;

        $('.rainbow-theme-envato-product-select').on('change', function () {

            var selectedOption = $(this).find('option:selected');

            const product_name = selectedOption.data('product_name');
            const envato_preview_url = selectedOption.data('envato_preview_url');
            const envato_product_sale = selectedOption.data('envato_product_sale');
            const envato_product_url = selectedOption.data('envato_product_url');
            const product_price = selectedOption.data('product_price');
            const product_desc_html = selectedOption.data('product_desc_html');
            const product_desc_raw = selectedOption.data('product_desc_raw');
            const updated_at = selectedOption.data('updated_at');
            const published_at = selectedOption.data('published_at');
            const columns = selectedOption.data('columns');
            const avg_rating = selectedOption.data('avg_rating');
            const total_rating = selectedOption.data('total_rating');
            const icon_url = selectedOption.data('icon_url');
            const template_type = selectedOption.data('template_type');


            $('input[name="product_other_info"').val(selectedOption.data('product_other_info'));
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
            $('input[name="_envato_product_template_type"]').val(template_type);

            /**
             * Change product content value
             */
            if ($('div#wp-content-wrap').hasClass('tmce-active')) {
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

        });

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

    // product redirect checkout page and add to cart product add

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

    // envato product update ajax api call script

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
            },
            complete: () => {
                console.log("completed task");
            },
            error: () => {

            }
        })
    });

    // blog single table content jquery

    $(function () {
        $('#eaw-add-row').on('click', function () {
            let extra_item = $('.empty-row.screen-reader-text').clone(true);
            extra_item.removeClass('empty-row screen-reader-text');
            extra_item.insertBefore('#eaw-repeatable-fieldset-one tbody>tr:last');
            return false;
        });

        $('.eaw-remove-row').on('click', function () {
            $(this).parents('tr').remove();
            return false;
        });
    });


    // ajax load more product scripts

    $(function () {
        

        if ($('.rainbowit-load-more').length) {
            var page = 1;
            var defaultCategory = document.querySelector('.rainbowit-load-more').getAttribute('data-cate');
            var perpage = document.querySelector('.rainbowit-load-more').getAttribute('data-perpage');
            var productby = document.querySelector('.rainbowit-load-more').getAttribute('data-productby');

            // Get the category from the URL
            const urlParams = new URLSearchParams(window.location.search);
            const categoryFromUrl = urlParams.get('category');

            var currentCategory = categoryFromUrl ? categoryFromUrl : defaultCategory; // Track current category

            var dataObject = JSON.parse(productby);
            let product_grid_type = dataObject.product_grid_type;
            let exclude_category = dataObject.exclude_category;
            let post__not_in = dataObject.post__not_in;
            let offset = dataObject.offset;
            let product_orderby = dataObject.product_orderby;
            let product_order = dataObject.product_order;
            let ignore_sticky_posts = dataObject.ignore_sticky_posts;
            let debounceTimeoutData;

            clearTimeout(debounceTimeoutData);
            debounceTimeoutData = setTimeout(function() {

                function loadProducts(category, page) {
                    $.ajax({
                        url: rainbowit_portfolio_ajax.ajax_url,
                        type: 'POST',
                        data: {
                            action: 'rainbowit_load_more_products',
                            page: page,
                            category: category,
                            perpage: perpage,
                            product_grid_type: product_grid_type,
                            exclude_category: exclude_category,
                            post__not_in: post__not_in,
                            offset: offset,
                            product_orderby: product_orderby,
                            product_order: product_order,
                            ignore_sticky_posts: ignore_sticky_posts,
                        },
                        beforeSend: function () {
                            if (page == 1) {
                                $('#loading-spinner-load-more').show();
                            } else {
                                $('#rainbowit-load-more').text('Loading...').prop('disabled', true).show();
                            }
                            

                        },
                        success: function (response) {
                            $('#loading-spinner-load-more').hide(); // Hide spinner
                            if (response) {

                                if (page == 1) {
                                    $('.rbt-tab-items').html(response);
                                } else {
                                    // Append new items with fade-in effect
                                    var $newItems = $(response).css({ opacity: 0 });
                                    $('.rbt-tab-items').append($newItems);
                                    $newItems.animate({ opacity: 1 }, 400); // Adjust animation duration as needed

                                }

                                var activeTab = $('.rbt-tab-link.active');
                                var countFilterValue = parseInt(activeTab.data('countfilter'), 10);

                                var totalPages = Math.ceil(countFilterValue / perpage);

                                $('#rainbowit-load-more').text('Load More').prop('disabled', false).show();

                                // Hide load more button if there are no more pages
                                if (page >= totalPages) {
                                    $('#rainbowit-load-more').text('No more products').prop('disabled', true).hide();
                                }


                            } else {
                                if (page == 1) {
                                    $('.rbt-tab-items').html('<p>No products found</p>');
                                }
                                $('#rainbowit-load-more').text('No more products').prop('disabled', true).hide();
                            }
                        },
                        error: function () {
                            $('#loading-spinner').hide(); // Hide spinner on error
                            $('#rainbowit-load-more').text('Load More').prop('disabled', false).hide();
                        },
                    });
                }

                // Load More Button
                $('#rainbowit-load-more').on('click', function () {
                    page++;
                    loadProducts(currentCategory, page);
                });

                // Filter by Category
                $('.rbt-tab-link').on('click', function () {
                    var button = $(this),
                        category = button.data('filter2').replace('.', '');

                    let allcat = button.data('allcat');

                    category = allcat ? allcat : category;

                    $('.rbt-tab-link').removeClass('');
                    button.addClass('active');
                    currentCategory = category;
                    $('.rainbowit-load-more').attr('data-cate', category);

                    // Reset page to 1 and load products
                    page = 1;
                    loadProducts(category, page);
                });

                // Load default category products on page load
                loadProducts(currentCategory, page);
            }, 500);

        }


        /**
         * Create an ajax for header search
         * 
         * @since 1.0.0
         * @return void
         */

        let debounceTimeout;
        $('.ajax_search_rainbowit_product').on('keydown', function(e) {

            if (e.key === 'Enter') {
                e.preventDefault();
            }
            let searchTitle;
            let searchVal = e.target.value;

            if( searchVal ) {
                searchTitle = "Showing Results for: " + "<span class='search-red-title'>" + searchVal + "</span>";
            } else {
               searchTitle = "All Products";
            }

            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(function() {
                const inputValue = e.target.value;
                // data
                const data = {
                    action: 'rbt_ajax_header_search',
                    url: rainbowit_portfolio_ajax.ajax_url,
                    nonce: rainbowit_portfolio_ajax.ajax_nonce,
                    inputValue
                }
                $.ajax({
                    type: 'post',
                    url: rainbowit_portfolio_ajax.ajax_url,
                    data,
                    beforeSend: () => {
                        $('.rainbow-header-popular-item-ajax').html( '<p>Loading</p>' );
                    },
                    success: (response) => {
                        const content = response?.data?.products;
                        const foundProduct = response?.data?.foundproduct;
                        $('.rainbow-header-popular-item-ajax').html( content );

                        if( foundProduct == 'yes') {
                            $('.rainbowit-search-title').html(searchTitle);
                            $('.rbt-no-search-results-found').css('display', 'none');
                        } else {
                            searchTitle = "Try it our popular items";
                            $('.rainbowit-search-title').html(searchTitle);
                            if( searchVal ) {
                                let notfound = "No result for ";
                                $('.rbt-no-search-results-found').css('display', 'block');
                                 $('.rbt-no-search-results-found').html( notfound +  "<span class='search-red-title'>" + '"' + searchVal + '"' + "</span>"  );
                            } else {
                                $('.rbt-no-search-results-found').css('display', 'none');
                            }
                            
                            
                        }
                    },
                    error: (err) => {
                        console.log(err);
                    }
                })
            }, 500);


        });
    });

    // cart count

    $(document).ready(function() {
        function updateCartCount() {
            $.ajax({
                url: rainbowit_portfolio_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'rainbowit_get_cart_count'
                },
                success: function(response) {
                    $('.rbt-cart-count').text(response);
                }
            });
        }

        // Update the cart count when the page loads
        updateCartCount();
        let intervalID = setInterval(updateCartCount, 300);

        setTimeout(function() {
            clearInterval(intervalID);
        }, 5000);

    });



}(jQuery));