<?php
/*
 * Custom Code
*/

$this->sections[] = array(
  'title' => esc_html__('Custom CSS', 'magplus'),
  'desc' => esc_html__('Easily add custom CSS to your website.', 'magplus'),
  'icon' => 'fa fa-css3',
  'fields' => array(

    array(
        'id'       => 'css_editor',
        'type'     => 'ace_editor',
        'title'    => esc_html__('CSS Code', 'magplus'),
        'subtitle' => esc_html__('Insert your custom CSS code right here. It will be displayed globally in the website.', 'magplus'),
        'mode'     => 'css',
        'theme'    => 'monokai',
        'desc'     => '',
        'default'  => ""
    )
  ),
);
