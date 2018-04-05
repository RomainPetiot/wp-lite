<?php
function site_scripts() {
  global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way

    //add jquery on the footer
    wp_deregister_script( 'jquery' );
	/*wp_register_script( 'jquery', get_stylesheet_directory_uri() . '/assets/js/jquery.min.js', false, NULL, true );
    wp_enqueue_script( 'jquery' );*/

    // Adding scripts file in the footer
//    wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/assets/js/script.min.js', false, '', true );
	//wp_enqueue_script( 'contact', get_stylesheet_directory_uri() . '/assets/js/contact.min.js', array( 'script' ), '', true );
    wp_localize_script('script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );

	//stylesheet
//	wp_enqueue_style( 'global-site-min', get_stylesheet_directory_uri() . '/assets/css/global.min.css', '', '', 'all' );
}
add_action('wp_enqueue_scripts', 'site_scripts', 999);
