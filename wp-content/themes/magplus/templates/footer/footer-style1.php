<?php
/**
 * Part of footer file ( default style )
 *
 * @package magplus
 * @since 1.0
 */
?>
<div class="tt-footer">
  <div class="container">
    <div class="row">
      <?php magplus_footer_columns(); ?>
      <div class="col-md-12"><div class="empty-space marg-lg-b60 marg-sm-b50 marg-xs-b30"></div></div>
    </div>
  </div>
  <div class="tt-footer-copy">
    <div class="container">
      <?php echo wp_kses_data(magplus_get_opt('footer-copyright-text')); ?>
    </div>
  </div>
</div> 

