<?php
/**
 * Backend Theme Functions.
 *
 * @package make
 * @subpackage Template
 */

/**
 * Get theme option value
 * @param string $option
 * @return mix|boolean
 */
if(!function_exists('magplus_get_opt')) {
  function magplus_get_opt($option) {
    global $magplus_theme_options;

    $local = false;

    //get local from main shop page
    if (class_exists( 'WooCommerce' ) && (is_shop() || is_product_category() || is_product_tag())) {

      $shop_page = wc_get_page_id( 'shop' );

      if (!empty($shop_page)) {
        $value = magplus_get_post_opt( $option.'-local', (int)$shop_page);
        $local = true;
      }

    //get local from metaboxes for the post value and override if not empty
    } else if (is_singular()) {
      $value = magplus_get_post_opt( $option.'-local' );
      //print_r($value);
      $local = true;
    }

    //return local value if exists
    if ($local === true) {
      //if $value is an array we need to check if first element is not empty before we return $value
      $first_element = null;
      if (is_array($value)) {
        $first_element = reset($value);
      }
      if (is_string($value) && (strlen($value) > 0 || !empty($value)) || is_array($value) && !empty($first_element)) {
        return $value;
      }
    }

    if (isset($magplus_theme_options[$option])) {
      return $magplus_theme_options[$option];
    }
    return false;
  }
}

/**
 * Get next page URL
 * @param int $max_num_pages
 * @return string/boolean
 */
if(!function_exists('magplus_next_page_url')) {
  function magplus_next_page_url($max_num_pages = 0) {

    if ($max_num_pages === false) {
      global $wp_query;
      $max_num_pages = $wp_query->max_num_pages;
    }

    if ($max_num_pages > max(1, get_query_var('paged'))) {

      return get_pagenum_link(max(1, get_query_var('paged')) + 1);
    }
    return false;
  }
}

/**
 * Get single post option value
 * @param unknown $option
 * @param string $id
 * @return NULL|mixed
 */
if(!function_exists('magplus_get_post_opt')) {
  function magplus_get_post_opt( $option, $id = '' ) {

    global $post;

    if (!empty($id)) {
      $local_id = $id;
    } else {
      if(!isset($post->ID)) {
        return null;
      }
      $local_id = get_the_ID();

    }

    if(function_exists('redux_post_meta')) {
      $options = redux_post_meta(REDUX_OPT_NAME, $local_id);
    } else {
      $options = get_post_meta( $local_id, REDUX_OPT_NAME, true );
    }

    //var_dump($local_id);

    if( isset( $options[$option] ) ) {
      return $options[$option];
    } else {
      return null;
    }
  }
}

/**
 * Adding inline styles
 * @param string $style
 * @return void
 *
 * Usage:
 * magplus_add_inline_style(".className { color: #FF0000; }")
 */
if(!function_exists('magplus_add_inline_style')) {
  function magplus_add_inline_style( $style ) {

    $oArgs = ThemeArguments::getInstance('inline_style');
    $inline_styles = $oArgs -> get('inline_styles');
    if (!is_array($inline_styles)) {
      $inline_styles = array();
    }
    array_push( $inline_styles, $style );
    $oArgs -> set('inline_styles', $inline_styles);
  }  
}

/**
 * Inline styles
 * @param type $css
 * @return type
 */
if(!function_exists('magplus_css_compress')) {
  function magplus_css_compress($css) {
    $css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
    $css = str_replace( ': ', ':', $css );
    $css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );
    return $css;
  }
}

/**
 * Get custom sidebars list
 * @return array
 */
if(!function_exists('magplus_get_custom_sidebar')) {
  function magplus_get_custom_sidebars_list($add_default = true) {

    $sidebars = array();
    if ($add_default) {
      $sidebars['default'] = esc_html__('Default', 'magplus');
    }

    $options = get_option('magplus_theme_options');

    if (!isset($options['custom-sidebars']) || !is_array($options['custom-sidebars'])) {
      return $sidebars;
    }

    if (is_array($options['custom-sidebars'])) {
      foreach ($options['custom-sidebars'] as $sidebar) {
        $sidebars[sanitize_title ( $sidebar )] = $sidebar;
      }
    }

    return $sidebars;
  }
}

  /**
   * Return page layout
   * @param type $type
   * @return array
   */
