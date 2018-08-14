<?php
/**
 * Slider Style 8
 *
 * @package magplus
 * @since 1.0
 */
?>

<?php
  
  $featured_args = array(
    'orderby'        => 'ID',
    'posts_per_page' => 5,
    'meta_query'     => array(array('key' => '_thumbnail_id')),
  );

  $featured_categories = magplus_get_opt('featured-category');
  $slider_top_margin = magplus_get_opt('slider-margin-top');
  $slider_style      = (!empty($slider_top_margin)) ? ' style="padding-top:'.esc_attr($slider_top_margin).'px;"':'';
  if (is_array($featured_categories)) {
    $featured_args['category__in'] =  $featured_categories;
  }

  $featured_query = new WP_Query(apply_filters('magplus_block_query_args', $featured_args, 'featured'));

?>

<div class="container">
  <div class="row nomargin tt-mag-slider tt-slider-custom-marg"<?php echo wp_kses_data($slider_style); ?>>
    <?php $i = 0; while ($featured_query -> have_posts()) : $featured_query -> the_post(); ?>
    <div <?php post_class('col-xs-6 col-sm-4 cust-lg-5 nopadding'); ?>>
      <div class="tt-post type-9">
        <?php magplus_post_format('magplus-medium', 'img-responsive'); ?>
        <div class="tt-post-info">
          <?php magplus_blog_title('c-h6'); ?>
        </div>
      </div>
      <div class="marg-md-b30"></div>           
    </div>
    <?php echo ($i % 2 == 1) ? '<div class="clearfix visible-xs-block"></div>':''; ?>
    <?php $i++; endwhile; wp_reset_postdata(); ?>
  </div>
  <div class="empty-space marg-lg-b25"></div>

  <?php
    wp_enqueue_script('swiper');
    wp_enqueue_style('swiper');

    $posts_per_page = magplus_get_opt('slider-posts-per-page');
    
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


<!-- TT-MBLOCK -->
                
  <div class="swiper-container tt-slider-custom-marg" data-autoplay="<?php echo magplus_get_opt('slider-autoplay'); ?>" data-loop="<?php echo magplus_get_opt('slider-loop-switch'); ?>" data-speed="<?php echo magplus_get_opt('slider-speed'); ?>" data-center="0" data-slides-per-view="1">
    <div class="swiper-wrapper<?php echo (!magplus_get_opt('slider-swipe-switch')) ? ' swipe-disabled':''; ?> clearfix">
      <?php 
        $i = 0; 
        while ($the_query -> have_posts()) : $the_query -> the_post();
        $image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
        $image_src = (!empty($image_src) && is_array($image_src)) ? $image_src[0]:''; 
      ?>

      <div class="swiper-slide <?php echo ($i === 0) ? 'active':''; ?>" data-val="0"> 
        <div class="tt-mblock">
          <a class="tt-mblock-bg custom-hover" href="<?php echo esc_url(get_the_permalink()); ?>">
            <div class="tt-mblock-img custom-hover-img background-block" style="background-image:url(<?php echo esc_url($image_src); ?>);"></div>
          </a>
          <div class="tt-mblock-info">
            <div class="tt-mblock-cat">
              <?php 
                $category = get_the_category(); 
                if(is_array($category) && !empty($category)):
                  foreach($category as $cat): ?>
                    <a class="c-btn type-3 color-3" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><?php echo esc_html($cat->cat_name); ?></a>
                 <?php 
                  endforeach;
                endif;
              ?>
            </div>
            <a href="<?php echo esc_url(get_the_permalink()); ?>" class="tt-mblock-title c-h2"><?php the_title(); ?></a>
            <div class="tt-mblock-label">
              <span><a href="#"><?php echo get_the_author(); ?></a></span>
              <span class="tt-mslide-date"><?php echo magplus_slider_time_format(); ?></span>
            </div>                      
          </div>
        </div>
      </div>
      <?php $i++; endwhile; wp_reset_postdata(); ?>

    </div>
    <div class="pagination c-pagination color-2 pos-3 visible-xs-block visible-sm-block"></div>
    <div class="swiper-arrow-left <?php echo (!magplus_get_opt('slider-show-pagination-switch')) ? 'hidden-lg':''; ?> c-arrow left pos-4 hidden-xs hidden-sm"><i class="fa fa-chevron-left" aria-hidden="true"></i></div>
    <div class="swiper-arrow-right <?php echo (!magplus_get_opt('slider-show-pagination-switch')) ? 'hidden-lg':''; ?> c-arrow right pos-4 hidden-xs hidden-sm"><i class="fa fa-chevron-right" aria-hidden="true"></i></div>
  </div>  
</div>
