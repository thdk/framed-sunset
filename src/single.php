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
                    
                    the_post_navigation( array(
						'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
						'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
                        'in_same_term' => true
					) );
            
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						// comments_template();
					endif;					

				endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->
<div class="wrap full-width space-top space-bottom">          

    <?php  //for use in the loop, list 5 post titles related to first tag on current post
  $backup = $post;  // backup the current object
  $tags = wp_get_post_tags($post->ID);
  $tagIDs = array();
  if ($tags) {
    $tagcount = count($tags);
    for ($i = 0; $i < $tagcount; $i++) {
      $tagIDs[$i] = $tags[$i]->term_id;
    }
    $args=array(
      'tag__in' => $tagIDs,
      'post__not_in' => array($post->ID),
      'showposts'=>6,
      'ignore_sticky_posts'=>1
    );
    $my_query = new WP_Query($args);
    if( $my_query->have_posts() ) {
    	?>
     <header class="entry-header center">
                    <h2 class="entry-title">Related posts</h2>


                    <?php twentyseventeen_edit_link( get_the_ID() ); ?>

			     </header><!-- .entry-header -->
    <div class="item-container"><?php 
      while ($my_query->have_posts()) : $my_query->the_post();
          echo get_template_part( 'template-parts/post/tile'); 
      endwhile; ?>
  </div></div>
  <?php 
    }      
  }
  $post = $backup;  // copy it back
  wp_reset_query(); // to use the original query again
?>
    
</div>

<?php get_footer();
