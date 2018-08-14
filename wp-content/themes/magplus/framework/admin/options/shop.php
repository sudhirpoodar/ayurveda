<?php
/*
 * Shop Section
*/
$this->sections[] = array(
  'title' => esc_html__('Shop', 'magplus'),
  'desc' => esc_html__('Change the shop section configuration.', 'magplus'),
  'icon' => 'fa fa-shopping-bag',
  'fields' => array(
    array(
      'id'    =>'shop-post-per-page',
      'type'  => 'text',
      'title' => esc_html__('Post Per Page', 'magplus'),
    ),
  ), // #fields
);

