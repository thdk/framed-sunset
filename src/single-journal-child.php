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
					get_template_part( 'template-parts/post/content', get_post_format() ); ?>

<?php
//					the_post_navigation( array(
//						'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
//						'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
//					) );

				endwhile; // End of the loop.
           // thdk_sharing();
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

     <h5>Find out what else we did in <a href="<?php echo get_permalink($post->post_parent);?>"><?php echo get_the_title($post->post_parent);?></a></h5>
       <?php wp_reset_postdata();
    get_template_part( 'template-parts/common/navigator', get_post_type()); ?>
        <?php // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    ?>
</div><!-- .wrap -->

<?php get_footer();
