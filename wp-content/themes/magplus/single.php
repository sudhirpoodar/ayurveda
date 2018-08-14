<?php
/**
 * Single.php
 *
 * @package magplus
 * @since 1.0
 */
get_header();
magplus_blog_post_template(magplus_get_opt('post-style'));
magplus_related_post('style2');
magplus_pagination();
get_footer();

