<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package magplus
 */
?>
<?php 
  $sidebar_heading_style = magplus_get_opt('sidebar-heading-style'); 
  $sidebar_details = magplus_sidebar_position();
  $col_class = ($sidebar_details['layout'] == 'dual_sidebar') ? 'col-md-3':'col-md-4';
?>
<div class="<?php echo esc_attr($col_class); ?>">
  <div class="sidebar pleft75 sidebar-heading-<?php echo esc_attr($sidebar_heading_style); ?> right-sidebar">
    <div class="empty-space marg-sm-b60"></div>
    <?php if (is_active_sidebar( magplus_get_custom_sidebar('main', $sidebar_details['sidebar-name-right']) )): ?>
      <?php dynamic_sidebar( magplus_get_custom_sidebar('main', $sidebar_details['sidebar-name-right']) ); ?>
    <?php endif; ?>
  </div>
</div>
    
