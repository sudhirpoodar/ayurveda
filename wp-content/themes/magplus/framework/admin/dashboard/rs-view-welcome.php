<?php
/**
 * View Welcome
 *
 * @package magplus
 * @since 1.0
 */
require_once 'rs-view-header.php';
$theme_details = wp_get_theme();
?>

<div class="rs-admin-wrapper about-wrap">
  <div class="rs-wc-header">
      <h1>Welcome to <?php echo esc_html($theme_details->get('Name')); ?> <div class="rs-theme-version">V<?php echo esc_html($theme_details->get('Version')); ?></div></h1>
      <div class="about-text">
         Thanks for using MagPlus. We've worked for more than 1.5 years to release a great product. Also, we'll continuously work on it to improve it even more by supporting this theme.
      </div>
  </div>

  <div class="feature-section two-column">
  
    <div class="half-width">
      <div class="rs-intro-image">
        <img src="<?php echo get_theme_file_uri('framework/admin/assets/img/dashboard/icons/07.png'); ?>" alt="" >
      </div>
    </div>

    <div class="half-width last-box">
      
      <div class="process-list">
        <h4>Now what ? Follow these steps:</h4>
        <ul>
          <li><span>Step 1:</span>Activate theme with envato purchase code.</li>
          <li><span>Step 2:</span>Activate all plugins.</a></li>
          <li><span>Step 3:</span>Go to "System Status" tab and check if your web hosting settings is good to go.</a></li>
          <li><span>Step 4:</span>Import demos, by going to <a href="<?php echo admin_url('admin.php?page=rs_theme_options&demo_import=active'); ?>">Theme Options > Demo Import.</a></li>
          <li><span>Step 5:</span>Start customizing — go to help center & watch video tutorials.</a></li>
        </ul>
      </div>

    </div>
  
  </div>


</div>
