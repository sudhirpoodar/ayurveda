<?php
/**
 * Action Hooks.
 *
 * @package magplus
 * @since 1.0
 */
/**
 * Post Column View
 *
 * @package magplus
 * @since 1.0
 */
if(!function_exists('magplus_posts_custom_column_views')) {
  function magplus_posts_custom_column_views($column_name, $id) {
    if($column_name === 'post_views'){
      echo magplus_getPostViews(get_the_ID());
    }
  }
  add_action('manage_posts_custom_column', 'magplus_posts_custom_column_views',5,2);
}

/**
* @return null
* @param none
* register widgets
**/
if(!function_exists('magplus_enqueue_inline_styles')) {
  function magplus_enqueue_inline_styles() {
    $oArgs = ThemeArguments::getInstance('inline_style');
    $inline_styles = $oArgs -> get('inline_styles');
    if (is_array($inline_styles) && count($inline_styles) > 0) {
      echo '<style id="custom-shortcode-css" scoped type="text/css">'. magplus_css_compress( htmlspecialchars_decode( wp_kses_data( join( '', $inline_styles ) ) ) ) .'</style>';
    }
    $oArgs -> reset();
  }
  //add_action( 'wp_footer', 'magplus_enqueue_inline_styles' ); // uncomment to add style in footer
}

/**
* @return null
* @param none
* load fontawesome
**/
if(!function_exists('magplus_redux_new_icon_font')) {
  function magplus_redux_new_icon_font() {
    wp_deregister_style( 'redux-elusive-icon' );
    wp_deregister_style( 'redux-elusive-icon-ie7' );
    wp_enqueue_style('font-awesome-admin',     get_theme_file_uri('css/font-awesome.min.css'),null, MAGPLUS_THEME_VERSION);
  }
  add_action( 'redux/page/magplus_theme_options/enqueue', 'magplus_redux_new_icon_font' );
}

/**
* @return null
* @param none
* editor style
**/
if(!function_exists('magplus_theme_editor_style')) {
  function magplus_theme_editor_style() {
    add_editor_style( 'custom-editor-style.css' );
  }
  add_action( 'admin_init', 'magplus_theme_editor_style' );
}

/**
* @return null
* @param none
* register widgets
**/
if( !function_exists('magplus_register_sidebar') ) {

  function magplus_register_sidebar() {
    register_sidebar(array(
      'id'            => 'main',
      'name'          => esc_html__('Main Sidebar', 'magplus'),
      'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
      'after_widget'  => '</div><div class="empty-space marg-lg-b30"></div>',
      'before_title'  => '<div class="tt-title-block"><h5 class="c-h5 widget-title tt-title-text">',
      'after_title'   => '</h5></div><div class="empty-space marg-lg-b20"></div>',
      'description'   => 'Drag the widgets for sidebars.'
    ));

    register_sidebar(array(
      'id'            => 'footer-instagram-sidebar',
      'name'          => esc_html__('Footer Instagram Sidebar', 'magplus'),
      'before_widget' => '<div id="%1$s" class="widget tt-footer-instagram footer_widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<div class="tt-title-block style1 dark"><h3 class="tt-title-text">',
      'after_title'   => '</h3></div><div class="empty-space marg-lg-b25"></div>',
      'description'   => 'Drag the instagram widgets for footer sidebar.'
    ));

    for($i = 1; $i < 5; $i++) {
      register_sidebar(array(
        'id'            => 'footer-'.$i,
        'name'          => esc_html__('Footer Sidebar '.$i, 'magplus'),
        'before_widget' => '<div id="%1$s" class="widget tt-footer-list footer_widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="tt-title-block-2">',
        'after_title'   => '</h5><div class="empty-space marg-lg-b20"></div>',
        'description'   => 'Drag the widgets for sidebars.'
      ));
    }

    $custom_sidebars = magplus_get_opt('custom-sidebars');
    if (is_array($custom_sidebars)) {
      foreach ($custom_sidebars as $sidebar) {

        if (empty($sidebar)) {
          continue;
        }

        register_sidebar ( array (
          'name'          => $sidebar,
          'id'            => sanitize_title ( $sidebar ),
          'before_widget' => '<div id="%1$s" class="custom-sidebar sidebar-item widget %2$s">',
          'after_widget'  => '</div><div class="empty-space marg-lg-b30"></div>',
          'before_title'  => '<div class="tt-title-block"><h3 class="widget-title tt-title-text">',
          'after_title'   => '</h3></div><div class="empty-space marg-lg-b20"></div>',
        ) );
      }
    }
  }
  add_action( 'widgets_init', 'magplus_register_sidebar' );
}


