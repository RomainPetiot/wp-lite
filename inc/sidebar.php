<?php
// SIDEBARS AND WIDGETIZED AREAS
function wplite_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar',
		'name' => __('Sidebar', 'wplite'),
		'description' => __('The first (primary) sidebar.', 'wplite'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	));




} // don't remove this bracket!
