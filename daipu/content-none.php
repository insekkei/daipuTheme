<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<a><?php _e( 'Contents are coming soon', 'twentyfifteen' ); ?></a>
	</header><!-- .page-header -->

	<div class="page-content" style="font-size:12px">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'twentyfifteen' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyfifteen' ); ?></p>
			<?php //get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can'."'".'t find what you'."'".'re looking for. Please check something interesting else.', 'twentyfifteen' ); ?></p>
			<?php //get_search_form(); ?>

		<?php endif; ?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