/**
 * Pagination Redirect
 *
 * @package adios
 * @since 1.0
 */
if(!function_exists('magplus_pagination_redirect')) {
  function magplus_pagination_redirect() {
    if( is_paged()) {
      get_template_part( 'paged' );
      exit;
    }
  }
  add_action( 'template_redirect', 'magplus_pagination_redirect' );
}

/**
 * Set up homepage and menu
 *
 * @package adios
 * @since 1.0
 */
if(!function_exists('magplus_set_homepage_menu')) {
  function magplus_set_homepage_menu($demo_active_import, $demo_directory_path) {
    reset( $demo_active_import );
    $current_key = key( $demo_active_import );
    // set menu
    $wbc_menu_array = array( 
      'magazinepro',
      'fashionpro',
      'newspro',
      'sportspro',
      'foodpro',
      'techpro',
      'travelpro',
      'blogpro',
      'viralpro',
      'videopro',
      'fitnesspro',
      'musicpro',
      'healthpro',
      'carpro',
      'femininepro',
      'minimalpro',
      'classicpro',
      'modernpro',
      'cleanpro',
      'luxurypro',
      'photographypro',
      'artpro',
      'designpro',
      'lifestylepro',
      'gamepro',
      'moviepro',
      'gadgetpro',
      'reviewpro',
      'podcastpro',
      'entertainmentpro',
      'girlypro',
      'architecturepro',
      'diypro',
      'cinemapro',
      'personalpro',
      'bitcoinpro',
      'recipepro',
      'writerpro',
      'seopro',
    );
    if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
      $locations = get_nav_menu_locations();
      $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
      $top_menu  = get_term_by( 'name', 'Top Menu', 'nav_menu' );

      if ( isset( $top_menu->term_id ) && isset($main_menu->term_id)) {
        set_theme_mod( 'nav_menu_locations', array(
          'top-menu'     => $top_menu->term_id,
          'primary-menu' => $main_menu->term_id,
        ));
      }
    }

    // set homepage
    $wbc_home_pages = array(
      'magazinepro'      => 'Home',
      'fashionpro'       => 'Home',
      'newspro'          => 'Home',
      'sportspro'        => 'Home',
      'foodpro'          => 'Home',
      'techpro'          => 'Home',
      'travelpro'        => 'Home',
      'blogpro'          => 'Home',
      'viralpro'         => 'Home',
      'videopro'         => 'Home',
      'fitnesspro'       => 'Home',
      'musicpro'         => 'Home',
      'healthpro'        => 'Home',
      'carpro'           => 'Home',
      'femininepro'      => 'Home',
      'minimalpro'       => 'Home',
      'classicpro'       => 'Home',
      'modernpro'        => 'Home',
      'cleanpro'         => 'Home',
      'luxurypro'        => 'Home',
      'photographypro'   => 'Home',
      'artpro'           => 'Home',
      'designpro'        => 'Home',
      'lifestylepro'     => 'Home',
      'gamepro'          => 'Home',
      'moviepro'         => 'Home',
      'gadgetpro'        => 'Home',
      'reviewpro'        => 'Home',
      'podcastpro'       => 'Home',
      'entertainmentpro' => 'Home',
      'girlypro'         => 'Home',
      'architecturepro'  => 'Home',
      'diypro'           => 'Home',
      'cinemapro'        => 'Home',
      'personalpro'      => 'Home',
      'bitcoinpro'       => 'Home',
      'recipepro'        => 'Home',
      'writerpro'        => 'Home',
      'seopro'           => 'Home',
    );
    if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
      $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
      if ( isset( $page->ID ) ) {
        update_option( 'page_on_front', $page->ID );
        update_option( 'show_on_front', 'page' );
      }
    }
  }
  add_action( 'wbc_importer_after_content_import', 'magplus_set_homepage_menu', 10, 2 );
}

