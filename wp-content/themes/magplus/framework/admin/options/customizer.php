<?php
$this->sections[] = array(
  'title' => esc_html__('Styling', 'magplus'),
  'desc' => esc_html__('Check child sections to style properly the correct area of the theme.', 'magplus'),
  'icon' => 'fa fa-paint-brush',
  'fields' => array(

  ), // #fields
);
$this->sections[] = array(
  'title'      => esc_html__('Top Header Styling', 'magplus'),
  'desc'       => esc_html__('Configure top header.', 'magplus'),
  'subsection' => true,
  'fields' => array(
    array(
      'id' => 'random-number',
      'type' => 'info',
      'desc' => '<h3 style="color:#303539;">'.esc_html__('Top Header Settings', 'magplus').'</h3>'
    ),
    array(
      'id'        => 'customizer-top-header-background-color',
      'type'      => 'color',
      'title'     => esc_html__('Background Color', 'magplus'),
      'default'   => '',
      'output'    => array('background' => '.tt-header .top-line, .tt-header.color-2 .top-line')
    ),
    array(
      'id'        => 'customizer-top-header-link-color',
      'type'      => 'color',
      'title'     => esc_html__('Link Color', 'magplus'),
      'default'   => '',
      'output'    => array('color' => '.tt-header .top-menu a, .tt-header .top-social a, .tt-header.color-2 .top-menu a, .tt-header.color-2 .top-social a')
    ),
    array(
      'id'        => 'customizer-top-header-link-hover-color',
      'type'      => 'color',
      'title'     => esc_html__('Link Hover Color', 'magplus'),
      'default'   => '',
      'output'    => array('color' => '.tt-header .top-menu a:hover, .tt-header .top-social a:hover, .tt-header.color-2 .top-menu a:hover, .tt-header.color-2 .top-social a:hover')
    ),

  ),
);
$this->sections[] = array(
  'title'      => esc_html__('Header Styling', 'magplus'),
  'desc'       => esc_html__('Configure header.', 'magplus'),
  'subsection' => true,
  'fields' => array(
    array(
      'id' => 'random-number',
      'type' => 'info',
      'desc' => '<h3 style="color:#303539;">'.esc_html__('Header Settings', 'magplus').'</h3>'
    ),
    array(
      'id'       => 'customizer-header-menu-bg-color',
      'type'     => 'color',
      'title'    => esc_html__('Menu Background Color', 'magplus'),
      'default'  => '',
      'output'   => array('background' => '.tt-header-type-7 .toggle-block, .tt-header-type-4 .toggle-block, .tt-header-type-3 .toggle-block, .tt-header .toggle-block, .tt-header-type-5 .top-inner'),
    ),
    array(
      'id'      => 'customizer-header-menu-link-color',
      'type'    => 'color',
      'title'   => esc_html__('Menu Link Color', 'magplus'),
      'default' => '',
      'output'  => array('color' => '.tt-header .main-nav > ul > li > a, .tt-header-type-4 .tt-s-popup-btn, .tt-s-popup-btn, .tt-header .cmn-mobile-switch span, .tt-header .cmn-mobile-switch::before, .tt-header .cmn-mobile-switch::after')
    ),
    array(
      'id'      => 'customizer-header-menu-link-hover-color',
      'type'    => 'color',
      'title'   => esc_html__('Menu Link Hover Color', 'magplus'),
      'default' => '',
      'output'  => array('color' => '.tt-header .main-nav > ul > li.active > a, .tt-header .main-nav > ul > li:hover > a, .tt-s-popup-btn:hover, .tt-header .cmn-mobile-switch:hover:before, .tt-header .cmn-mobile-switch:hover:after, .tt-header .cmn-mobile-switch:hover span')
    ),    
    array(
      'id'       => 'customizer-header-menu-link-hover-bg-color',
      'type'     => 'color',
      'title'    => esc_html__('Menu Link Hover Background Color', 'magplus'),
      'default'  => '',
      'output'   => array('background' => '.tt-header .main-nav > ul > li > a:hover, .tt-header-type-4 .main-nav > ul > li.active > a'),
    ),

    array(
      'id'       => 'customizer-header-menu-link-hover-border-color',
      'type'     => 'color',
      'title'    => esc_html__('Menu Hover Bottom Border Color', 'magplus'),
      'default'  => '',
      'output'   => array('background' => '.tt-header-style-link .main-nav > ul > li > a:after, .tt-header-type-5 .main-nav > ul > li > a:after'),
    ),
    array(
      'id'      => 'customizer-header-sub-menu-link-color',
      'type'    => 'color',
      'title'   => esc_html__('Sub Menu Link Color', 'magplus'),
      'default' => '',
      'output'  => array('color' => '.tt-header .main-nav > ul > li:not(.mega) > ul > li > a')
    ),
    array(
      'id'      => 'customizer-header-sub-menu-link-hover-color',
      'type'    => 'color',
      'title'   => esc_html__('Sub Menu Link Hover Color', 'magplus'),
      'default' => '',
      'output'  => array('color' => '.tt-header .main-nav > ul > li:not(.mega) > ul > li > a:hover')
    ),    
    array(
      'id'      => 'customizer-header-sub-menu-link-hover-bg-color',
      'type'    => 'color',
      'title'   => esc_html__('Sub Menu Hover Background Color', 'magplus'),
      'default' => '',
      'output'  => array('background' => '.tt-header .main-nav > ul > li:not(.mega) > ul > li > a:hover, .mega.type-2 ul.tt-mega-wrapper li>ul a:hover, .tt-mega-list a:hover, .mega.type-2 ul.tt-mega-wrapper li>ul a:hover')
    ),
    array(
      'id'      => 'customizer-header-menu-bar-color',
      'type'    => 'color',
      'title'   => esc_html__('Menu Bar Color', 'magplus'),
      'default' => '',
      'output'  => array('background' => '.tt-header .cmn-mobile-switch span, .tt-header .cmn-mobile-switch::before, .tt-header .cmn-mobile-switch::after')
    ),
    array(
      'id'      => 'customizer-header-menu-bar-hover-color',
      'type'    => 'color',
      'title'   => esc_html__('Menu Bar Hover Color', 'magplus'),
      'default' => '',
      'output'  => array('background' => '.tt-header .cmn-mobile-switch:hover span, .tt-header .cmn-mobile-switch:hover::before, .tt-header .cmn-mobile-switch:hover::after')
    ),
    array(
      'id'      => 'customizer-header-search-color',
      'type'    => 'color',
      'title'   => esc_html__('Search Icon Color', 'magplus'),
      'default' => '',
      'output'  => array('color' => '.tt-s-popup-btn')
    ),
    array(
      'id'      => 'customizer-header-search-color-hover',
      'type'    => 'color',
      'title'   => esc_html__('Search Icon Hover Color', 'magplus'),
      'default' => '',
      'output'  => array('color' => '.tt-s-popup-btn:hover, .tt-header-type-7 .tt-s-popup-btn:hover, .tt-header-type-3 .tt-s-popup-btn:hover')
    ),

  ),
);
$this->sections[] = array(
  'title'      => esc_html__('Sidebar Styling', 'magplus'),
  'desc'       => esc_html__('Configure sidebar heading.', 'magplus'),
  'subsection' => true,
  'fields' => array(
    array(
      'id' => 'random-number',
      'type' => 'info',
      'desc' => '<h3 style="color:#303539;">'.esc_html__('Sidebar Heading Settings', 'magplus').'</h3>'
    ),
    array(
      'id'        => 'customizer-sidebar-heading-primary-border',
      'type'      => 'color',
      'title'     => esc_html__('Primary Border Color', 'magplus'),
      'default'   => '',
      'output'    => array('border-color' => '.sidebar-heading-style2 .tt-title-text, .sidebar-heading-style4 .tt-title-block, .sidebar-heading-style5 .tt-title-block, .sidebar-heading-style3 .tt-title-block')
    ),    
    array(
      'id'        => 'customizer-sidebar-heading-secondary-border',
      'type'      => 'color',
      'title'     => esc_html__('Secondary Border Color', 'magplus'),
      'default'   => '',
      'output'    => array('background' => '.sidebar-heading-style2 .tt-title-block:after, .sidebar-heading-style1 .tt-title-text:before, .sidebar-heading-style1 .tt-title-text:after, .sidebar-heading-style6 .tt-title-text:before, .sidebar-heading-style6 .tt-title-text:after')
    ),
    array(
      'id'        => 'customizer-sidebar-heading-background-color',
      'type'      => 'color',
      'title'     => esc_html__('Background Color', 'magplus'),
      'default'   => '',
      'output'    => array('background' => '.sidebar-heading-style4 .tt-title-text, .sidebar-heading-style5 .tt-title-text, .sidebar-heading-style3 .tt-title-block, .sidebar-heading-style6 .tt-title-text', 'border-left-color' => '.sidebar-heading-style5 .tt-title-text:after')
    ),
    array(
      'id'        => 'customizer-sidebar-heading-text-color',
      'type'      => 'color',
      'title'     => esc_html__('Text Color', 'magplus'),
      'default'   => '',
      'output'    => array('color' => '.sidebar-heading-style4 .tt-title-text, .sidebar-heading-style5 .tt-title-text, .sidebar-heading-style1 .tt-title-text, .sidebar-heading-style2 .tt-title-text, .sidebar-heading-style3 .tt-title-text, .sidebar-heading-style6 .tt-title-text')
    ),
  ),
);
$this->sections[] = array(
  'title'      => esc_html__('Footer Styling', 'magplus'),
  'desc'       => esc_html__('Configure footer heading.', 'magplus'),
  'subsection' => true,
  'fields' => array(
    array(
      'id' => 'random-number',
      'type' => 'info',
      'desc' => '<h3 style="color:#303539;">'.esc_html__('Footer Settings', 'magplus').'</h3>'
    ),
    array(
      'id'        => 'customizer-footer-bg-color',
      'type'      => 'color',
      'title'     => esc_html__('Background Color', 'magplus'),
      'default'   => '',
      'output'    => array('background' => '.tt-footer')
    ), 
    array(
      'id'        => 'customizer-footer-heading-color',
      'type'      => 'color',
      'title'     => esc_html__('Heading Color', 'magplus'),
      'default'   => '',
      'output'    => array('color' => '.footer_widget .tt-title-block.type-2 .tt-title-text, .footer_widget .tt-newsletter-title, .tt-title-block-2, .tt-title-block.dark .tt-title-text')
    ),
    array(
      'id'        => 'customizer-footer-link-color',
      'type'      => 'color',
      'title'     => esc_html__('Link Color', 'magplus'),
      'default'   => '',
      'output'    => array('color' => '.tt-post.dark .tt-post-title, .footer_widget .tt-post-title, .footer_widget .tt-post .tt-post-label, .footer_widget .tt-post.dark .tt-post-cat, .footer_widget.widget_tag_cloud .tagcloud a')
    ), 
    array(
      'id'        => 'customizer-footer-border-color',
      'type'      => 'color',
      'title'     => esc_html__('Border Color', 'magplus'),
      'default'   => '',
      'output'    => array('border-color' => '.tt-post-list.dark li, .footer_widget .tt-post-list li, .footer_widget .tt-post-list.type-2 li:first-child, .footer_widget .tt-post-list.type-2 li:last-child, .footer_widget .tt-tab-wrapper.type-1, .footer_widget .tt-tab-wrapper.type-1 .tt-nav-tab-item, .footer_widget .tt-border-block, .footer_widget #wp-calendar, .footer_widget #wp-calendar caption, .footer_widget #wp-calendar tfoot, .footer_widget #wp-calendar td, .footer_widget #wp-calendar th, .footer_widget .tt-s-search input[type="text"], .footer_widget.widget_tag_cloud .tagcloud a', 'background' => '.tt-title-block.dark .tt-title-text:before, .tt-title-block.dark .tt-title-text:after')
    ),     
  ),
);
$this->sections[] = array(
  'title'      => esc_html__('Extra Styling', 'magplus'),
  'desc'       => esc_html__('Extra elements styling.', 'magplus'),
  'subsection' => true,
  'fields' => array(
    array(
      'id' => 'random-number',
      'type' => 'info',
      'desc' => '<h3 style="color:#303539;">'.esc_html__('Body Color Settings', 'magplus').'</h3>'
    ),
    array(
      'id'        => 'customizer-body-text-color',
      'type'      => 'color',
      'title'     => esc_html__('Text Color', 'magplus'),
      'default'   => '',
      'output'    => array('color' => '.simple-text p, body, p')
    ),
    array(
      'id' => 'random-number',
      'type' => 'info',
      'desc' => '<h3 style="color:#303539;">'.esc_html__('Load More Button Settings', 'magplus').'</h3>'
    ),
    array(
      'id'        => 'customizer-load-more-bg-color',
      'type'      => 'color',
      'title'     => esc_html__('Background Color', 'magplus'),
      'default'   => '',
      'output'    => array('background' => '.ajax-load-more')
    ), 
    array(
      'id'        => 'customizer-load-more-text-color',
      'type'      => 'color',
      'title'     => esc_html__('Text Color', 'magplus'),
      'default'   => '',
      'output'    => array('color' => '.ajax-load-more')
    ),
    array(
      'id'        => 'customizer-load-more-bg-hover-color',
      'type'      => 'color',
      'title'     => esc_html__('Background Hover Color', 'magplus'),
      'default'   => '',
      'output'    => array('background' => '.ajax-load-more:hover')
    ), 
    array(
      'id'        => 'customizer-load-more-text-hover-color',
      'type'      => 'color',
      'title'     => esc_html__('Text Hover Color', 'magplus'),
      'default'   => '',
      'output'    => array('color' => '.ajax-load-more:hover')
    ),     
  ),
);
