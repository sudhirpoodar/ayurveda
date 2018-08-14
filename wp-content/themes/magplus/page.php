<?php
/**
 * Page ( part of layout )
 *
 * @package magplus
 * @since 1.0
 */

get_header();
magplus_breaking_news_weather();
magplus_slider_template(magplus_get_opt('slider-template')); ?>
<div id="page-wrapper" class="content <?php echo magplus_get_post_opt('page-margin'); ?>">
  <div class="empty-space marg-lg-b55 marg-sm-b30"></div>
  <div class="container">
    <?php magplus_before_content_special_content(); ?>
    <?php get_template_part('templates/content/content-page'); ?>
    <?php magplus_after_content_special_content(); ?>
  </div>
  <div class="empty-space marg-lg-b60 marg-sm-b50 marg-xs-b30"></div>
</div>

<?php
get_footer();
