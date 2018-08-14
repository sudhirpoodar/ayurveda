<?php
/**
 * View Activate Theme
 *
 * @package magplus
 * @since 1.0
 */
$purchase_key = get_option('purchase_key');
$is_valid     = get_option('is_valid');

 if ( isset( $_POST['rs_verify_nonce'] ) && wp_verify_nonce( $_POST['rs_verify_nonce'], 'rs_verify_nonce' ) && ! empty($_POST['rs_envato_code']) && isset($_POST['rs_envato_code'] ) ) {
  $rs_envato_code = $_POST['rs_envato_code'];
  if(!empty($rs_envato_code)) {
    $is_valid = magplus_envato_verify_purchase($rs_envato_code);
    if(!empty($is_valid) && $is_valid != false) {
      update_option('is_valid', true);
      update_option('purchase_key', $rs_envato_code);
      $purchase_key = $rs_envato_code;
      $output       = 'Congratulations! MagPlus is activated.';
    }
  }
} else if($is_valid == true) {
  $output = 'Congratulations! MagPlus is activated.';
} else {
  $output = '';
}

//var_dump($is_valid);
require_once 'rs-view-header.php';
$theme_details = wp_get_theme();

?>

<div class="rs-admin-wrapper rs-plugins-wrapper about-wrap">
  <div class="rs-wc-header">
    <h1>Activate <?php echo esc_html($theme_details->get('Name')); ?></h1>
    <div class="about-text">
      <p> Please activate MagPlus. This activation enables all features of the theme (i.e. Demo import etc.). This step is taken for mass piracy of our theme, and to serve our paying customers better. </p>
    </div>

    <?php if(!empty($output)): ?>
      <div class="msg-box text-center">
        <div class="icon-box"><img src="<?php echo get_theme_file_uri('framework/admin/assets/img/dashboard/icons/06.png'); ?>" alt="" /></div>
        <?php echo esc_html($output); ?>
      </div>
    <?php endif; ?>

      <?php if($is_valid == false): ?>
      <form method="post" action="admin.php?page=rs_theme_activate">
        <div class="form-table rs-theme-activate">
          <div class="rs-form-title">Envato Purchase Code:</div>
          <div class="rs-input-box">
            <input type="text" placeholder="for e.g 4507f06b-ab21-4a97-8a1b-67w03d778345" name="rs_envato_code" value="<?php echo esc_html($purchase_key); ?>">
          </div>
          <input type="hidden" name="rs_active" value="auto">
          <?php wp_nonce_field( 'rs_verify_nonce', 'rs_verify_nonce' ); ?>
          <p class="submit"><input type="submit" name="submit" id="submit" class="btn-style-1 btn-blue" value="Activate Theme"></p>
          <div class="rs-info"><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">Where to find your purchase code ?</a></div>
        </div>
      </form>
      <?php endif; ?>
  </div>


</div>