/**
 * Inactive default widgets after import
 *
 * @package adios
 * @since 1.0
 */
if ( !function_exists( 'magplus_after_content_import' ) ) {
  function magplus_after_content_import( $demo_active_import , $demo_data_directory_path ) {
    $inactive = array();
    $sidebars = wp_get_sidebars_widgets();

    if( isset( $sidebars['wp_inactive_widgets'] ) ) {
      $inactive = $sidebars['wp_inactive_widgets'];
      unset( $sidebars['wp_inactive_widgets'] );
    }

    foreach ( $sidebars as $sidebar => $widgets ) {
      if(is_array($widgets)):
        $inactive = array_merge( $inactive, $widgets );
      endif;
      $sidebars[$sidebar] = array();
    }

    $sidebars['wp_inactive_widgets'] = $inactive;

    wp_set_sidebars_widgets( $sidebars );
  }

  add_action( 'wbc_importer_after_content_import', 'magplus_after_content_import', 10, 2 );
}


/**
* @return null
* @param none
* loads all the js and css script to frontend
**/
if( !function_exists('magplus_enqueue_scripts')) {

  function magplus_enqueue_scripts() {

    if(( is_admin())) { return; }

    if (is_singular()) { wp_enqueue_script( 'comment-reply' ); }

    wp_enqueue_script('magplus-global',       get_theme_file_uri('js/global.js'),array('jquery'), MAGPLUS_THEME_VERSION,true);
    wp_register_script('swiper',               get_theme_file_uri('js/idangerous.swiper.min.js'),array('jquery'), MAGPLUS_THEME_VERSION,true);
    wp_register_script('yt-playlist',          get_theme_file_uri('js/ytv.js'),array('jquery'), MAGPLUS_THEME_VERSION,true);
    wp_enqueue_script('match-height',          get_theme_file_uri('js/match.height.min.js'),array('jquery'), MAGPLUS_THEME_VERSION,true);
    if(magplus_woocommerce_enabled()):
      wp_enqueue_script('formstone',           get_theme_file_uri('js/jquery.formstone.min.js'),array('jquery'), MAGPLUS_THEME_VERSION,true);
    endif;
    wp_enqueue_script('appear',                get_theme_file_uri('js/jquery.appear.min.js'),array('jquery'), MAGPLUS_THEME_VERSION,true);
    wp_enqueue_script('parallax',              get_theme_file_uri('js/parallax.min.js'),array('jquery'), MAGPLUS_THEME_VERSION,true);
    wp_register_script('isotope-pkg',          get_theme_file_uri('js/jquery.isotope.min.js'),array('jquery'), MAGPLUS_THEME_VERSION,true);
    wp_enqueue_script('imagesloaded');

    wp_localize_script('magplus-global', 'magplus_ajax',
      array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'siteurl' => get_template_directory_uri()
      )
    );

    wp_enqueue_style('magplus-fonts',         magplus_fonts_url(), null, MAGPLUS_THEME_VERSION );
    wp_enqueue_style('magplus-material-icon', magplus_material_font_icon(), null, MAGPLUS_THEME_VERSION );
    wp_enqueue_style('font-awesome-theme',     get_theme_file_uri('css/font-awesome.min.css'),null, MAGPLUS_THEME_VERSION);
    wp_enqueue_style('ytv-playlist',           get_theme_file_uri('css/ytv.css'),null, MAGPLUS_THEME_VERSION);
    if(magplus_woocommerce_enabled()):
      wp_enqueue_style('woocommerce',          get_theme_file_uri('css/woocommerce.css'),null, MAGPLUS_THEME_VERSION);
    endif;
    wp_enqueue_style('bootstrap-theme',        get_theme_file_uri('css/bootstrap.min.css'),null, MAGPLUS_THEME_VERSION);
    wp_register_style('swiper',                get_theme_file_uri('css/idangerous.swiper.css'),null, MAGPLUS_THEME_VERSION);
    wp_enqueue_style('magplus-main-style',     get_theme_file_uri('css/style.css'),null, MAGPLUS_THEME_VERSION);
    
    if(is_rtl()):
      wp_enqueue_style('rtl',                  get_theme_file_uri('css/rtl.css'),null, MAGPLUS_THEME_VERSION);
    endif;

    $pages = array();
  
    if (magplus_get_post_opt('page-show-special-content-after-content')) {
      $pages[] = magplus_get_post_opt('page-after-special-content');
    }

    if (magplus_get_post_opt('page-show-special-content-before-content')) {
      $pages[] = magplus_get_post_opt('page-before-special-content');
    }
  
    if (is_array($pages) && count($pages) > 0) {
      foreach ($pages as $page) {        
        if (empty($page)) { continue; }
        $shortcodes_custom_css = get_post_meta( $page, '_wpb_shortcodes_custom_css', true );
        if(!empty($shortcodes_custom_css)) {
          wp_add_inline_style( 'magplus-main-style', $shortcodes_custom_css );
        }
      }
    }

    $css_code    = magplus_get_opt('css_editor');
    $accent_code = magplus_accent_css();
    $inline_css  = magplus_get_inline_css(); // get inline css by post id

    $style = '';
    $style .= ( !empty($css_code) || !empty($accent_code)|| !empty($inline_css)) ? $css_code.$accent_code.$inline_css:'';
    //$style .= ( !empty($css_code) || !empty($accent_code)) ? $css_code.$accent_code:''; // is will add style on footer

    wp_add_inline_style('magplus-main-style', $style);
  }
  add_action( 'wp_enqueue_scripts', 'magplus_enqueue_scripts' );
}

