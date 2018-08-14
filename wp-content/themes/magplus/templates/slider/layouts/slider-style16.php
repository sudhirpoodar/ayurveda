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

  if($posts_per_page >= 4):

  $the_query = new WP_Query(apply_filters('magplus_block_query_args', $args, 'slider'));

?>


<div class="container">
  <div class="arrow-closest tt-mag-slider tt-slider-custom-marg mobile-show-pagination pt-10 slider-style16"<?php echo wp_kses_data($slider_style); ?>>
    <div class="swiper-container tt-slider-type-5" data-mode="horizontal" data-effect="slide" data-slides-per-view="1" data-autoplay="<?php echo magplus_get_opt('slider-autoplay'); ?>" data-loop="<?php echo magplus_get_opt('slider-loop-switch'); ?>" data-speed="<?php echo magplus_get_opt('slider-speed'); ?>" data-sm-slides="4" data-xs-slides="4">
      <div class="swiper-wrapper<?php echo (!magplus_get_opt('slider-swipe-switch')) ? ' swipe-disabled':''; ?>">

        <?php 
          $i = 1; 
          if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
          $count = 1; if($i % 4 == 2) { $count = 2; } elseif($i % 4 == 3) { $count = 3;} elseif($i % 4 == 0) {$count = 4;}
          $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
          $image_src = (!empty($image_src) && is_array($image_src)) ? $image_src[0]:'';
          $gradient_enable = magplus_get_post_opt('post-enable-custom-overlay');
          $color_first     = magplus_get_post_opt('post-overlay-first-color');
          $color_second    = magplus_get_post_opt('post-overlay-second-color');
          
          $gradient_style = ($gradient_enable && !empty($color_first) || !empty($color_second)) ? ' style="background: -webkit-linear-gradient(bottom, '. $color_first .', '. $color_second .' );background: linear-gradient(to bottom, '. $color_first .', '. $color_second .' );"':'';  
          if($i == 1): ?><div class="swiper-slide"><?php endif; ?>

          <div class="tt-slide-item item-<?php echo esc_attr( $count ); ?>">
            <div class="tt-item-post-block type-2 tt-item-post-border custom-hover-image">
              <div class="bg" style="background-image:url(<?php echo esc_url($image_src); ?>)">
                <a class="tt-mslide-link" href="<?php echo esc_url(get_the_permalink()); ?>"></a>
                <div class="tt-mslide-gradient" <?php echo wp_kses_post($gradient_style); ?>></div>
              </div>
              <div class="tt-item-post-title">
                <?php 
                  $category = get_the_category(); 
                  if(is_array($category) && !empty($category)):
                    foreach($category as $cat): ?>
                      <a class="c-btn type-3 color-2 tt-mslide-cat" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->cat_name); ?></a>
                   <?php 
                    endforeach;
                  endif;
                ?>
                <h4 class="<?php echo ($count == 2) ? 'tt-h2-title':'tt-h4-title'; ?>"><a href="<?php echo esc_url(get_the_permalink()); ?>" class="tt-post-title"><?php the_title(); ?></a></h4>
                <?php if($count == 2): ?>
                  <ul class="tt-title-ul sm">
                    <li class="tt-mslide-author"><b><?php echo get_the_author(); ?></b></li>
                    <li class="tt-mslide-date"><i class="material-icons">access_time</i><span class="tt-mslide-date"><?php echo magplus_slider_time_format(); ?></span></li>
                    <li class="tt-mslide-views"><i class="material-icons">remove_red_eye</i><span><?php echo magplus_getPostViews(get_the_ID()); ?></span></li>
                  </ul>
                <?php endif; ?>
              </div>

              

            </div>
          </div>
          <?php if( ($i % 4 == 0) && ($i < $posts_per_page) ): ?></div><div class="swiper-slide"><?php endif; ?>

        <?php if($i == $posts_per_page || $i == $the_query->post_count): ?></div><?php endif; ?>
        <?php $i++; endwhile; wp_reset_postdata(); endif; ?>

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
      <span><?php echo esc_html__('Attention !! Slider must contain atleast 4 post.', 'magplus'); ?></span>
    </div>
  </div>
<?php endif; ?>
