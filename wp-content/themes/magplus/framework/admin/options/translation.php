<?php
/*
 * Translation
*/
$this->sections[] = array(
  'title' => esc_html__('Translation', 'magplus'),
  'desc' => esc_html__('Site Translation configuration.', 'magplus'),
  'icon' => 'fa fa-globe',
  'fields' => array(
    array(
      'id'      =>'translation-pages',
      'type'    => 'text',
      'title'   => esc_html__('Pages', 'magplus'),
      'default' => 'Pages'
    ),
    array(
      'id'      =>'translation-tags',
      'type'    => 'text',
      'title'   => esc_html__('Tags', 'magplus'),
      'default' => 'Tags'
    ),
    array(
      'id'      =>'translation-search-article',
      'type'    => 'text',
      'title'   => esc_html__('Search articles', 'magplus'),
      'default' => 'Search articles'
    ),
    array(
      'id'      =>'translation-search-products',
      'type'    => 'text',
      'title'   => esc_html__('Search Products', 'magplus'),
      'default' => 'Search Products..'
    ),
    array(
      'id'      =>'translation-cart',
      'type'    => 'text',
      'title'   => esc_html__('Cart', 'magplus'),
      'default' => 'Cart'
    ),
    array(
      'id'      =>'translation-cart-empty',
      'type'    => 'text',
      'title'   => esc_html__('Cart is empty', 'magplus'),
      'default' => 'Cart is empty'
    ),
    array(
      'id'      =>'translation-qty',
      'type'    => 'text',
      'title'   => esc_html__('Qty', 'magplus'),
      'default' => 'Qty'
    ),
    array(
      'id'      =>'translation-views',
      'type'    => 'text',
      'title'   => esc_html__('Views', 'magplus'),
      'default' => 'Views'
    ),
    array(
      'id'      =>'translation-comment',
      'type'    => 'text',
      'title'   => esc_html__('Comment', 'magplus'),
      'default' => 'Comment'
    ),
    array(
      'id'      =>'translation-comments',
      'type'    => 'text',
      'title'   => esc_html__('Comments', 'magplus'),
      'default' => 'Comments'
    ),
    array(
      'id'      =>'translation-ago',
      'type'    => 'text',
      'title'   => esc_html__('ago', 'magplus'),
      'default' => 'ago'
    ),
    array(
      'id'      =>'translation-loading',
      'type'    => 'text',
      'title'   => esc_html__('LOADING', 'magplus'),
      'default' => 'LOADING'
    ),
    array(
      'id'      =>'translation-load-more',
      'type'    => 'text',
      'title'   => esc_html__('Load More', 'magplus'),
      'default' => 'Load More'
    ),
    array(
      'id'      =>'translation-show-more',
      'type'    => 'text',
      'title'   => esc_html__('Show More', 'magplus'),
      'default' => 'Show More'
    ),
    array(
      'id'      =>'translation-search-results-for',
      'type'    => 'text',
      'title'   => esc_html__('search results for', 'magplus'),
      'default' => 'search results for'
    ),
    array(
      'id'      =>'translation-share',
      'type'    => 'text',
      'title'   => esc_html__('Share', 'magplus'),
      'default' => 'Share'
    ),
    array(
      'id'      =>'translation-you-might-also-like',
      'type'    => 'text',
      'title'   => esc_html__('You Might also Like', 'magplus'),
      'default' => 'You Might also Like'
    ),
    array(
      'id'      =>'translation-related-stories',
      'type'    => 'text',
      'title'   => esc_html__('Related Stories', 'magplus'),
      'default' => 'Related Stories'
    ),
    array(
      'id'      =>'translation-previous-article',
      'type'    => 'text',
      'title'   => esc_html__('Previous Article', 'magplus'),
      'default' => 'Previous Article'
    ),
    array(
      'id'      =>'translation-next-article',
      'type'    => 'text',
      'title'   => esc_html__('Next Article', 'magplus'),
      'default' => 'Next Article'
    ),
    array(
      'id'      =>'translation-type-to-search',
      'type'    => 'text',
      'title'   => esc_html__('Type to search', 'magplus'),
      'default' => 'Type to search'
    ),
    array(
      'id'      =>'translation-latest-news',
      'type'    => 'text',
      'title'   => esc_html__('Latest News', 'magplus'),
      'default' => 'Latest News'
    ),
    array(
      'id'      =>'translation-breaking-news',
      'type'    => 'text',
      'title'   => esc_html__('Breaking News', 'magplus'),
      'default' => 'Breaking News'
    ),
    array(
      'id'      =>'translation-trending',
      'type'    => 'text',
      'title'   => esc_html__('Trending', 'magplus'),
      'default' => 'Trending:'
    ),
    array(
      'id'      =>'translation-first-name',
      'type'    => 'text',
      'title'   => esc_html__('First Name', 'magplus'),
      'default' => 'First Name'
    ),
    array(
      'id'      =>'translation-email-address',
      'type'    => 'text',
      'title'   => esc_html__('Email Address', 'magplus'),
      'default' => 'Email Address'
    ),
    array(
      'id'      =>'translation-subscribe-now',
      'type'    => 'text',
      'title'   => esc_html__('Subscribe Now', 'magplus'),
      'default' => 'Subscribe Now'
    ),
    array(
      'id'      =>'translation-summary',
      'type'    => 'text',
      'title'   => esc_html__('Summary', 'magplus'),
      'default' => 'Summary'
    ),
    array(
      'id'      =>'translation-total-rating',
      'type'    => 'text',
      'title'   => esc_html__('Total Rating', 'magplus'),
      'default' => 'Total Rating'
    ),
    array(
      'id'      =>'translation-leave-comment',
      'type'    => 'text',
      'title'   => esc_html__('Leave a Comment', 'magplus'),
      'default' => 'Leave a Comment'
    ),
    array(
      'id'      =>'translation-cancel-comment',
      'type'    => 'text',
      'title'   => esc_html__('Cancel Comment', 'magplus'),
      'default' => 'Cancel Comment'
    ),
    array(
      'id'      =>'translation-post-comment',
      'type'    => 'text',
      'title'   => esc_html__('Post Comment', 'magplus'),
      'default' => 'Post Comment'
    ),
    array(
      'id'      =>'translation-your-comment',
      'type'    => 'text',
      'title'   => esc_html__('Your Comment', 'magplus'),
      'default' => 'Your Comment'
    ),
    array(
      'id'      =>'translation-email',
      'type'    => 'text',
      'title'   => esc_html__('Email', 'magplus'),
      'default' => 'Email'
    ),
    array(
      'id'      =>'translation-website',
      'type'    => 'text',
      'title'   => esc_html__('Website', 'magplus'),
      'default' => 'Website'
    ),
    array(
      'id'      =>'translation-404',
      'type'    => 'text',
      'title'   => esc_html__('404', 'magplus'),
      'default' => '404'
    ),
    array(
      'id'      =>'translation-back-to-home',
      'type'    => 'text',
      'title'   => esc_html__('Back to Home', 'magplus'),
      'default' => 'Back to Home'
    ),
  ), // #fields
);