if(!function_exists('magplus_customize_preview_init')) {
  function magplus_customize_preview_init(){
    wp_enqueue_script( 'customizer-frontend', get_theme_file_uri('framework/admin/assets/js/customizer.js'), array( 'jquery', 'customize-preview' ), MAGPLUS_THEME_VERSION, true );
  }
}
add_action( 'customize_preview_init', 'magplus_customize_preview_init' );

if(!function_exists('magplus_redux_custom_enqueue_scripts')) {
  function magplus_redux_custom_enqueue_scripts() {
    wp_enqueue_style('redux-custom',  get_theme_file_uri('framework/admin/assets/css/redux-custom.css'), array('redux-admin-css'), MAGPLUS_THEME_VERSION);
  }
  add_action( 'redux/page/magplus_theme_options/enqueue', 'magplus_redux_custom_enqueue_scripts' );
}

if(!function_exists('magplus_admin_enqueue_scripts')) {
  function magplus_admin_enqueue_scripts() {
    wp_enqueue_style('admin-custom',  get_theme_file_uri('framework/admin/assets/css/admin.css'), MAGPLUS_THEME_VERSION);
  }
  add_action( 'admin_enqueue_scripts', 'magplus_admin_enqueue_scripts' );
}

if(! function_exists('magplus_include_required_plugins')) {

  function magplus_include_required_plugins() {

    $plugins = array(

      array(
        'name'     => 'Redux Framework',
        'slug'     => 'redux-framework',
        'required' => true,
        'img_url'  => get_theme_file_uri('framework/admin/assets/img/dashboard/plugins/03.png'),
        'source'   => 'https://downloads.wordpress.org/plugin/redux-framework.3.6.7.7.zip',
        'text'     => 'Requried',
      ),

      array(
        'name'               => esc_html__('Contact Form 7', 'magplus'), 
        'slug'               => 'contact-form-7', 
        'required'           => false, 
        'source'             => 'https://downloads.wordpress.org/plugin/contact-form-7.4.9.2.zip',
        'version'            => '', 
        'text'               => 'Optional',
        'img_url'            => get_theme_file_uri('framework/admin/assets/img/dashboard/plugins/06.png'),
        'force_activation'   => false, 
        'force_deactivation' => false, 
        'external_url'       => '', 
      ),   
      array(
        'name'               => esc_html__('Facebook Widget', 'magplus'), 
        'slug'               => 'facebook-pagelike-widget', 
        'required'           => false, 
        'source'             => 'https://downloads.wordpress.org/plugin/facebook-pagelike-widget.zip',
        'text'               => 'Optional',
        'img_url'            => get_theme_file_uri('framework/admin/assets/img/dashboard/plugins/02.png'),
        'version'            => '', 
        'force_activation'   => false, 
        'force_deactivation' => false, 
        'external_url'       => '', 
      ),
      array(
        'name'               => esc_html__('Latest Tweets Widget', 'magplus'), 
        'slug'               => 'latest-tweets-widget', 
        'required'           => false, 
        'version'            => '', 
        'source'             => 'https://downloads.wordpress.org/plugin/latest-tweets-widget.1.1.4.zip',
        'text'               => 'Optional',
        'img_url'            => get_theme_file_uri('framework/admin/assets/img/dashboard/plugins/01.png'),
        'force_activation'   => false, 
        'force_deactivation' => false, 
        'external_url'       => '', 
      ),
      array(
        'name'               => esc_html__('Woocommerce', 'magplus'), 
        'slug'               => 'woocommerce', 
        'required'           => false, 
        'version'            => '', 
        'source'             => 'https://downloads.wordpress.org/plugin/woocommerce.3.2.6.zip',
        'text'               => 'Optional',
        'img_url'            => get_theme_file_uri('framework/admin/assets/img/dashboard/plugins/08.png'),
        'force_activation'   => false, 
        'force_deactivation' => false, 
        'external_url'       => '', 
      ),
      array(
        'name'               => esc_html__('Instagram', 'magplus'), 
        'slug'               => 'wp-instagram-widget', 
        'required'           => false, 
        'version'            => '', 
        'source'             => 'https://downloads.wordpress.org/plugin/wp-instagram-widget.zip',
        'text'               => 'Optional',
        'img_url'            => get_theme_file_uri('framework/admin/assets/img/dashboard/plugins/07.png'),
        'force_activation'   => false, 
        'force_deactivation' => false, 
        'external_url'       => '', 
      ),
      array(
        'name'               => esc_html__('Visual Composer', 'magplus'), 
        'slug'               => 'js_composer', 
        'source'             => get_theme_file_uri('plugins/js_composer.zip'), 
        'required'           => true, 
        'version'            => '5.4.7', 
        'force_activation'   => false, 
        'text'               => 'Requried',
        'img_url'            => get_theme_file_uri('framework/admin/assets/img/dashboard/plugins/04.png'),
        'force_deactivation' => false, 
        'external_url'       => '', 
      ),
      array(
        'name'               => esc_html__('MagPlus Addons', 'magplus'), 
        'slug'               => 'magplus-addons',   
        'source'             => get_theme_file_uri('plugins/magplus-addons.zip'), 
        'required'           => true, 
        'version'            => '1.9', 
        'text'               => 'Requried',
        'img_url'            => get_theme_file_uri('framework/admin/assets/img/dashboard/plugins/05.png'),
        'force_activation'   => false, 
        'force_deactivation' => false, 
        'external_url'       => '', 
      ),
      array(
        'name'               => esc_html__('Newsletter', 'magplus'), 
        'slug'               => 'newsletter',   
        'source'             =>  'https://downloads.wordpress.org/plugin/newsletter.5.1.9.zip', 
        'required'           => false, 
        'version'            => '1.2', 
        'text'               => 'Optional',
        'img_url'            => get_theme_file_uri('framework/admin/assets/img/dashboard/plugins/11.png'),
        'force_activation'   => false, 
        'force_deactivation' => false, 
        'external_url'       => '', 
      ),
      array(
        'name'               => esc_html__('Yellow Pencil', 'magplus'), 
        'slug'               => 'waspthemes-yellow-pencil',   
        'source'             =>  get_theme_file_uri('plugins/yellow_pencil.zip'), 
        'required'           => false, 
        'version'            => '', 
        'text'               => 'Optional',
        'img_url'            => get_theme_file_uri('framework/admin/assets/img/dashboard/plugins/10.png'),
        'force_activation'   => false, 
        'force_deactivation' => false, 
        'external_url'       => '', 
      ),
      array(
        'name'               => esc_html__('Viral Quiz – BuzzFeed Quiz Builder', 'magplus'), 
        'slug'               => 'wp-viral-quiz',   
        'source'             =>  get_theme_file_uri('plugins/wp-viral-quiz.zip'), 
        'required'           => false, 
        'version'            => '', 
        'text'               => 'Optional',
        'img_url'            => get_theme_file_uri('framework/admin/assets/img/dashboard/plugins/09.png'),
        'force_activation'   => false, 
        'force_deactivation' => false, 
        'external_url'       => '', 
      ),
      array(
        'name'               => esc_html__('MagPlus AMP', 'magplus'), 
        'slug'               => 'magplus-amp',   
        'source'             =>  get_theme_file_uri('plugins/magplus-amp.zip'), 
        'required'           => false, 
        'version'            => '1.2', 
        'text'               => 'Optional',
        'img_url'            => get_theme_file_uri('framework/admin/assets/img/dashboard/plugins/12.png'),
        'force_activation'   => false, 
        'force_deactivation' => false, 
        'external_url'       => '', 
      ),
    );

    $config = array(
      'id'           => 'magplus',              
      'default_path' => '',                      
      'menu'         => 'rs_plugins', 
      'parent_slug'  => 'themes.php',            
      'capability'   => 'edit_theme_options',    
      'has_notices'  => true,                    
      'dismissable'  => true,                    
      'dismiss_msg'  => '',                      
      'is_automatic' => false,                   
      'message'      => '',                      
    );

    tgmpa( $plugins, $config );

  }
  add_action( 'tgmpa_register', 'magplus_include_required_plugins' );
}


