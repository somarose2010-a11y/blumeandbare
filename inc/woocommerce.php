<?php
/**
 * WooCommerce compatibility.
 *
 * @package BlumeAndBare
 */

function blumeandbare_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'blumeandbare_woocommerce_setup' );

/**
 * Use the theme content wrappers on WooCommerce screens.
 */
function blumeandbare_woocommerce_wrapper_before() {
	echo '<main id="primary" class="site-main">';
}

function blumeandbare_woocommerce_wrapper_after() {
	echo '</main>';
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'blumeandbare_woocommerce_wrapper_before' );
add_action( 'woocommerce_after_main_content', 'blumeandbare_woocommerce_wrapper_after' );

/**
 * Refresh the header cart count after AJAX add-to-cart.
 *
 * @param array $fragments Cart fragments.
 * @return array
 */
function blumeandbare_cart_link_fragment( $fragments ) {
	ob_start();
	blumeandbare_header_cart_link();
	$fragments['a.header-cart-link'] = ob_get_clean();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'blumeandbare_cart_link_fragment' );
