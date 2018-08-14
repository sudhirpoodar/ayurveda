<?php
/*
 * Content Section
*/

$sections[] = array(
  'title' => esc_html__('Content', 'magplus'),
  'desc' => esc_html__('Change the content section configuration.', 'magplus'),
  'icon' => 'fa fa-sliders',
  'fields' => array(
    array(
      'id'        => 'page-margin',
      'type'      => 'select',
      'title'     => esc_html__('Content Margin', 'magplus'),
      'subtitle'  => esc_html__('Select desired margin for the content', 'magplus'),
      'options'   => array(
        'top-bottom'  => esc_html__('Top & bottom margin', 'magplus'),
        'only-top'    => esc_html__('Only top margin', 'magplus'),
        'only-bottom' => esc_html__('Only bottom margin', 'magplus'),
        'no-margin'   => esc_html__('No margin', 'magplus'),
      ),
      'default' => 'top-bottom',
    ),
    array(
      'id'       => 'page-show-special-content-before-content',
      'type'     => 'switch', 
      'title'    => esc_html__('Show Special Content Before Page Content', 'magplus'),
      'subtitle' => esc_html__('If on, selected page content will be displayed before content.', 'magplus'),
      'default'  => 0,
    ),
    array(
      'id'       => 'page-before-special-content',
      'type'     => 'select',
      'title'    => esc_html__('Special Content Displayed Before Content', 'magplus'),
      'subtitle' => esc_html__('Select special content item to be displayed before page content', 'magplus'),
      'options'  => magplus_get_special_content_array(),
      'default'  => '',
      'required' => array('page-show-special-content-before-content' ,'=', '1')
    ),
    array(
      'id'       => 'page-show-special-content-after-content',
      'type'     => 'switch', 
      'title'    => esc_html__('Show Special Content After Page Content', 'magplus'),
      'subtitle' => esc_html__('If on, selected page content will be displayed after content.', 'magplus'),
      'default'  => 0,
    ),
    
    array(
      'id'       => 'page-after-special-content',
      'type'     => 'select',
      'title'    => esc_html__('Special Content Displayed After Content', 'magplus'),
      'subtitle' => esc_html__('Select special content item to be displayed after page content', 'magplus'),
      'options'  => magplus_get_special_content_array(),
      'default'  => '',
      'required' => array('page-show-special-content-after-content' ,'=', '1')
    ),
  ),
);
