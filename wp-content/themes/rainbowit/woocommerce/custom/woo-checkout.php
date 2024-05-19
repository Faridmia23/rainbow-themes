<?php 

// add_filter( 'woocommerce_checkout_fields' , 'unset_checkout_field' );

// function unset_checkout_field( $fields ) {
//     if (!is_user_logged_in()) {

//         unset( $fields['billing_phone'] );  // Replace 'billing_phone' with the desired field ID
//         unset( $fields['billing_address_1'] );  // Replace 'billing_phone' with the desired field ID
//         unset( $fields['billing_address_2'] );  // Replace 'billing_phone' with the desired field ID
//         unset( $fields['billing_city'] );  // Replace 'billing_phone' with the desired field ID
//         unset( $fields['billing_state'] );  // Replace 'billing_phone' with the desired field ID
//         unset( $fields['billing_postcode'] );  // Replace 'billing_phone' with the desired field ID
//         unset( $fields['billing_country'] );  // Replace 'billing_phone' with the desired field ID

//     }

//   return $fields;
// }