<?php
/*
 * AMP
*/
$this->sections[] = array(
  'title' => esc_html__('AMP', 'magplus'),
  'desc' => esc_html__('Google AMP configuration.', 'magplus'),
  'icon' => 'fa fa-mobile',
  'fields' => array(
    array(
      'id'       => 'random-number-2',
      'type'     => 'info',
      'desc'     => '<h3 style="color:#303539;">'.wp_kses_data('<strong>Note:</strong> You should install and activate MagPlus AMP plugin before playing with these options.').'</h3>',
    ),
    array(
      'id'       =>'amp-logo',
      'type'     => 'media',
      'url'      => true,
      'title'    => esc_html__('Logo', 'magplus'),
      'subtitle' => esc_html__('Recommend Size 105 x 56.', 'magplus'),
    ),
    array(
      'id' => 'amp-featured-image-enable-switch',
      'type' => 'switch',
      'title' => esc_html__('Enable Featured Image', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id' => 'amp-author-date-enable-switch',
      'type' => 'switch',
      'title' => esc_html__('Enable Author and Date', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id' => 'amp-tags-enable-switch',
      'type' => 'switch',
      'title' => esc_html__('Enable Tags', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'    =>'amp-footer-copyright-text',
      'type'  => 'text',
      'title' => esc_html__('Copyright Text', 'magplus'),
    ),
    array(
      'id'       => 'random-number-5',
      'type'     => 'info',
      'desc'     => '<h3 style="color:#303539;">'.esc_html__('Google Ads Options', 'magplus').'</h3>',
    ),
    array(
      'id' => 'amp-ads-enable-switch',
      'type' => 'switch',
      'title' => esc_html__('Enable Google Ads', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
    ),
    array(
      'id'      =>'amp-google-client-id',
      'type'    => 'text',
      'title'   => esc_html__('Client ID', 'magplus'),
      'default' => '',
      'desc'    => 'Add google client id e.g ca-pub-xxxxxxxxxxxxxxxxx'
    ),

    array(
      'id'      =>'amp-google-slot-id',
      'type'    => 'text',
      'title'   => esc_html__('Slot ID', 'magplus'),
      'default' => '',
      'desc'    => 'Add google slot id e.g 3250103443'
    ),
    array(
      'id'       => 'random-number-6',
      'type'     => 'info',
      'desc'     => '<h3 style="color:#303539;">'.esc_html__('Social Share Options', 'magplus').'</h3>',
    ),
    array(
      'id' => 'amp-enable-social-share',
      'type' => 'switch',
      'title' => esc_html__('Enable Social Share', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'      =>'amp-fb-app-id',
      'type'    => 'text',
      'title'   => esc_html__('Facebook APP ID', 'magplus'),
      'default' => '',
      'desc'    => 'Add facebook app id https://developers.facebook.com/docs/apps/register/'
    ),
    array(
      'id'       => 'random-number-4',
      'type'     => 'info',
      'desc'     => '<h3 style="color:#303539;">'.esc_html__('Styling Options', 'magplus').'</h3>',
    ),
    array(
      'id'      =>'amp-title-color',
      'type'    => 'color',
      'title'   => esc_html__('Post Title Color', 'magplus'),
      'default' => '#111111'
    ),
    array(
      'id'    =>'amp-author-color',
      'type'  => 'color',
      'title' => esc_html__('Author Meta Color', 'magplus'),
      'default' => '#111111'
    ),
    array(
      'id'    =>'amp-date-color',
      'type'  => 'color',
      'title' => esc_html__('Date Meta Color', 'magplus'),
      'default' => '#b5b5b5'
    ),
    array(
      'id'    =>'amp-content-color',
      'type'  => 'color',
      'title' => esc_html__('Post Content Color', 'magplus'),
      'default' => '#666666'
    ),
    array(
      'id'    =>'amp-tags-color',
      'type'  => 'color',
      'title' => esc_html__('Meta Tag Color', 'magplus'),
      'default' => '#4f4f4f'
    ),
  ), // #fields
);

