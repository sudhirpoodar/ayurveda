<?php
/*
 * Post
*/
$sections[] = array(
  'icon' => 'el-icon-screen',
  'fields' => array(
    array(
      'id'    =>'post-enable-breaking-news',
      'type'  => 'switch',
      'title' => esc_html__('Is this Breaking News ? ', 'magplus'),
      'on'    => 'Yes',
      'off'   => 'No',
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),
    array(
      'id'=>'post-enable-custom-overlay',
      'type' => 'switch',
      'title' => esc_html__('Enable Post Custom Overlay', 'magplus'),
      'subtitle'=> esc_html__('If on, custom overlay will be displayed.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),
    array(
      'id'        => 'post-overlay-first-color',
      'type'      => 'color',
      'title'     => esc_html__('First Color', 'magplus'),
      'default'   => '',
      'required'  => array('post-enable-custom-overlay', 'equals', array(1)),
    ),

    array(
      'id'        => 'post-overlay-second-color',
      'type'      => 'color',
      'title'     => esc_html__('Second Color', 'magplus'),
      'default'   => '',
      'required'  => array('post-enable-custom-overlay', 'equals', array(1)),
    ),
    array(
      'id'        => 'blog-sidebar-layout-local',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Post Layout', 'magplus'),
      'subtitle'  => esc_html__('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'magplus'),
      'options'   => array(
        'default'       => esc_html__('1 Column', 'magplus'),
        'left_sidebar'  => esc_html__('2 - Columns Left', 'magplus'),
        'right_sidebar' => esc_html__('2 - Columns Right', 'magplus'),
        'dual_sidebar'  => esc_html__('3 - Columns Left/Right', 'magplus'),
      ),
      'default'   => '',
    ),
    array(
      'id'        => 'blog-sidebar-left-local',
      'type'      => 'select',
      'title'     => esc_html__('Sidebar Left', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('blog-sidebar-layout-local', 'equals', array('left_sidebar', 'dual_sidebar')),
    ),
    array(
      'id'        => 'blog-sidebar-right-local',
      'type'      => 'select',
      'title'     => esc_html__('Sidebar Right', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('blog-sidebar-layout-local', 'equals', array('right_sidebar', 'dual_sidebar')),
    ),
    array(
      'id'=>'post-style-local',
      'type' => 'select',
      'title' => esc_html__('Post Style', 'magplus'),
      'subtitle' => esc_html__('Select post style.', 'magplus'),
      'options' => array(
        'default'                    => esc_html__('Default','magplus'),
        'default-title-left-aligned' => esc_html__('Post Title Left','magplus'),
        'default-alt'                => esc_html__('No Hero','magplus'),
        'alternative'                => esc_html__('Big Hero','magplus'),
        'alternative-title-middle'   => esc_html__('Box Hero','magplus'),
        'alternative-big-one'        => esc_html__('Title Below Hero','magplus'),
        'alternative-cover'          => esc_html__('Hero Alternative','magplus'),
      ),
      'default' => '',
    ),
  )
);
