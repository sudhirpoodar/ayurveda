<?php
/**
 * Frontend Theme Functions.
 *
 * @package magplus
 * @subpackage Template
 */
 /**
 * Theme Loader
 * @param string $logo_field
 * @param string $default_url
 * @param string $class
 */
if(!function_exists('magplus_loader')) {
  function magplus_loader() { 
    $loader_on_off = magplus_get_opt('general-loader-enable-switch');
    if(!$loader_on_off) { return; }
  ?>
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div id="loading-text"><?php echo magplus_get_opt('translation-loading'); ?></div>
    </div>
  <?php
  }
}

 /**
 * Sideheader
 * @param string $logo_field
 * @param string $default_url
 * @param string $class
 */
 if( !function_exists('magplus_sideheader')) {
  function magplus_sideheader() { ?>
    <div class="tt-mobile-block">
        <div class="tt-mobile-close"></div>
        <?php magplus_logo('side-header-logo', get_theme_file_uri('img/header/logo_2.png'), 'tt-mobile-logo img-responsive'); ?>
        <nav class="tt-mobile-nav">
          <?php magplus_main_menu_mobile('side-menu', 'side-header-nav', 'side-menu'); ?>
        </nav>
    </div>
    <div class="tt-mobile-overlay"></div>
  <?php
  }
}

 /**
 * Sponsor Ads
 * @param string $logo_field
 * @param string $default_url
 * @param string $class
 */
if(!function_exists('magplus_ads')) {
  function magplus_ads() {
    $ads_content = magplus_get_opt('header-ads-content');
    return $ads_content;
  }
}

 /**
 * Theme logo
 * @param string $logo_field
 * @param string $default_url
 * @param string $class
 */
 if( !function_exists('magplus_logo')) {
  function magplus_logo($logo_field = '', $class = '', $retina = '') {

    if (empty($logo_field)) {
      $logo_field = 'logo';
    }

    $logo = '';

    if( magplus_get_opt( $logo_field ) != null ) {
      $logo_array = magplus_get_opt( $logo_field );
    }

    if( (!isset( $logo_array['url'] ) || empty($logo_array['url']))) {
      return;
    }

    if(empty($class)) {
      $class = ' logo';
    } else {
      $class = 'logo '.$class;
    }

    if( !isset( $logo_array['url'] ) || empty($logo_array['url']) ) {
      $logo_url = $default_url;
    } else {
      $logo_url = $logo_array['url'];
    }

    $width  = magplus_get_opt('logo-width');
    $height = magplus_get_opt('logo-height');

    $width_attr  = (!empty($width)) ? ' width="'.esc_attr($width).'"':'';
    $height_attr = (!empty($height)) ? ' height="'.esc_attr($height).'"':'';

    $style_attr = ($retina && !empty($height)) ? ' style="max-height:'.esc_attr($height).'px; height:auto;"':'';
    if($logo_field == 'side-header-logo'):
    ?>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="<?php echo magplus_sanitize_html_classes($class); ?>"><img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>"></a>
    <?php else: ?>

    <a href="<?php echo esc_url(home_url('/')); ?>" class="<?php echo magplus_sanitize_html_classes($class); ?>"><img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr(get_bloginfo( 'name' )); ?>"<?php echo wp_kses_post($width_attr); ?> <?php echo wp_kses_post($height_attr); ?><?php echo wp_kses_post($style_attr); ?>></a>
    <?php endif;
  }
}

