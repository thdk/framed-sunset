<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'twentyseventeen-panel ' ); ?> >

	<?php if ( has_post_thumbnail() ) :
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

		$post_thumbnail_id = get_post_thumbnail_id( $post->ID );

		$thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'twentyseventeen-featured-image' );

		// Calculate aspect ratio: h / w * 100%.
		$ratio = $thumbnail_attributes[2] / $thumbnail_attributes[1] * 100;
		?>

    <!--
		<div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
			<div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
		</div>
    
    -->

	<?php endif; ?>

	<div class="panel-content" style="display:none;">
		<div class="wrap space-top space-bottom">
			<header class="entry-header center">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

				<?php twentyseventeen_edit_link( get_the_ID() ); ?>

			</header><!-- .entry-header -->

			<div class="entry-content">
                <?php 
                $cat_id_photography = get_cat_ID('Photo of the week');
                $latest_cat_post = new WP_Query( array('posts_per_page' => 1, 'category__in' => array($cat_id_photography)));
                if( $latest_cat_post->have_posts() ) { ?>
                <div class="weekly photography">
                    <?php while( $latest_cat_post->have_posts() ) 
                        {
                        $latest_cat_post->the_post();

                ?>
                        <div class="featured-item">
                            <div class="photo">
                                <a href="<?php echo the_permalink()?>"><?php echo get_the_post_thumbnail( $page->ID, 'big', array( 'sizes' => '(max-width: 768px) 50vw, 40vw' ) ); ?></a>
                            </div>
                            <div class="description">
                                <a href="<?php echo the_permalink()?>"><p class="wp-caption gallery-caption"><?php echo get_the_title() ?></p></a>
                                <?php echo the_excerpt()?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php
                    //etc.
                    } ?>
                </div>
                <?php }  wp_reset_postdata(); ?>
                
			</div><!-- .entry-content -->

		</div><!-- .wrap -->
	</div><!-- .panel-content -->

</article><!-- #post-## -->
