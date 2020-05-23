<article class="post-item tile">
    <div class="photo">
        <a href="<?php echo the_permalink()?>">
            <?php
            // masonry does not support srcset yet !!!
            // thdk_get_responsive_image(get_post_thumbnail_id()) 
            the_post_thumbnail( 'medium_large' ); 
            ?>
        </a>
	</div>
	<div class="description">
		<a href="<?php echo the_permalink()?>"><h2><?php echo get_the_title() ?></h2></a>
		<p><?php echo the_excerpt()?></p>
	</div>
</article>