        
         <?php
         wp_reset_query(); 
        if ($post->post_parent != 0) {
            $args = array(
                'post_type'      => get_post_type(),
                'posts_per_page' => -1,
                'post_parent'       =>$post->post_parent,
                'order'          => 'ASC',
                'orderby'        => 'menu_order'
             );


            $parent = new WP_Query( $args );
            $siblings = array();

            while ( $parent->have_posts() ) {
                $parent->the_post();
                 $siblings[] += $post->ID;
            }           

            wp_reset_query();                   
        
            $current = array_search($post->ID, $siblings);
            $lastpage = count($siblings) - 1;

            $prevID = "";
            if ($current != 0) {
                $prevID = $siblings[$current-1];
            }
            $nextID = "";
            if ($current != $lastpage) 
            {
                $nextID = $siblings[$current+1];
            }
        }
	?>

	 	 <div class="navigator">
	<div class="navigation-inner">
		<?php if (!empty($prevID)) { ?>
					<div class="prev-holder">
				<div class="prev">
					<a href="<?php echo get_permalink($prevID);?>">
                        <?php 
					
						$feat_image = wp_get_attachment_url( get_post_thumbnail_id($prevID) );
						if ($feat_image) { 
							thdk_get_responsive_image(get_post_thumbnail_id($prevID), '123px');
						 } ?>
						
				
					</a>			</div>
				<div class="prev-info">
					<div class="navigation-info-holder">
						
							<span class="arrow_carrot-left navigation-icon"></span>
							<span class="navigation-info">Previous </span>
					</div>					
					<a class="nav-title" href="<?php echo get_permalink($prevID);?>">
						<?php echo get_the_title($prevID);?>					</a>	
				</div>
			</div>
			<?php }
			if (!empty($nextID)) { ?>
						<div class="next-holder">
			<div class="next-info">
				<div class="navigation-info-holder">
					
						<span class="navigation-info">Next</span>
						<span class="arrow_carrot-right navigation-icon"></span>
				</div>	
				<a href="<?php echo get_permalink($nextID);?>" class="nav-title">
					<?php echo get_the_title($nextID);?>				</a>
			</div>
			<div class="next">
				<a href="<?php echo get_permalink($nextID);?>" rel="next">
		
					
							<?php 
					
						$feat_image = wp_get_attachment_url( get_post_thumbnail_id($nextID) );
						if ($feat_image) { 
							thdk_get_responsive_image(get_post_thumbnail_id($nextID), '123px');
						 } ?>
						
				</a>			</div>
		</div>
	<?php } ?>
			</div>
			<div class="clear"></div>
	</div>