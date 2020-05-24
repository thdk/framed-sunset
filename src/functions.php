<?php
// enqueue stylesheets
function thdk_enqueue_styles() {

    $parent_style = 'twentyseventeen-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'framedsunset-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'thdk_enqueue_styles' );


/**
 * Proper way to enqueue scripts and styles.
 */
function thdk_scripts() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
    wp_enqueue_script( 'jquery' );

    $version = "1.0";
    if( current_user_can('editor') || current_user_can('administrator') ) {
       // $version = (string)strtotime("now");
    }

    wp_enqueue_script( 'script-name', get_stylesheet_directory_uri() . '/js/script.js', array('jquery' ,'jquery-masonry'), $version, true );

    global $wp_query;

	$args = array(
		'nonce' => wp_create_nonce( 'be-load-more-nonce' ),
		'url'   => admin_url( 'admin-ajax.php' ),
		'query' => $wp_query->query,
	);

	wp_enqueue_script( 'be-load-more', get_stylesheet_directory_uri() . '/js/load-more.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'be-load-more', 'beloadmore', $args );
}
add_action( 'wp_enqueue_scripts', 'thdk_scripts' );

/**
 * Add a sidebar.
 */
function thdk_sidebars_init() {
    register_sidebar( array(
        'name'          => __( 'Desktop sidebar', 'thdk' ),
        'id'            => 'sidebar-desktop',
        'description'   => __( 'Widgets in this area will be shown on hikes, cities, ... but not on posts', 'thdk' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'thdk_sidebars_init' );

// Async load
function ikreativ_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async";
    }
add_filter( 'clean_url', 'ikreativ_async_scripts', 11, 1 );


// custom post types
function thdk_custom_post_types() {

    // country
  $labels = array(
    'name'               => _x( 'Countries', 'post type general name' ),
    'singular_name'      => _x( 'Country', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'country' ),
    'add_new_item'       => __( 'Add New Country' ),
    'edit_item'          => __( 'Edit Country' ),
    'new_item'           => __( 'New Country' ),
    'all_items'          => __( 'All Countries' ),
    'view_item'          => __( 'View Country' ),
    'search_items'       => __( 'Search Countries' ),
    'not_found'          => __( 'No countries found' ),
    'not_found_in_trash' => __( 'No countries found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Countries'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our products and product specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'page-attributes', 'post-formats' ),
    'rewrite' => array( 'slug' => 'travel/countries'),
    'has_archive' => true
  );

    register_post_type( 'country', $args );

    // city
    $labels2 = array(
    'name'               => _x( 'Cities', 'post type general name' ),
    'singular_name'      => _x( 'City', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'city' ),
    'add_new_item'       => __( 'Add New city' ),
    'edit_item'          => __( 'Edit city' ),
    'new_item'           => __( 'New city' ),
    'all_items'          => __( 'All cities' ),
    'view_item'          => __( 'View city' ),
    'search_items'       => __( 'Search cities' ),
    'not_found'          => __( 'No cities found' ),
    'not_found_in_trash' => __( 'No cities found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Cities'
  );
  $args2 = array(
    'labels'        => $labels2,
    'description'   => 'Holds our products and product specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'page-attributes', 'post-formats' ),
    'rewrite' => array( 'slug' => 'travel/cities'),
    'has_archive'   => true,
  );
    register_post_type( 'city', $args2 );

    // journal


    $labels3 = array(
    'name'               => _x( 'Journals', 'post type general name' ),
    'singular_name'      => _x( 'Journal', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'journal' ),
    'add_new_item'       => __( 'Add New Journal' ),
    'edit_item'          => __( 'Edit Journal' ),
    'new_item'           => __( 'New Journal' ),
    'all_items'          => __( 'All Journals' ),
    'view_item'          => __( 'View Journal' ),
    'search_items'       => __( 'Search Journals' ),
    'not_found'          => __( 'No journals found' ),
    'not_found_in_trash' => __( 'No journals found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Journals'
  );
  $args3 = array(
    'labels'        => $labels3,
    'description'   => 'Holds our products and product specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'page-attributes', 'post-formats' ),
    'rewrite'       => array( 'slug' => 'travel/journals'),
    'hierarchical' => true,
    'has_archive' => true
  );
  register_post_type( 'journal', $args3 );

     // hike


    $labels4 = array(
    'name'               => _x( 'Hikes', 'post type general name' ),
    'singular_name'      => _x( 'Hike', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'hike' ),
    'add_new_item'       => __( 'Add New hike' ),
    'edit_item'          => __( 'Edit hike' ),
    'new_item'           => __( 'New hike' ),
    'all_items'          => __( 'All hikes' ),
    'view_item'          => __( 'View hike' ),
    'search_items'       => __( 'Search hikes' ),
    'not_found'          => __( 'No hikes found' ),
    'not_found_in_trash' => __( 'No hikes found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Hikes'
  );
  $args4 = array(
    'labels'        => $labels4,
    'description'   => 'Holds our products and product specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'page-attributes', 'post-formats' ),
    'rewrite'       => array( 'slug' => 'travel/hikes'),
    'hierarchical' => true,
    'has_archive' => true
  );
  register_post_type( 'hike', $args4 );
}
 add_action( 'init', 'thdk_custom_post_types' );

// thdk: add thdk categories for travel and photography

function thdk_create_categories() {
  $taxonomy = 'category'; // category by default for posts for other custom post types like woo-commerce it is product_cat
  $append = true ;// true means it will add the cateogry beside already set categories. false will overwrite

  $term = 'Travel';
  if(!term_exists($term, $taxonomy)){
     $travelid = wp_insert_term($term, $taxonomy, array(
    'slug' => 'travel'
  ));
  }

  $term = 'Photography';
  if(!term_exists($term, $taxonomy)){
     $photoid = wp_insert_term($term, $taxonomy, array(
    'slug' => 'photography'
  ));
  }

  $term = 'Featured Photo';
  if(!term_exists($term, $taxonomy)){
     wp_insert_term($term, $taxonomy, array(
    'slug' => 'featuredphotos',
    'parent'=> $photoid
  ));
  }

  $term = 'Featured Travel';
  if(!term_exists($term, $taxonomy)){
     wp_insert_term($term, $taxonomy, array(
    'slug' => 'featuredtravel',
    'parent'=> $travelid
  ));
  }

  $term = 'Photo of the week';
  if(!term_exists($term, $taxonomy)){
     wp_insert_term($term, $taxonomy, array(
    'slug' => 'photo-of-the-week'
  ));
  }
}

// remove has-sidebar body_class for archive pages
function thdk_filter_body_class( $wp_classes, $extra_classes )
{
    // define what pages have a full header image
    if (thdk_featured_image_in_header() | is_home()) {
        array_push($extra_classes, "twentyseventeen-front-page", "featured-image-in-header", "has-header-image");
    }

    $supportedPostTypes = ["city", "journal", "hike"];
    $posttype = get_post_type();
    $useThreeColumnTemplate =  !is_archive() && in_array ($posttype, $supportedPostTypes);

    // define page layout
    if ($useThreeColumnTemplate || get_page_template_slug() == "page-templates/three-columns.php" ) {
        $blacklist = array( 'page-one-column', 'has-sidebar' );
        $wp_classes = array_diff( $wp_classes, $blacklist );
        array_push($extra_classes, "page-three-columns");
    } else if (get_page_template_slug() == "page-templates/two-colums-sidebar.php") {
        $blacklist = array( 'page-one-column' );
        $wp_classes = array_diff( $wp_classes, $blacklist );
        array_push($extra_classes, "page-two-columns", "has-sidebar");
    }

    // Filter the body classes
    if (is_archive()) {
        $blacklist = array( 'has-sidebar' );
        $wp_classes = array_diff( $wp_classes, $blacklist );
    }

    return array_merge( $wp_classes, (array) $extra_classes );
}
add_filter( 'body_class', 'thdk_filter_body_class', 11, 2 );


// thdk: show fullsize featured image in header for some pages

function thdk_featured_image_in_header() {
    if (!has_post_thumbnail())
        return false;


    if (is_archive())
        return false;

    $supportedPostTypes = ["city", "journal", "hike", "country"];
    $posttype = get_post_type();
    if (in_array ($posttype, $supportedPostTypes))
        return true;

    return false;
}

// thdk: don't show children on overview

function hide_children( $query )
{
    remove_action( 'pre_get_posts', current_filter() );

    if ( is_admin() or ! $query->is_main_query() )
        return;

    if (!is_post_type_archive())
        return;

    // only top level posts
    $query->set( 'post_parent', 0 );
}

add_action( 'pre_get_posts','hide_children' );

// thdk: only show featured image on top for some pages / posts
function thdk_show_featured_image_on_top() {
    return false;
}

// thdk: hide breadcrumbs on some pages

function thdk_hide_breadcrumbs() {
    if (is_front_page())
        return true;

    return false;
}

// thdk: add photography or travel to breadcrumb
add_filter( 'wpseo_breadcrumb_links', 'thdk_override_yoast_breadcrumb_trail' );

function thdk_override_yoast_breadcrumb_trail( $links ) {
    global $post;

    $url = get_permalink();
            $parts = explode('/', $url);
    if (!is_home()) {
        $value = $parts[3];
    }

    if (count($parts) > 5) {
        if (is_archive() && get_post_type() == "post") {
             $breadcrumb[] = array(
                'url' => get_permalink( get_option( 'page_for_posts' ) ),
                'text' => 'Blog'
            );

            array_splice( $links, 1, -2, $breadcrumb );
        }
        else if ($value == "travel" || $value == "photography" ) {
            $breadcrumb[] = array(
                'url' => get_permalink( get_page_by_path( $value ) ),
                'text' => get_the_title(get_page_by_path($value))
            );

            array_splice( $links, 1, -2, $breadcrumb );
        }
    }

    return $links;
}

// thdk get responsive featured image
function thdk_get_responsive_image($attachment_id, $sizesAttr = null) {
    $img_src = wp_get_attachment_image_url( $attachment_id, 'big' );
    $img_srcset = wp_get_attachment_image_srcset( $attachment_id, 'big' );
    $img = '<img src="'.esc_url( $img_src ).'" srcset="'.esc_attr($img_srcset );
        if ($sizesAttr) {
             $img .= '" sizes=" '.$sizesAttr.'"';
        }
        else{
            $img .= '" sizes="(max-width: 768px) 40vw, 25vw"';
        }
    $img .= ' alt="'.esc_attr( get_the_title($attachment_id)).'"/>';

    echo $img;
}

// thdk: get childs
function thdk_get_posttype_childs() {
    $args = array(
          'post_type' => get_post_type(),
          'posts_per_page' => -1,
          'ignore_sticky_posts' => 1,
           'order_by' => 'menu_order',
            'post_parent' => $post->ID,
          'order' => 'ASC');

         $childs = new WP_Query($args);
    return $childs;
}

// thdk: display children by post type
function thdk_posttype_childs($title, $style = "") {
        global $post;
         $args = array(
          'post_type' => get_post_type(),
          'posts_per_page' => -1,
          'ignore_sticky_posts' => 1,
         'sort_column' => 'menu_order',
           'order_by' => 'menu_order',
            'post_parent' => $post->ID,
          'order' => 'ASC');

         $myposts = new WP_Query($args);
        if ( $myposts->have_posts() ) {
            echo '<div class="childs '.get_post_type().' '.$style.'">';
            echo '<h3 class="childs-title">'.$title.'</h3><div class="item-container pre-data">';
            while( $myposts->have_posts() ) : $myposts->the_post();
               echo get_template_part( 'template-parts/post/tile', get_post_format() );
            endwhile;
            echo '</div><div class="pre-data-message">Please hold, images are still loading <span></span></div></div>';

            wp_reset_postdata();
        }
}


// thdk: use different template for child/parent of custom post types

function thdk_use_different_template_for_parent_and_child($single_template)
{
	$object = get_queried_object();

    $key_1_value = get_post_meta( $object->ID, 'child-has-childs', true );
    // Check if the custom field has a value.
    if ( ! empty( $key_1_value ) ) {
        if ($key_1_value == "yes"){
            return $single_template;
        }
    }


    if ($object->post_parent) {
        $childTemplateFilename .= locate_template("single-{$object->post_type}-child.php");
    }

	if( file_exists( $childTemplateFilename ) )
	{
		return $childTemplateFilename;
	} else {
		return $single_template;
	}
}
add_filter( 'single_template', 'thdk_use_different_template_for_parent_and_child', 10, 1 );


/**
 * AJAX Load More
 * @link http://www.billerickson.net/infinite-scroll-in-wordpress
 */
function be_ajax_load_more() {
    check_ajax_referer( 'be-load-more-nonce', 'nonce' );

    $args = isset( $_POST['query'] ) ? array_map( 'esc_attr', $_POST['query'] ) : array();
    ob_start();

    $term;
    $tax;
    $paged;
    $arrayPostTypes;
    $categories;
    foreach ($args as $key => $value) {
        if ($key == "term") {
            $term = $value;
        } else if ($key == "tax") {
            $tax = $value;
        } else if ($key == "paged") {
            $paged = $value;
        }else if($key == "post_type") {
            $arrayPostTypes = json_decode(htmlspecialchars_decode(stripslashes($value)), true);
        }
        else if ($key == "category_name") {
            $categories = $value;
        }
    }


    if ($term && $tax) {
        $args = array('post_type' => 'post', 'paged' => $paged, 'posts_per_page' => 10, 'tax_query' => array (
          array (
             'taxonomy' => $tax,
             'field' => 'slug',
             'terms' => $term,
             'operator' => 'IN'
          )
        ));
    }
    else {
        $args = array('post_type' => $arrayPostTypes, 'paged' => $paged, 'posts_per_page' => 11, 'category_name' => $categories);
    }

    //echo print_r($args);
    $loop = new WP_Query( $args );
    if( $loop->have_posts() ): while( $loop->have_posts() ): $loop->the_post();
        if ($categories && strpos($args['category_name'], ',') == false) {
           echo get_template_part( 'template-parts/post/tile');
        }
        else{
           echo get_template_part( 'template-parts/post/cattile');
        }
    endwhile; endif; wp_reset_postdata();
    $data = ob_get_clean();
    wp_send_json_success( $data );
    wp_die();
}
add_action( 'wp_ajax_be_ajax_load_more', 'be_ajax_load_more' );
add_action( 'wp_ajax_nopriv_be_ajax_load_more', 'be_ajax_load_more' );

// thdk: custom implementation for sizes of responisve images in content

function thdk_content_image_sizes_attr($sizes, $size) {
    $width = $size[0];
    $template = get_post_type();
//    if (get_page_template_slug() === 'template-full_width.php') {
//        if ($width > 910) {
//            return '(max-width: 768px) 92vw, (max-width: 992px) 690px, (max-width: 1200px) 910px, 1110px';
//        }
//    }
//    if ($width > 597) {
//        return '(max-width: 768px) 92vw, (max-width: 992px) 450px, (max-width: 1200px) 597px, 730px';
//    }
    if ($sizes != 'full') {
        return '(max-width: 844px) 99vw, (max-width:960px) 79vw, (max-width:1140) 68vw, 58vw';
    }
    else {
        return sprintf( '(max-width: %1$dpx) 100vw, %1$dpx', $size[0] );;
    }
}
remove_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10);
add_filter('wp_calculate_image_sizes', 'thdk_content_image_sizes_attr', 11 , 2);

// thdk: add correct sizes attribute for images show with get_the_thumbnail
// Filter the sizes attribute of post thumbnails.
function thdk_attachment_image_attributes( $attr, $attachment, $size ) {
//    if ( is_archive() || is_search() || is_home() ) {
//		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
//	} else {
//		$attr['sizes'] = '100vw';
//	}

	//return $attr;

    if ( $size === 'thdk-small') {
        $attr['sizes'] = '(max-width: 1280px) 381px, 381px';
    } elseif ( $size === 'thdk-medium') {
        $attr['sizes'] = '(max-width: 1280px) 511px, 511px';
    } elseif ( $size === 'thdk-medium-2') {
        $attr['sizes'] = '(max-width: 1280px) 600px, 600px';
    } elseif ( $size === 'thdk-tile') {
        if (is_front_page()) {
            $attr['sizes'] = '(max-width: 1280px) 381px, 381px';
        }
        else{
             $attr['sizes'] = '(max-width: 1280px) 600px, 600px';
        }
    }
    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'thdk_attachment_image_attributes', 11, 3 );

// thdk: remove default jetpack sharing icons
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}

add_action( 'loop_start', 'jptweak_remove_share' );

// thdk: display jetpack sharing icons

function thdk_jetpack_sharing_icons() {
    if ( function_exists( 'sharing_display' ) ) {
        sharing_display( '', true );
    }

    if ( class_exists( 'Jetpack_Likes' ) ) {
        $custom_likes = new Jetpack_Likes;
        echo $custom_likes->post_likes( '' );
    }
}


/**
 * THDK: include sharing to twenty_seventeen_entry_footer
 * Prints HTML with meta information for the categories, tags and comments.
 */
function twentyseventeen_entry_footer($showSocialIcons = true) {

	/* translators: used between list items, there is a space after the comma */
    $separate_meta = __( ', ', 'twentyseventeen' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );

	// Get Tags for posts.
	$tags_list = get_the_tag_list( '', $separate_meta );

    $country_list = wp_get_post_terms(get_the_ID(), 'country', array("fields" => "all"));

    $city_list = wp_get_post_terms(get_the_ID(), 'city', array("fields" => "all"));

	// We don't want to output .entry-footer if it will be empty, so make sure its not.
	if ( ( ( twentyseventeen_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() || $showSocialIcons || count($country_list) > 0 || count($city_list) > 0 || isset($parent_post_title)) {
        echo '<div id="scroller-anchor"></div>';
		echo '<footer class="entry-footer" id="scroller">';

			// if ( 'post' === get_post_type() ) {
				if ( ( $categories_list && twentyseventeen_categorized_blog() ) || $tags_list || count($country_list) > 0 || count($city_list) > 0 || true ) {
					echo '<span class="cat-tags-links">';

						// Make sure there's more than one category before displaying.
						if ( $categories_list && twentyseventeen_categorized_blog() ) {
							echo '<span class="cat-links">' . twentyseventeen_get_svg( array( 'icon' => 'folder-open' ) ) . '<span class="screen-reader-text">' . __( 'Categories', 'twentyseventeen' ) . '</span>' . $categories_list . '</span>';
                        }
                        echo thdk_show_parent();
                        echo thdk_show_location();

						if ( $tags_list ) {
							echo '<span class="tags-links">' . twentyseventeen_get_svg( array( 'icon' => 'hashtag' ) ) . '<span class="screen-reader-text">' . __( 'Tags', 'twentyseventeen' ) . '</span>' . $tags_list . '</span>';
						}

					echo '</span>';
				}
			// }

			twentyseventeen_edit_link();

            //thdk: include sharing icons
       if ($showSocialIcons) {
        thdk_sharing();
       }
		echo '</footer> <!-- .entry-footer -->';
	}
}

function thdk_show_location($addLink = true) {
   global $cpt_onomy;
    $postid = get_the_ID();
    $term_list = wp_get_post_terms($postid, 'country', array("fields" => "all"));
    if($addLink && $term_list[0]->name) {
           $country = '<a href="' . thdk_get_permalink_by_slug($term_list[0]->name, $term_list[0]->taxonomy) . '">' . $term_list[0]->name . '</a>';
        }
        else {
            $country = $term_list[0]->name;
        }

    $term_list = wp_get_post_terms($postid, 'city', array("fields" => "all"));
    $city = $term_list[0]->name;

    if($addLink && $term_list[0]->name) {
           $city = '<a href="' . thdk_get_permalink_by_slug($term_list[0]->name, $term_list[0]->taxonomy) . '">' . $term_list[0]->name . '</a>';
        }
        else {
            $city = $term_list[0]->name;
        }

    if($country || $city) {
        echo '<span class="location-links">';
        echo '<span class="location-icon"></span>';
    }
    if($country) {
        echo $country;
        if($city)
        {
            echo ' - '.$city;
        }
    }
    else if($city) {
        echo $city;
    }
    if($country || $city) {
        echo '</span>';
    }
}

function thdk_show_parent($addLink = true) {
    $postid = get_the_ID();
    $parentPostId = wp_get_post_parent_id($postid);

    if ($parentPostId) {
        if($addLink) {
            $parent = '<a href="' . get_post_permalink($parentPostId) . '">' . get_the_title($parentPostId) . '</a>';
        }
        else {
            $parent = get_the_title($parentPostId);
        }

        echo '<span class="parent-links" style="display=none">';
        echo '<span class="parent-icon"></span>';
        echo $parent;
        echo '</span>';
 }
}

function thdk_sharing() {
    echo '<div class="sharing">';
    thdk_jetpack_sharing_icons();
    echo '<div class="clear"></div>';
    echo '</div>';
}

// thdk: get related posts for specified taxonomy
// todo: add optional post type parameter to get for ex. hikes in current country
function thdk_get_related_posts( $taxonomy = '', $args = [] )
{
    /*
     * Before we do anything and waste unnecessary time and resources, first check if we are on a single post page
     * If not, bail early and return false
     */
    if ( !is_single() )
        return false;

    /*
     * Check if we have a valid taxonomy and also if the taxonomy exists to avoid bugs further down.
     * Return false if taxonomy is invalid or does not exist
     */
    if ( !$taxonomy )
        return false;

    $taxonomy = filter_var( $taxonomy, FILTER_SANITIZE_STRING );
    if ( !taxonomy_exists( $taxonomy ) )
        return false;

    /*
     * We have made it to here, so we should start getting our stuff togther.
     * Get the current post object to start of
     */
    $current_post = get_queried_object();

    /*
     * Get the post terms, just the ids
     */
    $terms = wp_get_post_terms( $current_post->ID, $taxonomy, ['fields' => 'ids'] );

    /*
     * Lets only continue if we actually have post terms and if we don't have an WP_Error object. If not, return false
     */
    if ( !$terms || is_wp_error( $terms ) )
        return false;

    /*
     * Set the default query arguments
     */
    $defaults = [
        'post_type' => $current_post->post_type,
        'post__not_in' => [$current_post->ID],
        'tax_query' => [
            [
                'taxonomy' => $taxonomy,
                'terms' => $terms,
                'include_children' => false
            ],
        ],
    ];

    /*
     * Validate and merge the defaults with the user passed arguments
     */
    if ( is_array( $args ) ) {
        $args = wp_parse_args( $args, $defaults );
    } else {
        $args = $defaults;
    }

    /*
     * Now we can query our related posts and return them
     */
    $q = get_posts( $args );

    return $q;
}


/**
 * Returns the permalink for a page based on the incoming slug.
 *
 * @param   string  $slug   The slug of the page to which we're going to link.
 * @return  string          The permalink of the page
 * @since   1.0
 */
function thdk_get_permalink_by_slug( $slug, $post_type = '' ) {

    // Initialize the permalink value
    $permalink = null;

    // Build the arguments for WP_Query
    $args = array(
        'name'          => $slug,
        'max_num_posts' => 1
    );

    // If the optional argument is set, add it to the arguments array
    if( '' != $post_type ) {
        $args = array_merge( $args, array( 'post_type' => $post_type ) );
    }

    // Run the query (and reset it)
    $query = new WP_Query( $args );
    if( $query->have_posts() ) {
        $query->the_post();
        $permalink = get_permalink( get_the_ID() );
        wp_reset_postdata();
    }
    return $permalink;
}

?>