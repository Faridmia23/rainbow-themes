const { registerCheckoutFilters } = window.wc.blocksCheckout;

// Adjust the place order button label.
registerCheckoutFilters( 'example-extension', {
  placeOrderButtonLabel: ( value, extensions, args ) => {
    return '💰 Pay now 💰';
  }
} );


