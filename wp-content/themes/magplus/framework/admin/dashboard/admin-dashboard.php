<?php
/**
* Admin Dashboard
*/
if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(!class_exists('RS_Admin_Dashboard')) {
  class RS_Admin_Dashboard {
    public $is_activated;
    function __construct() {
      $this->rs_init();
    }

    public function rs_init() {
      $this->is_activated = get_option('is_valid');
      add_action('admin_menu', array($this, 'rs_register_theme_panel'));
      add_action('admin_init', array($this, 'rs_theme_redirect'));
      add_action('admin_notices', array($this, 'rs_theme_activate_notice'));
      add_action('admin_bar_menu', array($this, 'rs_add_admin_bar_menu'), 80);
    }

    public function rs_register_theme_panel() {
      call_user_func('add_'. 'menu' .'_page', 'Theme Panel', 'MagPlus', 'edit_posts', 'rs_theme_welcome', array($this, 'rs_view_welcome'), null, 2);
      if(!defined('ENVATO_HOSTED_SITE')):
        call_user_func( 'add_'. 'submenu' .'_page', 'rs_theme_welcome', 'Activate Theme', 'Activate Theme', 'edit_posts', 'rs_theme_activate', array($this, 'rs_theme_activate'));
      endif;
      if (current_user_can( 'activate_plugins' )):
        call_user_func( 'add_'. 'submenu' .'_page', 'rs_theme_welcome', 'Plugins', 'Plugins', 'edit_posts', 'rs_theme_plugins', array( $this, 'rs_theme_plugins' ));
      endif;
      if(!defined('ENVATO_HOSTED_SITE')):
        call_user_func( 'add_'. 'submenu' .'_page', 'rs_theme_welcome', 'System Status', 'System Status', 'edit_posts', 'rs_theme_system_status', array($this, 'rs_theme_system_status'));
      endif;
      call_user_func( 'add_'. 'submenu' .'_page', 'rs_theme_welcome', 'Help Center', 'Help Center', 'edit_posts', 'rs_theme_help_center', array($this, 'rs_theme_help_center'));
      global $submenu;
      $submenu['rs_theme_welcome'][0][0] = 'Welcome';
    }

    public function rs_view_welcome() {
      require_once 'rs-view-welcome.php';
    }

    public function rs_theme_system_status() {
      require_once 'rs-view-system-status.php';
    }

    public function rs_theme_help_center() {
      require_once 'rs-view-help-center.php';
    }

    public function rs_theme_plugins() {
      require_once 'rs-view-plugins.php';
    }

    public function rs_theme_activate() {
      require_once 'rs-view-activate.php';
    }

    public function rs_theme_cache_settings() {
      require_once 'rs-view-cache.php';
    }

    public function rs_theme_activate_notice() {
      if($this->is_activated || defined('ENVATO_HOSTED_SITE')) { return; }
    ?>
      <div class="notice notice-error is-dismissible"> 
        <p></p>
        <p><strong> Please activate <em>MagPlus.</em> This activation enables all features of the theme (i.e. Demo import etc.). This step is taken for mass piracy of our theme, and to serve our paying customers better. </strong></p>
        <p><strong><a href="<?php echo admin_url('admin.php?page=rs_theme_activate'); ?>">Enter purchase code</a></strong></p>
        <p></p>
        <button type="button" class="notice-dismiss">
          <span class="screen-reader-text">Dismiss this notice.</span>
        </button>
      </div>
    <?php
    }

    public function rs_add_admin_bar_menu($wp_admin_bar) {
      if($this->is_activated && class_exists('ReduxFramework')):
        $args = array(
          'id'    => 'rs_demo_import',
          'title' => 'Demo Import',
          'href'  => admin_url('admin.php?page=rs_theme_options&demo_import=active'),
          'meta'  => array( 'class' => 'rs-admin-bar-demo-import' )
        );
      $wp_admin_bar->add_node( $args );
      endif;
      if($this->is_activated == false && !defined('ENVATO_HOSTED_SITE')):
        $args = array(
          'id'    => 'rs_activate_theme',
          'title' => 'Activate Theme',
          'href'  => admin_url('admin.php?page=rs_theme_activate'),
          'meta'  => array( 'class' => 'rs-admin-bar-activate-theme' )
        );
        $wp_admin_bar->add_node( $args );
      endif;
    }

    public function rs_theme_redirect() {
      global $pagenow;
      if ( is_admin() && isset( $_GET['activated'] ) && 'themes.php' == $pagenow ) {
        wp_redirect(admin_url('admin.php?page=rs_theme_welcome')); 
      }
    }
  }
  new RS_Admin_Dashboard();
}
