<?php
/**
 Template Name: Product
 *
 */


get_header('product'); ?>

	<div id="primary" class="content-area product">
		<main id="main" class="site-main" role="main">

	<?php
		// Start the loop.
	while ( have_posts() ) : the_post();

			$args = array(
					'post_type' => 'attachment'
				);

			$attachments = get_posts( $args );

			if ( $attachments ) { ?>

			<script type="text/javascript">
			
			jQuery(function($){
				
				$.supersized({
					mouse_scrub				:	1,
				
					// 
					slide_interval          :   3000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	300,		// Speed of transition
															   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					slides 					:  

					<?php	echo "[";
						foreach ( $attachments as $attachment ) {
		         		  	$image_full = wp_get_attachment_image_src( $attachment->ID, 'full' );
		         		  	$image_thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail');
		         		  	$temp = array('image' => $image_full[0], 'thumb' => $image_thumb[0]);

		         		  	$temp['image'] = "'".$temp['image']."'";
		         		  	$temp['thumb'] = "'".$temp['thumb']."'";
		         		  	echo "{image: ". $temp['image'] . ", thumb :".$temp['thumb'] . "},";
						}
						echo "]";
					?>
				});
		    });
		    
		</script>


		<?php
			}
		?>
			<!--Thumbnail Navigation-->
			<div id="prevthumb"></div>
			<div id="nextthumb"></div>
			
			<!--Arrow Navigation-->
			<a id="prevslide" class="load-item"></a>
			<a id="nextslide" class="load-item"></a>
			
			<div id="thumb-tray" class="load-item">
				<!-- <div id="thumb-back">&lt;</div>
				<div id="thumb-forward">&gt;</div> -->
			</div>

			<!--Control Bar-->
			<div id="controls-wrapper" class="load-item">
				<div id="controls">
						
					<!--Slide captions displayed here-->
					<div id="slidecaption"><?php the_title(); ?></div>

					<!--Slide counter-->
					<div id="slidecounter">
						&lt;<span class="slidenumber"></span> / <span class="totalslides"></span>&gt;
					</div>
					
					<!--Slideinfo-->
					<div id="slideinfo">
						<div id="slideinfo-caption">简介</div>
						<div id="slideinfo-content">
							<a href="" class="close-info">&times;</a>
							<div>
								<?php 
								//	the_content();
							//	get_the_content(); 
								 echo strip_tags(get_the_content($post->ID), '');
								?>
							</div>
						</div>
					</div>
					<!--Slide Next links-->
					<div id="nextproject">
						<a href="">下一作品</a>
					</div>
				</div>
			</div>

		<?php // End the loop.
		 endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer('product'); ?>
