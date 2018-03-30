<?php
// Register menus
register_nav_menus(
	array(
		'main-nav' => __( 'The Main Menu', 'wplite' ),   // Main nav in header
		'footer-links' => __( 'Footer Links', 'wplite' ), // Secondary nav in footer
		'footer-links2' => __( 'Footer Links2', 'wplite' ), // Secondary nav in footer
	)
);

// The Top Menu
function wplite_top_nav($nav = 'main-nav') {
     wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'main-menu',       // Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'theme_location' => $nav,                 // Where it's located in the theme
        'depth' => 2,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new Topbar_Menu_Walker()
    ));
}


// The footer Menu
function wplite_footer_links($nav = 'footer-links') {
     wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'footer-links',       // Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s" >%3$s</ul>',
        'theme_location' => $nav,                 // Where it's located in the theme
        'depth' => 2,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new Topbar_Menu_Walker()
    ));
}


// Big thanks to Brett Mason (https://github.com/brettsmason) for the awesome walker
class Topbar_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu\">\n";
    }
}

// Add active class to menu
function required_active_nav_class( $classes, $item ) {
    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'required_active_nav_class', 10, 2 );
