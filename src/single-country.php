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

<div class="wrap full-width no-border">

			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					//get_template_part( 'template-parts/post/content', get_post_format() );
                $tax = get_post_type();
                $term = get_post_field( 'post_name', get_post() );
                $journals = new WP_Query( array('post_type' => 'journal', 'posts_per_page' => 1, 'post_parent' => 0, 'tax_query' => array (
                  array (
                     'taxonomy' => $tax,
                     'field' => 'slug',
                     'terms' => $term,
                     'operator' => 'IN'
                  )
               )));
            
                $cities = new WP_Query( array('post_type' => 'city', 'posts_per_page' => 5, 'tax_query' => array (
                  array (
                     'taxonomy' => $tax,
                     'field' => 'slug',
                     'terms' => $term,
                     'operator' => 'IN'
                  )
               )));
            ?>
                <?php if($cities->post_count <= 2 || $journals->have_posts()) { ?>
    
            
                    <div class="childs-overview desktop">
                    <?php while($journals->have_posts()) { 
                        $journals->the_post(); ?>
                     <div class="child"><div class="img">
                                <a href="<?php echo esc_url( get_permalink($post->ID) ); ?>"><?php echo get_the_post_thumbnail( $post->ID, 'thdk-medium-2'); ?></a>
                            </div>
                            <div class="text">
                                <a href="<?php echo esc_url( get_permalink($post->ID) ); ?>"><h1><?php echo apply_filters( 'the_title', $post->post_title, $post->ID ); ?></h1></a>
                                <?php echo apply_filters( 'the_excerpt', $post->post_excerpt ); ?>
                            </div>
                             </div>

                    <?php } ?>
                        
                     <?php 
                    if ($cities->post_count <= 2) {
                    while($cities->have_posts()) { 
                        $cities->the_post(); ?>
                     <div class="child"><div class="img">
                                <a href="<?php echo esc_url( get_permalink($post->ID) ); ?>"><?php echo get_the_post_thumbnail( $post->ID, 'thdk-medium-2'); ?></a>
                            </div>
                            <div class="text">
                                <a href="<?php echo esc_url( get_permalink($post->ID) ); ?>"><h1><?php echo apply_filters( 'the_title', $post->post_title, $post->ID ); ?></h1></a>
                                <?php echo apply_filters( 'the_excerpt', $post->post_excerpt ); ?>
                            </div>
                             </div>

                    <?php }
                    }?>
                        
                        
                    <div class="clear"></div>
                    </div> <!-- end overview -->
            
                <?php } wp_reset_postdata(); ?>
                    
				<? endwhile; // End of the loop.
			?>

</div><!-- .wrap -->

<?php if($cities->post_count > 2) { 
    $tax = get_post_type();
    $term = get_post_field( 'post_name', get_post() );
	$latest_cat_post = new WP_Query( array('post_type' => 'city', 'posts_per_page' => 6, 'tax_query' => array (
      array (
         'taxonomy' => $tax,
         'field' => 'slug',
         'terms' => $term,
         'operator' => 'IN'
      )
   )));
	if( $latest_cat_post->have_posts() ) { ?>
		<div class="wrap full-width">
				<h2>Cities in <?php echo the_title(); ?></h2>
				<div class="item-container post-listing noload" data-loadmore-tax="<?php echo $tax; ?>" data-loadmore-term="<?php echo $term; ?>" id="masonry-grid">
		<?php while( $latest_cat_post->have_posts() ) 
			{
			$latest_cat_post->the_post();
	       get_template_part( 'template-parts/post/tile'); 
	} ?>
                    <div class="last clear"></div>     
                </div>
             
	   </div>
	<?php } wp_reset_postdata(); ?>
<?php } ?>

<?php 

    $tax = get_post_type();
    $term = get_post_field( 'post_name', get_post() );
	$latest_cat_post = new WP_Query( 
        array('post_type' => 'hike', 
              'posts_per_page' => 4, 
              'post_parent' => 0,
              'meta_query'  => array(
                    array(
                            'key' => 'is-multi-hike',
                            'value' => 'yes'
                        )
                    ),
              'tax_query' => array (
                  array (
                     'taxonomy' => $tax,
                     'field' => 'slug',
                     'terms' => $term,
                     'operator' => 'IN'
                  )
                )
             )
        );
	if( $latest_cat_post->have_posts() ) { ?>
		<div class="wrap full-width">
				<h2>Trails in <?php echo the_title(); ?></h2>
				<div class="item-container post-listing noload" data-loadmore-tax="<?php echo $tax; ?>" data-loadmore-term="<?php echo $term; ?>" id="masonry-grid">
		<?php while( $latest_cat_post->have_posts() ) 
			{
			$latest_cat_post->the_post();
	       get_template_part( 'template-parts/post/tile'); 
	} ?>
                    <div class="last clear"></div>     
                </div>
             
	   </div>
	<?php } wp_reset_postdata(); ?>



<?php get_template_part( 'template-parts/common/more-in'); ?>

<?php get_footer();
