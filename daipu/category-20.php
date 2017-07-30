<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header('daipu'); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main index news" role="main">
			<div class="overlay">
				<div class="overlay-con">
				<?php
                $sortArgs = array(
                    'orderby' => 'date'
                );
                $args = array_merge( $wp_query->query_vars,  $sortArgs);

                query_posts($args);

                if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						echo get_category_parents( $cat, true, '' );
					?>
				</header><!-- .page-header -->

				<div class="scrollbar">
                    <div class="track">
                        <div class="thumb">
                            <div class="end"></div>
                        </div>
                    </div>
                </div>
				<div class="viewport">
				<div class="overview">
			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();?>

				<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<div class="entry-title">
							<?php the_time('Y-m-d'); ?><br>
                            <a href="/?p=<?php the_ID()  ?>">
                                <?php the_title(); ?>
                            </a>
						</div>
					</header><!-- .entry-header -->
                    <div class="entry-content">
                        <?php
                    		// Post thumbnail.
                    		twentyfifteen_post_thumbnail();
                    	?>
						<?php the_excerpt(); ?>
					</div><!-- .entry-content -->
				</article>
			<?php
			// End the loop.
			endwhile;
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
        wp_reset_query();
		?>
					</div>
				</div>
			</div>
		</div>
		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>
