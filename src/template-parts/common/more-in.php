<?php 
    $tax = get_post_type();
    $term = get_post_field( 'post_name', get_post() );
	$latest_cat_post = new WP_Query( 
        array(
            'post_type' => array('post' ,'hike'), 
            'posts_per_page' => 10,
            'meta_query' => array(
               'relation' => 'OR',
                array(
                 'key' => 'is-multi-hike',
                 'compare' => 'NOT EXISTS',
                 'value' => ''
                ),
                array(
                 'key' => 'is-multi-hike',
                 'value' => ''
                )
            ),
            'tax_query' => array (
              array (
                 'taxonomy' => $tax,
                 'field' => 'slug',
                 'terms' => $term,
                 'operator' => 'IN'
              )
   )));
	if( $latest_cat_post->have_posts() ) { ?>
		<div class="wrap full-width">
				<h2>More in <?php echo the_title(); ?></h2>
				<div class="pre-data item-container post-listing" data-loadmore-tax="<?php echo $tax; ?>" data-loadmore-term="<?php echo $term; ?>" id="masonry-grid">
		<?php while( $latest_cat_post->have_posts() ) 
			{
			$latest_cat_post->the_post();
	       get_template_part( 'template-parts/post/cattile'); 
	} ?>
                    <div class="last clear"></div>     
                </div>
             <?php get_template_part( 'template-parts/common/load-more-btn'); ?>
            <div class="pre-data-message">Please hold, images are still loading <span></span></div>
	   </div>
	<?php } wp_reset_postdata(); ?>