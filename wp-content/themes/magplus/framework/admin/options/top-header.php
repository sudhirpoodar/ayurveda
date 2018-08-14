<?php
/*
 * Top Header Section
*/
$this->sections[] = array(
  'title' => esc_html__('Top Header', 'magplus'),
  'desc' => esc_html__('Change the header section configuration.', 'magplus'),
  'icon'  => 'fa fa-columns',
  'fields' => array(
    array(
      'id'    => 'top-header-enable',
      'type'  => 'switch',
      'title' => esc_html__('Enable Top Header', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default'  => '1',
      'subtitle' => esc_html__('If on, this layout part will be displayed.', 'magplus'),
    ),
    array(
      'id'       => 'top-social-icons-category',
      'type'     => 'select',
      'title'    => esc_html__('Social Icons Category', 'magplus'),
      'subtitle' => esc_html__('Select desired category', 'magplus'),
      'options'  => magplus_get_terms_assoc('social-site-category'),
      'default'  => '',
    ),
  ), 
);
