<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header('daipu'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main index" role="main">
			<div class="overlay">
				<div class="overlay-con">
		<?php


		// Start the loop.
		while ( have_posts() ) : the_post();
			
			// Include the page content template.
			get_template_part( 'content', 'page' );


		// End the loop.
		endwhile;
		?>
			</div>
		</div>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
