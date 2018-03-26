<?php

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point( $path ) {
    // update path
    $path = get_stylesheet_directory() . '/assets/acf';
    // return
    return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    // append path
    $paths[] = get_stylesheet_directory() . '/assets/acf';
    // return
    return $paths;
}

function my_acf_init() {

	acf_update_setting('google_api_key', 'AIzaSyBhfy-jFUas3xdj1s2ufhrbFj0PU6ryT_g');
}
add_action('acf/init', 'my_acf_init');
