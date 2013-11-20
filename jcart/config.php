<?php

// jCart v1.3
// http://conceptlogic.com/jcart/

// Do NOT store any sensitive info in this file!!!
// It's loaded into the browser as plain text via Ajax


////////////////////////////////////////////////////////////////////////////////
// REQUIRED SETTINGS

// Path to your jcart files
$config['jcartPath']              = 'jcart/';

// Path to your checkout page
$config['checkoutPath']           = 'checkout.php';

// The HTML name attributes used in your item forms
$config['item']['id']             = 'my-item-id';    // Item id
$config['item']['name']           = 'my-item-name';    // Item name
$config['item']['price']          = 'my-item-price';    // Item price
$config['item']['qty']            = 'my-item-qty';    // Item quantity
$config['item']['url']            = 'my-item-url';    // Item URL (optional)
$config['item']['add']            = 'my-add-button';    // Add to cart button

// Your PayPal secure merchant ID
// Found here: https://www.paypal.com/webapps/customerprofile/summary.view
$config['paypal']['id']           = '7YU68FCYR9BFG';

////////////////////////////////////////////////////////////////////////////////
// OPTIONAL SETTINGS

// Three-letter currency code, defaults to USD if empty
// See available options here: http://j.mp/agNsTx
$config['currencyCode']           = '';

// Add a unique token to form posts to prevent CSRF exploits
// Learn more: http://conceptlogic.com/jcart/security.php
$config['csrfToken']              = false;

// Override default cart text
$config['text']['cartTitle']      = 'Carrito de Compras';    // Shopping Cart
$config['text']['singleItem']     = 'Producto';    // Item
$config['text']['multipleItems']  = 'Productos';    // Items
$config['text']['subtotal']       = 'Subtotal';    // Subtotal
$config['text']['update']         = 'Actualizar';    // update
$config['text']['checkout']       = 'Checkout';    // checkout
$config['text']['checkoutPaypal'] = 'Checkout via Paypal';    // Checkout with PayPal
$config['text']['removeLink']     = 'Eliminar';    // remove
$config['text']['emptyButton']    = 'Vaciar';    // empty
$config['text']['emptyMessage']   = 'Su carrito de compas esta vacio';    // Your cart is empty!
$config['text']['itemAdded']      = 'Producto Agregado';    // Item added!
$config['text']['priceError']     = 'Precio invalido';    // Invalid price format!
$config['text']['quantityError']  = 'Error de cantidad';    // Item quantities must be whole numbers!
$config['text']['checkoutError']  = 'Error de Checkout';    // Your order could not be processed!

// Override the default buttons by entering paths to your button images
$config['button']['checkout']     = '';
$config['button']['paypal']       = '';
$config['button']['update']       = '';
$config['button']['empty']        = '';


////////////////////////////////////////////////////////////////////////////////
// ADVANCED SETTINGS

// Display tooltip after the visitor adds an item to their cart?
$config['tooltip']                = true;

// Allow decimals in item quantities?
$config['decimalQtys']            = false;

// How many decimal places are allowed?
$config['decimalPlaces']          = 2;

// Number format for prices, see: http://php.net/manual/en/function.number-format.php
$config['priceFormat']            = array('decimals' => 2, 'dec_point' => '.', 'thousands_sep' => ',');

// Send visitor to PayPal via HTTPS?
$config['paypal']['https']        = true;

// Use PayPal sandbox?
$config['paypal']['sandbox']      = true;

// The URL a visitor is returned to after completing their PayPal transaction
$config['paypal']['returnUrl']    = 'http://fastfoodes.net23.net/index.php?estatus=ok';

// The URL of your PayPal IPN script
$config['paypal']['notifyUrl']    = 'http://fastfoodes.net23.net/index.php?estatus=notify';

?>