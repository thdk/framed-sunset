<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('tile'); ?> data-lng="<?php echo get_geocode_lng( $post->ID ); ?>" data-lat="<?php echo get_geocode_lat( $post->ID ); ?>">
	<?php
		if ( is_sticky() && is_home() ) :
			echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
		endif;
	?>
	<header class="entry-header">
		<?php		

			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
                
				<?php // masonry does not support srcset
               // the_post_thumbnail( 'thdk-tile' ); ?>
                <img src="<?php the_post_thumbnail_url( 'medium_large' ); ?>">
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
//			the_excerpt( sprintf(
//				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
//				get_the_title()
//			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( is_archive() || is_front_page()) : ?>
		<?php twentyseventeen_entry_footer(false); ?>
	<?php endif; ?>

</div><!-- #post-## -->
