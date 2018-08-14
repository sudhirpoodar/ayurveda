<?php
/*
 * Post
*/
$sections[] = array(
  'icon' => 'el-icon-screen',
  'fields' => array(
    array(
      'id'        => 'post-audio-url',
      'type'      => 'text',
      'title'     => esc_html__('Audio URL', 'magplus'),
      'subtitle'  => esc_html__('Soundcloud URL for e.g https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/302683451&auto_play=false', 'magplus'),
      'default'   => '',
    ),
  )
);
