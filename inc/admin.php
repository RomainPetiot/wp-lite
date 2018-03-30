<?php
// This file handles the admin area and functions - You can use this file to make changes to the dashboard.

/************* DASHBOARD WIDGETS *****************/
// Disable default dashboard widgets
function disable_default_dashboard_widgets() {
	// Remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget

	// Remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
	remove_meta_box('dashboard_primary', 'dashboard', 'core');         //
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //

	// Removing plugin dashboard boxes
	remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget

}

/*
For more information on creating Dashboard Widgets, view:
http://digwp.com/2010/10/customize-wordpress-dashboard/
*/

// RSS Dashboard Widget
function wplite_rss_dashboard_widget() {
	if(function_exists('fetch_feed')) {
		include_once(ABSPATH . WPINC . '/feed.php');               // include the required file
		$feed = fetch_feed('http://jointswp.com/feed/rss/');        // specify the source feed
		$limit = $feed->get_item_quantity(5);                      // specify number of items
		$items = $feed->get_items(0, $limit);                      // create an array of items
	}
	if ($limit == 0) echo '<div>' . __( 'The RSS Feed is either empty or unavailable.', 'wplite' ) . '</div>';   // fallback message
	else foreach ($items as $item) { ?>

	<h4 style="margin-bottom: 0;">
		<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo mysql2date(__('j F Y @ g:i a', 'wplite'), $item->get_date('Y-m-d H:i:s')); ?>" target="_blank">
			<?php echo $item->get_title(); ?>
		</a>
	</h4>
	<p style="margin-top: 0.5em;">
		<?php echo substr($item->get_description(), 0, 200); ?>
	</p>
	<?php }
}

// Calling all custom dashboard widgets
function wplite_custom_dashboard_widgets() {
	//wp_add_dashboard_widget('wplite_rss_dashboard_widget', __('Custom RSS Feed (Customize in admin.php)', 'wplite'), 'wplite_rss_dashboard_widget');

	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );            // WordPress blog
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );          // Other WordPress News
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
    remove_action( 'welcome_panel', 'wp_welcome_panel' );

	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );   // Right Now
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );   
	//remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); // Recent Comments
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );  // Incoming Links
	//remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );   // Plugins
	/*
	Be sure to drop any other created Dashboard Widgets
	in this function and they will all load.
	*/
}
// removing the dashboard widgets
add_action('admin_menu', 'disable_default_dashboard_widgets');
// adding any custom widgets
add_action('wp_dashboard_setup', 'wplite_custom_dashboard_widgets');

/************* CUSTOMIZE ADMIN *******************/
// Custom Backend Footer
function wplite_custom_admin_footer() {
	_e('<span id="footer-thankyou">Developed by <a href="https://www.romainpetiot.com" target="_blank">Romain Petiot</a></span>.', 'wplite');
}

// adding it to the admin area
add_filter('admin_footer_text', 'wplite_custom_admin_footer');


//cache les erreurs de connexion
add_filter('login_errors',create_function('$a', "return null;"));


function remove_menu_items() {
 global $menu;
 $restricted = array(__('Links'), __('Comments'));
 end ($menu);
 while (prev($menu)){
 $value = explode(' ',$menu[key($menu)][0]);
 if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
 unset($menu[key($menu)]);}
 }
 }

add_action('admin_menu', 'remove_menu_items');

function remove_submenus() {
 global $submenu;
  unset($submenu['options-general.php'][15]); // Supprimer 'Ecriture'.
 unset($submenu['options-general.php'][25]); // Supprimer 'Commentaires'.
 unset($submenu['themes.php'][6]); // Customize link
 unset($submenu['edit.php'][16]); // Supprimer 'Tags'.
 }
add_action('admin_menu', 'remove_submenus');

define( 'DISALLOW_FILE_EDIT', true );


add_action( 'admin_menu', 'remove_menu_widget', 999 );
function remove_menu_widget() {
    remove_submenu_page(  'themes.php', 'widgets.php' );
}
