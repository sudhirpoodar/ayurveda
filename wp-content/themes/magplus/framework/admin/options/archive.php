<?php
/*
 * Advanced
*/
$this->sections[] = array(
  'title' => esc_html__('Archive Page', 'magplus'),
  'desc' => esc_html__('Archive page confugration.', 'magplus'),
  'icon'  => 'fa fa-file-archive-o',
  'fields' => array(
    array(
      'id'        => 'archive-sidebar-layout',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Layout', 'magplus'),
      'subtitle'  => esc_html__('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'magplus'),
      'options'   => array(
        'default'       => esc_html__('1 Column', 'magplus'),
        'left_sidebar'  => esc_html__('2 - Columns Left', 'magplus'),
        'right_sidebar' => esc_html__('2 - Columns Right', 'magplus'),
        'dual_sidebar'  => esc_html__('3 - Columns Left/Right', 'magplus'),
      ),
      'default'   => 'default',
    ),
    array(
      'id'        => 'archive-sidebar-left',
      'type'      => 'select',
      'title'     => esc_html__('Sidebar Left', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('archive-sidebar-layout', 'equals', array('left_sidebar', 'dual_sidebar')),
    ),
    array(
      'id'        => 'archive-sidebar-right',
      'type'      => 'select',
      'title'     => esc_html__('Sidebar Right', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('archive-sidebar-layout', 'equals', array('right_sidebar', 'dual_sidebar')),
    ),
    array(
      'id'=>'archive-enable-post-category',
      'type' => 'switch',
      'title' => esc_html__('Category', 'magplus'),
      'subtitle'=> esc_html__('If on, post share section will be displayed on a single post page.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'=>'archive-enable-post-comment',
      'type' => 'switch',
      'title' => esc_html__('Comment', 'magplus'),
      'subtitle'=> esc_html__('If on, post share section will be displayed on a single post page.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'=>'archive-enable-post-author',
      'type' => 'switch',
      'title' => esc_html__('Author', 'magplus'),
      'subtitle'=> esc_html__('If on, post share section will be displayed on a single post page.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'=>'archive-enable-post-date',
      'type' => 'switch',
      'title' => esc_html__('Date', 'magplus'),
      'subtitle'=> esc_html__('If on, post share section will be displayed on a single post page.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'=>'post-enable-post-view',
      'type' => 'switch',
      'title' => esc_html__('View', 'magplus'),
      'subtitle'=> esc_html__('If on, post share section will be displayed on a single post page.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),

  ), // #fields
);