if(!function_exists('magplus_sidebar_position')) {
  function magplus_sidebar_position() {
    $sidebar_details = array();
    if(is_singular('post')) {
      $sidebar_details['layout']             = magplus_get_opt('blog-sidebar-layout');
      $sidebar_details['sidebar-name-left']  = 'blog-sidebar-left';
      $sidebar_details['sidebar-name-right'] = 'blog-sidebar-right';
    } elseif (is_archive()) {
      $sidebar_details['layout']             = magplus_get_opt('archive-sidebar-layout');
      $sidebar_details['sidebar-name-left']  = 'archive-sidebar-left';
      $sidebar_details['sidebar-name-right'] = 'archive-sidebar-right';
    } else {
      $sidebar_details['layout']             = magplus_get_opt('main-layout');
      $sidebar_details['sidebar-name-left']  = 'sidebar';
      $sidebar_details['sidebar-name-right'] = 'sidebar-right';
    }
    return $sidebar_details;
  }
}

/**
 * Get custom sidebar, returns $default if custom sidebar is not defined
 * @param string $default
 * @param string $sidebar_option_field
 * @return string
 */
if( !function_exists('magplus_get_custom_sidebar')) {
  function magplus_get_custom_sidebar($default = '', $sidebar_option_field = 'sidebar') {

    $sidebar = magplus_get_opt($sidebar_option_field);

    if ($sidebar != 'default' && !empty($sidebar)) {
      return $sidebar;
    }
    return $default;
  }
}

/**
 *
 * Blog Excerpt Read More
 * @since 1.7.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'magplus_auto_post_excerpt' ) ) {
  function magplus_auto_post_excerpt( $limit = '', $content = '' ) {
    $limit   = ( empty($limit)) ? 20:$limit;
    $content = (empty($content)) ? get_the_excerpt():$content;
    $content = strip_shortcodes( $content );
    $content = str_replace( ']]>', ']]&gt;', $content );
    $content = strip_tags( $content );
    $words   = explode( ' ', $content, $limit + 1 );

    if( count( $words ) > $limit ) {

      array_pop( $words );
      $content  = implode( ' ', $words );
      $content .= ' ...';

    }

    return $content;

  }
}

/**
*
* @return none
* @param  class
* multiple class sanitization
*
**/
if ( ! function_exists( 'magplus_sanitize_html_classes' ) && function_exists( 'sanitize_html_class' ) ) {
  function magplus_sanitize_html_classes( $class, $fallback = null ) {

    // Explode it, if it's a string
    if ( is_string( $class ) ) {
      $class = explode(" ", $class);
    }

    if ( is_array( $class ) && count( $class ) > 0 ) {
      $class = array_map("sanitize_html_class", $class);
      return implode(" ", $class);
    }
    else {
      return sanitize_html_class( $class, $fallback );
    }
  }
}

/**
 *
 * element values post, page, categories
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'magplus_element_values_page' ) ) {
  function magplus_element_values_page(  $type = '', $query_args = array() ) {

    $options = array();

    switch( $type ) {

      case 'pages':
      case 'page':
      $pages = get_pages( $query_args );

      if ( !empty($pages) ) {
        foreach ( $pages as $page ) {
          $options[$page->post_title] = $page->ID;
        }
      }
      break;

      case 'posts':
      case 'post':
      $posts = get_posts( $query_args );

      if ( !empty($posts) ) {
        foreach ( $posts as $post ) {
          $options[$post->post_title] = lcfirst($post->post_title);
        }
      }
      break;

      case 'tags':
      case 'tag':

      $tags = get_terms( $query_args['taxonomies'], $query_args['args'] );
        if ( !empty($tags) ) {
          foreach ( $tags as $tag ) {
            $options[$tag->term_id] = $tag->name;
        }
      }
      break;

      case 'categories':
      case 'category':

      $categories = get_categories( $query_args );
      if ( !empty($categories) ) {
        foreach ( $categories as $category ) {
          $options[$category->term_id] = $category->name;
        }
      }
      break;

      case 'custom':
      case 'callback':

      if( is_callable( $query_args['function'] ) ) {
        $options = call_user_func( $query_args['function'], $query_args['args'] );
      }

      break;

    }

    return $options;

  }
}

/**
 * Select magplus footer style
 * @since magplus 1.0
 */
