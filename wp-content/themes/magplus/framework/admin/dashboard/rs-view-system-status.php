<?php
/**
 * View System Status
 *
 * @package magplus
 * @since 1.0
 */
require_once 'rs-view-header.php';
$theme_details = wp_get_theme();
?>
<div class="about-wrap rs-admin-wrap">
  <h1><?php echo wp_get_theme()->get('Name'); ?> System Status</h1>
  <div class="about-text"">
    <p>
        Check the system status here. <strong>Yellow status:</strong> Website will work as expected on the front end but it may cause problems in wp-admin. <strong>Memory notice:</strong> Theme is well tested with a limit of 40MB/request but plugins may require more, for example woocommerce requires 64MB. <strong>Pro tip:</strong> If you face any system issues, contact your web hosting and show them the error message. They'll do necessary steps in order to make your system solid &amp; sound (System solely depends on your web hosting).
    </p>
</div>

<!-- Theme Config -->
<table class="widefat rs-system-status-table" cellspacing="0">
  <thead>
    <tr>
      <th colspan="4">Theme Config</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="rs-system-status-name">Theme Name</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-grey"></div>
      </td>
      <td class="rs-system-status-value"><?php echo esc_html($theme_details->get('Name')); ?></td>
    </tr>
    <tr>
      <td class="rs-system-status-name">Version</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-grey"></div>       
      </td>
      <td class="rs-system-status-value"><?php echo esc_html($theme_details->get('Version')); ?></td>
    </tr>
  </tbody>
</table>

<!-- Theme Config -->
<table class="widefat rs-system-status-table" cellspacing="0" style="margin-top: 30px;">
  <thead>
    <tr>
      <th colspan="4">Requried Plugins</th>
    </tr>
  </thead>
  <tbody>

  <?php if(is_plugin_active('js_composer/js_composer.php')): ?>
    <tr>
      <td class="rs-system-status-name">Visual Composer</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-green"></div>
      </td>
      <td class="rs-system-status-value">Active</td>
    </tr>
  <?php else: ?>
    <tr>
      <td class="rs-system-status-name">Visual Composer</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-yellow"></div>
      </td>
      <td class="rs-system-status-value">Deactive<span class="rs-status-small-text"> - Install and Activate Visual Composer Plugin to run MagPlus. <a href="<?php echo admin_url('admin.php?page=page=rs_theme_plugins'); ?>">From Here</a></td>
    </tr>
  <?php endif; ?>
  <?php if(is_plugin_active('redux-framework/redux-framework.php')): ?>
    <tr>
      <td class="rs-system-status-name">Redux Framework</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-green"></div>       
      </td>
      <td class="rs-system-status-value">Active</td>
    </tr>
  <?php else: ?>
    <tr>
      <td class="rs-system-status-name">Redux Framework</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-yellow"></div>       
      </td>
      <td class="rs-system-status-value">Deactive<span class="rs-status-small-text"> - Install and Activate Redux Framework Plugin to run MagPlus. <a href="<?php echo admin_url('admin.php?page=page=rs_theme_plugins'); ?>">From Here</a></td>
    </tr>
  <?php endif; ?>
  <?php if(is_plugin_active('magplus-addons/theme-plugins.php')): ?>
    <tr>
      <td class="rs-system-status-name">MagPlus Addons</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-green"></div>       
      </td>
      <td class="rs-system-status-value">Active</td>
    </tr>
  <?php else: ?>
    <tr>
      <td class="rs-system-status-name">MagPlus Addons</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-yellow"></div>       
      </td>
      <td class="rs-system-status-value">Deactive<span class="rs-status-small-text"> - Install and Activate magplus Addons Plugin to run MagPlus. <a href="<?php echo admin_url('admin.php?page=page=rs_theme_plugins'); ?>">From Here</a></td>
    </tr>
  <?php endif; ?>
  </tbody>
</table>