/**
 *
 * Text Logo
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if(!function_exists('magplus_text_logo')) {
  function magplus_text_logo() {
    $logo_array    = magplus_get_opt('logo');
    $logo_2x_array = magplus_get_opt('logo-2x');
    $logo_text     = magplus_get_opt('logo-text');

    if(!empty($logo_array['url'])) { return; }

    $logo_text = (empty($logo_text)) ? get_bloginfo('name'):$logo_text;

    if( !isset( $logo_array['url'] ) || empty($logo_array['url']) && !isset($logo_2x_array['url']) || empty($logo_2x_array['url']) ): ?>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo text-logo"><?php echo esc_html($logo_text); ?></a>
    <?php endif;
  }
}

/**
 *
 * Main Menu
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( !function_exists('magplus_main_menu')) {
  function magplus_main_menu($class = '', $menu_id = 'nav', $mobile_mega_menu = 'enabled', $nav_menu = 'primary-menu') {
    if ( function_exists('wp_nav_menu') && has_nav_menu( $nav_menu ) ) {
      $menu = '';
      if(is_singular()) {
        $menu = magplus_get_opt('header-primary-menu');
      }
      wp_nav_menu(array(
        'theme_location' => $nav_menu,
        'container'      => false,
        'menu_id'        => $menu_id,
        'menu'           => $menu,
        'menu_class'     => $class,
        'walker'         => new magplus_menu_widget_walker_nav_menu($mobile_mega_menu)
      ));
    } else {
      echo '<a target="_blank" href="'. admin_url('nav-menus.php') .'" class="nav-list cell-view no-menu">'. esc_html__( 'You can edit your menu content on the Menus screen in the Appearance section.', 'magplus' ) .'</a>';
    }
  }
}

/**
 *
 * Main Menu
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( !function_exists('magplus_main_menu_mobile')) {
  function magplus_main_menu_mobile($class = '', $menu_id = 'nav', $nav_menu = 'primary-menu') {
    if ( function_exists('wp_nav_menu') && has_nav_menu( $nav_menu ) ) {
      $menu = '';
      if(is_singular()) {
        $menu = magplus_get_opt('header-primary-menu');
      }
      wp_nav_menu(array(
        'theme_location' => $nav_menu,
        'container'      => false,
        'menu_id'        => $menu_id,
        'menu'           => $menu,
        'menu_class'     => $class,
      ));
    } else {
      echo '<a target="_blank" href="'. admin_url('nav-menus.php') .'" class="nav-list cell-view no-menu">'. esc_html__( 'You can edit your menu content on the Menus screen in the Appearance section.', 'magplus' ) .'</a>';
    }
  }
}


/**
 *
 * Pagination
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'magplus_paging_nav' ) ) {
  function magplus_paging_nav( $max_num_pages = false, $args = array() ) {

    if (get_query_var('paged')) {
      $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
      $paged = get_query_var('page');
    } else {
      $paged = 1;
    }

    if ($max_num_pages === false) {
      global $wp_query;
      $max_num_pages = $wp_query->max_num_pages;
    }



    $defaults = array(
      'nav'            => 'load',
      'posts_per_page' => get_option( 'posts_per_page' ),
      'max_pages'      => $max_num_pages,
      'post_type'      => 'post',
    );


    $args = wp_parse_args( $args, $defaults );

    if ( $max_num_pages < 2 ) { return; }

    if( $args['nav'] == 'load-more' || $args['nav'] == 'infinite-scroll' ) {

      $uniqid = uniqid();
      $output  = '<div class="ajax-pagination '.$args['template'].'">';
      $output .= '<button type="button" class="ajax-load-more load-more '.$args['nav'].' '.$args['template'].'" data-token="'. $uniqid .'">';
      $output .= magplus_get_opt( 'translation-load-more' );
      $output .= '</button>';
      $output .= '</div>';

      unset( $args['query'] );
      wp_localize_script( 'magplus-global', 'magplus_load_more_' . $uniqid, $args );

      echo $output;

    } else {

      $big = 999999999; // need an unlikely integer

      $links = paginate_links( array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => $paged,
        'total'     => $max_num_pages,
        'prev_next' => true,
        'prev_text' => esc_html__('...', 'magplus'),
        'prev_text' => esc_html__('...', 'magplus'),
        'end_size'  => 1,
        'mid_size'  => 2,
        'type'      => 'list',
      ) );

      if (!empty($links)): ?>
        <div class="text-center">
           <?php echo wp_kses_post($links); ?>                           
        </div>
        <div class="empty-space marg-sm-b60"></div>
      <?php endif;
    }

  }
}

/**
 *
 * Get the Page Title
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if( !function_exists('magplus_get_the_title')) {
  function magplus_get_the_title() {

    $title = '';

    //woocoomerce page
    if (function_exists('is_woocoomerce') && is_woocommerce() || function_exists('is_shop') && is_shop()):
      if (apply_filters( 'woocommerce_show_page_title', true )):
        $title = woocommerce_page_title(false);
      endif;
    // Default Latest Posts page
    elseif( is_home() && !is_singular('page') ) :
      $title = esc_html__('Blog','magplus');

    // Singular
    elseif( is_singular() ) :
      $title = get_the_title();

    // Search
    elseif( is_search() ) :
      global $wp_query;
      $total_results = $wp_query->found_posts;
      $prefix = '';

      if( $total_results == 1 ){
        $prefix = '1 '.magplus_get_opt('translation-search-results-for');
      }
      else if( $total_results > 1 ) {
        $prefix = $total_results . ' ' . magplus_get_opt('translation-search-results-for');
      }
      else {
        $prefix = magplus_get_opt('translation-search-results-for');
      }
      $title = $prefix . ': ' . get_search_query();
      //$title = get_search_query();

    // Category and other Taxonomies
    elseif ( is_category() ) :
      $title = single_cat_title('', false);

    elseif ( is_tag() ) :
      $title = single_tag_title('', false);

    elseif ( is_author() ) :
      $title = wp_kses_post(sprintf( __( 'Author: %s', 'magplus' ), '<span class="vcard">' . get_the_author() . '</span>' ));

    elseif ( is_day() ) :
      $title = wp_kses_post(sprintf( __( 'Day: %s', 'magplus' ), '<span>' . get_the_date() . '</span>' ));

    elseif ( is_month() ) :
      $title = wp_kses_post(sprintf( __( 'Month: %s', 'magplus' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'magplus' ) ) . '</span>' ));

    elseif ( is_year() ) :
      $title = wp_kses_post(sprintf( __( 'Year: %s', 'magplus' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'magplus' ) ) . '</span>' ));

    elseif( is_tax() ) :
      $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
      $title = $term->name;

    elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
      $title = esc_html__( 'Asides', 'magplus' );

    elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
      $title = esc_html__( 'Galleries', 'magplus');

    elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
      $title = esc_html__( 'Images', 'magplus');

    elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
      $title = esc_html__( 'Videos', 'magplus' );

    elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
      $title = esc_html__( 'Quotes', 'magplus' );

    elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
      $title = esc_html__( 'Links', 'magplus' );

    elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
      $title = esc_html__( 'Statuses', 'magplus' );

    elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
      $title = esc_html__( 'Audios', 'magplus' );

    elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
      $title = esc_html__( 'Chats', 'magplus' );

    elseif( is_404() ) :
      $title = esc_html__( '404', 'magplus' );

    else :
      $title = esc_html__( 'Archives', 'magplus' );
    endif;

    return $title;
  }
}

/**
 *
 * Social Share
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if(!function_exists('magplus_social_share')) {
  function magplus_social_share($style) {
    if(class_exists('ReduxFramework') && !magplus_get_opt('post-enable-post-share')) { return; }
    global $post;
    $pinterest_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'magplus-big-alt' );
    switch ($style) {
      case 'style1':
      default: ?>

        <div class="tt-share position-2">
          <h5 class="tt-share-title"><?php echo magplus_get_opt('translation-share'); ?></h5>
          <ul class="tt-share-list">
            <li><a class="tt-share-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_the_permalink()); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a class="tt-share-twitter" href="https://twitter.com/home?status=<?php echo esc_url(get_the_permalink()); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a class="tt-share-pinterest" href="https://pinterest.com/pin/create/button/?url=&amp;media=<?php echo esc_url($pinterest_image[0]); ?>&amp;description=<?php echo urlencode(get_the_title()); ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
            <li><a class="tt-share-google" href="https://plus.google.com/share?url=<?php echo esc_url(get_the_permalink()); ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
            <li><a class="tt-share-reddit" href="http://www.reddit.com/submit?url=<?php echo esc_url(get_the_permalink()); ?>&amp;title="><i class="fa fa-reddit-alien" aria-hidden="true"></i></a></li>
            <li><a class="tt-share-mail" href="http://digg.com/submit?url=<?php echo esc_url(get_the_permalink()); ?>&amp;title="><i class="fa fa-digg" aria-hidden="true"></i></a></li>
          </ul>
        </div>
        <?php
        break;

      case 'style2': ?>
      <?php
        break;
    }
  }
}


if ( ! function_exists( 'magplus_comment' ) ) :
/**
 * Comments and pingbacks. Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since magplus 1.0
 */
