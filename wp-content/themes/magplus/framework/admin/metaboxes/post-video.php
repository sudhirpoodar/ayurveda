<?php
/*
 * Post
*/
$sections[] = array(
  'icon' => 'el-icon-screen',
  'fields' => array(
    array(
      'id'        => 'post-video-url',
      'type'      => 'text',
      'title'     => esc_html__('Video URL', 'magplus'),
      'subtitle'  => esc_html__('Youtube Video URL for e.g http://www.youtube.com/embed/wTcNtgA6gHs', 'magplus'),
      'default'   => '',
    ),
    array(
      'id'        => 'post-video-length',
      'type'      => 'text',
      'title'     => esc_html__('Video Length', 'magplus'),
      'subtitle'  => esc_html__('Youtube Video Length', 'magplus'),
      'default'   => '',
    ),
  )
);
