<?php
/**
 * The header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package BlumeAndBare
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'blumeandbare' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-header__inner">
			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<p class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<?php echo esc_html__( 'Blume', 'blumeandbare' ); ?> <span class="amp">&amp;</span> <?php echo esc_html__( 'Bare', 'blumeandbare' ); ?>
						</a>
					</p>
				<?php endif; ?>
			</div>

			<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary', 'blumeandbare' ); ?>">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'blumeandbare' ); ?></span>
					<?php echo blumeandbare_icon( 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'fallback_cb'    => 'blumeandbare_primary_menu_fallback',
					)
				);
				?>
			</nav>

			<div class="header-actions">
				<button class="header-action header-search-toggle" type="button" aria-expanded="false" aria-controls="header-search-panel">
					<span class="screen-reader-text"><?php esc_html_e( 'Search', 'blumeandbare' ); ?></span>
					<?php echo blumeandbare_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</button>

				<a class="header-action header-account-link" href="<?php echo esc_url( blumeandbare_account_url() ); ?>">
					<span class="screen-reader-text"><?php esc_html_e( 'Account', 'blumeandbare' ); ?></span>
					<?php echo blumeandbare_icon( 'user' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>

				<?php blumeandbare_header_cart_link(); ?>
			</div>
		</div>

		<div id="header-search-panel" class="header-search-panel">
			<form class="header-search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="screen-reader-text" for="header-search-field"><?php esc_html_e( 'Search for:', 'blumeandbare' ); ?></label>
				<input id="header-search-field" type="search" name="s" placeholder="<?php esc_attr_e( 'Search products…', 'blumeandbare' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<input type="hidden" name="post_type" value="product" />
				<?php endif; ?>
				<button type="submit"><?php esc_html_e( 'Search', 'blumeandbare' ); ?></button>
			</form>
		</div>
	</header>
