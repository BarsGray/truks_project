<?php
/**
 * Plugin Name: Калькулятор лизинга AlphaBank
 * Description: Вставляет калькулятор лизинга на страницу
 * Author:      Aleksandr Aleksandrov
 * Version:     1.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include 'admin_table.php';
include ABSPATH.'wp-load.php';


// print plugin_dir_url(__FILE__) . 'script.js';
// add_action('wp_enqueue_styles', function () {

// });
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('calc-style', plugin_dir_url(__FILE__).'style.css');
  wp_enqueue_script('calc-script', plugin_dir_url(__FILE__).'script.js');
});

function get_product_image_url($id)
{
  $product = wc_get_product($id);
  $image_id = $product->get_image_id();
  $url = wp_get_attachment_image_url($image_id, 'full');
  return $url ? $url : '';
}


function calc_get_product_categories($product, $return_raw_categories = false) {
  $result = array();
  // Get all the categories to which a product is assigned
  $categories = wp_get_post_terms($product->get_id(), 'product_cat');

  // The $categories array contains a list of objects. Most likely, we would
  // like to have categorys slug as a keys, and their names as values. The#
  // wp_list_pluck() function is perfect for this
  $categories = wp_list_pluck($categories, 'slug');
  return $categories;
}

function calc_leasing_func($atts, $content, $tag)
{
  $path = plugin_dir_url(__FILE__);
  $body = file_get_contents($path . "body.php");
  $adds =
    '<div class="calc_holder"><div class="left_select">';
  global $product;
  $id = false;
  if($atts[0]) {
    $id = $atts[0];
  }
  elseif ($product) {
    $id = $product->get_id();
  }

  
	//$product_ids = wc_get_products(array('return' => 'ids'));
	
	$args = array(
		'category' => 'vyvodim-v-kalkulyator'
	);
	$product_ids = wc_get_products($args);
	
  $select = "<select id='select-products'>";
  for ($i = 0; $i < count($product_ids); $i++) {
    $product = wc_get_product($product_ids[$i]);
    $selected = ($id == $product_ids[$i]);

    if ($selected) {
      $selected = 'selected';
    } else {
      $selected = '';
    }

    $select .=
      '<option ' .
        $selected
        . ' dataprice="'  . $product->get_price() . '"'
        . ' datatitle="'  . $product->get_title() . '"'
        . ' image="'      . get_product_image_url($product->get_id()) . '"'
        . ' value="'      . $product->get_id() . '"'
        . ' class="'      . implode(' ', calc_get_product_categories($product)) . '">'
        . $product->get_title() . "</option>\n";
  }
  $select .= "</select>" . wp_get_attachment_image_src($product->get_id(), 'wooocommerce_thumbnail');
  // $product = wc_get_product($product_ids[0]);
  // $image_id = $product->get_image_id();
  // $image_url = wp_get_attachment_image_src($image_id, 'full');
  // if ($image_url) {
  $select .= '<img id="calc-image" />';
  // }


  return $adds . $select . "</div>" . $body . "</div>";
}

add_shortcode("calc-leasing", "calc_leasing_func");

add_action( 'woocommerce_after_single_product', 'wc_init' );
function wc_init(){
  $current_product = wc_get_product();
  print calc_leasing_func([$current_product->get_id()], null, null);
}

