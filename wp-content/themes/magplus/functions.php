<?php
/**
 * The template includes necessary functions for theme.
 *
 * @package magplus
 * @since 1.0
 */
define ('REDUX_OPT_NAME', 'magplus_theme_options');
define ('MAGPLUS_THEME_VERSION','1.0');
define ('MAGPLUS_THEME_ACTIVATED' , true);

if(class_exists('Vc_Manager')):
  vc_set_as_theme( $disable_updater = true );
endif;

require get_theme_file_path('framework/includes/rs-theme-argument-class.php');
require get_theme_file_path('framework/includes/rs-woocommerce-config.php');
require get_theme_file_path('framework/includes/rs-actions-config.php');
require get_theme_file_path('framework/includes/rs-helper-functions.php');
require get_theme_file_path('framework/includes/rs-frontend-functions.php');
require get_theme_file_path('framework/includes/plugins/tgm/class-tgm-plugin-activation.php');
require get_theme_file_path('framework/includes/rs-filters-config.php');
require get_theme_file_path('framework/includes/rs-menu-walker-class.php');
require get_theme_file_path('framework/admin/admin-init.php');

$username = magplus_get_opt( 'envato_username' );
$apikey   = magplus_get_opt( 'envato_apikey' );
if( ! empty( $username ) && ! empty( $apikey ) ):
  include_once get_theme_file_path('framework/admin/theme-updater/theme-updater.php');
endif;

if( !function_exists('magplus_after_setup')) {

  function magplus_after_setup() {

    add_image_size('magplus-small-hor',    110,  81,  true ); 
    add_image_size('magplus-small',        183,  96,  true ); 
    add_image_size('magplus-small-ver',    225,  305,  true ); 
    add_image_size('magplus-small-alt',    80,   80,  true ); 
    add_image_size('magplus-medium',       394,  218, true ); 
    add_image_size('magplus-medium-ver',   546,  200, true );  
    add_image_size('magplus-medium-hor',   335,  160, true ); 
    add_image_size('magplus-medium-alt',   290,  162, true ); 
    add_image_size('magplus-big-alt',      546,  644, true ); 
    add_image_size('magplus-big',          820,  394, true );
    add_image_size('magplus-big-alt-2',    442,  200, true );

    add_theme_support('post-thumbnails');
    add_theme_support('custom-background');
    add_theme_support('automatic-feed-links' );
    add_theme_support('post-formats', array('video', 'gallery', 'audio', 'aside', 'quote') );
    add_theme_support('title-tag');
    add_theme_support('bbpress');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    register_nav_menus (array(
      'top-menu'     => esc_html__( 'Top Menu', 'magplus' ),
      'primary-menu' => esc_html__( 'Main Menu', 'magplus' ),
      'side-menu'    => esc_html__( 'Side Header Menu', 'magplus' ),
    ) );
  }
  add_action( 'after_setup_theme', 'magplus_after_setup' );
}

$remove_duplicates = magplus_get_opt('general-homepage-duplicate-switch');
if($remove_duplicates):
  add_filter('loop_end', 'magplus_update_duplicate_posts');
  add_filter('magplus_block_query_args', 'magplus_add_duplicate_exclude');
endif;
/**
 * Action callback: Add to list processed posts to handle duplicates
 * 
 * @param object $query
 */
global $magplus_registry;
$magplus_registry = array();
if(!function_exists('magplus_update_duplicate_posts')) {
  function magplus_update_duplicate_posts(&$query) {
    global $magplus_registry;
    if (empty($query->query_vars['handle_duplicates'])) {
      return;
    }

    foreach ($query->posts as $post) {
      $duplicates = (array) $magplus_registry['page_duplicate_posts'];
      array_push($duplicates, $post->ID); 
      $magplus_registry['page_duplicate_posts'] = $duplicates;
    }
  }
}

/**
 * Filter callback: Enable duplicate prevention on these query args
 * 
 * @param array $query  query arguments
 */
if(!function_exists('magplus_add_duplicate_exclude')) {
  function magplus_add_duplicate_exclude($query) {
    global $magplus_registry;
    if (!is_front_page()) {
      return $query;
    }
    
    if (!isset($magplus_registry['page_duplicate_posts'])) {
      $magplus_registry['page_duplicate_posts'] = array();
    }
    
    $query['post__not_in'] = $magplus_registry['page_duplicate_posts'];
    $query['handle_duplicates'] = true;
        
    return $query;
  }
  
}

if ( ! isset( $content_width ) ) {
  $content_width = 1140;
}
