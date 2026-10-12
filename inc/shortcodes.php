<?php
/**
 * Theme shortcodes.
 *
 * @package BlumeAndBare
 */

/**
 * Product category grid.
 * Usage: [bb_category_columns]
 */
function blumeandbare_category_columns_shortcode() {
	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => false,
			'number'     => 4,
			'exclude'    => array( (int) get_option( 'default_product_cat' ) ),
		)
	);

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return '';
	}

	ob_start();
	?>
	<div class="bb-categories__grid">
		<?php foreach ( $terms as $term ) : ?>
			<?php $image_id = get_term_meta( $term->term_id, 'thumbnail_id', true ); ?>
			<a class="bb-category-card" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
				<?php echo wp_get_attachment_image( $image_id, 'large' ); ?>
				<span class="bb-category-card__copy">
					<span class="bb-category-card__name"><?php echo esc_html( $term->name ); ?></span>
					<span class="bb-category-card__count"><?php echo (int) $term->count; ?> Products</span>
				</span>
			</a>
		<?php endforeach; ?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'bb_category_columns', 'blumeandbare_category_columns_shortcode' );
