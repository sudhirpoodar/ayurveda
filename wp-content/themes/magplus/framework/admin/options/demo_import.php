<?php

$demo_notice = array();
if ( ! function_exists( 'is_plugin_active' ) ) {
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
}

if(is_plugin_active('wordpress-importer/wordpress-importer.php')) {
  $demo_notice = array(
    'id'       => 'demo-notice',
    'type'     => 'info',
    'desc'     => '<h3 style="color:#555d66;">Demo import stuck at 0% ? <a href="'.admin_url('plugins.php').'">WordPress Importer</a> plugin is activated or installed please deactivate before using our demo import.</h3>',
  );
}
$this->sections[] = array(
  'id' => 'wbc_importer_section',
  'title'  => esc_html__( 'Demo Import', 'magplus' ),
  'icon'   => 'fa fa-upload',
  'fields' => array(
    array(
      'id'       => 'demo-info',
      'type'     => 'info',
      'desc'     => '<h3 style="color:#555d66;"> Importing a demo will create pages, posts, add images, theme options, widgets and others. IMPORTANT: Please check <a href="'.admin_url('admin.php?page=rs_theme_system_status').'">system status</a> before importing demo content after that install and activate required plugins before to import any demo NOTE: If after installing a demo, you want to install another, please delete special content pages and home page.
      </h3>',
    ),
    $demo_notice,
    array(
      'id'   => 'wbc_demo_importer',
      'type' => 'wbc_importer'
    ),
  ),
);

