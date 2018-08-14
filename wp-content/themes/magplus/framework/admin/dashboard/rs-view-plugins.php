<?php
/**
 * View Plugins
 *
 * @package magplus
 * @since 1.0
 */

if (current_user_can( 'activate_plugins' )) {
  if (isset($_GET['rs_deactivate_plugin_slug'])) {
    $rs_deactivate_plugin_slug = $_GET['rs_deactivate_plugin_slug'];
    if (!empty($rs_deactivate_plugin_slug)) {
      $plugins = TGM_Plugin_Activation::$instance->plugins;
      //var_dump($plugins);
      foreach ($plugins as $plugin) {
        if ($plugin['slug'] == $rs_deactivate_plugin_slug) {
          deactivate_plugins($plugin['file_path']); ?>
          <script type="text/javascript">
            window.location = "admin.php?page=rs_theme_plugins";
          </script>
          <?php
          break;
        }
      }
    }
  }

  if (isset($_GET['rs_activate_plugin_slug'])) {
    $rs_activate_plugin_slug = $_GET['rs_activate_plugin_slug'];
    if (!empty($rs_activate_plugin_slug)) {
      $plugins = TGM_Plugin_Activation::$instance->plugins;
      foreach ($plugins as $plugin) {
        if ($plugin['slug'] == $rs_activate_plugin_slug) {
            activate_plugins($plugin['file_path']); ?>
            <script type="text/javascript">
                window.location = "admin.php?page=rs_theme_plugins";
            </script>
            <?php
            break;
        }
      }
    }
  }
}


require_once 'rs-view-header.php'; 


$plugin_list          = get_plugins();
$rs_tgm_theme_plugins = TGM_Plugin_Activation::$instance->plugins;


?>


<div class="about-wrap theme-browser">
  <h1>Install Plugins</h1>
  <div class="about-text">
      <p>
        Install all the plugins from this panel. Note that, you can't update  some of these plugins on your own as per Envato policy. You can, however, use these premium plugins for free. Don't worry — we update these plugins with our theme update.<br>
        For more info: <a href="https://goo.gl/kNxxQn">https://goo.gl/kNxxQn</a>
      </p>
  </div>

</div>

<div class="rs-plugins-wrapper about-wrap theme-browser">
  <?php 
    foreach($rs_tgm_theme_plugins as $rs_tgm_theme_plugin):
    //var_dump($rs_tgm_theme_plugin['file_path']); 
      // check plugin exist or not
      $label = $rs_tgm_theme_plugin['text'];
      if(isset($rs_tgm_theme_plugin['file_path'])):
        if(is_plugin_active($rs_tgm_theme_plugin['file_path'])):
          $class = 'plugin-active';
          $label = 'Active';
        elseif (isset($plugin_list[$rs_tgm_theme_plugin['file_path']])):
          $class = 'plugin-deactived';
        else:
          $class = 'plugin-not-installed';
        endif;
      else:
        $class = 'plugin-not-installed';
      endif;

      //echo $class;

      //var_dump($api);

      //require_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // Need for plugins_api.


  ?>


  <div class="rs-plugin-box col-4 <?php echo esc_attr($class); ?>">
    <div class="rs-plugin-image">
      <img src="<?php echo esc_url($rs_tgm_theme_plugin['img_url']); ?>" alt="" >
    </div>

    <div class="rs-plugin-content-box">

      <div clsss="rs-plugin-name">
        <h3><?php echo esc_html($rs_tgm_theme_plugin['name']); ?></h3>
      </div>

      <div class="rs-plugin-text">
        <p><?php echo esc_html($label); ?></p>
      </div>

      <div class="theme-actions">
        <a class="btn-style-1 btn-blue rs-button-install-plugin" href="<?php
        echo esc_url( wp_nonce_url(
          add_query_arg(
            array(
              'page'          => urlencode(TGM_Plugin_Activation::$instance->menu),
              'plugin'        => urlencode($rs_tgm_theme_plugin['slug']),
              'plugin_name'   => urlencode($rs_tgm_theme_plugin['name']),
              'plugin_source' => urlencode($rs_tgm_theme_plugin['source']),
              'tgmpa-install' => 'install-plugin',
              'return_url'    => 'rs_theme_plugins'
            ),
            admin_url('themes.php')
          ),
          'tgmpa-install'
        ));
        ?>">Install</a>
        <a class="btn-style-1 rs-button-deactivate-plugin" href="<?php
        echo esc_url(
          add_query_arg(
            array(
              'page'                      => urlencode('rs_theme_plugins'),
              'rs_deactivate_plugin_slug' => urlencode($rs_tgm_theme_plugin['slug']),
            ),
            admin_url('admin.php')
          ));
        ?>">Deactivate</a>

        <a class="btn-style-1 btn-blue rs-button-activate-plugin" href="<?php
        echo esc_url(
          add_query_arg(
            array(
              'page'                    => urlencode('rs_theme_plugins'),
              'rs_activate_plugin_slug' => urlencode($rs_tgm_theme_plugin['slug']),
            ),
            admin_url('admin.php')
          ));
        ?>">Activate</a>
      </div>

    </div>


  </div>

  <?php endforeach; ?>
</div>