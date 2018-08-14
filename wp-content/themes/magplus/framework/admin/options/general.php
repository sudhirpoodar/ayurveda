<?php
/*
 * General Section
*/
$this->sections[] = array(
  'title' => esc_html__('General', 'magplus'),
  'desc' => esc_html__('Configure general styles.', 'magplus'),
  'icon'  => 'fa fa-toggle-on',
  'subsection' => true,
  'fields'  => array(
    array(
      'id' => 'general-loader-enable-switch',
      'type' => 'switch',
      'title' => esc_html__('Enable Loader', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
      'subtitle' => esc_html__('If on, this layout part will be displayed.', 'magplus'),
    ),
    array(
      'id' => 'general-homepage-duplicate-switch',
      'type' => 'switch',
      'title' => esc_html__('No Duplicate Posts In Homepage Blocks?', 'magplus'),
      'options' => array(
        '1' => 'Yes',
        '0' => 'No',
      ),
      'on'  => 'Yes',
      'off' => 'No',
      'desc' => esc_html__('If you have a lot of content or when you are using latest posts slider, you can see duplicate in featured area and homepage blocks. Setting this feature to Yes will remove duplicates.'),
      'default' => '0',
    ),
    array(
      'id'        => 'page-layout',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Page Layout', 'magplus'),
      'subtitle'  => esc_html__('Select page layout.', 'magplus'),
      'options'   => array(
        'full-page'       => esc_html__('Full', 'magplus'),
        'boxed'  => esc_html__('Boxed', 'magplus'),
      ),
      'default'   => 'full-page',
    ),
    array(
      'id'        => 'theme-skin',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Theme Skin', 'magplus'),
      'subtitle'  => esc_html__('Select theme skin color.', 'magplus'),
      'options'   => array(
        'theme-default' => esc_html__('Default', 'magplus'),
        'theme-accent'  => esc_html__('Accent', 'magplus'),
      ),
      'default'   => 'theme-default',
    ),
    array(
      'id'        => 'theme-skin-accent-first',
      'type'      => 'color',
      'title'     => esc_html__('Accent Color', 'magplus'),
      'desc'     => esc_html__( 'This color is main color.', 'magplus' ),
      'default'   => '',
      'required'  => array('theme-skin', 'equals', array('theme-accent')),
    ),
    array(
      'id'        => 'main-layout',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Main Layout', 'magplus'),
      'subtitle'  => esc_html__('Select main content and sidebar alignment. Choose between 1 or 2 column layout.', 'magplus'),
      'options'   => array(
        'default'       => esc_html__('1 Column', 'magplus'),
        'left_sidebar'  => esc_html__('2 - Columns Left', 'magplus'),
        'right_sidebar' => esc_html__('2 - Columns Right', 'magplus'),
        'dual_sidebar'  => esc_html__('3 - Columns Left/Right', 'magplus'),
      ),
      'default'   => 'default',
    ),
    array(
      'id'        => 'sidebar',
      'type'      => 'select',
      'title'     => esc_html__('Sidebar Left', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('main-layout', 'equals', array('left_sidebar', 'dual_sidebar')),
    ),
    array(
      'id'        => 'sidebar-right',
      'type'      => 'select',
      'title'     => esc_html__('Sidebar Right', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('main-layout', 'equals', array('right_sidebar', 'dual_sidebar')),
    ),
    array(
      'id'       => 'custom-sidebars',
      'type'     => 'multi_text',
      'title'    => esc_html__( 'Custom Sidebars', 'magplus' ),
      'subtitle' => esc_html__( 'Custom sidebars can be assigned to any page or post.', 'magplus' ),
      'desc'     => esc_html__( 'You can add as many custom sidebars as you need.', 'magplus' )
    ),
    array(
      'id'        => 'sidebar-heading-style',
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
      'default'   => 'style1',
    ),
    array(
      'id'        => 'paged-template',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Pagination Template', 'magplus'),
      'options'   => array(
        'default' => esc_html__('Default', 'magplus'),
        'masonry' => esc_html__('Masonry', 'magplus')
      ),
      'default'   => 'default',
    ),
  ),
);



