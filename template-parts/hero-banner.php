<?php
/**
 * Homepage hero banner.
 *
 * @package BlumeAndBare
 */

$eyebrow        = get_theme_mod( 'blumeandbare_hero_eyebrow', __( 'Organic skincare, wellness', 'blumeandbare' ) );
$title          = get_theme_mod( 'blumeandbare_hero_title', __( 'Nurture your skin with raw, botanical purity', 'blumeandbare' ) );
$text           = get_theme_mod( 'blumeandbare_hero_text', __( 'Clean, biodegradable formulations crafted to respect your skin’s natural barrier. No fillers, no harsh synthetics—just honest, plant-powered nourishment.', 'blumeandbare' ) );
$primary_label  = get_theme_mod( 'blumeandbare_hero_primary_label', __( 'Shop the collection', 'blumeandbare' ) );
$primary_url     = get_theme_mod( 'blumeandbare_hero_primary_url' );
$secondary_label = get_theme_mod( 'blumeandbare_hero_secondary_label', __( 'Our philosophy', 'blumeandbare' ) );
$secondary_url   = get_theme_mod( 'blumeandbare_hero_secondary_url' );
$image_url       = get_theme_mod( 'blumeandbare_hero_image', '' );

if ( ! $primary_url ) {
	$primary_url = blumeandbare_shop_url();
}

if ( ! $secondary_url ) {
	$secondary_url = home_url( '/about/' );
}

if ( ! $image_url ) {
	$image_url = get_template_directory_uri() . '/assets/images/hero-banner.jpg';
}
?>

<section class="hero-banner" aria-label="<?php esc_attr_e( 'Featured collection', 'blumeandbare' ); ?>">
	<div class="hero-banner__inner">
		<div class="hero-banner__copy">
			<?php if ( $eyebrow ) : ?>
				<p class="hero-banner__eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
			<?php endif; ?>

			<?php if ( $title ) : ?>
				<h1 class="hero-banner__title"><?php echo esc_html( $title ); ?></h1>
			<?php endif; ?>

			<?php if ( $text ) : ?>
				<p class="hero-banner__text"><?php echo esc_html( $text ); ?></p>
			<?php endif; ?>

			<div class="hero-banner__actions">
				<?php if ( $primary_label && $primary_url ) : ?>
					<a class="bb-btn bb-btn--solid" href="<?php echo esc_url( $primary_url ); ?>">
						<?php echo esc_html( $primary_label ); ?>
					</a>
				<?php endif; ?>

				<?php if ( $secondary_label && $secondary_url ) : ?>
					<a class="bb-btn bb-btn--ghost" href="<?php echo esc_url( $secondary_url ); ?>">
						<?php echo esc_html( $secondary_label ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<figure class="hero-banner__media">
			<img
				src="<?php echo esc_url( $image_url ); ?>"
				alt="<?php echo esc_attr( $title ? $title : get_bloginfo( 'name' ) ); ?>"
				width="720"
				height="720"
			/>
		</figure>
	</div>
</section>
