<?php
/**
 * View Header
 *
 * @package magplus
 * @since 1.0
 */
global $submenu;

if (isset($submenu['rs_theme_welcome'])):
  $rs_welcome_menu_items = $submenu['rs_theme_welcome'];
endif;

if (!empty($rs_welcome_menu_items) && is_array($rs_welcome_menu_items)) : ?>
  <div class="wrap about-wrap rs-wp-admin-header ">
    <h2 class="nav-tab-wrapper">
      <?php foreach ($rs_welcome_menu_items as $rs_welcome_menu_item): ?>
        <a href="admin.php?page=<?php echo $rs_welcome_menu_item[2]?>" class="nav-tab <?php if(isset($_GET['page']) and $_GET['page'] == $rs_welcome_menu_item[2]) { echo 'nav-tab-active'; }?> "><?php echo esc_html($rs_welcome_menu_item[0]); ?></a>
      <?php endforeach; ?>
    </h2>
  </div>
<?php endif; ?>


