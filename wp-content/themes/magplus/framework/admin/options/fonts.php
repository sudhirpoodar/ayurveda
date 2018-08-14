<?php
/**
 * Customizer Section
 */

$this->sections[] = array(
  'title' => esc_html__('Fonts', 'magplus'),
  'desc' => esc_html__('Check child sections to style properly the correct area of the theme.', 'magplus'),
  'icon' => 'fa fa-text-width',
  'fields' => array(

  ), // #fields
);
/**
* Pagination Section
*/
$this->sections[] = array(
  'title' => esc_html__('Heading', 'magplus'),
  'desc' => esc_html__('Configure heading styles.', 'magplus'),
  'subsection' => true,
  'fields' => array(
    array(
      'id'          => 'font-heading',
      'type'        => 'typography',
      'title'       => esc_html__('Heading', 'magplus'),
      'font-size'   => false,
      'line-height' => false,
      'text-align'  => false,
      'color'       => false,
      'output'      => array('#loading-text,
      .simple-text h1,
      .c-h1,.simple-text h2,
      .c-h2,.simple-text h3,.c-h3,.simple-text h4,.c-h4,.simple-text h5,.c-h5,.simple-text h6,
      .c-h6,.simple-text.font-poppins,.c-btn.type-1,.c-btn.type-2,.c-btn.type-3,.c-input,
      .tt-mobile-nav > ul > li > a,.tt-mobile-nav > ul > li > ul > li > a,
      .tt-header .main-nav > ul > li:not(.mega) > ul > li > a,.tt-mega-list a,.tt-s-popup-title,
      .tt-title-text,.tt-title-block-2,
      .comment-reply-title,.tt-tab-wrapper.type-1 .tt-nav-tab-item,
      .tt-f-list a,.tt-footer-copy,.tt-pagination a,.tt-blog-user-content,.tt-author-title,.tt-blog-nav-label,
      .tt-blog-nav-title,.tt-comment-label,.tt-search input[type="text"],.tt-share-title,.tt-mblock-label, .page-numbers a,.page-numbers span, .footer_widget.widget_nav_menu li a, .tt-h1-title, .tt-h4-title, .tt-h2-title, .shortcode-4 .tt-title-slider a, .footer_widget .tt-title-block.type-2 .tt-title-text, .footer_widget .tt-newsletter-title.c-h4 small'),
    ),
  ),
);

$this->sections[] = array(
  'title' => esc_html__('Menu', 'magplus'),
  'desc' => esc_html__('Configure menu styles.', 'magplus'),
  'subsection' => true,
  'fields' => array(
    array(
      'id'             => 'font-menu',
      'type'           => 'typography',
      'title'          => esc_html__('Menu', 'magplus'),
      'font-size'      => true,
      'line-height'    => false,
      'text-align'     => false,
      'color'          => false,
      'text-transform' => true,
      'output'         => array('.tt-header .main-nav>ul>li>a'),
    ),
    array(
      'id'          => 'font-submenu',
      'type'        => 'typography',
      'title'       => esc_html__('Sub Menu', 'magplus'),
      'font-size'   => true,
      'line-height' => false,
      'text-align'  => false,
      'color'       => false,
      'output'      => array('.tt-header .main-nav > ul > li:not(.mega) > ul > li > a, .tt-mega-list a, .mega.type-2 ul.tt-mega-wrapper li>ul a, .tt-header .main-nav>ul>li:not(.mega)>ul>li>ul>li>a'),
    ),
  ),
);

$this->sections[] = array(
  'title' => esc_html__('Body', 'magplus'),
  'desc' => esc_html__('Configure body styles.', 'magplus'),
  'subsection' => true,
  'fields' => array(
    array(
      'id'          => 'font-body',
      'type'        => 'typography',
      'title'       => esc_html__('Body', 'magplus'),
      'font-size'   => true,
      'line-height' => true,
      'text-align'  => false,
      'color'       => false,
      'output'      => array('body, .tt-title-ul, .simple-text.title-droid h1,
      .simple-text.title-droid h2,
      .simple-text.title-droid h3,
      .simple-text.title-droid h4,
      .simple-text.title-droid h5,
      .simple-text.title-droid h6,
      .tt-tab-wrapper.tt-blog-tab .tt-nav-tab .tt-nav-tab-item,
      .tt-header .main-nav,
      .tt-header .top-menu a,
      .tt-post-bottom,
      .tt-post-label,
      .tt-s-popup-field input[type="text"],
      .tt-slide-2-title span,input,
      textarea,.tt-post-cat, .tt-slider-custom-marg .c-btn.type-3,.tt-mslide-label,
      select, .tt-post-breaking-news .tt-breaking-title, .sidebar-item.widget_recent_posts_entries .tt-post.dark .tt-post-cat,.shortcode-4 .simple-text, .woocommerce-result-count'),
    ),
  ),
);
