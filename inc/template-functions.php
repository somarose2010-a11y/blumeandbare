<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package BlumeAndBare
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blumeandbare_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'blumeandbare_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function blumeandbare_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'blumeandbare_pingback_header' );

/**
 * Shop URL helper.
 *
 * @return string
 */
function blumeandbare_shop_url() {
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		return wc_get_page_permalink( 'shop' );
	}

	return home_url( '/shop/' );
}

/**
 * Account URL helper.
 *
 * @return string
 */
function blumeandbare_account_url() {
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		return wc_get_page_permalink( 'myaccount' );
	}

	return wp_login_url();
}

/**
 * Cart URL helper.
 *
 * @return string
 */
function blumeandbare_cart_url() {
	if ( function_exists( 'wc_get_cart_url' ) ) {
		return wc_get_cart_url();
	}

	return home_url( '/cart/' );
}

/**
 * Inline header icons.
 *
 * @param string $name Icon key.
 * @return string
 */
function blumeandbare_icon( $name ) {
	$icons = array(
		'search' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="11" cy="11" r="7"/><path d="M20 20l-3.4-3.4"/></svg>',
		'user'   => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="8" r="3.25"/><path d="M5.5 19.5c.8-3.4 3.6-5.25 6.5-5.25s5.7 1.85 6.5 5.25"/></svg>',
		'bag'    => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M6.5 8.5h11l-1 12.5h-9l-1-12.5z"/><path d="M9 8.5V7.25A3 3 0 0 1 12 4.25a3 3 0 0 1 3 3V8.5"/></svg>',
		'menu'   => '<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" aria-hidden="true" focusable="false"><path d="M4 7h16M4 12h16M4 17h16"/></svg>',
	);

	return isset( $icons[ $name ] ) ? $icons[ $name ] : '';
}

/**
 * Header cart link used by WooCommerce fragments.
 */
function blumeandbare_header_cart_link() {
	$count = 0;

	if ( function_exists( 'WC' ) && WC()->cart ) {
		$count = (int) WC()->cart->get_cart_contents_count();
	}
	?>
	<a class="header-action header-cart-link" href="<?php echo esc_url( blumeandbare_cart_url() ); ?>">
		<span class="screen-reader-text"><?php esc_html_e( 'Cart', 'blumeandbare' ); ?></span>
		<?php echo blumeandbare_icon( 'bag' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php if ( $count > 0 ) : ?>
			<span class="header-cart-count"><?php echo esc_html( (string) $count ); ?></span>
		<?php endif; ?>
	</a>
	<?php
}

/**
 * Fallback menu when no menu is assigned to Primary Header.
 */
function blumeandbare_primary_menu_fallback() {
	echo '<ul id="primary-menu" class="menu nav-menu">';
	wp_list_pages(
		array(
			'title_li' => '',
		)
	);
	echo '</ul>';
}
