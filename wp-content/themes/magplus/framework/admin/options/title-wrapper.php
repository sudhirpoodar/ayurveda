<?php
/*
 * Title Wrapper Section
*/

$this->sections[] = array(
  'title' => esc_html__('Title Wrapper', 'magplus'),
  'desc' => esc_html__('Change the title wrapper section configuration.', 'magplus'),
  'icon' => 'fa fa-window-restore',
  'fields' => array(

    array(
      'id' => 'title-wrapper-enable',
      'type'   => 'switch',
      'title' => esc_html__('Enable Title Wrapper', 'magplus'),
      'subtitle'=> esc_html__('If on, this layout part will be displayed.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'       =>'page-header',
      'type'     => 'media',
      'url'      => true,
      'title'    => esc_html__('Background', 'magplus'),
      'subtitle' => esc_html__('Title wrapper background, color and other options.', 'magplus'),
    ),
    array(
      'id'        => 'title-wrapper-background-color',
      'type'      => 'color',
      'title'     => esc_html__('Background Color', 'magplus'),
      'default'   => '',
      'output'    => array('background' => '.tt-heading.title-wrapper')
    ),
    array(
      'id'             => 'title-wrapper-typo',
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
      'id'        => 'title-wrapper-subheading',
      'type'      => 'text',
      'title'     => esc_html__('Sub Heading', 'magplus'),
      'default'   => '',
    ),
    array(
      'id'        => 'title-wrapper-padding-top',
      'type'      => 'text',
      'title'     => esc_html__('Padding Top', 'magplus'),
      'default'   => '',
      'desc'      => 'Add padding top (optional)'
    ),
    array(
      'id'        => 'title-wrapper-padding-bottom',
      'type'      => 'text',
      'title'     => esc_html__('Padding Bottom', 'magplus'),
      'default'   => '',
      'desc'      => 'Add padding bottom (optional)'
    ),
  ), // #fields
);
