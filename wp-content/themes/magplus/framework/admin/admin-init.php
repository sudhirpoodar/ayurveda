<?php

if(is_admin() && current_user_can('switch_themes')):
  require get_theme_file_path('framework/admin/dashboard/admin-dashboard.php');
endif;
$is_valid = get_option('purchase_key');
if($is_valid == true):
  require get_theme_file_path('framework/admin/cache/rs-cache.php');
endif;

require_once get_theme_file_path('framework/admin/redux-extensions/extensions-init.php');
require_once get_theme_file_path('framework/admin/metaboxes-init.php');
require_once get_theme_file_path('framework/admin/options-init.php');
