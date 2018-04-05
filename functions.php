<?php


// Theme support options
require_once(get_stylesheet_directory().'/inc/theme-support.php');

// Register sidebars/widget areas
require_once(get_stylesheet_directory().'/inc/sidebar.php');

// WP Head and other cleanup functions
require_once(get_stylesheet_directory().'/inc/cleanup.php');

// Register scripts and stylesheets
require_once(get_stylesheet_directory().'/inc/enqueue-scripts.php');

// Register custom menus and menu walkers
require_once(get_stylesheet_directory().'/inc/menu.php');

// Makes WordPress comments suck less
require_once(get_stylesheet_directory().'/inc/comments.php');

// Replace 'older/newer' post links with numbered navigation
require_once(get_stylesheet_directory().'/inc/page-navi.php');

// Remove 4.2 Emoji Support
require_once(get_stylesheet_directory().'/inc/disable-emoji.php');

// ajouter des formats d'image
require_once(get_stylesheet_directory().'/inc/add_image_size.php');

// Ajouter des options dans l'admin
//require_once(get_stylesheet_directory().'/inc/options.php');

// Use this as a template for custom post types
require_once(get_stylesheet_directory().'/inc/custom-post-type.php');

// Customize the WordPress login menu
require_once(get_stylesheet_directory().'/inc/login.php');

// Customize the WordPress admin
require_once(get_stylesheet_directory().'/inc/admin.php');

require_once(get_stylesheet_directory().'/inc/acf.php');

require_once(get_stylesheet_directory().'/inc/plugin-require.php');
