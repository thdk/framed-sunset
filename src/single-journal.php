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
		<?php if ( is_active_sidebar( 'sidebar-desktop' ) ) { ?>
				<ul id="sidebar">
					<?php dynamic_sidebar('sidebar-desktop'); ?>
				</ul>
			<?php } ?>
        </aside>
	</div><!-- #primary -->
</div><!-- .wrap -->

<div class="wrap">
    <?php
            echo thdk_posttype_childs(get_the_title().': Day by day', '');
			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
		?>

    <?php

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
    ?>
</div>




<?php wp_reset_query(); ?>
<?php get_footer();
