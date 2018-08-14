<?php
/**
 * Slider Style 11
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

<div class="container">
  <div class="arrow-closest tt-mag-slider tt-slider-custom-marg slider-style11 mobile-show-pagination"<?php echo wp_kses_data($slider_style); ?>>
    <div class="swiper-container tt-slider-type-1" data-anime="type-1" data-mode="horizontal" data-effect="slide" data-slides-per-view="1" data-autoplay="<?php echo magplus_get_opt('slider-autoplay'); ?>" data-loop="<?php echo magplus_get_opt('slider-loop-switch'); ?>" data-speed="<?php echo magplus_get_opt('slider-speed'); ?>">
      <div class="swiper-wrapper<?php echo (!magplus_get_opt('slider-swipe-switch')) ? ' swipe-disabled':''; ?>">


      <?php 
        $i = 0; 
        while ($the_query -> have_posts()) : $the_query -> the_post();
        $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
        $image_src = (!empty($image_src) && is_array($image_src)) ? $image_src[0]:''; 
      ?>
        <div class="swiper-slide custom-hover-image">
          <a href="<?php echo esc_url(get_the_permalink()); ?>" class="bg" style="background-image:url(<?php echo esc_url($image_src); ?>)"></a>
          <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tt-vertical-align full mobile-relative">
            <div class="tt-main-slider-title type-3">
              <h1 class="tt-h1-title tt-main-caption"><?php the_title(); ?></h1>
              <ul class="tt-title-ul mr-bott-30">
                <li class="tt-mslide-author"><b><?php echo get_the_author(); ?></b></li>
                <li class="tt-mslide-date"><?php echo magplus_slider_time_format(); ?></li>
              </ul>
              <div class="link-wrap">
                <div class="c-btn type-1 style-2 color-1 size-6 tt-inline"><span><?php echo esc_html__('READ MORE', 'magplus'); ?></span></div>
              </div>
            </div>
          </a>
        </div>
        <?php $i++; endwhile; wp_reset_postdata(); ?>



      </div>
      <div class="pagination pagination-hidden c-pagination color-2"></div>
      <div class="swiper-arrow-left <?php echo (!magplus_get_opt('slider-show-pagination-switch')) ? 'hidden-lg':''; ?> tt-swiper-arrow type-2"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
      <div class="swiper-arrow-right <?php echo (!magplus_get_opt('slider-show-pagination-switch')) ? 'hidden-lg':''; ?> tt-swiper-arrow type-2"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
    </div>
  </div>
</div>
