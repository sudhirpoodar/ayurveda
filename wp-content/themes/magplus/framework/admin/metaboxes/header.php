<?php
/*
 * Header Section
*/
$sections[] = array(
  'title' => esc_html__('Header', 'magplus'),
  'desc' => esc_html__('Change the header section configuration.', 'magplus'),
  'icon' => 'fa fa-window-maximize',
  'fields' => array(

    array(
      'id' => 'header-enable-switch-local',
      'type' => 'button_set',
      'title' => esc_html__('Enable Header', 'magplus'),
      'options' => array(
        '1' => 'On',
        '' => 'Default',
        '0' => 'Off',
      ),
      'default' => '',
      'subtitle' => esc_html__('If on, this layout part will be displayed.', 'magplus'),
    ),
    array(
      'id' => 'header-height-switch-local',
      'type' => 'button_set',
      'title' => esc_html__('Header Height', 'magplus'),
      'options' => array(
        '1' => 'On',
        '' => 'Default',
        '0' => 'Off',
      ),
      'default' => '',
      'subtitle' => esc_html__('If on, space will create below header.', 'magplus'),
    ),
    array(
      'id' => 'header-enable-switch-bars-local',
      'type' => 'button_set',
      'title' => esc_html__('Enable Header Bars', 'magplus'),
      'options' => array(
        '1' => 'On',
        '' => 'Default',
        '0' => 'Off',
      ),
      'default' => '',
      'subtitle' => esc_html__('If on, this layout part will be displayed.', 'magplus'),
    ),
    array(
      'id'       => 'header-template-local',
      'type'     => 'image_select',
      'width'    => '180',
      'title'    => esc_html__('Template', 'magplus'),
      'subtitle' => esc_html__('Choose template for navigation header.', 'magplus'),
      'options'  => array(
        'header-style1'  => array(
          'alt' => 'Header Style 1',
          'img' => get_theme_file_uri('framework/admin/assets/img/1.png')
        ),
        'header-style2'  => array(
          'alt' => 'Header Style 2',
          'img' => get_theme_file_uri('framework/admin/assets/img/2.png')
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
        'header-style10'  => array(
          'alt' => 'Header Style 10',
          'img' => get_theme_file_uri('framework/admin/assets/img/10.png')
        ),
        'header-style11'  => array(
          'alt' => 'Header Style 11',
          'img' => get_theme_file_uri('framework/admin/assets/img/11.png')
        ),
        'header-style12'  => array(
          'alt' => 'Header Style 12',
          'img' => get_theme_file_uri('framework/admin/assets/img/12.png')
        ),
        'header-style13'  => array(
          'alt' => 'Header Style 13',
          'img' => get_theme_file_uri('framework/admin/assets/img/13.png')
        ),
        ''  => array(
          'alt' => 'Header Style 13',
          'img' => get_theme_file_uri('framework/admin/assets/img/131.png')
        ),
      ),
      'default' => '',
      'validate' => '',
    ),
    array(
      'id'   => 'random-number',
      'type' => 'info',
      'desc' => '<h3 style="color:#007aff;">Ads Module</h3>'
    ),
    array(
      'id'       =>'header-ads-img-local',
      'type'     => 'media',
      'url'      => true,
      'title'    => esc_html__('Small Image', 'magplus'),
      'subtitle' => esc_html__('Upload Ads size of 62 x 81.', 'magplus'),
      'required' => array('header-template-local', 'equals', array('header-style1', 'header-style2', 'header-style6', 'header-style11', 'header-style13')),
    ),
    array(
      'id'       =>'header-ads-img-long-local',
      'type'     => 'media',
      'url'      => true,
      'title'    => esc_html__('Long Image', 'magplus'),
      'subtitle' => esc_html__('Upload Ads size of 728 x 90.', 'magplus'),
      'required' => array('header-template-local', 'equals', array('header-style4')),
    ),
    array(
      'id'       =>'header-ads-img-big-local',
      'type'     => 'media',
      'url'      => true,
      'title'    => esc_html__('Big Image', 'magplus'),
      'subtitle' => esc_html__('Upload Ads size of 1920 x 200.', 'magplus'),
      'required' => array('header-template-local', 'equals', array('header-style3')),
    ),
    array(
      'id'       =>'header-ads-title-local',
      'type'     => 'text',
      'title'    => esc_html__('Title', 'magplus'),
      'default'  => '',
      'required' => array('header-template-local', 'equals', array('header-style1, header-style2, header-style6, header-style11, header-style13')),
    ),
    array(
      'id'       =>'header-ads-btn-text-local',
      'type'     => 'text',
      'title'    => esc_html__('Button Text', 'magplus'),
      'default'  => '',
      'required' => array('header-template-local', 'equals', array('header-style1', 'header-style2', 'header-style6', 'header-style11', 'header-style13')),
    ),
    array(
      'id'       =>'header-ads-btn-link-local',
      'type'     => 'text',
      'title'    => esc_html__('Button Link', 'magplus'),
      'default'  => '',
      'required' => array('header-template-local', 'equals', array('header-style1', 'header-style2', 'header-style6', 'header-style11', 'header-style13')),
    ),


    array(
      'id'       => 'header-social-icons-category-local',
      'type'     => 'select',
      'title'    => esc_html__('Social Icons Category', 'magplus'),
      'subtitle' => esc_html__('Select desired category', 'magplus'),
      'options'  => magplus_get_terms_assoc('social-site-category'),
      'default'  => '',
      'required'  => array('header-template-local', 'equals', array('menu-left-with-social-right', 'menu-right-with-social')),
    ),
    array(
      'id'=>'header-primary-menu-local',
      'type' => 'select',
      'title' => esc_html__('Primary Menu', 'magplus'),
      'subtitle' => esc_html__('Select a menu to overwrite the header menu location.', 'magplus'),
      'data' => 'menus',
      'default' => '',
    ),

    array(
      'id' => 'random-number',
      'type' => 'info',
      'desc' => esc_html__('Logo Module Configuration.', 'magplus')
    ),

    array(
      'id'=>'logo-local',
      'type' => 'media',
      'url' => true,
      'title' => esc_html__('Logo', 'magplus'),
      'subtitle' => esc_html__('Upload the logo that will be displayed in the header.', 'magplus'),
    ),






  ), // #fields
);

