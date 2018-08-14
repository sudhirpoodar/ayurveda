<?php
/**
 * Title Wrapper
 *
 * @package magplus
 * @since 1.0
 */
?>
<?php
$sub_heading = magplus_get_opt('title-wrapper-subheading');
if(magplus_get_opt('title-wrapper-enable') || !class_exists('ReduxFramework') && !is_single()): ?>
<div class="tt-heading title-wrapper tt-parallax-on background-block">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="tt-heading-title"><?php echo magplus_get_the_title(); ?></h1>
        <?php if(!empty($sub_heading)): ?>
          <div class="simple-text size-6 tt-sub-heading color-4">
            <p><?php echo esc_html($sub_heading); ?></p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