if(!function_exists('magplus_header_template')) {
  function magplus_header_template($layout) {
    if(class_exists('ReduxFramework') && !magplus_get_opt('header-enable-switch')) { return; }
    //var_dump($layout);
    //$layout = 'header-style4';
    switch ($layout) {
      case 'header-style1':
      default:
        get_template_part('templates/header/header-style1');
        break;
      case 'header-style3':
        get_template_part('templates/header/header-style3');
        break;
      case 'header-style4':
        get_template_part('templates/header/header-style4');
        break; 
      case 'header-style5':
        get_template_part('templates/header/header-style5');
        break;
      case 'header-style6':
        get_template_part('templates/header/header-style6');
        break;break;
      case 'header-style7':
        get_template_part('templates/header/header-style7');
        break;
      case 'header-style8':
        get_template_part('templates/header/header-style8');
        break;
      case 'header-style9':
        get_template_part('templates/header/header-style9');
        break;
      case 'header-style10':
        get_template_part('templates/header/header-style10');
        break;
      case 'header-style11':
        get_template_part('templates/header/header-style11');
        break;
      case 'header-style12':
        get_template_part('templates/header/header-style12');
        break;
      case 'header-style13':
        get_template_part('templates/header/header-style13');
        break;
    }
  }
}

/**
 * Select magplus footer style
 * @since magplus 1.0
 */
if(!function_exists('magplus_footer_template')) {
  function magplus_footer_template($layout) {
    if(class_exists('ReduxFramework') && !magplus_get_opt('footer-enable-switch')) { return; }
    switch ($layout) {
      case 'footer-style3':
        get_template_part('templates/footer/footer-style3');
        break;
      case 'footer-style2':
        get_template_part('templates/footer/footer-style2');
        break;
      case 'footer-style1':
      default:
        get_template_part('templates/footer/footer-style1');
        break;
    }
  }
}

/**
 * Select magplus slider style
 * @since magplus 1.0
 */
if(!function_exists('magplus_slider_template')) {
  function magplus_slider_template($layout) {
    if(!class_exists('ReduxFramework')|| !magplus_get_opt('slider-enable-switch')) { return; }
    switch ($layout) {
      case 'slider-style2':
        get_template_part('templates/slider/layouts/slider-style2');
        break;
      case 'slider-style3':
        get_template_part('templates/slider/layouts/slider-style3');
        break;
      case 'slider-style4':
        get_template_part('templates/slider/layouts/slider-style4');
        break;
      case 'slider-style5':
        get_template_part('templates/slider/layouts/slider-style5');
        break;
      case 'slider-style6':
        get_template_part('templates/slider/layouts/slider-style6');
        break;
      case 'slider-style7':
        get_template_part('templates/slider/layouts/slider-style7');
        break;
      case 'slider-style8':
        get_template_part('templates/slider/layouts/slider-style8');
        break;
      case 'slider-style9':
        get_template_part('templates/slider/layouts/slider-style9');
        break;
      case 'slider-style10':
        get_template_part('templates/slider/layouts/slider-style10');
        break;
      case 'slider-style11':
        get_template_part('templates/slider/layouts/slider-style11');
        break;
      case 'slider-style12':
        get_template_part('templates/slider/layouts/slider-style12');
        break;
      case 'slider-style13':
        get_template_part('templates/slider/layouts/slider-style13');
        break;
      case 'slider-style14':
        get_template_part('templates/slider/layouts/slider-style14');
        break;
      case 'slider-style15':
        get_template_part('templates/slider/layouts/slider-style15');
        break;
      case 'slider-style16':
        get_template_part('templates/slider/layouts/slider-style16');
        break;
      case 'slider-style17':
        get_template_part('templates/slider/layouts/slider-style17');
        break;
      case 'slider-style18':
        get_template_part('templates/slider/layouts/slider-style18');
        break;
      case 'slider-style19':
        get_template_part('templates/slider/layouts/slider-style19');
        break;
      case 'slider-style20':
        get_template_part('templates/slider/layouts/slider-style20');
        break;
      case 'slider-style21':
        get_template_part('templates/slider/layouts/slider-style21');
        break;
      case 'slider-style22':
        get_template_part('templates/slider/layouts/slider-style22');
        break;
      case 'slider-style23':
        get_template_part('templates/slider/layouts/slider-style23');
        break;
      case 'slider-style24':
        get_template_part('templates/slider/layouts/slider-style24');
        break;
      case 'slider-style25':
        get_template_part('templates/slider/layouts/slider-style25');
        break;
      case 'slider-style26':
        get_template_part('templates/slider/layouts/slider-style26');
        break;
      case 'slider-style1':
      default:
        get_template_part('templates/slider/layouts/slider-style1');
        break;
    }
  }
}

