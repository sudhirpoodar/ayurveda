<?php
$this->sections[] = array(
  'title' => esc_html__('Import/Export', 'magplus'),
  'desc' => esc_html__('Import/Export Options', 'magplus'),
  'icon' => 'fa fa-retweet',
  'fields' => array(

    array(
      'id'            => 'opt-import-export',
      'type'          => 'import_export',
      'title'         => esc_html__('Import Export', 'magplus'),
      'subtitle'      => esc_html__('Save and restore your Redux options', 'magplus'),
      'full_width'    => false,
    ),
  ),
);