/**
 *
 * Ajax Pagination
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if( ! function_exists( 'magplus_ajax_pagination' ) ) {
  function magplus_ajax_pagination() {
    global $post;
    $type           = ( ! empty( $_POST['post_type'] ) ) ? $_POST['post_type'] : 'post';
    $template       = ( ! empty( $_POST['template'] ) ) ? $_POST['template'] : 'list-layout';
    $show_category  = ( ! empty( $_POST['show_category'] ) ) ? $_POST['show_category'] : 'yes';
    $show_date      = ( ! empty( $_POST['show_date'] ) ) ? $_POST['show_date'] : 'yes';
    $show_author    = ( ! empty( $_POST['show_author'] ) ) ? $_POST['show_author'] : 'yes';
    $show_comment   = ( ! empty( $_POST['show_comment'] ) ) ? $_POST['show_comment'] : 'yes';
    $show_views     = ( ! empty( $_POST['show_views'] ) ) ? $_POST['show_views'] : 'yes';
    $show_views     = ( ! empty( $_POST['show_views'] ) ) ? $_POST['show_views'] : 'yes';
    $query_args = array(
      'paged'          => $_POST['paged'],
      'posts_per_page' => $_POST['posts_per_page'],
      'post_type'      => 'post',
      'isotope'        => 0
    );

    query_posts( $query_args );

    if($template == 'list-layout'):


    //var_dump($post);
    while( have_posts() ) : the_post(); 
      $video_url = get_post_meta($post->ID, 'post-video-url', true);

    ?>

    <div <?php post_class('tt-post type-6 clearfix'); ?>>
      <?php magplus_post_format('magplus-medium-ver', 'img-responsive', false, $video_url); ?>
      <div class="tt-post-info">
        <?php magplus_blog_category($show_category); ?>
        <?php magplus_blog_title('c-h4', true); ?>
        <?php magplus_blog_author_date($show_author, $show_date); ?>
        <?php magplus_blog_excerpt($excerpt_length); ?>
        <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
      </div>
    </div>
    <div class="empty-space marg-lg-b30"></div>

    <?php
    endwhile;
    wp_reset_query();
    else: 

    while( have_posts() ) : the_post(); 
      $video_url = get_post_meta($post->ID, 'post-video-url', true);
    ?>

    <div <?php post_class('isotope-item col-xs-12 col-sm-6 col-md-2'); ?>>
      <div class="tt-post type-2">
        <?php magplus_post_format('magplus-medium', 'img-responsive'); ?>
        <div class="tt-post-info">
          <?php magplus_blog_category($show_category); ?>
          <?php magplus_blog_title('c-h5'); ?>
          <?php magplus_blog_author_date($show_author, $show_date); ?>
          <?php magplus_blog_excerpt($excerpt_length); ?>
          <?php magplus_blog_post_bottom($show_comment, $show_views); ?>
        </div>
      </div>
      <div class="empty-space marg-lg-b30 marg-xs-b30"></div>
    </div>

    <?php
    endwhile;
    wp_reset_query();
    endif;

    die();
  }
  add_action('wp_ajax_ajax-pagination', 'magplus_ajax_pagination');
  add_action('wp_ajax_nopriv_ajax-pagination', 'magplus_ajax_pagination');
}
