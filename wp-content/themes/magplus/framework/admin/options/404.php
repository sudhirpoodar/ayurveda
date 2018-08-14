<?php
/*
 * Title Wrapper Section
*/

$this->sections[] = array(
  'title' => esc_html__('404 Page', 'magplus'),
  'desc' => esc_html__('Change the title wrapper section configuration.', 'magplus'),
  'icon' => 'fa fa-window-close-o',
  'fields' => array(
    array(
      'id'=>'page404-content',
      'type' => 'textarea',
      'title' => esc_html__('Content', 'magplus'),
      'subtitle' => esc_html__('Content for 404 page.', 'magplus'),
    ),
  ), // #fields
);