/**
 * Select magplus blog post style
 * @since magplus 1.0
 */
if(!function_exists('magplus_blog_post_template')) {
  function magplus_blog_post_template($layout) {
    //$layout = 'default';
    switch ($layout) {
      case 'alternative':
        get_template_part('templates/blog/blog-single/layout/alternative');
        # code...
        break;
      case 'default-alt':
        get_template_part('templates/blog/blog-single/layout/default-alt');
        # code...
        break;
      case 'default-title-left-aligned':
        get_template_part('templates/blog/blog-single/layout/default-title-left-aligned');
        # code...
        break;
      case 'alternative-title-middle':
        get_template_part('templates/blog/blog-single/layout/alternative-title-middle');
        # code...
        break;
      case 'alternative-big-one':
        get_template_part('templates/blog/blog-single/layout/alternative-big-one');
        # code...
        break;
      case 'alternative-cover':
        get_template_part('templates/blog/blog-single/layout/alternative-cover');
        # code...
        break;
      case 'default':
      default:
        get_template_part('templates/blog/blog-single/layout/default');
        break;
    }
  }
}

/**
 * Get associative terms array
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('magplus_get_terms_assoc')) {
  function magplus_get_terms_assoc($terms) {
    $terms = get_terms( $terms , array('fields' => 'all' ) );

    if (is_array($terms) && !is_wp_error($terms)) {
      $terms_assoc = array();

      foreach ($terms as $term) {
        $terms_assoc[$term -> term_id] = $term -> name;
      }
      return $terms_assoc;
    }
    return false;
  }
}


/**
 * Get associative special content array
 * 
 * @param type $terms
 * @return boolean
 */
if(!function_exists('magplus_get_special_content_array')) {
  function magplus_get_special_content_array() {
    
    $args = array(
      'posts_per_page' => -1,
      'offset'         => 0,
      'orderby'        => 'title',
      'order'          => 'ASC',
      'post_type'      => 'special-content',
      'post_status'    => 'publish'
    );
    
    $custom_query = new WP_Query($args);
    
    $special_content = array();
    
    if ( $custom_query->have_posts() ) {
      
      while ( $custom_query -> have_posts() ) {
        $custom_query -> the_post(); 
        $special_content[get_the_ID()] = get_the_title();
      }
      wp_reset_postdata();
    }
    
    return $special_content;
  }
}

/**
 * Displays special content set as after content page on page options>content
 * @return void
 */
if(!function_exists('magplus_after_content_special_content')) {
  function magplus_after_content_special_content() {
    
    if (!magplus_get_post_opt('page-show-special-content-after-content')) {return;}
    
    $page = magplus_get_post_opt('page-after-special-content');
    //var_dump($page);
    magplus_echo_page_content($page);
  }
}

/**
 * Displays special content set as before content page on page options>content
 * @return void
 */
