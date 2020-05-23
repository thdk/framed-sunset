<?php
/**
 * Displays header media
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="custom-header">

		<div class="custom-header-media">
			<?php 
                if (thdk_featured_image_in_header()) {
                    sprintf(
                        '<div id="wp-custom-header" class="wp-custom-header">%s</div>',
                        the_post_thumbnail()
                    );
                }            
                else {
                    the_custom_header_markup();
                }
            ?>
		</div>

	<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

</div><!-- .custom-header -->
