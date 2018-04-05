<?php

// Adding WP Functions & Theme Support
function wplite_theme_support() {

	// Add WP Thumbnail Support
	add_theme_support( 'post-thumbnails' );

	// Default thumbnail size
	set_post_thumbnail_size(125, 125, true);

	// Add RSS Support
	//add_theme_support( 'automatic-feed-links' );

	// Add Support for WP Controlled Title Tag
	add_theme_support( 'title-tag' );

	// Add HTML5 Support
	add_theme_support( 'html5',
	         array(
	         //	'comment-list',
	        // 	'comment-form',
	         	'search-form',
	         )
	);
}
add_action( 'after_setup_theme', 'wplite_theme_support' );
