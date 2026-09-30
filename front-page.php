<?php
/**
 * The front page template.
 *
 * Homepage content comes from the Gutenberg editor.
 *
 * @package BlumeAndBare
 */

get_header();
?>

	<main id="primary" class="site-main site-main--home">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</main>

<?php
get_footer();
