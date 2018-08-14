<?php
/**
 * Slider Style 12
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

  if($posts_per_page >=3):

?>


<div class="container">
  <div class="arrow-closest tt-mag-slider tt-slider-custom-marg mobile-show-pagination pt-10 slider-style12 slider-style24"<?php echo wp_kses_data($slider_style); ?>>
    <div class="swiper-container tt-slider-type-5" data-mode="horizontal" data-effect="slide" data-slides-per-view="responsive" data-add-slides="2" data-lg-slides="2" data-md-slides="2" data-sm-slides="1" data-xs-slides="1" data-autoplay="<?php echo magplus_get_opt('slider-autoplay'); ?>" data-loop="<?php echo magplus_get_opt('slider-loop-switch'); ?>" data-speed="<?php echo magplus_get_opt('slider-speed'); ?>">
      <div class="swiper-wrapper<?php echo (!magplus_get_opt('slider-swipe-switch')) ? ' swipe-disabled':''; ?>">

      <?php 
        $i = 0; 
        while ($the_query -> have_posts()) : $the_query -> the_post();
          $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
          $image_src = (!empty($image_src) && is_array($image_src)) ? $image_src[0]:''; 
          $gradient_enable = magplus_get_post_opt('post-enable-custom-overlay');
          $color_first     = magplus_get_post_opt('post-overlay-first-color');
          $color_second    = magplus_get_post_opt('post-overlay-second-color');
        
          $gradient_style = ($gradient_enable && !empty($color_first) || !empty($color_second)) ? ' style="background: -webkit-linear-gradient(bottom, '. $color_first .', '. $color_second .' );background: linear-gradient(to bottom, '. $color_first .', '. $color_second .' );"':'';   
      ?>
        <div class="swiper-slide">
          <div class="tt-item-post-block tt-item-post-border custom-hover-image">
            <div class="bg" style="background-image:url(<?php echo esc_url($image_src); ?>)">
              <a class="tt-mslide-link" href="<?php echo esc_url(get_the_permalink()); ?>"></a>
            </div>
            <div class="tt-item-post-title" <?php echo wp_kses_post($gradient_style); ?>>
              <?php 
                $category = get_the_category(); 
                if(is_array($category) && !empty($category)):
                  foreach($category as $cat): ?>
                    <a class="c-btn type-3 color-2 tt-mslide-cat" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->cat_name); ?></a>
                 <?php 
                  endforeach;
                endif;
              ?>
              <h2 class="tt-h2-title"><a href="<?php echo esc_url(get_the_permalink()); ?>" class="tt-post-title"><?php the_title(); ?></a></h2>
              <ul class="tt-title-ul">
                <li class="tt-mslide-author"><b><?php echo get_the_author(); ?></b></li>
                <li class="tt-mslide-date"><?php echo magplus_slider_time_format(); ?></li>
              </ul>
            </div>
          </div>
        </div>

        <?php $i++; endwhile; wp_reset_postdata(); ?>



      </div>
      <div class="pagination pagination-hidden c-pagination color-2"></div>
      <div class="swiper-arrow-left <?php echo (!magplus_get_opt('slider-show-pagination-switch')) ? 'hidden-lg':''; ?> tt-swiper-arrow-2"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
      <div class="swiper-arrow-right <?php echo (!magplus_get_opt('slider-show-pagination-switch')) ? 'hidden-lg':''; ?> tt-swiper-arrow-2"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
    </div>
  </div>
</div>
<?php else: ?>
  <div class="container">
    <div class="empty-space marg-lg-b55"></div>
    <div class="tt-slider-info">
      <span><?php echo esc_html__('Attention !! Slider must contain atleast 3 post.', 'magplus'); ?></span>
    </div>
  </div>
<?php endif; ?>
