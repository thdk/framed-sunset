<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap full-width no-border">	
	
			<?php
			if ( have_posts() ) : ?> 
    <div class="pre-data item-container post-listing" data-loadmore-tax="<?php echo $tax; ?>" data-loadmore-term="<?php echo $term; ?>" id="masonry-grid">
				
				<?php while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/post/cattile'); 

				endwhile; ?>
                    </div>
                <div class="last clear"></div>  
				<div class="pre-data-message">Please hold, images are still loading <span></span></div>
<?php
			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif;
			?>

		
</div><!-- .wrap -->

<?php get_footer();
