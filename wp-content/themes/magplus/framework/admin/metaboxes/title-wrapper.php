<?php
/*
 * Title Wrapper Section
*/
$sections[] = array(
  'title' => esc_html__('Title Wrapper', 'magplus'),
  'desc' => esc_html__('Change the title wrapper section configuration.', 'magplus'),
  'icon' => 'fa fa-window-restore',
  'fields' => array(

    array(
      'id'       => 'title-wrapper-enable-local',
      'type'     => 'button_set',
      'title'    => esc_html__('Enable Title Wrapper', 'magplus'),
      'subtitle' => esc_html__('If on, this layout part will be displayed.', 'magplus'),
      'options' => array(
        '1' => 'On',
        ''  => 'Default',
        '0' => 'Off',
      ),
      'default' => '',
    ),
        array(
      'id'       =>'page-header-local',
      'type'     => 'media',
      'url'      => true,
      'title'    => esc_html__('Background', 'magplus'),
      'subtitle' => esc_html__('Title wrapper background, color and other options.', 'magplus'),
    ),
    array(
      'id'        => 'title-wrapper-background-color-local',
      'type'      => 'color',
      'title'     => esc_html__('Background Color', 'magplus'),
      'default'   => '',
      'output'    => array('background' => '.tt-heading.title-wrapper')
    ),
    array(
      'id'             => 'title-wrapper-typo-local',
      'type'           => 'typography',
      'title'          => esc_html__('Font Properties', 'magplus'),
      'font-size'      => true,
      'line-height'    => true,
      'text-align'     => true,
      'font-weight'    => true,
      'color'          => true,
      'text-transform' => true,
      'output'         => array('.tt-heading-title'),
    ),
    array(
      'id'        => 'title-wrapper-subheading-local',
      'type'      => 'text',
      'title'     => esc_html__('Sub Heading', 'magplus'),
      'default'   => '',
    ),
    array(
      'id'        => 'title-wrapper-padding-top-local',
      'type'      => 'text',
      'title'     => esc_html__('Padding Top', 'magplus'),
      'default'   => '',
      'desc'      => 'Add padding top (optional)'
    ),
    array(
      'id'        => 'title-wrapper-padding-bottom-local',
      'type'      => 'text',
      'title'     => esc_html__('Padding Bottom', 'magplus'),
      'default'   => '',
      'desc'      => 'Add padding bottom (optional)'
    ),
  ), // #fields
);
