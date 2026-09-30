<?php
/**
 * The front page template.
 *
 * @package BlumeAndBare
 */

get_header();
?>

	<main id="primary" class="site-main site-main--home">
		<?php get_template_part( 'template-parts/hero', 'banner' ); ?>
	</main>

<?php
get_footer();
