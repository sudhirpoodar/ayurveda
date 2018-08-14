<?php

$sections[] = array(
  'title' => esc_html__(' Slider', 'magplus'),
  'icon' => 'fa fa-pause',
  'fields' => array(
    array(
      'id' => 'slider-enable-switch-local',
      'type' => 'button_set',
      'title' => esc_html__('Enable Slider', 'magplus'),
      'options' => array(
        '1' => 'On',
        '' => 'Default',
        '0' => 'Off',
      ),
      'default' => '',
      'subtitle' => esc_html__('If on, slider will be displayed.', 'magplus'),
    ),
  )
);