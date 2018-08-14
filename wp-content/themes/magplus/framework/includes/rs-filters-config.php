<?php
/**
 * Filter Hooks
 *
 * @package make
 * @since 1.0
 */

/**
 * Title Filter
 *
 * @package make
 * @since 1.0
 */
if (! function_exists('magplus_wp_title') ) {
  function magplus_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() ) {
      return $title;
    } // end if

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
      $title = "$title $sep $site_description";
    } // end if

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 ) {
      $title = sprintf( __( 'Page %s', 'magplus' ), max( $paged, $page ) ) . " $sep $title";
    } // end if

    return $title;

  } // end rs_wp_title
  add_filter( 'wp_title', 'magplus_wp_title', 10, 2 );
}

/**
 * Allow xml file to upload
 *
 * @package adios
 * @since 1.0
 */
if(!function_exists('magplus_upload_svg')) {
  function magplus_upload_svg($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
  }
  add_filter('upload_mimes', 'magplus_upload_svg');
}

/**
 * Post Column View
 *
 * @package magplus
 * @since 1.0
 */
if(!function_exists('magplus_posts_column_views')) {
  function magplus_posts_column_views($defaults) {
    $defaults['post_views'] = magplus_get_opt('translation-views');
    return $defaults;
  }
  add_filter('manage_posts_columns', 'magplus_posts_column_views');
}

/**
 * Avatar img class
 *
 * @package make
 * @since 1.0
 */
if( !function_exists('magplus_add_gravatar_class')) {
  function magplus_add_gravatar_class( $class ) {
    $class = str_replace("class='avatar", "class='tt-comment-form-ava", $class);
    return $class;
  }
  add_filter('get_avatar','magplus_add_gravatar_class');
}

/**
 * Body Filter Hook
 *
 * @package make
 * @since 1.0
 */
if( !function_exists('magplus_body_class')) {
  function magplus_body_class($classes) {
    $top_header    = magplus_get_opt('top-header-enable');
    $sticky_header = magplus_get_opt('header-enable-sticky-switch');
    $classes[] = '';
    $classes[] = magplus_get_opt('page-layout');
    $classes[] = magplus_get_opt('header-template');
    $classes[] = ($top_header) ? 'tt-top-header-enable':'tt-top-header-disable';
    $classes[] = ($sticky_header) ? 'tt-header-sticky':'tt-disable-sticky';
    return $classes;
  }
  add_filter('body_class', 'magplus_body_class');
}

/**
 * Add Custom Class
 *
 * @package make
 * @since 1.0
 */
if(!function_exists('magplus_post_link_next_class')) {
  function magplus_post_link_next_class($format){
   $format = str_replace('href=', 'class="tt-blog-nav-title" href=', $format);
   return $format;
  }
  add_filter('next_post_link', 'magplus_post_link_next_class');
}

/**
 * Add Custom Class
 *
 * @package make
 * @since 1.0
 */
if(!function_exists('magplus_post_link_prev_class')) {
  function magplus_post_link_prev_class($format) {
   $format = str_replace('href=', 'class="tt-blog-nav-title" href=', $format);
   return $format;
  }
  add_filter('previous_post_link', 'magplus_post_link_prev_class');
}

/**
 * Allow demo name to be changed
 *
 * @package magplus
 * @since 1.0
 */
if(!function_exists('magplus_importer_filter_title')) {
  function magplus_importer_filter_title( $title ) {
    $output = trim( ucfirst( str_replace( 'pro', ' ', $title ) ) );
    return $output .' Pro';
  }
  add_filter( 'wbc_importer_directory_title', 'magplus_importer_filter_title', 10 );
}

/**
 * Filter for changing importer description info in options panel
 * when not setting in Redux config file.
 *
 * @param [string] $title description above demos
 *
 * @return [string] return.
 */
if ( !function_exists( 'magplus_importer_description_text' ) ) {

  function magplus_importer_description_text( $description ) {
    $message = wp_kses_data('<i><strong>Note:</strong> Please wait 2-3 minutes depending upon your connection, if importer doesn\'t working as expected then, refer this <a href="#">article</a></i>');
    return $message;
  }
  add_filter( 'wbc_importer_description', 'magplus_importer_description_text', 10 );
}

/**
 * Rename Post Format to Review
 *
 * @package magplus
 * @since 1.0
 */
if(!function_exists('magplus_rename_post_formats')) {
  function magplus_rename_post_formats($translation, $text, $context, $domain) {
    $names = array(
      'Aside'  => 'Review',
    );
    if ($context == 'Post format') {
      $translation = str_replace(array_keys($names), array_values($names), $text);
    }
    return $translation;
  }
  add_filter('gettext_with_context', 'magplus_rename_post_formats', 10, 4);
}

/**
 * Latest Tweet Render
 *
 * @package magplus
 * @since 1.0
 */
if(!function_exists('magplus_latest_tweets_render_tweet') && function_exists('latest_tweets_render')) {
  function magplus_latest_tweets_render_tweet($html, $date, $link, array $tweet) {
    $pic = $tweet['user']['profile_image_url_https'];
    return '<p class="my-tweet"><img src="'.$pic.'"/>'.$html.'</p><p class="my-date"><a href="'.$link.'">'.$date.'</a></p>';
  }
  add_filter('latest_tweets_render_tweet', 'magplus_latest_tweets_render_tweet', 10, 4);
}

/**
 * magplus_facebook_post_thumbnail
 *
 * @package magplus
 * @since 1.0
 */
if(!function_exists('magplus_social_post_thumbnail')) {
  function magplus_social_post_thumbnail() { 
    $social_image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'magplus-medium');
  ?>
    <meta property="og:image" content="<?php echo esc_url($social_image[0]); ?>"/>
    <meta name="twitter:image:src" content="<?php echo esc_url($social_image[0]); ?>">
  <?php
  }
  add_filter('wp_head', 'magplus_social_post_thumbnail');
}

/**
 * magplus_exclude_page_from_search
 *
 * @package magplus
 * @since 2.5
 */
if(!function_exists('magplus_exclude_page_from_search')) {
  function magplus_exclude_page_from_search($query) {
    if ($query->is_search) {
      $query->set('post_type', 'post');
    }
    return $query;
  }
  add_filter('pre_get_posts','magplus_exclude_page_from_search');
}
