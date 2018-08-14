<?php
/*
 * Footer Section
*/
$this->sections[] = array(
  'title' => esc_html__('Footer', 'magplus'),
  'desc' => esc_html__('Change the footer section configuration.', 'magplus'),
  'icon' => 'fa fa-list-alt',
  'fields' => array(

    array(
      'id' => 'footer-enable-switch',
      'type' => 'switch',
      'title' => esc_html__('Enable Footer', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'subtitle' => esc_html__('If on, this layout part will be displayed.', 'magplus'),
    ),
    array(
      'id'       => 'random-number-2',
      'type'     => 'info',
      'desc'     => '<p style="color:#303539;">'.wp_kses_data('<em>Please go to <a target="_blank" href="'.admin_url('widgets.php').'">Apperance > Widgets</a> section and watch this video tutorial on how to configure instagram footer <a target="_blank" href="https://youtu.be/zZywysNVJ4A?list=PLXrHHgyJRjXPWKqWUrIWGbVDcapMmxGh7">watch this</a></em>', 'magplus').'</p>',
      'required' => array('footer-template', 'equals', array('footer-style2')),
    ),
    array(
      'id'        => 'footer-template',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Footer Template', 'magplus'),
      'subtitle'  => esc_html__('Select footer layout.', 'magplus'),
      'options'   => array(
        'footer-style1' => esc_html__('Footer Style 1', 'magplus'),
        'footer-style2' => esc_html__('Footer Style 2', 'magplus'),
        'footer-style3' => esc_html__('Footer Style 3', 'magplus'),
      ),
      'default'   => 'footer-style1',
    ), 
    array(
      'id'        => 'footer-column',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Footer Columns', 'magplus'),
      'subtitle'  => esc_html__('Select footer column.', 'magplus'),
      'options'   => array(
        '4' => esc_html__('Column 4', 'magplus'),
        '3' => esc_html__('Column 3', 'magplus'),
        '2' => esc_html__('Column 2', 'magplus'),
        '1' => esc_html__('Column 1', 'magplus'),
      ),
      'default'   => '4',
      'required'  => array('footer-template', 'equals', array('footer-style1')),
    ),
    array(
      'id'        => 'footer-sidebar-1',
      'type'      => 'select',
      'title'     => esc_html__('Footer Sidebar 1', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('footer-column', 'equals', array('4', '3', '2', '1')),
    ),
    array(
      'id'        => 'footer-sidebar-2',
      'type'      => 'select',
      'title'     => esc_html__('Footer Sidebar 2', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('footer-column', 'equals', array('4', '3', '2')),
    ),
    array(
      'id'        => 'footer-sidebar-3',
      'type'      => 'select',
      'title'     => esc_html__('Footer Sidebar 3', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('footer-column', 'equals', array('4', '3')),
    ),
    array(
      'id'        => 'footer-sidebar-4',
      'type'      => 'select',
      'title'     => esc_html__('Footer Sidebar 4', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('footer-column', 'equals', array('4')),
    ),
    array(
      'id'       =>'footer-slider-heading',
      'type'     => 'text',
      'title'    => esc_html__('Slider Heading', 'magplus'),
      'default'  => 'Trending & Hot',
      'required' => array('footer-template', 'equals', array('footer-style3')),
    ),
    array(
      'id'       =>'footer-no-slides',
      'type'     => 'text',
      'title'    => esc_html__('No of slides', 'magplus'),
      'required' => array('footer-template', 'equals', array('footer-style3')),
      'default'  => '5'
    ),
    array(
      'id' => 'random-number',
      'type' => 'info',
      'desc' => '<h3 style="color:#303539;font-weight:500;">'.esc_html__('Copyright Configuration', 'magplus').'</h3>'
    ),
    array(
      'id'    =>'footer-copyright-text',
      'type'  => 'text',
      'title' => esc_html__('Copyright Text', 'magplus'),
    ),
  ), // #fields
);

