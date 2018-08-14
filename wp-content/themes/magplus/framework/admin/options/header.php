<?php
/*
 * Header Section
*/
$this->sections[] = array(
  'title' => esc_html__('Header', 'magplus'),
  'desc' => esc_html__('Change the header section configuration.', 'magplus'),
  'icon'  => 'fa fa-window-maximize',
  'fields' => array(

    array(
      'id' => 'header-enable-switch',
      'type' => 'switch',
      'title' => esc_html__('Enable Header', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'subtitle' => esc_html__('If on, this layout part will be displayed.', 'magplus'),
    ),
    array(
      'id' => 'header-enable-sticky-switch',
      'type' => 'switch',
      'title' => esc_html__('Enable Sticky Header', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'subtitle' => esc_html__('If on, header will be sticky.', 'magplus'),
    ),
    array(
      'id' => 'header-enable-switch-bars',
      'type' => 'switch',
      'title' => esc_html__('Enable Header Bars', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'subtitle' => esc_html__('If on, this layout part will be displayed.', 'magplus'),
    ),
    array(
      'id' => 'header-enable-breaking-news',
      'type' => 'switch',
      'title' => esc_html__('Enable Breaking News / Trending Tags', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
      'subtitle' => esc_html__('If on, breaking news will get displayed in header.', 'magplus'),
    ),
    array(
      'id'        => 'header-hash-tags',
      'type'      => 'select',
      'title'     => esc_html__('Trending Tags', 'magplus'),
      'subtitle'  => esc_html__('Select desired tags', 'magplus'),
      'options'   => magplus_element_values_page( 'tag', array(
        'sort_order'  => 'ASC',
        'hide_empty'  => false,
        'taxonomies'  => 'post_tag',
        'args'        => '',
      ) ),
      'multi'     => true,
      'default' => '',
      'desc'    => esc_html__('Please select tags not more than 4-5.', 'magplus'),
      'required' => array('header-enable-breaking-news', 'equals', array('1')),
    ),
    array(
      'id'       => 'header-template',
      'type'     => 'image_select',
      'width'    => '180',
      'title'    => esc_html__('Template', 'magplus'),
      'subtitle' => esc_html__('Choose template for navigation header.', 'magplus'),
      'options'  => array(
        'header-style1'  => array(
          'alt' => 'Header Style 1',
          'img' => get_theme_file_uri('framework/admin/assets/img/1.png')
        ),
        'header-style3'  => array(
          'alt' => 'Header Style 3',
          'img' => get_theme_file_uri('framework/admin/assets/img/3.png')
        ),
        'header-style4'  => array(
          'alt' => 'Header Style 4',
          'img' => get_theme_file_uri('framework/admin/assets/img/4.png')
        ),
        'header-style5'  => array(
          'alt' => 'Header Style 5',
          'img' => get_theme_file_uri('framework/admin/assets/img/5.png')
        ),
        'header-style6'  => array(
          'alt' => 'Header Style 6',
          'img' => get_theme_file_uri('framework/admin/assets/img/6.png')
        ),
        'header-style7'  => array(
          'alt' => 'Header Style 7',
          'img' => get_theme_file_uri('framework/admin/assets/img/7.png')
        ),
        'header-style8'  => array(
          'alt' => 'Header Style 8',
          'img' => get_theme_file_uri('framework/admin/assets/img/8.png')
        ),
        'header-style9'  => array(
          'alt' => 'Header Style 9',
          'img' => get_theme_file_uri('framework/admin/assets/img/9.png')
        ),
        'header-style12'  => array(
          'alt' => 'Header Style 12',
          'img' => get_theme_file_uri('framework/admin/assets/img/12.png')
        ),
        'header-style11'  => array(
          'alt' => 'Header Style 11',
          'img' => get_theme_file_uri('framework/admin/assets/img/11.png')
        ),
        'header-style10'  => array(
          'alt' => 'Header Style 10',
          'img' => get_theme_file_uri('framework/admin/assets/img/10.png')
        ),
        'header-style13'  => array(
          'alt' => 'Header Style 13',
          'img' => get_theme_file_uri('framework/admin/assets/img/13.png')
        ),
      ),
      'default' => '',
      'validate' => '',
    ),
    array(
      'id'       => 'random-number',
      'type'     => 'info',
      'desc'     => '<h3 style="color:#303539;">Ads Module</h3>',
      'required' => array('header-template', 'equals', array('header-style1', 'header-style2', 'header-style3', 'header-style4', 'header-style6', 'header-style11', 'header-style13')),
    ),
    array(
      'id'           =>'header-ads-content',
      'type'         => 'textarea',
      'title'        => esc_html__('Your Header Ads', 'magplus'),
      'allowed_html' => true,
      'desc'         => wp_kses_data('Paste your ad code here. Google adsense will be made responsive automatically. To  add non adsense responsive ads, 
        <a href ="http://themebubble.com/documentation/magplus/#line3_12" target="_blank">click here</a>', 'magplus'),
      'required' => array('header-template', 'equals', array('header-style1', 'header-style2', 'header-style3', 'header-style4', 'header-style6', 'header-style11', 'header-style13')),
      'default'      => '',
    ),
    array(
      'id'       => 'header-social-icons-category',
      'type'     => 'select',
      'title'    => esc_html__('Social Icons Category', 'magplus'),
      'subtitle' => esc_html__('Select desired category', 'magplus'),
      'options'  => magplus_get_terms_assoc('social-site-category'),
      'default'  => '',
      'required'  => array('header-template', 'equals', array('menu-left-with-social-right', 'menu-right-with-social')),
    ),
    array(
      'id'       => 'random-number',
      'type'     => 'info',
      'desc'     => '<h3 style="color:#303539;">Menu Module</h3>',    ),
    array(
      'id'=>'header-primary-menu',
      'type' => 'select',
      'title' => esc_html__('Primary Menu', 'magplus'),
      'subtitle' => esc_html__('Select a menu to overwrite the header menu location.', 'magplus'),
      'data' => 'menus',
      'default' => '',
    ),

    array(
      'id' => 'random-number',
      'type' => 'info',
      'desc' => '<h3 style="color:#303539;">Logo Module</h3>'
    ),

    array(
      'id'=>'logo',
      'type' => 'media',
      'url' => true,
      'title' => esc_html__('Logo', 'magplus'),
      'subtitle' => esc_html__('Upload the logo that will be displayed in the header.', 'magplus'),
    ),
    array(
      'id'      =>'logo-width',
      'type'    => 'text',
      'title'   => esc_html__('Width', 'magplus'),
      'default' => '',
      'desc'    => 'Enter logo width or type "auto" (optional)'
    ),
    array(
      'id'      =>'logo-height',
      'type'    => 'text',
      'title'   => esc_html__('Height', 'magplus'),
      'default' => '',
      'desc'    => 'Enter logo height or type "auto" (optional)'
    ),
    array(
      'id'=>'logo-2x',
      'type' => 'media',
      'url' => true,
      'title' => esc_html__('Logo Retina (@2x)', 'magplus'),
      'subtitle' => esc_html__('Upload the logo that will be displayed in the header.', 'magplus'),
    ),
    array(
      'id'=>'side-header-logo',
      'type' => 'media',
      'url' => true,
      'title' => esc_html__('Side Header Logo', 'magplus'),
      'subtitle' => esc_html__('Upload the logo that will be displayed in the side header.', 'magplus'),
    ),
    array(
      'id'    =>'logo-text',
      'type'  => 'text',
      'title' => esc_html__('Logo Text', 'magplus'),
    ),
    array(
      'id'             => 'logo-text-typography',
      'type'           => 'typography',
      'title'          => esc_html__('Logo Text Typography', 'magplus'),
      'font-size'      => true,
      'line-height'    => false,
      'text-align'     => false,
      'color'          => true,
      'letter-spacing' => true,
      'text-transform' => true,
      'output'         => array('.text-logo'),
    ),
    array(
      'id' => 'random-number',
      'type' => 'info',
      'desc' => '<h3 style="color:#303539;">Logo Module (Mobile & Tablet)</h3>'
    ),
    array(
      'id'      =>'logo-width-sm',
      'type'    => 'text',
      'title'   => esc_html__('Width', 'magplus'),
      'default' => '',
      'desc'    => 'Enter logo width or type "auto" (optional)'
    ),
    array(
      'id'      =>'logo-height-sm',
      'type'    => 'text',
      'title'   => esc_html__('Height', 'magplus'),
      'default' => '',
      'desc'    => 'Enter logo height or type "auto" (optional)'
    ),

  ), // #fields
);

