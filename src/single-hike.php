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
                <a href="//www.dmca.com/Protection/Status.aspx?ID=2e768fa0-042d-40f4-a7d0-c62c67cada08" title="DMCA.com Protection Status" class="dmca-badge"> <img src="//images.dmca.com/Badges/dmca-badge-w250-5x1-05.png?ID=2e768fa0-042d-40f4-a7d0-c62c67cada08" alt="DMCA.com Protection Status"></a> <script src="//images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>						<p><a href="http://thdk.be/contact/">Contact me</a> or have a look at my portfolio on <a href="http://www.shutterstock.com/g/Thomas+Dekiere?rid=1864868">Shutterstock</a> to support my work.</p>				<p style="font-size:12px;">				Do not try to use photos without permission or your site will be taken down by DMCA.		</p>
        </aside>
	</div><!-- #primary -->
    
</div><!-- .wrap -->

<div class="wrap">
    <?php
            echo thdk_posttype_childs('All stages of the '.get_the_title().':');
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

<?php get_footer();
