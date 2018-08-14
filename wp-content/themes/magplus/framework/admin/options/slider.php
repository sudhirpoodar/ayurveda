<?php

$this->sections[] = array(
  'title' => esc_html__(' Slider', 'magplus'),
  'icon' => 'fa fa-pause',
  'fields' => array(
    array(
      'id' => 'slider-enable-switch',
      'type' => 'switch',
      'title' => esc_html__('Enable Slider', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'subtitle' => esc_html__('If on, slider will be displayed.', 'magplus'),
    ),
    array(
      'id'       =>'slider-margin-top',
      'type'     => 'spinner',
      'title'    => esc_html__('Slider Top Margin', 'magplus'),
      'default'  => '0',
      'min'      => '0',
      'step'     => '1',
      'max'      => '50',
      'required' => array('slider-enable-switch', 'equals', array(1)),
    ),
    array(
      'id'       => 'slider-template',
      'type'     => 'image_select',
      'title'    => esc_html__('Template', 'magplus'),
      'subtitle' => esc_html__('Choose layout for slider.', 'magplus'),
      'options'  => array(
        'slider-style1'  => array(
          'alt' => 'Slider Style 1',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/1.png')
        ),
        'slider-style2'  => array(
          'alt' => 'Slider Style 2',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/2.png')
        ),
        'slider-style3'  => array(
          'alt' => 'Slider Style 3',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/3.png')
        ),
        'slider-style4'  => array(
          'alt' => 'Slider Style 4',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/4.png')
        ),
        'slider-style5'  => array(
          'alt' => 'Slider Style 5',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/5.png')
        ),
        'slider-style6'  => array(
          'alt' => 'Slider Style 6',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/6.png')
        ),
        'slider-style7'  => array(
          'alt' => 'Slider Style 7',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/7.png')
        ),
        'slider-style8'  => array(
          'alt' => 'Slider Style 8',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/8.png')
        ),
        'slider-style9'  => array(
          'alt' => 'Slider Style 9',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/9.png')
        ),
        'slider-style10'  => array(
          'alt' => 'Slider Style 10',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/10.png')
        ),
        'slider-style11'  => array(
          'alt' => 'Slider Style 11',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/11.png')
        ),
        'slider-style12'  => array(
          'alt' => 'Slider Style 12',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/12.png')
        ),
        'slider-style13'  => array(
          'alt' => 'Slider Style 13',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/13.png')
        ),
        'slider-style14'  => array(
          'alt' => 'Slider Style 14',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/14.png')
        ),
        'slider-style15'  => array(
          'alt' => 'Slider Style 15',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/15.png')
        ),
        'slider-style16'  => array(
          'alt' => 'Slider Style 16',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/16.png')
        ),
        'slider-style17'  => array(
          'alt' => 'Slider Style 17',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/17.png')
        ),
        'slider-style18'  => array(
          'alt' => 'Slider Style 18',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/18.png')
        ),
        'slider-style19'  => array(
          'alt' => 'Slider Style 19',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/19.png')
        ),
        'slider-style20'  => array(
          'alt' => 'Slider Style 20',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/20.png')
        ),
        'slider-style21'  => array(
          'alt' => 'Slider Style 21',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/21.jpg')
        ),
        'slider-style22'  => array(
          'alt' => 'Slider Style 22',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/22.jpg')
        ),
        'slider-style23'  => array(
          'alt' => 'Slider Style 23',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/23.jpg')
        ),
        'slider-style24'  => array(
          'alt' => 'Slider Style 24',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/24.jpg')
        ),
        'slider-style25'  => array(
          'alt' => 'Slider Style 25',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/25.jpg')
        ),
        'slider-style26'  => array(
          'alt' => 'Slider Style 26',
          'img' => get_theme_file_uri('framework/admin/assets/img/slider/26.jpg')
        ),
      ),
      'default' => 'slider-style1',
      'validate' => '',
      'required'  => array('slider-enable-switch', 'equals', array(1)),
    ),
    array(
      'id'        => 'featured-category',
      'type'      => 'select',
      'title'     => esc_html__('Categories', 'magplus'),
      'subtitle'  => esc_html__('Select desired category for featured', 'magplus'),
      'options'   => magplus_element_values_page( 'category', array(
        'sort_order'  => 'ASC',
        'hide_empty'  => false,
        'taxonomies'  => 'category',
        'args'        => '',
      ) ),
      'multi'     => true,
      'default' => '',
      'required'  => array('slider-template', 'equals', array('slider-style8')),
    ),
    array(
      'id'        => 'slider-editor-pick-category',
      'type'      => 'select',
      'title'     => esc_html__('Editor Pick Categories', 'magplus'),
      'subtitle'  => esc_html__('Select desired category for editor pick', 'magplus'),
      'options'   => magplus_element_values_page( 'category', array(
        'sort_order'  => 'ASC',
        'hide_empty'  => false,
        'taxonomies'  => 'category',
        'args'        => '',
      ) ),
      'multi'     => true,
      'default' => '',
      'required'  => array('slider-template', 'equals', array('slider-style18')),
    ),
    array(
      'id'        => 'slider-category',
      'type'      => 'select',
      'title'     => esc_html__('Categories', 'magplus'),
      'subtitle'  => esc_html__('Select desired category for slider', 'magplus'),
      'options'   => magplus_element_values_page( 'category', array(
        'sort_order'  => 'ASC',
        'hide_empty'  => false,
        'taxonomies'  => 'category',
        'args'        => '',
      ) ),
      'multi'     => true,
      'default' => '',
      'required'  => array('slider-enable-switch', 'equals', array(1)),
    ),
    array(
      'id'        => 'slider-posts-per-page',
      'type'      => 'spinner',
      'title'     => esc_html__('No of Slides', 'magplus'),
      'subtitle'  => esc_html__('The number of items to show on slider.', 'magplus'),
      'default'  => '-1',
      'min'      => '1',
      'step'     => '1',
      'max'      => '20',
      'required'  => array('slider-enable-switch', 'equals', array(1)),
    ),
    array(
      'id' => 'slider-loop-switch',
      'type' => 'switch',
      'title' => esc_html__('Loop', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'required'  => array('slider-enable-switch', 'equals', array(1)),
    ),
    array(
      'id' => 'slider-swipe-switch',
      'type' => 'switch',
      'title' => esc_html__('Swipe', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'required'  => array('slider-enable-switch', 'equals', array(1)),
    ),
    array(
      'id' => 'slider-show-pagination-switch',
      'type' => 'switch',
      'title' => esc_html__('Pagination', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'required'  => array('slider-enable-switch', 'equals', array(1)),
    ),
    array(
      'id' => 'slider-show-category-switch',
      'type' => 'switch',
      'title' => esc_html__('Categories', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'required'  => array('slider-enable-switch', 'equals', array(1)),
    ),
    array(
      'id' => 'slider-show-author-switch',
      'type' => 'switch',
      'title' => esc_html__('Author', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'required'  => array('slider-enable-switch', 'equals', array(1)),
    ),
    array(
      'id' => 'slider-show-date-switch',
      'type' => 'switch',
      'title' => esc_html__('Date', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'required'  => array('slider-enable-switch', 'equals', array(1)),
    ),
    array(
      'id' => 'slider-show-views-switch',
      'type' => 'switch',
      'title' => esc_html__('Views', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'required'  => array('slider-enable-switch', 'equals', array(1)),
    ),
    array(
      'id'        => 'slider-autoplay',
      'type'      => 'spinner',
      'title'     => esc_html__('Autoplay', 'magplus'),
      'subtitle'  => esc_html__('Default is 0 means autoplay is OFF, e.g 2000.', 'magplus'),
      'default'  => '0',
      'min'      => '0',
      'step'     => '100',
      'max'      => '3000',
      'required'  => array('slider-enable-switch', 'equals', array(1)),
    ),
    array(
      'id'        => 'slider-speed',
      'type'      => 'spinner',
      'title'     => esc_html__('Speed', 'magplus'),
      'subtitle'  => esc_html__('Default is 500, e.g 2000.', 'magplus'),
      'default'  => '500',
      'min'      => '500',
      'step'     => '100',
      'max'      => '3000',
      'required'  => array('slider-enable-switch', 'equals', array(1)),
    ),
    array(
      'id'=>'slider-post-date-format',
      'type' => 'select',
      'title' => esc_html__('Slider Date Format', 'magplus'),
      'options' => array(
        'default'         => esc_html__('Default','magplus'),
        'ago-date-format' => esc_html__('Time Ago','magplus'),
      ),
      'default' => 'default',
    ),
  )
);
