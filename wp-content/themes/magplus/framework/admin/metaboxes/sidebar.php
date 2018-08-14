<?php
/*
 * Sidebar Section
*/

$sections[] = array(
  'title' => esc_html__('Sidebar', 'magplus'),
  'desc' => esc_html__('Change the sidebar and configure it.', 'magplus'),
  'icon' => 'fa fa-trello',
  'fields' => array(
    array(
      'id'        => 'main-layout-local',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Main Layout', 'magplus'),
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
      'id'        => 'sidebar-local',
      'type'      => 'select',
      'title'     => esc_html__('Sidebar Left', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('main-layout-local', 'equals', array('left_sidebar', 'dual_sidebar')),
    ),
    array(
      'id'        => 'sidebar-right-local',
      'type'      => 'select',
      'title'     => esc_html__('Sidebar Right', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('main-layout-local', 'equals', array('right_sidebar', 'dual_sidebar')),
    ),
    array(
      'id'        => 'sidebar-heading-style-local',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Heading Style', 'magplus'),
      'options'   => array(
        'style1' => esc_html__('Style 1', 'magplus'),
        'style2' => esc_html__('Style 2', 'magplus'),
        'style3' => esc_html__('Style 3', 'magplus'),
        'style4' => esc_html__('Style 4', 'magplus'),
        'style5' => esc_html__('Style 5', 'magplus'),
        'style6' => esc_html__('Style 6', 'magplus'),
      ),
      'default'   => '',
    ),
  ),
);
