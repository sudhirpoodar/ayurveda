<?php
/*
 * Post
*/
$sections[] = array(
  'icon' => 'el-icon-screen',
  'fields' => array(
    array(
      'id'        => 'post-gallery',
      'type'      => 'slides',
      'title'     => esc_html__('Gallery Slider', 'magplus'),
      'subtitle'  => esc_html__('Upload images or add from media library.', 'magplus'),
      'placeholder'   => array(
        'title'         => esc_html__('Title', 'magplus'),
      ),
      'show' => array(
        'title'       => true,
        'description' => true,
        'url'         => true,
      )
    ),
  )
);
