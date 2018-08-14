<?php
/*
 * Auto Update
*/
$this->sections[] = array(
  'title' => esc_html__('Theme Auto Update', 'magplus'),
  'icon' => 'fa fa-download',
  'fields' => array(
    array(
      'id'    =>'envato_username',
      'type'  => 'text',
      'title' => esc_html__('Envato Username', 'magplus'),
    ),
    array(
      'id'    =>'envato_apikey',
      'type'  => 'text',
      'title' => esc_html__('Envato API Key', 'magplus'),
      'desc'     => '<p style="color:#303539;">'.wp_kses_data('<em>Please go to <a target="_blank" href="https://help.market.envato.com/hc/en-us/articles/204498284-How-to-get-an-API-Key">https://help.market.envato.com/hc/en-us/articles/204498284-How-to-get-an-API-Key</a></em>', 'magplus').'</p>',
    ),
  ), // #fields
);

