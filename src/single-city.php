<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/post/content', get_post_format() );

				endwhile; // End of the loop.
			?>

		</main><!-- #main -->
        <aside class="content">
        
        </aside>
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_template_part( 'template-parts/common/more-in'); ?>

<?php get_footer();
