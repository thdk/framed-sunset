<?php
/**
 * Template part for displaying pages on front page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

global $twentyseventeencounter;

?>

<article id="panel<?php echo $twentyseventeencounter; ?>" <?php post_class( 'twentyseventeen-panel ' ); ?> >

	<?php if ( has_post_thumbnail() ) :
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

		// Calculate aspect ratio: h / w * 100%.
		$ratio = $thumbnail[2] / $thumbnail[1] * 100;
		?>

		<div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
			<div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
		</div><!-- .panel-image -->

	<?php endif; ?>
    
    <?php if ($post->post_name == 'featured-travel') { ?>
	<div class="panel-content">
		<div class="wrap">
			<header class="entry-header center">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

				<?php twentyseventeen_edit_link( get_the_ID() ); ?>

			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
                    
                        	
                            $cat_id_featured = get_cat_ID('Featured Travel');
                            $latest_cat_post = new WP_Query( array('posts_per_page' => 10, 'category__in' => array($cat_id_featured)));
                            if( $latest_cat_post->have_posts() ) { ?>
                            <div class="featured travel">			
                                <div class="center">
                                <?php while( $latest_cat_post->have_posts() ) 
                                    {
                                    $latest_cat_post->the_post();
                            
                            ?>
                                    <div class="featured-item">
                                        <div class="photo">
                                            <a href="<?php echo the_permalink()?>"><?php echo get_the_post_thumbnail( $page->ID, 'thdk-medium'); ?></a>
                                        </div>
                                        <div class="description">
                                            <a href="<?php echo the_permalink()?>"><h1><?php echo get_the_title() ?></h1></a>
                                            <?php echo the_excerpt()?>

                                        </div>
                                    </div>
                                <?php
                                //etc.
                                } ?>
                                </div>
                            </div>
                            <?php }  wp_reset_postdata(); 
                
				?>
			</div><!-- .entry-content -->			

		</div><!-- .wrap -->
	</div><!-- .panel-content -->
<?php } else if ($post->post_name == 'featured-photography') { ?>
	<div class="panel-content">
		<div class="wrap">
			<header class="entry-header center">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

				<?php twentyseventeen_edit_link( get_the_ID() ); ?>

			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php
                    
                        	
                            $cat_id_featured = get_cat_ID('Featured Photo');
                            $latest_cat_post = new WP_Query( array('posts_per_page' => 10, 'category__in' => array($cat_id_featured)));
                            if( $latest_cat_post->have_posts() ) { ?>
                            <div class="featured photography">			
                                <div class="center">
                                <?php while( $latest_cat_post->have_posts() ) 
                                    {
                                    $latest_cat_post->the_post();
                            
                            ?>
                                    <div class="featured-item">
                                        <div class="photo">
                                            <a href="<?php echo the_permalink()?>"><?php echo get_the_post_thumbnail( $page->ID, 'thdk-medium'); ?></a>
                                        </div>
                                        <div class="description">
                                            <a href="<?php echo the_permalink()?>"><h1><?php echo get_the_title() ?></h1></a>
                                            <?php echo the_excerpt()?>

                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                <?php
                                //etc.
                                } ?>
                                </div>
                            </div>
                            <?php }  wp_reset_postdata(); 
                
				?>
			</div><!-- .entry-content -->			

		</div><!-- .wrap -->
	</div><!-- .panel-content -->
<?php } else {
        ?>
<div class="panel-content">
		<div class="wrap">
			<header class="entry-header center">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

				<?php twentyseventeen_edit_link( get_the_ID() ); ?>

			</header><!-- .entry-header -->

			<div class="entry-content">                  
					<?php /* translators: %s: Name of current post */
                    
					the_content( sprintf(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
						get_the_title()
					) );
                
				?>
			</div><!-- .entry-content -->

			<?php
			// Show recent blog posts if is blog posts page (Note that get_option returns a string, so we're casting the result as an int).
			if ( get_the_ID() === (int) get_option( 'page_for_posts' )  ) : ?>

				<?php // Show four most recent posts.
				$recent_posts = new WP_Query( array(
					'posts_per_page'      => 10,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
                    'post_type'           => array('post', 'journal', 'hike')
				) );
				?>

		 		<?php if ( $recent_posts->have_posts() ) : ?>

					<div class="recent-posts item-container" data-loadmore-types="journal,post,hike">

						<?php
						while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
							get_template_part( 'template-parts/post/cattile');
						endwhile;
                        ?> <div class="last clear"></div>
                        
						<?php
                         wp_reset_postdata();
						?>
					</div><!-- .recent-posts -->
                   <?php get_template_part( 'template-parts/common/load-more-btn'); ?>
				<?php endif; ?>
			<?php endif; ?>

		</div><!-- .wrap -->
	</div><!-- .panel-content -->
<?php
    } ?>

</article><!-- #post-## -->
