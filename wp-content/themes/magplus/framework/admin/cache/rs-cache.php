<?php
/**
* Cache Class
*/
if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(!class_exists('RS_Cache')) {
  class RS_Cache {

    public $caching  = '';
    public $index    = '';
    public $dir_path = '';
    public $updated  = false;
    public $is_valid;
    public $config   = array( 'engine' => 'none', 'exclude_query' => '', 'exclude_url' => '' );

    function __construct() {
      $this->is_valid = get_option('purchase_key');
      $this->dir_path = dirname(__FILE__).'/';
      $this->index    = "require_once ( dirname( __FILE__ ) .'/wp-content/themes/magplus/framework/admin/cache/rs-cache-index.php');";
      add_action('admin_init',          array(&$this,  'rs_admin_init'));
      if($this->is_valid):
        add_action('admin_menu',        array(&$this,  'rs_register_cache_tab'));
        add_action('admin_bar_menu',    array( &$this, 'rs_add_admin_bar_menu' ), 99 );
      endif;
      add_action('after_switch_theme',  array(&$this,   'rs_append_index'), 99);
      add_action('switch_theme',        array(&$this,   'rs_remove_index'), 99);
    }

    public function rs_append_index() {
      $indexphp = ABSPATH .'index.php';
      if( is_writeable( $indexphp ) ) {
        $content = file( $indexphp );
        foreach ( $content as $line ) {
          $output[] = $line;
          if ( substr( trim($line), 0, 5 ) == '<?php' ) {
            $output[] = "\r\n". $this->index ."\r\n\r\n";
          }
        }

        file_put_contents( $indexphp, join('', $output ) );
        //$this->flag = false;

      }
    }

    public function rs_remove_index() {
      $indexphp = ABSPATH .'index.php';
      if( is_writeable( $indexphp ) ) {

        $content = file_get_contents( $indexphp );
        $index = "\r\n". $this->index ."\r\n\r\n";
        $content = str_replace( $index, '', $content );

        @file_put_contents( $indexphp, $content  );

      }
    }

    public function rs_admin_init() {
      if(is_admin()) {
        $this->rs_check_index();
      }
    }

    public function rs_check_index() {

      $check    = false;
      $indexphp = ABSPATH .'index.php';
      $content  = file( $indexphp );
      foreach ( $content as $line ) {
        if ( trim( $line ) == $this->index ) {
          $check = true;
        }
      }
      return $check;
    }

    public function rs_add_admin_bar_menu() {

      global $wp_admin_bar;

      $text_flush = 'Flush cache only this page';

      $menus = array(
        array(
          'id'    => 'rs_caching',
          'title' => 'MagPlus Cache',
        ),
        array(
          'id'     => 'rs_caching_flush_page',
          'title'  => ( is_admin() ) ? '<del>'. $text_flush .'</del>' : $text_flush,
          'href'   => ( is_admin() ) ? '#' : remove_query_arg( 'flushall', add_query_arg( 'flushcache', 'do' ) ),
          'parent' => 'rs_caching'
        ),
        array(
          'id'     => 'rs_caching_flush_all',
          'title'  => 'Flush all cache',
          'href'   => remove_query_arg( 'flushcache', add_query_arg( 'flushall', 'do' ) ),
          'parent' => 'rs_caching'
        ),
      );

      foreach ( $menus as $menu ) {

        $wp_admin_bar->add_node( $menu );

      }

    }

    public function rs_register_cache_tab() {
      call_user_func( 'add_'. 'submenu' .'_page', 'rs_theme_welcome', 'MagPlus Cache', 'MagPlus Cache', 'edit_posts', 'rs_theme_cache_settings', array($this, 'rs_theme_cache_settings'));
    }

    public function rs_theme_cache_settings() {
      if ( isset( $_POST['rs_caching'] ) && wp_verify_nonce( $_POST['rs_caching'], 'rs_caching_post' ) ) {

        $this->updated = true;

        if( isset( $_POST['rs_caching_save_and_flush_submit'] ) ) {

          @file_put_contents( $this->dir_path .'config.json', json_encode( $_POST['config'] ) );

        }

        if( isset( $_POST['rs_caching_install_index'] ) ) {
          $this->rs_append_index();
        }

      }

      $this->rs_connecting();

      if( $this->updated ) {
        echo '<div class="updated"><p>Updated settings.</p></div>';
      }

      require 'rs-view-cache.php';
    }

    public function rs_connecting() {

      $config_file = $this->dir_path .'config.json';

      if ( $config_result = file_get_contents( $config_file ) ) {
        $this->config = json_decode( $config_result, true );
      }

      include_once $this->dir_path .'rs-phpfastcache.php';
      $this->caching = new RS_Caching_PhpFastCache();


      if( ! empty( $this->caching ) ) {

        if ( isset( $_GET['flushall'] ) || ( isset( $_POST['rs_caching_save_and_flush_submit'] ) && isset( $_POST['rs_caching'] ) && wp_verify_nonce( $_POST['rs_caching'], 'rs_caching_post' ) ) ) {

          $this->updated = true;
          $this->caching->rs_flush();

        }

      }

    }

  }
  $caching = new RS_Cache();
}
