<?php
/**
 * Theme shortcodes.
 *
 * @package BlumeAndBare
 */

function blumeandbare_category_columns_shortcode() {
	$terms = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
		'number'     => 4,
		'exclude'    => array( (int) get_option( 'default_product_cat' ) ),
	) );

	if ( empty( $terms ) || is_wp_error( $terms ) ) {
		return '';
	}

	ob_start();
	?>
	<div class="bb-categories__grid">
		<?php foreach ( $terms as $term ) : ?>
			<a class="bb-category-card" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
				<?php echo wp_get_attachment_image( get_term_meta( $term->term_id, 'thumbnail_id', true ), 'large' ); ?>
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

// Bestsellers shortcode

function blumeandbare_bestsellers_shortcode() {
	if ( ! function_exists( 'wc_get_products' ) ) {
		return '';
	}

	$products = wc_get_products( array(
		'limit'   => 4,
		'orderby' => 'popularity',
	) );

	// No sales yet — show Featured products instead.
	if ( empty( $products ) || ! $products[0]->get_total_sales() ) {
		$products = wc_get_products( array(
			'limit'    => 4,
			'featured' => true,
		) );
	}

	if ( empty( $products ) ) {
		return '';
	}

	ob_start();
	?>
	<div class="bb-bestsellers__grid">
		<?php foreach ( $products as $product ) : ?>
			<?php
			$tags  = get_the_terms( $product->get_id(), 'product_tag' );
			$label = ( $tags && ! is_wp_error( $tags ) ) ? $tags[0]->name : '';
			?>
			<article class="bestseller-card">
				<a class="bestseller-card__image" href="<?php echo esc_url( $product->get_permalink() ); ?>">
					<?php echo $product->get_image( 'large' ); ?>
				</a>
				<div class="bestseller-card__body">
					<?php if ( $label ) : ?>
						<p class="bestseller-card__category"><?php echo esc_html( $label ); ?></p>
					<?php endif; ?>
					<h3 class="bestseller-card__title">
						<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
					</h3>
					<div class="bestseller-card__meta">
						<span class="bestseller-card__price"><?php echo $product->get_price_html(); ?></span>
						<?php blumeandbare_product_rating( $product ); ?>
					</div>
					<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
						class="bestseller-card__cta ajax_add_to_cart add_to_cart_button"
						data-quantity="1"
						data-product_id="<?php echo esc_attr( $product->get_id() ); ?>">
						<?php esc_html_e( 'Add to cart', 'blumeandbare' ); ?>
					</a>
				</div>
			</article>
		<?php endforeach; ?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'bb_bestsellers', 'blumeandbare_bestsellers_shortcode' );
