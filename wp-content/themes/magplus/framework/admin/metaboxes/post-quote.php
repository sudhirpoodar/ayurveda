<?php
/*
 * Post
*/
$sections[] = array(
  'icon' => 'el-icon-screen',
  'fields' => array(
    array(
      'id'        => 'post-quote-text',
      'type'      => 'textarea',
      'title'     => esc_html__('Quote Text', 'magplus'),
      'default'   => '',
    ),
    array(
      'id'        => 'post-quote-cite',
      'type'      => 'text',
      'title'     => esc_html__('Cite', 'magplus'),
      'subtitle'  => esc_html__('Enter name', 'magplus'),
      'default'   => '',
    ),
  )
);
