<?php
/**
 * Pagination
*/
get_header();
wp_enqueue_script('isotope-pkg');
if (get_query_var('paged')) {
  $paged = get_query_var('paged');
} elseif (get_query_var('page')) {
  $paged = get_query_var('page');
} else {
  $paged = 1;
}

$post_args = array(
  'posts_per_page' => get_option('posts_per_page'),
  'orderby'        => 'date',
  'paged'          => $paged,
  'order'          => 'DESC',
  'post_type'      => 'post',
  'post_status'    => 'publish',
  'meta_query'     => array(array('key' => '_thumbnail_id')), 
);

$query = new WP_Query( $post_args );
if(is_page()) {
  $max_num_pages = $query -> max_num_pages;
} else {
  global $wp_query;
  $query = $wp_query;
  $max_num_pages = false;
}

$pagination_template = magplus_get_opt('paged-template');

if($pagination_template == 'masonry'):

?>

  <div class="row tt-blog-masonry">
  <div class="empty-space marg-lg-b60 marg-sm-b20 marg-xs-b15"></div>
   <div class="isotope isotope-content">
    <div class="grid-sizer col-xs-12 col-sm-6 col-md-2"></div>

    <?php while ($query -> have_posts()) : $query -> the_post(); ?>
    <div <?php post_class('isotope-item col-xs-12 col-sm-6 col-md-2'); ?>>
      <div class="tt-post type-2">
        <?php magplus_post_format('magplus-medium', 'img-responsive'); ?>
        <div class="tt-post-info">
          <?php magplus_blog_category(); ?>
          <?php magplus_blog_title('c-h5'); ?>
          <?php magplus_blog_author_date(); ?>
          <?php magplus_blog_excerpt(20); ?>
          <?php magplus_blog_post_bottom(); ?>
        </div>
      </div>
      <div class="empty-space marg-lg-b30 marg-xs-b30"></div> 
    </div>
    <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php magplus_paging_nav($max_num_pages, 'default'); ?>
    <div class="empty-space marg-lg-b60 marg-sm-b20 marg-xs-b15"></div>
  </div>

<?php else: ?>

<div class="container">
  <div class="empty-space marg-lg-b60 marg-sm-b20 marg-xs-b15"></div>
  <?php get_template_part('templates/global/page-before-content'); ?>
    <?php if($query -> have_posts()): while ($query -> have_posts()) : $query -> the_post(); ?>
    	<?php $post_thumbnail_class = (has_post_thumbnail()) ? 'has-thumbnail':'no-thumbnail'; ?>
	  <div <?php post_class('tt-post '.$post_thumbnail_class.' type-6 clearfix'); ?>>
	    <?php magplus_post_format('magplus-medium-ver', 'img-responsive'); ?>
	    <div class="tt-post-info">
	      <?php magplus_blog_category(); ?>
	      <?php magplus_blog_title('c-h5'); ?>
	      <?php magplus_blog_author_date(); ?>
	      <?php magplus_blog_excerpt(35); ?>
	      <?php magplus_blog_post_bottom(); ?>
	    </div>
	  </div>
	  <div class="empty-space marg-xs-b0 marg-lg-b30"></div>
    <?php endwhile; wp_reset_postdata(); else:
      get_template_part('templates/content', 'none');
    endif; ?>

    <?php magplus_paging_nav($max_num_pages, 'default'); ?>    
  <?php get_template_part('templates/global/page-after-content'); ?> 
</div>
<div class="empty-space marg-lg-b60 marg-sm-b20 marg-xs-b15"></div>
<?php
endif;
get_footer();
