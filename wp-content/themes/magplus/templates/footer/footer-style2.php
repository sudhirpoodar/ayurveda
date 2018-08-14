<?php
/**
 * Part of footer file ( default style )
 *
 * @package magplus
 * @since 1.0
 */
?>
<div class="tt-footer tt-instagram-post">

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php if (is_active_sidebar( magplus_get_custom_sidebar('footer-instagram-sidebar') )): ?>
          <?php dynamic_sidebar( magplus_get_custom_sidebar('footer-instagram-sidebar') ); ?>
        <?php endif; ?>
        <div class="empty-space marg-lg-b30 marg-xs-b30"></div>
      </div>
    </div>
  </div>

  <div class="tt-footer-copy">
    <div class="container">
      <?php echo wp_kses_data(magplus_get_opt('footer-copyright-text')); ?>
    </div>
  </div>

</div>
