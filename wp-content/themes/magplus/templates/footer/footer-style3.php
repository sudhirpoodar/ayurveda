<?php
/**
 * Part of footer file ( default style )
 *
 * @package magplus
 * @since 1.0
 */
?>


<?php
  $the_query = new WP_Query( array('meta_query' => array(array('key' => '_thumbnail_id')), 'orderby' => 'comment_count', 'order' => 'DESC', 'posts_per_page' => magplus_get_opt('footer-no-slides'), 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true)  );

  if($the_query->have_posts()):
    wp_enqueue_script('swiper');
    wp_enqueue_style('swiper');

?>


<div class="tt-footer tt-trending-slider-post">


  <div class="container">
      
    <div class="tt-title-block style1 dark">
      <h3 class="tt-title-text"><?php echo magplus_get_opt('footer-slider-heading'); ?></h3>
    </div>
    <div class="empty-space marg-lg-b25"></div> 

    <div class="tt-custom-arrows tt-footer-post-slider text-center tt-swiper-margin">
      <div class="swiper-container" data-autoplay="5000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="4">
          <div class="swiper-wrapper clearfix">

            <?php $i = 0; while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
            <div class="swiper-slide<?php echo ($i == 0) ? ' active':''; ?>" data-val="<?php echo esc_attr($i); ?>">
              <div class="tt-swiper-margin-entry">
                <div class="tt-post type-5 dark">
                  <?php magplus_post_format('magplus-medium-alt', 'img-responsive'); ?>
                  <div class="tt-post-info text-left">
                    <a class="tt-post-title c-h5" href="<?php echo esc_url(get_the_permalink()); ?>"><small><?php the_title(); ?></small></a>
                    <?php magplus_blog_category(); ?>
                  </div>
                </div>                                        
              </div>                             
            </div>
            <?php $i++; endwhile; wp_reset_postdata(); ?>

          </div>
          <div class="pagination c-pagination pos-3 visible-xs-block visible-sm-block"></div>
      </div>


      <div class="custom-arrow-left c-arrow left size-2 style-2 pos-2 hidden-xs hidden-sm">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
      </div>
      <div class="custom-arrow-right c-arrow right size-2 style-2 pos-2 hidden-xs hidden-sm">
          <i class="fa fa-chevron-right" aria-hidden="true"></i>
      </div>  



    </div>                                     
    <div class="empty-space marg-lg-b55 marg-sm-b50 marg-xs-b30"></div>
  </div>

  <div class="tt-footer-copy">
    <div class="container">
      <?php echo wp_kses_data(magplus_get_opt('footer-copyright-text')); ?>
    </div>
  </div>

</div>

<?php endif; ?>