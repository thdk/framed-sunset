	<?php /* Template Name: Photography */ ?>

	<?php get_header(); ?>
	<?php 
	$cat_id_photography = get_cat_ID('Featured Photo');
	$latest_cat_post = new WP_Query( array('posts_per_page' => 10, 'category__in' => array($cat_id_photography)));
	if( $latest_cat_post->have_posts() ) { ?>
        <div class="wrap space-top space-bottom">
            <header class="entry-header center">
                <h2 class="entry-title">Featured Photography</h2>
                

				<?php twentyseventeen_edit_link( get_the_ID() ); ?>

			</header><!-- .entry-header -->
            <div class="featured photography">
                <?php while( $latest_cat_post->have_posts() ) 
                    {
                    $latest_cat_post->the_post();

            ?>
                    <div class="featured-item">
                        <div class="photo">
                            <a href="<?php echo the_permalink()?>"><?php echo get_the_post_thumbnail( $page->ID, 'thdk-medium' ); ?></a>
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
	$cat_id_photography = get_cat_ID('Photography');
	$latest_cat_post = new WP_Query( array('posts_per_page' => 10, 'category__in' => array($cat_id_photography)));
	if( $latest_cat_post->have_posts() ) { ?>		
			<div class="wrap full-width space-top">
                <header class="entry-header center">
                    <h2 class="entry-title">Recently posted in photography</h2>


                    <?php twentyseventeen_edit_link( get_the_ID() ); ?>

			     </header><!-- .entry-header -->
				<div class="posts item-container loadmore post-listing" data-loadmore-cats="photography" id="masonry-grid">
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