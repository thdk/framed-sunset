<div id="post-<?php the_ID(); ?>" <?php post_class('tile'); ?>>
	<?php
		if ( is_sticky() && is_home() ) :
			echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
		endif;
	?>
	<header class="entry-header">
		<?php
        $posttype = get_post_type();
			//if ( 'post' === get_post_type() ) :
				echo '<div class="entry-meta">';
					 
						// twentyseventeen_posted_on(); ?>
                        <span class="category-name">	
                            <?php
                            $cat = new WPSEO_Primary_Term('category', get_the_ID());
                            $cat = $cat->get_primary_term();
                            $catName = get_cat_name($cat);
                            $catLink = get_category_link($cat);
                            if ($catName) {
                                echo $catName;                                
                            }
                            else{
                                // fallback to photography or travel 
                                $categories = get_the_category(); 
                                if ( ! empty( $categories ) ) {
                                    foreach ($categories as $cat) {
                                        // tempory check category name untill all other categories have been removed.
                                        if (strtoupper($cat->name) == "PHOTOGRAPHY" || strtoupper($cat->name) == "TRAVEL") {
                                            echo strtoupper($cat->name);
                                            
                                        }  
                                    }
                                }
                                else{
                                    $terms = get_the_terms( get_the_ID(), 'country' );
                                    if ( ! empty( $categories ) ) {
                                        $termlist = array();
                                         foreach ( $terms as $term ) {
                                            $termlist[] = $term->name;
                                        }

                                        echo join( ", ", $termlist );
                                    }
                                    
                                    echo 'TRAVEL - '.$posttype;
                                }
                            }
                            
                            
                            ?>
                        </span> 
    <?php 
				echo '</div><!-- .entry-meta -->';
			// endif;

			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail()) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php // the_post_thumbnail( 'thdk-tile' ); ?>
                
                <?php // masonry does not support srcset
               // the_post_thumbnail( 'thdk-tile' ); ?>
                <img src="<?php the_post_thumbnail_url( 'medium_large' ); ?>">
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			//the_excerpt();        

			wp_link_pages( array(
				'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( is_single() || true) : ?>
		<?php twentyseventeen_entry_footer(false); ?>
	<?php endif; ?>

</div><!-- #post-## -->
