<?php

$redux_opt_name = REDUX_OPT_NAME;

function magplus_redux_add_metaboxes($metaboxes) {

  // Variable used to store the configuration array of metaboxes
  $metaboxes = array();

  $metaboxes[] = magplus_redux_get_video_post_metaboxes();
  $metaboxes[] = magplus_redux_get_quote_post_metaboxes();
  $metaboxes[] = magplus_redux_get_review_post_metaboxes();
  $metaboxes[] = magplus_redux_get_gallery_post_metaboxes();
  $metaboxes[] = magplus_redux_get_audio_post_metaboxes();
  $metaboxes[] = magplus_redux_get_post_metaboxes();
  $metaboxes[] = magplus_redux_get_post_adv_metaboxes();
  $metaboxes[] = magplus_redux_get_page_metaboxes();
  $metaboxes[] = magplus_redux_get_social_metaboxes();

  return $metaboxes;
}
add_action('redux/metaboxes/'.$redux_opt_name.'/boxes', 'magplus_redux_add_metaboxes');

/**
 * Get configuration array for post metaboxes
 * @return type
 */
function magplus_redux_get_post_metaboxes() {
  
  // Variable used to store the configuration array of sections
  $sections = array();
  
  // Metabox used to overwrite theme options by page
  require get_theme_file_path('framework/admin/metaboxes/post.php');
  
  return array(
    'id' => 'magplus-post-options',
    'title' => esc_html__('Post Options', 'magplus'),
    'post_types' => array('post'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections,
  );
}


/**
 * Get configuration array for contact template
 * @return type
 */
function magplus_redux_get_social_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  require get_theme_file_path('framework/admin/metaboxes/social-site.php');

  return array(
    'id' => 'magplus-template-social-options',
    'title' => esc_html__('Social Options', 'magplus'),
    'post_types' => array('social-site'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections,
  );
}


/**
 * Get configuration array for page metaboxes
 * @return type
 */
function magplus_redux_get_page_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  //require get_theme_file_path() . '/framework/admin/metaboxes/header.php';
  require get_theme_file_path('framework/admin/metaboxes/slider.php');
  require get_theme_file_path('framework/admin/metaboxes/title-wrapper.php');
  require get_theme_file_path('framework/admin/metaboxes/content.php');
  require get_theme_file_path('framework/admin/metaboxes/sidebar.php');

  return array(
    'id' => 'magplus-page-options',
    'title' => esc_html__('Options', 'magplus'),
    'post_types' => array('page'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections
  );
}


/**
 * Get configuration array for video post metaboxes
 * @return type
 */
function magplus_redux_get_video_post_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  require get_theme_file_path('framework/admin/metaboxes/post-video.php');

  return array(
    'id' => 'magplus-video-post-options',
    'title' => esc_html__('Video Post Options', 'magplus'),
    'post_types' => array('post'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections,
    'post_format' => array('video')
  );
}

/**
 * Get configuration array for qoute post metaboxes
 * @return type
 */
function magplus_redux_get_quote_post_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  require get_theme_file_path('framework/admin/metaboxes/post-quote.php');

  return array(
    'id' => 'magplus-quote-post-options',
    'title' => esc_html__('Quote Post Options', 'magplus'),
    'post_types' => array('post'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections,
    'post_format' => array('quote')
  );
}

/**
 * Get configuration array for video post metaboxes
 * @return type
 */
function magplus_redux_get_review_post_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  require get_theme_file_path('framework/admin/metaboxes/post-review.php');

  return array(
    'id' => 'magplus-review-post-options',
    'title' => esc_html__('Review Post Options', 'magplus'),
    'post_types' => array('post'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections,
    'post_format' => array('aside')
  );
}

/**
 * Get configuration array for video post metaboxes
 * @return type
 */
function magplus_redux_get_audio_post_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  require get_theme_file_path('framework/admin/metaboxes/post-audio.php');

  return array(
    'id' => 'magplus-audio-post-options',
    'title' => esc_html__('Audio Post Options', 'magplus'),
    'post_types' => array('post'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections,
    'post_format' => array('audio')
  );
}

/**
 * Get configuration array for video post metaboxes
 * @return type
 */
function magplus_redux_get_gallery_post_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  require get_theme_file_path('framework/admin/metaboxes/post-gallery.php');

  return array(
    'id' => 'magplus-gallery-post-options',
    'title' => esc_html__('Gallery Post Options', 'magplus'),
    'post_types' => array('post'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections,
    'post_format' => array('gallery')
  );
}

/**
 * Get configuration array for page metaboxes
 * @return type
 */
function magplus_redux_get_post_adv_metaboxes() {

  // Variable used to store the configuration array of sections
  $sections = array();

  // Metabox used to overwrite theme options by page
  require get_theme_file_path('framework/admin/metaboxes/title-wrapper.php');
  require get_theme_file_path('framework/admin/metaboxes/content.php');

  return array(
    'id' => 'magplus-post-adv-options',
    'title' => esc_html__('Options', 'magplus'),
    'post_types' => array('post'),
    'position' => 'normal', // normal, advanced, side
    'priority' => 'high', // high, core, default, low
    'sections' => $sections
  );
}