function magplus_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
      ?>
      <li <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID(); ?>">
        <div class="media-body"><?php _e( 'Pingback:', 'magplus' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'magplus' ), ' ' ); ?></div>
      </li>
      <?php
    break;

    default :
      $class = array('comment_wrap');
      if ($depth > 1) {
        $class[] = 'chaild';
      }
      ?>
      <!-- Comment Item -->
      <li <?php comment_class('comment-list'); ?> id="comment-<?php comment_ID(); ?>">

        <div class="tt-comment-container clearfix">
          <a class="tt-comment-avatar" href="#">
            <?php echo get_avatar( $comment, 40 ); ?>
          </a>

          <div class="tt-comment-info">


            <div class="tt-comment-label">
              <span><a href="#" class="tt-comment-name"><?php comment_author_link();?></a></span>
              <span><?php echo comment_date(get_option('date_format')) ?></span>
            </div>


            <div class="simple-text font-poppins">
              <?php if ( $comment->comment_approved == '0' ) : ?>
                <em><?php _e( 'Your comment is awaiting moderation.', 'magplus' ); ?></em>
              <?php endif; ?>
              <?php comment_text(); ?>
            </div>




            <?php 
              $reply = get_comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => 2 ) ) );
              if (!empty($reply)): ?>
                <?php echo wp_kses_post($reply); ?>
              <?php endif;
              edit_comment_link( __( 'Edit', 'magplus' ), '', '' );
            ?>
          </div>



        </div>
      <?php
      break;
  endswitch;
}

endif; // ends check for magplus_comment()

if (!function_exists('magplus_close_comment')):
/**
 * Close comment
 *
 * @since magplus 1.0
 */
function magplus_close_comment() { ?>
  </li>
  <!-- End Comment Item -->
<?php }

endif; // ends check for magplus_close_comment()


/**
 *
 * Related Post
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if(!function_exists('magplus_related_post')) {
  function magplus_related_post($style = 'style1') {
    if(class_exists('ReduxFramework') && !magplus_get_opt('post-enable-related-post')) { return; }
    global $post;
    $tags = wp_get_post_tags($post->ID);

    if(!empty($tags) && is_array($tags)):
      $simlar_tag = $tags[0]->term_id;
    ?>

    <?php
      $args = array(
        'tag__in'             => array($simlar_tag),
        'post__not_in'        => array($post->ID),
        'posts_per_page'      => 4,
        'meta_query'          => array(array('key' => '_thumbnail_id', 'compare' => 'EXISTS')),
        'ignore_sticky_posts' => 1,
      );
      $re_query = new WP_Query($args);
      if($re_query->have_posts()):
        switch ($style) {
          case 'style1':
          default: ?>
            <div class="tt-title-block">
              <h3 class="tt-title-text"><?php echo magplus_get_opt('translation-you-might-also-like'); ?></h3>
            </div>
            <div class="empty-space marg-lg-b25"></div>
            <div class="row">

            <?php while ($re_query->have_posts()) : $re_query->the_post(); ?>

              <div <?php post_class('col-xs-6 col-sm-4 col-lg-3'); ?>>
                <div class="tt-post type-3">
                  <?php magplus_blog_featured_image('magplus-small', 'img-responsive'); ?>
                  <div class="tt-post-info">
                    <a class="tt-post-title c-h5" href="<?php echo esc_url(get_the_permalink()); ?>"><small><?php the_title(); ?></small></a>
                    <?php magplus_blog_author_date(); ?>
                  </div>
                </div> 
                <div class="empty-space marg-lg-b15"></div>                 
              </div>
              <div class="clearfix visible-md-block"></div>

              <?php endwhile; wp_reset_postdata(); ?>

            </div>
            <div class="empty-space marg-lg-b40 marg-sm-b30"></div>
            <?php
            break;
          
          case 'style2': ?>
            <div class="tt-shortcode-1">


              <div class="tt-title-block">
                <h3 class="tt-title-text"><?php echo magplus_get_opt('translation-related-stories'); ?></h3>
                <span class="tt-shortcode-1-close"></span>
              </div>

              <div class="container">
                <div class="row">

                <?php while ($re_query->have_posts()) : $re_query->the_post(); ?>
                  <div <?php post_class('col-md-3 col-sm-6'); ?>>


                    <div class="tt-post type-7 clearfix">
                      
                      <?php magplus_blog_featured_image('magplus-small-alt', 'img-responsive'); ?>
                     
                      <div class="tt-post-info">
                        <a class="tt-post-title c-h6" href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?> </a>
                      </div>
                    </div> 


                  </div>
                <?php endwhile; wp_reset_postdata(); ?>


                </div>
              </div>  


            </div>
            <?php
            break;
        }
      endif;
    endif;
  }
}

/**
 * Get Social Icons links
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('magplus_post_author_details')) {
  function magplus_post_author_details() {
    if(class_exists('ReduxFramework') && !magplus_get_opt('post-enable-author-description')) { return; }
    global $post;
    $curauth = get_userdata($post->post_author);
    if(!empty($curauth->description)): ?>
      <div class="tt-devider"></div>
      <div class="empty-space marg-lg-b60 marg-sm-b50 marg-xs-b30"></div>     
      <div class="tt-author clearfix">
        <a class="tt-author-img" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>">
          <?php echo get_avatar( get_the_author_meta('ID'), 90 ); ?>
        </a>
        <div class="tt-author-info">
          <a class="tt-author-title" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php the_author(); ?></a>
          <div class="simple-text font-poppins">
            <p><?php echo get_the_author_meta('description'); ?></p>
          </div>
          <ul class="tt-author-social">
            <?php magplus_social_links('%s', magplus_get_opt('post-author-social-icons-category')); ?> 1
          </ul>
        </div>
      </div>
      <div class="empty-space marg-lg-b55 marg-sm-b50 marg-xs-b30"></div>
    <?php endif;
  }
}

/**
 * Get Social Icons links
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('magplus_social_links')) {
  function magplus_social_links($pattern = '%s', $category = '') {
    $args = array(
      'posts_per_page' => -1,
      'offset'          => 0,
      'orderby'         => 'menu_order',
      'order'           => 'ASC',
      'post_type'       => 'social-site',
      'post_status'     => 'publish'
    );

    if (!empty($category)) {
      $args['tax_query'] = array(
        array(
          'taxonomy' => 'social-site-category',
          'field'    => 'id',
          'terms'    => $category,
        ),
      );
    }

    $custom_query = new WP_Query( $args );
    if ( $custom_query->have_posts() ):

      $found_posts = $custom_query->found_posts;
      while ( $custom_query -> have_posts() ) :
        $custom_query -> the_post();
        $get_title = get_the_title();
        $title = empty( $get_title ) ? '#':$get_title;
        echo sprintf($pattern, '<li><a href="'.esc_url($title).'"><i class="fa '.esc_attr(magplus_get_post_opt('icon')).'"></i></a></li>');
      endwhile; // end of the loop.
    endif;
    wp_reset_postdata();
  }
}

/**
 * Get Social Icons links
 *
 * @param type $terms
 * @return boolean
 */
