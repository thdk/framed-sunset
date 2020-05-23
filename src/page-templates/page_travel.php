	<?php /* Template Name: Travel */ ?>

	<?php get_header(); ?>
	<div class="wrap full-width no-border border-bottom">
        <header class="entry-header center">
                <h2 class="entry-title">Latest travel journals</h2>
                

				<?php twentyseventeen_edit_link( get_the_ID() ); ?>

			</header><!-- .entry-header -->
    <?php   

    $myquery = array(  
        'post_status' => 'publish',  
        'posts_per_page' => -1,    
        'order' => 'DESC',  
        'post_type' => 'journal',
         'post_parent' => 0
    );  


    $queryObject = new WP_Query($myquery);   

    while( $queryObject->have_posts() ) : $queryObject->the_post();  

    $pages_array[] = $post;  

    endwhile;  

    wp_reset_query(); ?>
    <div class="childs-overview desktop">
    <?php if ($pages_array) { foreach ($pages_array as $page){ ?>

     <div class="child"><div class="img">
                <a href="<?php echo esc_url( get_permalink($page->ID) ); ?>"><?php echo get_the_post_thumbnail( $page->ID, 'thdk-medium-2'); ?></a>
            </div>
            <div class="text">
                <a href="<?php echo esc_url( get_permalink($page->ID) ); ?>"><h1><?php echo apply_filters( 'the_title', $page->post_title, $page->ID ); ?></h1></a>
                <?php echo apply_filters( 'the_excerpt', $page->post_excerpt ); ?>
            </div>
             </div>

    <?php } }?>
    <div class="clear"></div>
    </div> <!-- end overview -->



    </div>
	<?php 
	$cat_id_featured = get_cat_ID('Featured Travel');
	$latest_cat_post = new WP_Query( array('posts_per_page' => 10, 'category__in' => array($cat_id_featured)));
	if( $latest_cat_post->have_posts() ) { ?>
        <div class="wrap space-bottom space-top">
            <header class="entry-header center">
                <h2 class="entry-title">Featured Travel</h2>
                

				<?php twentyseventeen_edit_link( get_the_ID() ); ?>

			</header><!-- .entry-header -->
            <div class="featured travel">
                <?php while( $latest_cat_post->have_posts() ) 
                    {
                    $latest_cat_post->the_post();

            ?>
                    <div class="featured-item">
                        <div class="photo">
                            <a href="<?php echo the_permalink()?>"><?php echo get_the_post_thumbnail( $page->ID, 'thdk-medium'); ?></a>
                        </div>
                        <div class="description">
                            <a href="<?php echo the_permalink()?>"><h1><?php echo get_the_title() ?></h1></a>
                            <?php echo the_excerpt()?>

                        </div>
                        <div class="clear"></div>
                    </div>
                <?php
                //etc.
                } ?>
            </div>
    </div>
	<?php }  wp_reset_postdata(); ?>	

	<?php 
	$cat_id_photography = get_cat_ID('Travel');
	$latest_cat_post = new WP_Query( array('posts_per_page' => 10, 'category__in' => array($cat_id_photography)));
	if( $latest_cat_post->have_posts() ) { ?>		
			<div class="wrap full-width space-top">
                <header class="entry-header center">
                    <h2 class="entry-title">Recently posted in travel</h2>


                    <?php twentyseventeen_edit_link( get_the_ID() ); ?>

			     </header><!-- .entry-header -->
				
				<div class="posts item-container loadmore post-listing" data-loadmore-cats="travel" id="masonry-grid">
		<?php while( $latest_cat_post->have_posts() ) 
			{
			$latest_cat_post->the_post();
	       get_template_part( 'template-parts/post/tile'); 
	} ?>
                    <div class="last clear"></div>
                  
      
                </div>
                <div class="load-more-btn">
                        <span class="text">give me more</span>
                        <span class="load-icon"><p></p></span>
                        <span class="finished">bummer, that's all</span>
                    </div>
            </div>
	<?php } wp_reset_postdata(); ?>
	

	<?php get_footer(); ?>	