<!-- PHP INI-->
<table class="widefat rs-system-status-table" cellspacing="0" style="margin-top: 30px;">
  <thead>
    <tr>
      <th colspan="4">PHP Settings</th>
    </tr>
  </thead>
  <tbody>


    <tr>
      <td class="rs-system-status-name">Server Software</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-grey""></div>       
      </td>
      <td class="rs-system-status-value"><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ); ?></td>
    </tr>


    <tr>
      <td class="rs-system-status-name">PHP Version</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-grey""></div>       
      </td>
      <td class="rs-system-status-value"><?php echo esc_html(phpversion()); ?></td>
    </tr>


    <tr>
      <td class="rs-system-status-name">post_max_size</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-grey""></div>       
      </td>
      <td class="rs-system-status-value"><?php echo esc_html(ini_get('post_max_size')); ?><span class="rs-status-small-text"> - You cannot upload images, themes and plugins that have a size bigger than this value. See: <a target="_blank" href="http://www.wpbeginner.com/wp-tutorials/how-to-increase-the-maximum-file-upload-size-in-wordpress/">How to increase post_max_size value.</a></span></td>
    </tr>

    <?php 
      $max_execution_time = ini_get('max_execution_time'); 
      if($max_execution_time == 0 || $max_execution_time >= 60):
    ?>
    <tr>
      <td class="rs-system-status-name">max_execution_time</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-green""></div>       
      </td>
      <td class="rs-system-status-value"><?php echo esc_html($max_execution_time); ?><span class="rs-status-small-text"> - Status : Ok</span></td>
    </tr>
  <?php else: ?>

    <tr>
      <td class="rs-system-status-name">max_execution_time</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-yellow""></div>       
      </td>
      <td class="rs-system-status-value"><?php echo esc_html($max_execution_time); ?><span class="rs-status-small-text"> - the execution time should be bigger than 60 inorder to import our demo content properply. To see how you can change this please check our guide <a target="_blank" href="https://premium.wpmudev.org/blog/increase-memory-limit/">here</a>.</td>
    </tr>

  <?php endif; ?>


  <?php 
      $max_input_vars = ini_get('max_input_vars'); 
      if($max_input_vars == 0 || $max_input_vars >= 2000):
  ?>
    <tr>
      <td class="rs-system-status-name">max_input_vars</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-green""></div>       
      </td>
      <td class="rs-system-status-value"><?php echo esc_html($max_input_vars); ?><span class="rs-status-small-text"> - Status : Ok</span></td>
    </tr>
  <?php else: ?>

    <tr>
      <td class="rs-system-status-name">max_input_vars</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-yellow""></div>       
      </td>
      <td class="rs-system-status-value"><?php echo esc_html($max_input_vars); ?><span class="rs-status-small-text"> - the max_input_vars should be greater than 2000, otherwise it can cause incomplete saves in the menu panel in WordPress. To see how you can change this please check our guide <a target="_blank" href="https://premium.wpmudev.org/forums/topic/increase-wp-memory-limit-php-max-input-vars/">here</a>.</td>
    </tr>

  <?php endif; ?>



  </tbody>
</table>


<!-- Wordpress -->
<table class="widefat rs-system-status-table" cellspacing="0" style="margin-top: 30px;">
  <thead>
    <tr>
      <th colspan="4">WordPress &amp; Plugins Settings</th>
    </tr>
  </thead>
  <tbody>


    <tr>
      <td class="rs-system-status-name">Home URL</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-grey""></div>       
      </td>
      <td class="rs-system-status-value"><?php echo home_url(); ?></td>
    </tr>


    <tr>
      <td class="rs-system-status-name">Site URL</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-grey""></div>       
      </td>
      <td class="rs-system-status-value"><?php echo site_url(); ?></td>
    </tr>

    <?php 
      $memory_limit = magplus_return_bytes(WP_MEMORY_LIMIT);
      if($memory_limit > 67108864):
    ?>
    <tr>
      <td class="rs-system-status-name">WP Memory Limit</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-green""></div>       
      </td>
      <td class="rs-system-status-value"><?php echo esc_html(size_format($memory_limit)); ?>/request<span class="rs-status-small-text"> - Status : Ok</td>
    </tr>
  <?php else: ?>
    <tr>
      <td class="rs-system-status-name">WP Memory Limit</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-yellow""></div>       
      </td>
      <td class="rs-system-status-value"><?php echo esc_html(size_format($memory_limit)); ?>/request<span class="rs-status-small-text"> - We recommend memory to be at least 64MB. The theme is well tested with a 40MB/request limit, but if you are using multiple plugins that may not be enough. See: <a target="_blank" href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP">Increasing memory allocated to PHP</a>.</span></td>
    </tr>
  <?php endif; ?>


  <?php  
      if(defined('WP_DEBUG') and WP_DEBUG === true):
  ?>
    <tr>
      <td class="rs-system-status-name">WP_DEBUG</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-yellow""></div>       
      </td>
      <td class="rs-system-status-value">WP_DEBUG is enabled.<span class="rs-status-small-text"> It may display unsual messages. See: <a target="_blank" href="https://codex.wordpress.org/Debugging_in_WordPress">How to disable WP_DEBUG mode.</a></span></td>
    </tr>
  <?php else: ?>

    <tr>
      <td class="rs-system-status-name">WP_DEBUG</td>
      <td class="rs-system-status-status">
        <div class="rs-system-status-led rs-system-status-info status-green""></div>       
      </td>
      <td class="rs-system-status-value">WP_DEBUG is disabled.</td>
    </tr>

  <?php endif; ?>



  </tbody>
</table>



