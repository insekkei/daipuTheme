<?php
/**
 * The template for displaying all single posts and attachments
 *
 */

get_header('daipu'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main index default-single" role="main">
			<div class="overlay">
				<div class="overlay-con">
                    <header class="page-header">
    					<?php the_category(); ?>
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
		// Start the loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );

		// End the loop.
		endwhile;
		?>
    </div>
</div>
				</div>
			</div>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
