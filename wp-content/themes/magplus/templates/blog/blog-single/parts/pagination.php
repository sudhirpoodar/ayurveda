
<?php
/**
 * Pagination
 *
 * @package magplus
 * @since 1.0
 */
?>
<?php
  $nextPost  = get_next_post();
  if($nextPost):
    $args = array(
      'posts_per_page' => 1,
      'include'        => $nextPost->ID,
    );
    $nextPost = get_posts($args);
    foreach ($nextPost as $post):
      setup_postdata($post);
      $img_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'magplus-medium-hor');
?>
<div class="tt-shortcode-2 visible">
  <div class="tt-post type-4">
    <div class="tt-title-block">
      <h3 class="tt-title-text"><?php echo esc_html__('Next Up', 'magplus'); ?></h3>
      <span class="tt-shortcode-2-close"></span>
    </div>
    <div class="empty-space marg-lg-b20"></div>
    <?php  if(isset($img_src[0])): ?>
      <a class="tt-post-img custom-hover" href="<?php echo esc_url(get_the_permalink()); ?>">
        <img class="img-responsive" src="<?php echo esc_url($img_src[0]); ?>" alt="">
      </a>
    <?php endif; ?>
    <div class="tt-post-info">
      <a class="tt-post-title c-h5" href="<?php echo esc_url(get_the_permalink()); ?>"><small><?php the_title(); ?></small></a>
      <?php magplus_blog_author_date(); ?>
    </div>
  </div>
</div>
<?php endforeach; endif; ?>