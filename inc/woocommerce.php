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

add_filter( 'woocommerce_price_trim_zeros', '__return_true' );

/**
 * Load AJAX add-to-cart on pages that render the bestsellers grid.
 */
function blumeandbare_bestsellers_scripts() {
	if ( ! function_exists( 'WC' ) ) {
		return;
	}

	$post = get_post();
	if ( is_front_page() || ( $post && has_shortcode( $post->post_content, 'bb_bestsellers' ) ) ) {
		wp_enqueue_script( 'wc-add-to-cart' );
	}
}
add_action( 'wp_enqueue_scripts', 'blumeandbare_bestsellers_scripts' );
