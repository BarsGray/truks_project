<?php

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );


function theme_register_nav_menu() {
	register_nav_menu( 'primary', 'Главное меню' );
	register_nav_menu( 'footer_menu', 'Футер меню' );
}
add_action( 'after_setup_theme', 'theme_register_nav_menu' );

add_theme_support( 'custom-logo', [
	'height'      => 9999,
	'width'       => 9999,
	'flex-width'  => false,
	'flex-height' => false,
	'header-text' => '',
	'unlink-homepage-logo' => true
] );

 /* Enqueue scripts and styles.*/
add_action( 'wp_default_scripts', 'ds_print_jquery_in_footer' );
function ds_print_jquery_in_footer( &$scripts) {
	if ( ! is_admin() ) $scripts->add_data( 'jquery', 'group', 1 );
}
add_action('wp_enqueue_scripts', 'shd_scripts');
function shd_scripts() {
    // styles
    wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'style-dop', get_template_directory_uri() . "/css/style-dop.css" );
    wp_enqueue_style( 'slick-theme', get_template_directory_uri() . "/css/slick-theme.css" );
	wp_enqueue_style( 'slick', get_template_directory_uri() . "/css/slick.css" );
	wp_enqueue_style( 'modal', get_template_directory_uri() . "/css/jquery.modal.min.css" );
    // scripts
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'slick', get_template_directory_uri() . "/js/slick.min.js", array(), null, "in_footer" );
    wp_enqueue_script( 'modal', get_template_directory_uri() . "/js/jquery.modal.min.js", array(), null, "in_footer" );
    wp_enqueue_script( 'inputmask', get_template_directory_uri() . "/js/inputmask/jquery.inputmask.js", array(), null, "in_footer" );
    wp_enqueue_script( 'scripts', get_template_directory_uri() . "/js/scripts.js", array(), null, "in_footer" );
}

// Clean up the <head>
add_action('init', 'removeHeadLinks');
function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}
remove_action( 'wp_head', 'wp_generator' );


// add working shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');
add_theme_support('html5', array( 'gallery', 'caption'));
add_filter('use_default_gallery_style', '__return_false');

// remove autoformat
//remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');
remove_filter('comment_text', 'wpautop');

// Remove <p> and <br/> from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

/* Disable updating a plugins */
add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );
function filter_plugin_updates( $value ) {
	if( isset( $value->response ) ) {
		unset( $value->response['advanced-custom-fields-pro-master/acf.php'] );
	}
	return $value;
}

/* ACF Pro */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page( array(
		'page_title' 	=> 'Настройки темы',
		'menu_title'	=> 'Настройки темы',
		'menu_slug' 	=> 'options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'position'      => 80,
	));
}

add_filter('acf/format_value/type=text', 'root_acf_format_value', 10, 3);
add_filter('acf/format_value/type=textarea', 'root_acf_format_value', 10, 3);
function root_acf_format_value( $value, $post_id, $field ) {
	return do_shortcode( $value );
}

/* Disable Guttenberg for Custom Post Types */
/*add_filter( 'use_block_editor_for_post_type', 'my_disable_gutenberg', 10, 2 );
function my_disable_gutenberg( $current_status, $post_type ) {
	$disabled_post_types = ['locations', 'door-models', 'covering-options'];
	return !in_array( $post_type, $disabled_post_types, true );
}*/















add_action( 'woocommerce_after_shop_loop_item', 'truemisha_short_description', 7 );
 
function truemisha_short_description() {
	the_excerpt();
}

function wplife_filter_woocommerce_short_description( $post_post_excerpt ) {
  return ""; 
};
add_filter( 'woocommerce_short_description', 'wplife_filter_woocommerce_short_description', 10, 1 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

add_filter ( 'woocommerce_product_thumbnails_columns', 'three_product_thumbnails_columns', 10, 1 );
function three_product_thumbnails_columns( $columns ) {
    return 3; // Default is 4
}

## Вывод текста "от" перед ценой
add_filter( 'woocommerce_get_price_html', 'qfurs_add_price_prefix', 99, 2 );
  
function qfurs_add_price_prefix( $price, $product ){
    $price = 'Цена: ' . $price;
    return $price;
}


