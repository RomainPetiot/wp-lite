<?php
function site_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    //add jquery on the footer
    wp_deregister_script( 'jquery' );
	/*wp_register_script( 'jquery', get_stylesheet_directory_uri() . '/assets/js/jquery.min.js', false, NULL, true );
    wp_enqueue_script( 'jquery' );*/

    // Adding scripts file in the footer
    wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/assets/js/script.min.js', false, '', true );
	//wp_enqueue_script( 'contact', get_stylesheet_directory_uri() . '/assets/js/contact.min.js', array( 'script' ), '', true );
    wp_localize_script('script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );

	//stylesheet
	wp_enqueue_style( 'global-site-min', get_stylesheet_directory_uri() . '/assets/css/global.min.css', '', '', 'all' );
}
add_action('wp_enqueue_scripts', 'site_scripts', 999);

/**
*   Child page conditional
*   @ Accept's page ID, page slug or page title as parameters
*/
/*
function is_child( $parent = '' ) {
    global $post;

    @$parent_obj = get_page( $post->post_parent, ARRAY_A );
    $parent = (string) $parent;
    $parent_array = (array) $parent;

    if ( in_array( (string) $parent_obj['ID'], $parent_array ) ) {
        return true;
    } elseif ( in_array( (string) $parent_obj['post_title'], $parent_array ) ) {
        return true;
    } elseif ( in_array( (string) $parent_obj['post_name'], $parent_array ) ) {
        return true;
    } else {
        return false;
    }
}*/
