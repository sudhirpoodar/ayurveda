<?php
/**
 * Slider Style 7
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

  $args = apply_filters('magplus_block_query_args', $args, 'slider');

  if($posts_per_page >= 4):

  $the_query = new WP_Query(apply_filters('magplus_block_query_args', $args, 'slider'));

?>
<div class="tt-slider-wide tt-mag-slider tt-slider-custom-marg tt-custom-arrows"<?php echo wp_kses_data($slider_style); ?>>
  <div class="container">
    <div class="tt-slider-entry">
      <div class="swiper-container" data-autoplay="<?php echo magplus_get_opt('slider-autoplay'); ?>" data-loop="<?php echo magplus_get_opt('slider-loop-switch'); ?>" data-effect="slide" data-anime="type-1" data-speed="<?php echo magplus_get_opt('slider-speed'); ?>" data-center="1" data-slides-per-view="responsive" data-xs-slides="3" data-sm-slides="2" data-md-slides="3" data-lg-slides="3" data-add-slides="3">
        <div class="swiper-wrapper<?php echo (!magplus_get_opt('slider-swipe-switch')) ? ' swipe-disabled':''; ?> clearfix">
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

          <div class="swiper-slide slider-style10 <?php echo ($i === 0) ? 'active':''; ?>" data-val="<?php echo esc_attr($i); ?>">
            <div class="tt-slide-2 custom-hover-image">
              <div class="tt-slide-2-img bg-two" style="background-image:url(<?php echo esc_url($image_src); ?>);">
                <a class="tt-mslide-link" href="<?php echo esc_url(get_the_permalink()); ?>"></a>
                <?php if(!empty($gradient_style) && isset($gradient_style)): ?>
                  <div class="tt-mslide-gradient" <?php echo wp_kses_post($gradient_style); ?>></div>
                <?php endif; ?>
              </div>

              <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tt-vertical-align full mobile-relative">
                <div class="tt-main-slider-title type-2">
                  <h1 class="tt-h1-title tt-main-caption"><?php the_title(); ?></h1>
                  <ul class="tt-title-ul">
                    <li class="tt-mslide-author"><b><?php echo get_the_author(); ?></b></li>
                    <li class="tt-mslide-date"><i class="material-icons">access_time</i><span class="tt-mslide-date"><?php echo magplus_slider_time_format(); ?></span></li>
                    <li class="tt-mslide-views"><i class="material-icons">remove_red_eye</i><span><?php echo magplus_getPostViews(get_the_ID()); ?></span></li>
                  </ul>
                </div>
              </a>
              
            </div>          
          </div>
          <?php $i++; endwhile; wp_reset_postdata(); ?>


        </div>
        <div class="pagination c-pagination color-2 pos-3 visible-xs-block"></div>
      </div>                  
    </div>                
  </div>
  <div class="custom-arrow-left tt-swiper-arrow type-2 <?php echo (!magplus_get_opt('slider-show-pagination-switch')) ? 'hidden-lg':''; ?> c-arrow left size-2 pos-1 hidden-xs hidden-sm">
    <i class="fa fa-chevron-left" aria-hidden="true"></i>
  </div>
  <div class="custom-arrow-right tt-swiper-arrow type-2 <?php echo (!magplus_get_opt('slider-show-pagination-switch')) ? 'hidden-lg':''; ?> c-arrow right size-2 pos-1 hidden-xs hidden-sm">
    <i class="fa fa-chevron-right" aria-hidden="true"></i>
  </div>  
</div>
<?php else: ?>
  <div class="container">
    <div class="empty-space marg-lg-b55"></div>
    <div class="tt-slider-info">
      <span><?php echo esc_html__('Attention !! Slider must contain atleast 4 post.', 'magplus'); ?></span>
    </div>
  </div>
<?php endif; ?>