if(!function_exists('magplus_accent_css')) {
  function magplus_accent_css() {
    $accent_color_first  = magplus_get_opt('theme-skin-accent-first');
    $output = '';
    if(magplus_get_opt('theme-skin') == 'theme-accent' && !empty($accent_color_first)):
    $output .= 
     '.tt-header .main-nav > ul > li:not(.mega) > ul > li > a:hover,
      .tt-header .main-nav > ul > li:not(.mega) > ul > li > ul > li > a:hover,
      .mega.type-2 ul.tt-mega-wrapper li>ul a:hover,
      .tt-mega-list a:hover,.tt-s-popup-devider:after,
      .tt-s-popup-close:hover:before,.tt-s-popup-close:hover:after,.tt-tab-wrapper.type-1 .tt-nav-tab-item:before,
      .tt-pagination a:hover,.tt-pagination li.active a,.tt-thumb-popup-close:hover,.tt-video-popup-close:hover,
      .c-btn.type-1.color-2:before,.c-btn.type-1.style-2.color-2, .page-numbers a:hover, .page-numbers li span.current,.tpl-progress .progress-bar, .c-pagination.color-2 .swiper-active-switch, .tt-comment-form .form-submit,
      .woo-pagination span.current, .woo-pagination a:hover {
        background: '.esc_attr($accent_color_first).';
      }

      .tt-header .main-nav > ul > li.active > a,
      .tt-header .main-nav > ul > li:hover > a,.tt-s-popup-btn:hover,
      .tt-header.color-2 .top-menu a:hover,.tt-header.color-2 .top-social a:hover,
      .tt-s-popup-submit:hover .fa,.tt-mslide-label a:hover,
      .tt-sponsor-title:hover,.tt-sponsor.type-2 .tt-sponsor-title:hover,
      .tt-post-title:hover,.tt-post-label span a:hover,
      .tt-post-bottom a:hover,.tt-post-bottom a:hover .fa,
      .tt-post.light .tt-post-title:hover,.tt-blog-user-content a:hover,
      .tt-blog-user.light .tt-blog-user-content a:hover,.simple-img-desc a:hover,
      .tt-author-title:hover,.tt-author-social a:hover,.tt-blog-nav-title:hover,
      .tt-comment-label a:hover,.tt-comment-reply:hover,
      .tt-comment-reply:hover .fa,
      .comment-reply-link:hover,
      .comment-reply-link:hover .fa,
      .comment-edit-link:hover,.tt-search-submit:hover,.tt-news-title:hover,
      .tt-mblock-title:hover,.tt-mblock-label a:hover,.simple-text a,
      .c-btn.type-1.style-2.color-2:hover,.c-btn.type-2:hover,.c-btn.type-3.color-2:hover,
      .c-btn.type-3.color-3, .sidebar-item.widget_recent_posts_entries .tt-post.dark .tt-post-title:hover, .tt-post-cat a:hover, .sidebar-item.widget ul li a:hover, .tt-small-blog-slider .tt-h4-title a:hover, .tt-comment-form .form-submit:hover {
        color: '.esc_attr($accent_color_first).';
      }

      .c-pagination.color-2 .swiper-pagination-switch,
      .c-pagination.color-2 .swiper-active-switch,.tt-search input[type="text"]:focus,
      #loader,.c-btn.type-1.color-2,.c-input:focus,.c-btn.type-3.color-2:hover,.c-area:focus, .tt-title-text,
      .c-pagination.color-2 .swiper-pagination-switch, .tt-comment-form .form-submit, .custom-arrow-left.tt-swiper-arrow-3:hover, .custom-arrow-right.tt-swiper-arrow-3:hover {
        border-color: '.esc_attr($accent_color_first).';
      }';
    endif;

    /* woocommerce */
    if(magplus_woocommerce_enabled()):
      $output .= '.woocommerce .onsale, .woocommerce-page .onsale,
      .ajax_add_to_cart.c-btn.type-2,
      .product_type_variable.add_to_cart_button.c-btn.type-2, .tt-custom-pagination .current,
      .price_slider_amount button[type="submit"],
      .widget_price_filter .ui-slider .ui-slider-handle,
      .widget_shopping_cart .buttons .checkout,
      .woocommerce-form-login input[type="submit"],
      .woocommerce .shop_table .button[name="apply_coupon"], 
      .woocommerce-page .shop_table .button[name="apply_coupon"], 
      .single_add_to_cart_button,
      .woocommerce .shop_table .button[name="update_cart"], .woocommerce-page .shop_table .button[name="update_cart"],
      .woocommerce #payment .button, .woocommerce-page #payment .button, .woocommerce-page .wc-proceed-to-checkout .button {
        background: '.esc_attr($accent_color_first).' !important;
      }

      .ajax_add_to_cart.c-btn.type-2:hover, 
      .product_type_variable.add_to_cart_button.c-btn.type-2:hover,
      .widget_shopping_cart .buttons .checkout:hover,
      .price_slider_amount button[type="submit"]:hover,
      .woocommerce .wc-proceed-to-checkout .button:hover,
      .woocommerce .shop_table .button:hover,
      .woocommerce .single_add_to_cart_button.button:hover,
      .woocommerce-page .wc-proceed-to-checkout .button:hover,
      .woocommerce-page .shop_table .button:hover,
      .woocommerce-page .single_add_to_cart_button.button:hover,
      .woocommerce .shop_table .button[name="update_cart"]:hover,
      .woocommerce-page .shop_table .button[name="update_cart"]:hover,
      .woocommerce #payment .button:hover, .woocommerce-page #payment .button:hover {
        background:'.magplus_hex2rgba($accent_color_first, 0.80).' !important;
      }';

    endif;

    $width  = magplus_get_opt('logo-width');
    $height = magplus_get_opt('logo-height');
    if(!empty($width) || !empty($height)):
      $output .= '.tt-header-type-5 .logo, .tt-header .logo {';
      $output .= (!empty($width)) ? 'max-width:'.esc_attr($width).'px;':'';
      $output .= (!empty($height)) ? 'height:'.esc_attr($height).'px;':'';
      $output .= (!empty($height)) ? 'line-height:'.esc_attr($height).'px;':'';
      $output .= '}';
    endif;

    $menu_hover_bg_color = magplus_get_opt('customizer-header-menu-link-hover-bg-color');
    if(!empty($menu_hover_bg_color)):
      $output .= '.tt-header .main-nav > ul > li:hover > a {';
      $output .= 'background:'.esc_attr($menu_hover_bg_color).';';
      $output .= '}';
    endif;

    $title_wrapper = magplus_get_opt('page-header');
    if(isset($title_wrapper['url']) && !empty($title_wrapper['url'])):
      $output .= '.tt-heading.title-wrapper {';
      $output .= 'background-image:url('.$title_wrapper['url'].');';
      $output .= '}';
    endif;

    $title_wrapper_padding_top    = magplus_get_opt('title-wrapper-padding-top');
    $title_wrapper_padding_bottom = magplus_get_opt('title-wrapper-padding-bottom');
    if(!empty($title_wrapper_padding_top) || !empty($title_wrapper_padding_bottom)) {
      $output .= '.tt-heading.title-wrapper {';
      $output .=  (!empty($title_wrapper_padding_top)) ? 'padding-top:'.esc_attr($title_wrapper_padding_top).'px;':'';
      $output .=  (!empty($title_wrapper_padding_bottom)) ? 'padding-bottom:'.esc_attr($title_wrapper_padding_bottom).'px;':'';
      $output .= '}';
    }

    $post_featured_image_height = magplus_get_opt('post-featured-image-height');
    if(!empty($post_featured_image_height)) {
      $output .= '.tt-blog-head,.tt-blog-head.alternative-cover {';
      $output .= 'height:'.esc_attr($post_featured_image_height).'px;';
      $output .= '}';
    }

    $slider_category_show = magplus_get_opt('slider-show-category-switch');
    $slider_author_show   = magplus_get_opt('slider-show-author-switch');
    $slider_date_show     = magplus_get_opt('slider-show-date-switch');
    $slider_views_show    = magplus_get_opt('slider-show-views-switch');

    $output .= (!$slider_category_show) ? '.tt-mslide-cat,.tt-slide-2-cat,.tt-mblock-cat {display:none !important;}':'';
    $output .= (!$slider_author_show) ? '.tt-mslide-author,.tt-mblock-label > span {display:none !important;}':'';
    $output .= (!$slider_date_show) ? '.tt-mslide-date {display:none !important;}':'';
    $output .= (!$slider_views_show) ? '.tt-mslide-views {display:none !important;}':'';

    $post_author_details   = magplus_get_opt('post-enable-post-author');
    $post_date_details     = magplus_get_opt('post-enable-post-date');
    $post_category_details = magplus_get_opt('post-enable-post-category');
    $post_comment          = magplus_get_opt('post-enable-post-comment');
    $output .= (!$post_author_details) ? '.tt-post-author-single,.tt-blog-user-img {display:none !important;}':'';
    $output .= (!$post_date_details) ? '.tt-post-date-single {display:none !important;}':'';
    $output .= (!$post_category_details) ? '.tt-blog-category {display:none !important;}':'';
    $output .= (!$post_comment) ? '.coment-item {display:none;}':'';

    $archive_author_show   = magplus_get_opt('archive-enable-post-author');
    $archive_date_show     = magplus_get_opt('archive-enable-post-date');
    $archive_view_show     = magplus_get_opt('archive-enable-post-view');
    $archive_comment_show  = magplus_get_opt('archive-enable-post-comment');
    $archive_category_show = magplus_get_opt('archive-enable-post-category');

    $output .= (!$archive_author_show) ? 'body.archive .tt-post-author-name {display:none !important;}':'';
    $output .= (!$archive_date_show) ? 'body.archive .tt-post-date {display:none !important;}':'';
    $output .= (!$archive_view_show) ? 'body.archive .tt-post-views {display:none !important;}':'';
    $output .= (!$archive_comment_show) ? 'body.archive .tt-post-comment {display:none !important;}':'';
    $output .= (!$archive_category_show) ? 'body.archive .tt-post-cat {display:none !important;}':'';

    $header_bars = magplus_get_opt('header-enable-switch-bars');
    $output .= (!$header_bars) ? '.cmn-mobile-switch {display:none;}':'';

    $mobile_similar_post      = magplus_get_opt('mobile-post-enable-similar-post');
    $mobile_next_popup_post   = magplus_get_opt('mobile-post-enable-next-post-popup');
    $mobile_sticky_video_post = magplus_get_opt('mobile-post-enable-sticky-video');
    $mobile_logo_width        = magplus_get_opt('logo-width-sm');
    $mobile_logo_height       = magplus_get_opt('logo-height-sm');
    $output .= '@media (max-width:767px) {';
    $output .=  (!$mobile_similar_post) ? '.tt-shortcode-1 {display:none;}':'';
    $output .=  (!$mobile_next_popup_post) ? '.tt-shortcode-2 {display:none;}':'';
    $output .=  (!$mobile_sticky_video_post) ? '.tt-iframe.smallVid {display:none !important;}':'';
    $output .=  '}';

    if(!empty($mobile_logo_width) || !empty($mobile_logo_height)):
      $output .= '@media (max-width:767px) {';
      $output .= '.tt-header-type-5 .logo, .tt-header .logo {';
      $output .= (!empty($mobile_logo_width)) ? 'max-width:'.esc_attr($mobile_logo_width).'px;':'';
      $output .= (!empty($mobile_logo_height)) ? 'height:'.esc_attr($mobile_logo_height).'px;':'';
      $output .= (!empty($mobile_logo_height)) ? 'line-height:'.esc_attr($mobile_logo_height).'px;':'';
      $output .= '}';
      $output .= '.tt-header .logo img {';
      $output .= (!empty($mobile_logo_height)) ? 'max-height:'.esc_attr($mobile_logo_height).'px !important;':'';
      $output .= '}';
      $output .= '}';
    endif;
    
    return $output;
  }
}