if(!function_exists('magplus_before_content_special_content')) {
  function magplus_before_content_special_content() {
    
    if (!magplus_get_post_opt('page-show-special-content-before-content')) {return;}
    
    $page = magplus_get_post_opt('page-before-special-content');
    //var_dump($page);
    magplus_echo_page_content($page);
  }
}

/**
 * Echo page content
 * @param int $page
 * @return void
 */
if(!function_exists('magplus_echo_page_content')) {
  function magplus_echo_page_content($page) {

    if (!intval($page)) {return;}
    
    $args = array(
      'posts_per_page' => 1,
      'page_id'        => $page,
      'post_type'      => 'special-content',
      'post_status'    => 'publish'
    );
    $query = new WP_Query($args);

    //var_dump($query);
    
    if ($query -> have_posts()):
      while ($query -> have_posts()) : $query -> the_post();
        the_content();
      endwhile; 
      wp_reset_postdata();
    endif;
  }
}

/**
 * Load Google Font
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('magplus_fonts_url')) {
  function magplus_fonts_url() {
    $fonts_url = '';

    $roboto = _x( 'on', 'Roboto font: on or off', 'magplus' );

    if ( 'off' !== $roboto ) {
      $font_families = array();

      if ( 'off' !== $roboto ) {
        $font_families[] = 'Roboto:400,500,700';
      }

      $query_args = array('family' => urlencode( implode( '|', $font_families ) ), 'subset' => urlencode( 'latin,latin-ext' ));
      $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url_raw( $fonts_url );
  }
}

/**
 * Load Material Icon
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('magplus_material_font_icon')) {
  function magplus_material_font_icon() {
    $fonts_url = '';

    $material_icons = _x( 'on', 'Material Icons: on or off', 'magplus' );

    if ( 'off' !== $material_icons ) {
      $font_families = array();

      if ( 'off' !== $material_icons ) {
        $font_families[] = 'Material Icons';
      }

      $query_args = array('family' => urlencode( implode( '|', $font_families ) ));
      $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/icon' );
    }

    return esc_url_raw( $fonts_url );
  }
}

/**
 * Load Google Font
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('magplus_header_height')) {
  function magplus_header_height($class = '') {
    $sticky_header = magplus_get_opt('header-enable-sticky-switch');
    if(!$sticky_header) { return; }
    $class = (!empty($class)) ? '-'.$class:'';
    echo '<div class="tt-header-height tt-header-margin'.magplus_sanitize_html_classes($class).'"></div>';
  }
}

/**
 * Timestamp Ago
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('magplus_time_ago')) {
  function magplus_time_ago() {
    return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.esc_html(magplus_get_opt('translation-ago'));
  }
}

/**
 * Post Format
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('magplus_post_format')) {
  function magplus_post_format($image_size = '', $class = '', $time_farme = true, $url = '') {
    $post_format = get_post_format();
    switch ($post_format) {
      case 'video': 
      $video_url    = (empty($url)) ? magplus_get_post_opt('post-video-url'):$url; 
      $video_length = magplus_get_post_opt('post-video-length'); 
      if(!empty($video_url)): ?>
        <a class="tt-post-img tt-video-open custom-hover " href="<?php echo esc_url($video_url); ?>?autoplay=1">
          <span class="tt-post-icon"><i class="material-icons">videocam</i></span>
          <?php if(isset($video_length) && $time_farme): ?>
            <span class="tt-post-length"><?php echo esc_html($video_length); ?></span>
          <?php endif; ?>
          <?php the_post_thumbnail($image_size, array('class' => $class)); ?>
        </a>
        <?php endif;
        break;

      case 'gallery':
        if(has_post_thumbnail()): ?>
          <a class="tt-post-img custom-hover" href="<?php echo esc_url(get_the_permalink()); ?>">
            <span class="tt-post-icon"><i class="material-icons">filter_none</i></span>
            <?php the_post_thumbnail($image_size, array('class' => $class)); ?>
          </a>
        <?php endif;
        break;

      case 'audio':
        if(has_post_thumbnail()): ?>
          <a class="tt-post-img custom-hover" href="<?php echo esc_url(get_the_permalink()); ?>">
            <span class="tt-post-icon"><i class="material-icons">mic</i></span>
            <?php the_post_thumbnail($image_size, array('class' => $class)); ?>
          </a>
        <?php endif;
        break;

      case 'quote':
        if(has_post_thumbnail()): ?>
          <a class="tt-post-img custom-hover" href="<?php echo esc_url(get_the_permalink()); ?>">
            <span class="tt-post-icon"><i class="material-icons">format_quote</i></span>
            <?php the_post_thumbnail($image_size, array('class' => $class)); ?>
          </a>
        <?php endif;
        break;

      case 'aside':
        $total_rating = magplus_calc_rating(true);
        $frac_no = explode('.', $total_rating);
        if(has_post_thumbnail()): ?>
          <a class="tt-post-img custom-hover" href="<?php echo esc_url(get_the_permalink()); ?>">
            <?php if($total_rating > 0): ?>
              <span class="tt-post-icon"><?php echo esc_html($frac_no[0].'.'); ?><small><?php echo esc_html($frac_no[1]); ?></small></span>
            <?php endif; ?>
            <?php the_post_thumbnail($image_size, array('class' => $class)); ?>
          </a>
        <?php endif;
        break;
      
      default:
        magplus_blog_featured_image($image_size, $class);
        break;
    }
  }
}

/**
 * Post Format
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('magplus_weekly_post_format')) {
  function magplus_weekly_post_format($image_url = '', $post_format, $permalink, $post_gallery = array(), $post_video_url = '', $video_length = '') {
    switch ($post_format) {
      case 'video': if(!empty($post_video_url)): ?>
        <a class="tt-post-img tt-video-open custom-hover " href="<?php echo esc_url($post_video_url); ?>?autoplay=1">
          <?php if(isset($video_length)): ?>
            <span class="tt-post-length"><?php echo esc_html($video_length); ?></span>
          <?php endif; ?>
          <img class="img-responsive" src="<?php echo esc_url($image_url); ?>" alt="">
        </a>
        <?php endif;
        break;

      case 'gallery': ?>
        <?php
          wp_enqueue_script('swiper');
          wp_enqueue_style('swiper'); 
          if(is_array($post_gallery) && !empty($post_gallery)): ?>

          <div class="tt-post-img swiper-container" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
            <div class="swiper-wrapper">

              <?php foreach($post_gallery as $key => $item): ?>
              <div class="swiper-slide <?php echo ($key == 0) ? 'active':''; ?>" data-val="<?php echo esc_attr($key); ?>">
                <a class="custom-hover" href="<?php echo esc_url($permalink); ?>">
                  <img class="img-responsive" src="<?php echo esc_url($image_url); ?>" alt="">
                </a>                                         
              </div>
              <?php endforeach; ?>

            </div>
            <div class="pagination c-pagination"></div>
            <div class="swiper-arrow-left c-arrow left hidden-xs hidden-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
            <div class="swiper-arrow-right c-arrow right hidden-xs hidden-sm"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
          </div>
        <?php endif; ?>

        <?php
        break;
      
      default: ?>
        <a class="tt-post-img custom-hover" href="<?php echo esc_url($permalink); ?>">
          <img class="img-responsive" src="<?php echo esc_url($image_url); ?>" alt="">
        </a>
      <?php
        break;
    }
  }
}

/**
 * getPost View
 *
 * @since magplus 1.0
 */
