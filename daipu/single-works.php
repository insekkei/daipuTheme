<?php
/**
 * The template for displaying single posts which are in works category
 *
 */

get_header('product'); ?>

	<div id="primary" class="content-area product">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

			$content =  apply_filters('the_content', $post->post_content);
			$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
			preg_match_all($pattern,$content,$match); ?>


			<script type="text/javascript">

			jQuery(function($){

				$.supersized({

					// Functionality
					slide_interval          :   3000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	300,		// Speed of transition

					// Components
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					slides 					:

					<?php	echo "[";
						foreach ( $match[1] as $img_url ) {
						//	$image = pathinfo($img_url);
						//	$thumb = $image[dirname]."/".$image[filename]."-150x150.".$image[extension];
		         		  	echo "{image: '". $img_url . "', thumb :'". $img_url . "'},";
						//	echo "{image: '". $img_url . "', thumb :'". $thumb . "'},";
						}
						echo "]";
					?>
				});
		    });

			</script>

			<!--Thumbnail Navigation-->
			<div id="prevthumb"></div>
			<div id="nextthumb"></div>

			<!--Arrow Navigation-->
			<a id="prevslide" class="load-item"></a>
			<a id="nextslide" class="load-item"></a>

			<div id="thumb-tray" class="load-item">
				<div id="thumb-back">&lt;</div>
				<div id="thumb-forward">&gt;</div>
			</div>

			<!--Control Bar-->
			<div id="controls-wrapper" class="load-item">
				<div id="controls">

					<!--Slide captions displayed here-->
					<div id="slidecaption" title="<?php the_title() ?>"><?php the_title(); ?></div>

					<!--Slide counter-->
					<div id="slidecounter">
						&lt;<span class="slidenumber"></span> / <span class="totalslides"></span>&gt;
					</div>

					<!--Slideinfo-->
					<div id="slideinfo">
						<div id="slideinfo-caption"><?php _e( 'info', 'twentyfifteen' ); ?></div>
						<div id="slideinfo-content">
							<a href="" class="close-info">&times;</a>
							<div class="overlay-con">
								<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
								<div class="viewport">
								<div class="overview">
								<pre><?php
								 echo get_post_meta( $post->ID, 'works_info', true );
								?></pre>
								</div>
								</div>
							</div>
						</div>
					</div>

					<!--Slide Next links-->
					<div id="nextproject">
						<?php
							$category = get_the_category();

							// 存在下一片文章
							if ( get_next_post($in_same_term = true, $excluded_terms = '', $taxonomy = $category[0]->cat_name) ) {
								next_post_link( '%link', translate( 'next', 'twentyfifteen' ) .' ' . translate( 'work', 'twentyfifteen' ) . '  &gt; ', true );
							} else {
								//不存在下一片文章，显示第一篇
									$tmp = array(
										'posts_per_page' => 1,
										'category' => $category[0]->cat_ID,
										'orderby' => 'date',
										'order' => 'ASC'
										);
									$postslist = get_posts($tmp);
									foreach ($postslist as $post) :
									     setup_postdata($post); ?>

									 <a href="<?php the_permalink(); ?>">
                                         <?php echo translate( 'next', 'twentyfifteen' ) . ' ' . translate( 'work', 'twentyfifteen' ) . '  &gt; '; ?>
                                     </a>

        							<?php
        								endforeach;
                                        wp_reset_query();
        								}
        						    ?>
					</div>
				</div>
			</div>

		<?php endwhile; wp_reset_postdata();else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
