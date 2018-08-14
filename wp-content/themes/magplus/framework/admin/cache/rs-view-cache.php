<?php
/**
 * View Header
 *
 * @package magplus
 * @since 1.0
 */
require get_theme_file_path('framework/admin/dashboard/rs-view-header.php');
$has_phpfastcache = ( is_writable( dirname( __FILE__ ) .'/cache/' ) ) ? true : false;
$not_installed    = '<small style="color: #FF3937;">( Not Available )</small>';

?>

<div class="about-wrap rs-admin-wrap">
  <h1><?php echo wp_get_theme()->get('Name'); ?> MagPlus Cache <sup class="beta-note" style="font-size:12px; color:#FF3937;">Beta</sup></h1>
  <div class="about-text" style="margin-bottom:25px;">
    <p>This custom cache system is comptaibale with all of the popular cache plugins like WP Super Cache, W3C Total Cache, WP Rocket etc.<strong style="color:#FF3937;"> Note: We recommend to turn ON this engine in PRODUCTION MODE, if you had changed PHP, CSS, JS files, Widgets, Content or Anything then please make sure you CLEAR the cache.</strong></a></p>
  </div>


  <form action="" method="post">

    <?php if( $this->rs_check_index() ): ?>

      <table class="form-table" cellpadding="5">

        <tr>
          <th>Cache Engine:</th>
          <td>
            <label><input type="radio" name="config[engine]" value="phpfastcache" <?php echo ( ( ! $has_phpfastcache ) ? 'disabled ' : '' ); ?><?php echo $this->config['engine'] == 'phpfastcache' ? 'checked' : ''; ?>>PhpFastCache <?php echo ( ( ! $has_phpfastcache ) ? $not_installed : '' ); ?></label>  &nbsp;
            <label><input type="radio" name="config[engine]" value="none" <?php echo $this->config['engine'] == 'none' ? 'checked' : ''; ?>> None</label>  &nbsp;
          </td>
        </tr>

        <tr>
          <th>Exclude Query Args:</th>
          <td>
            <label><input type="radio" name="config[exclude_query]" value="ON" <?php echo $this->config['exclude_query'] == 'ON' ? 'checked' : ''; ?>> Do not cache URL args</label>  &nbsp;
            <label><input type="radio" name="config[exclude_query]" value="OFF" <?php echo $this->config['exclude_query'] == 'OFF' ? 'checked' : ''; ?>> Cache everything</label>  &nbsp;
          </td>
        </tr>

        <tr>
          <th>Exclude URL(s):</th>
          <td>
            <p><textarea name="config[exclude_url]" cols="80" rows="10"><?php echo $this->config['exclude_url']; ?></textarea></p>
            <p><code>http://example.com/woocommerce/*</code></p>
            <p><code>http://example.com/some-page/</code></p>
            <p><code>http://example.com/hello-world/</code></p>
            <p><code>http://example.com/category/fashion</code></p>
          </td>
        </tr>

        <tr>
          <th>Cached Pages:</th>
          <td><?php echo ( ( $this->config['engine'] != 'none' ) ? $this->caching->rs_info( 'cached' ) : 0 ) .' Page(s)'; ?>
          </td>
        </tr>

        <tr>
          <th>Memory Used:</th>
          <td>
            <?php

              $used = 0;

              if ( $this->config['engine'] !== 'none' ) {
                echo $this->caching->rs_info( 'size' ) .' / '. $this->caching->rs_info( 'disk' );
                $used = $this->caching->rs_info( 'used' );
              } else {
                echo '0 / 0';
              }

              echo ' ( Used: '. $used .'% of Memory )';

            ?>
          </td>
        </tr>

      </table>

      <hr />

      <p><button type="submit" name="rs_caching_save_and_flush_submit" class="btn-style-1 btn-blue">Save or Clear Cache</button></p>

    <?php else: ?>

      <p>Ops! There is not including caching class on WordPress <strong>index.php</strong></p>
      <p>Please modify <strong>index.php</strong> by manually.</p>

      <p><textarea cols="100" rows="25">&lt?php
      <?php echo "\r\n". $this->index ."\r\n\r\n"; ?>
      /**
       * Front to the WordPress application. This file doesn't do anything, but loads
       * wp-blog-header.php which does and tells WordPress to load the theme.
       *
       * @package WordPress
       */

      /**
       * Tells WordPress to load the WordPress theme and output it.
       *
       * @var bool
       */
      define( 'WP_USE_THEMES', true );

      /** Loads the WordPress Environment and Template */
      require( dirname( __FILE__ ) . '/wp-blog-header.php' );</textarea></p>

      <p>!! Oh maybe !! WordPress software updated and <strong>index.php</strong> changged automatically ? So you can try to force modify <strong>index.php</strong></p>
      <p><button type="submit" name="rs_caching_install_index" class="button button-primary">Try to force modify index.php</button></p>

    <?php endif; ?>

    <?php wp_nonce_field( 'rs_caching_post', 'rs_caching' ); ?>

  </form>
</div>

