<?php
// Calling your own login css so you can style it
function wplite_login_css() {
	wp_enqueue_style( 'wplite_login_css', get_stylesheet_directory_uri() . '/assets/css/login.min.css', false );
}

// changing the logo link from wordpress.org to your site
function wplite_login_url() {  return home_url(); }

// changing the alt text on the logo to show your site name
function wplite_login_title() { return get_option('blogname'); }

// calling it only on the login page
add_action( 'login_enqueue_scripts', 'wplite_login_css', 10 );
add_filter('login_headerurl', 'wplite_login_url');
add_filter('login_headertitle', 'wplite_login_title');
