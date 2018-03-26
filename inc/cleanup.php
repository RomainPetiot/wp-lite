<?php

// Fire all our initial functions at the start
add_action('after_setup_theme','wplite_start', 16);

function wplite_start() {

    // launching operation cleanup
    add_action('init', 'wplite_head_cleanup');

    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'wplite_remove_wp_widget_recent_comments_style', 1 );

    // clean up comment styles in the head
    add_action('wp_head', 'wplite_remove_recent_comments_style', 1);

    // clean up gallery output in wp
    add_filter('gallery_style', 'wplite_gallery_style');

    // adding sidebars to Wordpress
    add_action( 'widgets_init', 'wplite_register_sidebars' );

    // cleaning up excerpt
    add_filter('excerpt_more', 'wplite_excerpt_more');

} /* end joints start */

//The default wordpress head is a mess. Let's clean it up by removing all the junk we don't need.
function wplite_head_cleanup() {
	// Remove category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// Remove post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// Remove EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// Remove Windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// Remove index link
	remove_action( 'wp_head', 'index_rel_link' );
	// Remove previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// Remove start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// Remove links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// Remove WP version
	remove_action( 'wp_head', 'wp_generator' );
} /* end Joints head cleanup */

// Remove injected CSS for recent comments widget
function wplite_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// Remove injected CSS from recent comments widget
function wplite_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// Remove injected CSS from gallery
function wplite_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

// This removes the annoying […] to a Read More link
function wplite_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '';
	//return '<a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __('Read', 'jointswp') . get_the_title($post->ID).'">'. __('... Read more &raquo;', 'jointswp') .'</a>';
}

//  Stop WordPress from using the sticky class (which conflicts with Foundation), and style WordPress sticky posts using the .wp-sticky class instead
function remove_sticky_class($classes) {
	if(in_array('sticky', $classes)) {
		$classes = array_diff($classes, array("sticky"));
		$classes[] = 'wp-sticky';
	}

	return $classes;
}
add_filter('post_class','remove_sticky_class');

//This is a modified the_author_posts_link() which just returns the link. This is necessary to allow usage of the usual l10n process with printf()
function wplite_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s', 'jointswp' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}

add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );
function adjust_the_wp_menu() {
    //remove_submenu_page( 'widgets.php' );
}


function remove_json_api () {

    // Remove the REST API lines from the HTML Header
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

    // Remove the REST API endpoint.
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );

    // Turn off oEmbed auto discovery.
    add_filter( 'embed_oembed_discover', '__return_false' );

    // Don't filter oEmbed results.
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

    // Remove oEmbed discovery links.
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );

    remove_action( 'wp_head','feed_links', 2 );
  	remove_action( 'wp_head','feed_links_extra', 3 );

  	remove_action( 'wp_head', 'wp_resource_hints', 2 );




}
add_action( 'after_setup_theme', 'remove_json_api' );
