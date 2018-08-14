
<?php
/**
 * Slider Style 9
 *
 * @package magplus
 * @since 1.0
 */
?>


<?php
  wp_enqueue_script('swiper');
  wp_enqueue_style('swiper');

  $posts_per_page = magplus_get_opt('slider-posts-per-page');
  $slider_top_margin = magplus_get_opt('slider-margin-top');
  $slider_style      = (!empty($slider_top_margin)) ? ' style="padding-top:'.esc_attr($slider_top_margin).'px;"':'';
  $args = array(
    'orderby'        => 'ID',
    'posts_per_page' => $posts_per_page,
    'meta_query'     => array(array('key' => '_thumbnail_id')),
  );

  $categories = magplus_get_opt('slider-category');
  if (is_array($categories)) {
    $args['category__in'] =  $categories;
  }

  $the_query = new WP_Query(apply_filters('magplus_block_query_args', $args, 'slider'));

?>


<div class="arrow-closest tt-mag-slider mobile-show-pagination"<?php echo wp_kses_data($slider_style); ?>>
  <div class="swiper-container tt-slider-custom-marg slider-style9 tt-slider-type-1" data-anime="type-1" data-mode="horizontal" data-effect="slide" data-slides-per-view="1" data-autoplay="<?php echo magplus_get_opt('slider-autoplay'); ?>" data-loop="<?php echo magplus_get_opt('slider-loop-switch'); ?>" data-speed="<?php echo magplus_get_opt('slider-speed'); ?>">
    <div class="swiper-wrapper<?php echo (!magplus_get_opt('slider-swipe-switch')) ? ' swipe-disabled':''; ?>">

    <?php 
      $i = 0; 
      while ($the_query -> have_posts()) : $the_query -> the_post();
      $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
      $image_src = (!empty($image_src) && is_array($image_src)) ? $image_src[0]:''; 
    ?>
      <div <?php post_class('swiper-slide custom-hover-image'); ?>>
        <div class="bg" style="background-image:url(<?php echo esc_url($image_src); ?>)"></div>
        <div class="tt-vertical-align full mobile-relative">
          <div class="tt-main-slider-title">
            <h1 class="tt-h1-title tt-main-caption"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h1>
            <ul class="tt-title-ul">
              <li class="tt-mslide-author"><b><?php echo get_the_author(); ?></b></li>
              <li class="tt-mslide-date"><?php echo magplus_slider_time_format(); ?></li>
            </ul>
          </div>
        </div>
        <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tt-hold-link"></a>
      </div>
    <?php $i++; endwhile; wp_reset_postdata(); ?>


    </div>
    <div class="pagination pagination-hidden c-pagination color-2"></div>
    <div class="swiper-arrow-left <?php echo (!magplus_get_opt('slider-show-pagination-switch')) ? 'hidden-lg':''; ?> tt-swiper-arrow"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
    <div class="swiper-arrow-right <?php echo (!magplus_get_opt('slider-show-pagination-switch')) ? 'hidden-lg':''; ?> tt-swiper-arrow"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
  </div>
</div>