/**
 * Blog Featured Image
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_blog_featured_image')) {
  function magplus_blog_featured_image($image_size = 'full', $class_name = '') { ?>
    <?php if(has_post_thumbnail()): ?>
    <a class="tt-post-img custom-hover" href="<?php echo esc_url(get_the_permalink()); ?>">
      <?php the_post_thumbnail($image_size, array('class' => $class_name)); ?>
    </a>
  <?php endif;
  }
}

/**
 * Blog Category
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_blog_category')) {
  function magplus_blog_category($show_category = 'yes') { if($show_category == 'yes'): ?>
    <div class="tt-post-cat"><?php echo get_the_category_list( esc_html__( ', ', 'magplus' ) );?></div>
  <?php endif;
  }
}

/**
 * Blog Title
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_blog_title')) {
  function magplus_blog_title($class = 'c-h2', $small = false) { ?>
    <a class="tt-post-title <?php echo esc_attr($class); ?>" href="<?php echo esc_url(get_the_permalink()); ?>"><?php if($small): ?><small><?php endif; ?><?php the_title(); ?><?php if($small): ?></small><?php endif; ?></a>
  <?php
  }
}

/**
 * Blog Author & Date
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_blog_author_date')) {
  function magplus_blog_author_date($show_author = 'yes', $show_date = 'yes') { ?>
    <div class="tt-post-label">
      <?php if($show_author == 'yes'):?>
        <span class="tt-post-author-name"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span>
      <?php endif; ?>
      <?php if($show_date == 'yes'): ?>
        <span class="tt-post-date"><?php the_time('M d' ); ?></span>
      <?php endif; ?>
    </div>
  <?php
  }
}

/**
 * Blog Excerpt
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_blog_excerpt')) {
  function magplus_blog_excerpt($length = 20) { ?>
    <div class="simple-text">
      <p><?php echo magplus_auto_post_excerpt($length); ?></p>
    </div>
  <?php
  }
}

/**
 * Blog Post Bottom
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_blog_post_bottom')) {
  function magplus_blog_post_bottom($show_comment = 'yes', $show_views = 'yes') { ?>
    <?php if($show_comment == 'yes' || $show_views == 'yes'): ?>
    <div class="tt-post-bottom">
      <?php if($show_comment == 'yes'): ?>
      <span class="tt-post-comment"><a href="#"><i class="material-icons">chat_bubble</i><?php comments_number( '0 '.magplus_get_opt('translation-comment'), '01 '.magplus_get_opt('translation-comment'), '% '.magplus_get_opt('translation-comments') ); ?></a></span>
      <?php endif; ?>
      <?php if($show_views == 'yes'): ?>
      <span class="tt-post-views"><a href="#"><i class="material-icons">visibility</i><?php echo magplus_getPostViews(get_the_ID()); ?></a></span>
      <?php endif; ?>
    </div>
  <?php endif;
  }
}


/**
 * Post Navigation
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_post_navigation')) {
  function magplus_post_navigation() { 

    $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if(empty($previous) && empty($next)) { return; }

    ?>

    <!-- TT-NAV -->
    <div class="row">

      <?php if (get_previous_post()): ?>
      <div class="col-sm-6">
        <div class="tt-blog-nav left">
          <div class="tt-blog-nav-label"><?php echo magplus_get_opt('translation-previous-article'); ?></div>
          <?php previous_post_link('%link', '%title'); ?> 
        </div>
        <div class="empty-space marg-xs-b20"></div>
      </div>
      <?php endif; ?>

      <?php if (get_next_post()): ?>
      <div class="col-sm-6">
        <div class="tt-blog-nav right">
          <div class="tt-blog-nav-label"><?php echo magplus_get_opt('translation-next-article'); ?></div>
          <?php next_post_link('%link', '%title'); ?>                                    
        </div>
      </div>
      <?php endif; ?>
    </div>

    <div class="empty-space marg-lg-b55 marg-sm-b50 marg-xs-b30"></div>
  <?php
  }
}

/**
 * Video Popup
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_popup')) {
  function magplus_popup() { ?>
    <div class="tt-video-popup">
      <div class="tt-video-popup-overlay"></div>
      <div class="tt-video-popup-content">
        <div class="tt-video-popup-layer"></div>
        <div class="tt-video-popup-container">
          <div class="tt-video-popup-align">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="about:blank"></iframe>
            </div>
          </div>
          <div class="tt-video-popup-close"></div>
        </div>
      </div>
    </div> 

    <div class="tt-thumb-popup">
      <div class="tt-thumb-popup-overlay"></div>
      <div class="tt-thumb-popup-content">
        <div class="tt-thumb-popup-layer"></div>
        <div class="tt-thumb-popup-container">
          <div class="tt-thumb-popup-align">
            <img class="tt-thumb-popup-img img-responsive" src="about:blank" alt="">
          </div>
          <div class="tt-thumb-popup-close"></div>
        </div>
      </div>
    </div>  
  <?php
  }
}

/**
 * Search Popup
 * @param type $type
 * @return array
 */
