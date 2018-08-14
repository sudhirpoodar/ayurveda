<?php
/**
 * Slider Style 2
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


<!-- TT-SLIDER-WIDE -->
<div class="tt-slider-wide tt-mag-slider tt-slider-custom-marg slider-style6 tt-custom-arrows"<?php echo wp_kses_data($slider_style); ?>>
  
    <div class="tt-slider-entry-style6">
      <div class="tt-swiper-margin-10">
        <div class="swiper-container" data-autoplay="<?php echo magplus_get_opt('slider-autoplay'); ?>" data-loop="<?php echo magplus_get_opt('slider-loop-switch'); ?>" data-speed="<?php echo magplus_get_opt('slider-speed'); ?>" data-center="0" data-slides-per-view="1" data-add-slides="2">
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

            <div class="swiper-slide <?php echo ($i === 0) ? 'active':''; ?>" data-val="<?php echo esc_attr($i); ?>">
              <div class="tt-swiper-margin-10-entry custom-hover-image">
                <div class="tt-mslide type-2 bg" style="background-image:url(<?php echo esc_url($image_src); ?>);">
                  <a class="tt-mslide-link" href="<?php echo esc_url(get_the_permalink()); ?>"></a>
                  <div class="tt-mslide-gradient" <?php echo wp_kses_post($gradient_style); ?>></div>
                </div>

                  <div class="tt-mslide-table">
                    <div class="tt-mslide-cell">
                      <div class="tt-mslide-block">
                        <div class="tt-mslide-cat">
                          <?php 
                            $category = get_the_category(); 
                            if(is_array($category) && !empty($category)):
                              foreach($category as $cat): ?>
                                <a class="c-btn type-3 color-2 tt-mslide-cat" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->cat_name); ?></a>
                             <?php 
                              endforeach;
                            endif;
                          ?>
                        </div>            
                        <h1 class="tt-mslide-title c-h1"><?php the_title(); ?></h1>
                        <div class="tt-mslide-label">
                          <span class="tt-mslide-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a></span>
                          <span class="tt-mslide-date"><?php echo magplus_slider_time_format(); ?></span>
                        </div>

                      </div>
                    </div>          
                  </div>
                
              </div>  
            </div> 

            <?php $i++; endwhile; wp_reset_postdata(); ?>

          </div>
          <div class="pagination c-pagination color-2 pos-3 visible-xs-block"></div>
        </div>
      </div>                
    </div>                
  
  <div class="custom-arrow-left <?php echo (!magplus_get_opt('slider-show-pagination-switch')) ? 'hidden-lg':''; ?> c-arrow left size-2 pos-1 hidden-xs hidden-sm">
      <i class="fa fa-chevron-left" aria-hidden="true"></i>
  </div>
  <div class="custom-arrow-right <?php echo (!magplus_get_opt('slider-show-pagination-switch')) ? 'hidden-lg':''; ?> c-arrow right size-2 pos-1 hidden-xs hidden-sm">
      <i class="fa fa-chevron-right" aria-hidden="true"></i>
  </div>              
</div>