if(!function_exists('magplus_getPostViews')) {
  function magplus_getPostViews($postID) {
    $count_key = 'post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if($count == '' || $count == 0 ){
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
      return wp_kses_post('0 View', 'magplus');
    }
    return $count.' '.magplus_get_opt('translation-views');
  }
}

/**
 * Set Post View
 *
 * @since magplus 1.0
 */
if(!function_exists('magplus_setPostViews')) {
  function magplus_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count     = get_post_meta($postID, $count_key, true);
    if($count == ''){
      $count = 0;
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
    } else {
      $count++;
      update_post_meta($postID, $count_key, $count);
    }
  }
}


/**
 * Pagination
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_pagination')) {
  function magplus_pagination() {
    if(!magplus_get_opt('post-enable-next-post-popup')) { return; }
    get_template_part('templates/blog/blog-single/parts/pagination');
  }
}

/**
 *
 * Hex to Rgba
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( ! function_exists( 'magplus_hex2rgba' ) ) {
  function magplus_hex2rgba( $hexcolor, $opacity = 1 ) {
    $hex    = str_replace( '#', '', $hexcolor );
    if( strlen( $hex ) == 3 ) {
      $r    = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
      $g    = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
      $b    = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
    } else {
      $r    = hexdec( substr( $hex, 0, 2 ) );
      $g    = hexdec( substr( $hex, 2, 2 ) );
      $b    = hexdec( substr( $hex, 4, 2 ) );
    }

    return ( isset( $opacity ) && $opacity != 1 ) ? 'rgba('. $r .', '. $g .', '. $b .', '. $opacity .')' : ' ' . $hexcolor;
  }
}

if(!function_exists('magplus_return_bytes')) {
  function magplus_return_bytes($size) {
    $val   = substr( $size, -1 );
    $ret = substr( $size, 0, -1 );
    switch ( strtoupper( $val ) ) {
      case 'P':
       $ret *= 1024;
      case 'T':
       $ret *= 1024;
      case 'G':
       $ret *= 1024;
      case 'M':
       $ret *= 1024;
      case 'K':
       $ret *= 1024;
    }
    return $ret;
  }
}

/**
 *
 * Envato Verify Purchase by Purchase Code
 *
 */