if(!function_exists('search_popup')) {
  function search_popup() { ?>
    <div class="tt-s-popup">
      <div class="tt-s-popup-overlay"></div>
      <div class="tt-s-popup-content">
        <div class="tt-s-popup-layer"></div>
        <div class="tt-s-popup-container">
          <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="tt-s-popup-form">
            <div class="tt-s-popup-field">
              <input type="text" id="s" name="s" value="" placeholder="Search" class="input" required>
              <div class="tt-s-popup-devider"></div>
              <h3 class="tt-s-popup-title"><?php echo magplus_get_opt('translation-type-to-search'); ?></h3>     
            </div>
            <a href="#" class="tt-s-popup-close"></a>
          </form> 
        </div>
      </div>
    </div>
  <?php
  }
}


/**
 * Post Grid
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_post_grid')) {
  function magplus_post_grid($class) { ?>
    <div <?php post_class($class.' post-handy-picked'); ?>>
      <div class="tt-post type-3">
        <?php magplus_post_format('magplus-small', 'img-responsive'); ?>
          <div class="tt-post-info">
            <?php magplus_blog_title('c-h5'); ?>
            <?php magplus_blog_author_date(); ?>
          </div>
      </div> 
      <div class="empty-space marg-lg-b25"></div>                 
    </div>
  <?php
  }
}

/**
 * Sidebar Heading Style
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_sidebar_heading_style')) {
  function magplus_sidebar_heading_style() { 
    $hello = magplus_get_opt('sidebar-heading-style');
  }
}

/**
 * Footer Columns
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_footer_columns')) {
  function magplus_footer_columns() { 
    $footer_columns = magplus_get_opt('footer-column');
    switch ($footer_columns) {
      case '1':
        $col_class = 'col-md-12 col-sm-12';
        break;
      case '2':
        $col_class = 'col-md-6 col-sm-6';
        break;
      case '3':
        $col_class = 'col-md-4 col-sm-6';
        break;
      case '4':
      default:
        $col_class = 'col-md-3 col-sm-6';
        break;
    }
    for($i = 1; $i < $footer_columns + 1; $i++) { ?>
      <div class="<?php echo esc_attr($col_class .' col-'.$i); ?>">
        <?php if (is_active_sidebar( magplus_get_custom_sidebar('footer-'.$i, 'footer-sidebar-'.$i) )): ?>
          <?php dynamic_sidebar( magplus_get_custom_sidebar('footer-'.$i, 'footer-sidebar-'.$i) ); ?>
        <?php endif; ?>
        <div class="empty-space marg-xs-b30"></div>
      </div>
    <?php }
  }
}

/**
 * Top Latest News
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_top_latest_news')) {
  function magplus_top_latest_news() {
    $args = array(
      'posts_per_page' => 1,
      'orderby'        => 'date',
    );

    $the_query = new WP_Query($args);
    if($the_query->have_posts()):
      while( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="tt-post-breaking-news tt-post type-7 clearfix">
          <?php magplus_post_format('magplus-small-hor', 'img-responsive', false); ?>
          <div class="tt-post-info">
            <h6 class="c-h6 tt-breaking-title"><?php echo magplus_get_opt('translation-latest-news'); ?></h6>
            <?php magplus_blog_title('c-h6'); ?>
          </div>
        </div>
      <?php
      endwhile; 
      wp_reset_postdata();
    endif;
  }
}

/**
 * Before Page Breaking
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_breaking_news_weather')) {
  function magplus_breaking_news_weather() { 
    $breaking_news = magplus_get_opt('header-enable-breaking-news');
    if(!$breaking_news) { return; }  
    wp_enqueue_script('swiper');
    wp_enqueue_style('swiper'); 
                  
    $args = array(
      'posts_per_page' => -1,
      'meta_key'       => 'post-enable-breaking-news',
      'meta_value'     =>  1
    );
    $the_query = new WP_Query($args); if($the_query->have_posts()): 
                  
  ?>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="tt-breaking-news-weather-wrapper">
          <div class="tt-breaking-news">
            <div class="tt-breaking-news-title"><?php echo magplus_get_opt('translation-breaking-news'); ?></div>
            <div class="swiper-container tt-news-content" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1"> 
              <div class="swiper-wrapper tt-breaking-news-posts">

                <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                  <div class="swiper-slide tt-news-block">
                    <div class="tt-breaking-post">
                      <a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a>
                    </div>
                  </div>
                <?php endwhile; wp_reset_postdata(); ?>

              </div>
              <div class="pagination c-pagination hidden-lg"></div>
              <div class="swiper-arrow-left-content c-arrow left hidden-xs hidden-lg hidden-sm"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
              <div class="swiper-arrow-right-content c-arrow right hidden-xs hidden-lg hidden-sm"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
            </div>

          </div>
          <?php 
            $header_hash_tags = magplus_get_opt('header-hash-tags');
            if(is_array($header_hash_tags) && !empty($header_hash_tags)):
          ?>

            <div class="tt-trending-tag">
              <div class="tt-author-tag">
                <?php global $current_user; echo get_avatar( $current_user->ID, 30 ); ?>
                <div class="tt-trending-title"><?php echo magplus_get_opt('translation-trending'); ?></div>

                <div class="tt-hash-tags">
                  <?php foreach($header_hash_tags as $value): $tag = get_term($value, 'post_tag');?>
                    <a href="<?php echo get_tag_link($value); ?>">#<?php echo esc_html($tag->name); ?></a>
                  <?php endforeach; ?>
                </div>


              </div>
            </div>
          <?php endif; ?>


        </div>
      </div>
    </div>
  </div>
  <?php endif;
  }
}


if(!function_exists('magplus_calc_rating')) {
  function magplus_calc_rating($is_total = false) {

    $progress_bar_rating = array();
    $total_rating        = 0;
    $id_array = array('one', 'two', 'three', 'four');

    for($i = 0; $i < count($id_array); $i++) {
      $rating_label  = magplus_get_post_opt('post-review-label-'.$id_array[$i]);
      $rating_number = magplus_get_post_opt('post-review-rating-number-'.$id_array[$i]);
      if(!empty($rating_label) && !empty($rating_number) ) {
        $progress_bar_rating[$rating_label] = $rating_number;
      }

      if($is_total) {
        $total_rating += $rating_number;
      }

    }

    $count = count($progress_bar_rating);

    $total_rating = ($count > 0) ? number_format(($total_rating / $count), 1):$total_rating;

    return ($is_total) ? $total_rating:$progress_bar_rating;
    
  }
}

/**
 * Review
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_review_post_format')) {
  function magplus_review_post_format() {

    $summary_text = magplus_get_post_opt('post-review-summary');

    $progress_bar_rating = magplus_calc_rating(false);

    $count = count($progress_bar_rating);

    if($count > 0):

  ?>

  <div class="tt-rating">

    <div class="tt-rating-progress">
    
    <?php $rating_total = 0; foreach ($progress_bar_rating as $label => $rating_number): ?>
      
      <div class="tt-progress-title"><?php echo esc_html($label); ?></div>
      <div class="tt-progress-number"><?php echo esc_html($rating_number); ?></div>
      <div class="progress tpl-progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo esc_attr($rating_number * 10); ?>" aria-valuemin="0" aria-valuemax="100"></div>
      </div>

    <?php $rating_total += $rating_number; endforeach; ?>

    </div>

    <div class="tt-rating-content">

      <div class="row">  

        <div class="col-md-10 col-xs-12">  
          <?php if(!empty($summary_text)): ?>
            <div class="tt-summary-title"><h4 class="c-h5"><?php echo magplus_get_opt('translation-summary'); ?></h4></div><div class="empty-space marg-lg-b5"></div>
            <div class="tt-summary-text simple-text"><p><?php echo wp_kses_post($summary_text); ?></p></div>
          <?php endif; ?>
        </div>

        <div class="col-md-2 text-right col-xs-12">
          <div class="empty-space marg-xs-b15"></div>  
          <div class="tt-rating-title"><h4 class="c-h5"><?php echo magplus_get_opt('translation-total-rating'); ?></h4></div><div class="empty-space marg-lg-b10"></div>
            <div class="tt-rating-text"><?php echo number_format(($rating_total / $count), 1); ?></div> 
        </div>  

      </div>
    </div>
  </div>

  <?php
  endif;

  }
}

/**
 * Time Format
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_time_format')) {
  function magplus_time_format() {
    $time_format = magplus_get_opt('post-date-format');
    return ($time_format == 'default') ? get_the_date(get_option('date_format')):magplus_time_ago();
  }
}
/**
 * Slider Time Format
 * @param type $type
 * @return array
 */
if(!function_exists('magplus_slider_time_format')) {
  function magplus_slider_time_format() {
    $time_format = magplus_get_opt('slider-post-date-format');
    return ($time_format == 'default') ? get_the_date(get_option('date_format')):magplus_time_ago();
  }
}