if( ! function_exists( 'magplus_envato_verify_purchase' ) ) {
  function magplus_envato_verify_purchase( $purchase_code ) {
    $response = wp_remote_get( 'http://www.themebubble.com/verify/verify.php?code='. $purchase_code );
    if ( is_array( $response ) ) {
      $body = $response['body'];
      $attr = json_decode($body);
      $is_valid = ($attr->item_id == '19761728') ? true:false;
      return $is_valid;
    }
  }
}

/**
 *
 * Inline CSS
 *
 */
if(!function_exists('magplus_get_inline_css')) {
  function magplus_get_inline_css() {

    global $magplus_tabindex;

    $post_id = get_the_ID();

    $page_show_content_before = magplus_get_post_opt('page-show-special-content-before-content');

    $page_before_special_content = magplus_get_post_opt('page-before-special-content');

    if( !empty( $page_show_content_before) && !empty( $page_show_content_before ) && is_object($page_before_special_content) ) {
      do_shortcode( get_page($page_before_special_content)->post_content );
    }

    $page = get_page($post_id);

    if(is_object($page)):
      do_shortcode( $page->post_content );
    endif;

    $page_show_content_after = magplus_get_post_opt('page-show-special-content-after-content');
    $page_after_special_content = magplus_get_post_opt('page-after-special-content');
    if( !empty( $page_show_content_after) && !empty( $page_show_content_after ) && is_object($page_after_special_content)) {
      do_shortcode( get_page($page_after_special_content)->post_content );
    }

    $args   = ThemeArguments::getInstance('inline_style'); 
    $styles = $args->get('inline_styles');

    $magplus_tabindex = 1000;

    return (is_array($styles) && !empty($styles)) ? magplus_css_compress( htmlspecialchars_decode( wp_kses_data( join( '', $styles ) ) ) ):NULL;
  }  
}

/**
 *
 * Shortcode Autoincrement
 *
 */
global $magplus_tabindex;
$magplus_tabindex = 1000;
if(!function_exists('magplus_tabindex') ) {
  function magplus_tabindex() {
    global $magplus_tabindex;
    return $magplus_tabindex++;
  }
}

/**
 *
 * is bbpress activated
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'magplus_is_bbpress_activated' ) ) {
  function magplus_is_bbpress_activated() {
    if ( class_exists( 'bbPress' ) ) { return true; } else { return false; }
  }
}
