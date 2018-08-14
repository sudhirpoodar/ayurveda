<?php
/*
 * Advanced
*/
$this->sections[] = array(
  'title' => esc_html__('Blog Single Posts', 'magplus'),
  'desc' => esc_html__('Blog single posts confugration.', 'magplus'),
  'icon'  => 'fa fa-newspaper-o',
  'fields' => array(
    array(
      'id'        => 'blog-sidebar-layout',
      'type'      => 'select',
      'compiler'  => true,
      'title'     => esc_html__('Layout', 'magplus'),
      'subtitle'  => esc_html__('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'magplus'),
      'options'   => array(
        'default'       => esc_html__('1 Column', 'magplus'),
        'left_sidebar'  => esc_html__('2 - Columns Left', 'magplus'),
        'right_sidebar' => esc_html__('2 - Columns Right', 'magplus'),
        'dual_sidebar'  => esc_html__('3 - Columns Left/Right', 'magplus'),
      ),
      'default'   => 'default',
    ),
    array(
      'id'        => 'blog-sidebar-left',
      'type'      => 'select',
      'title'     => esc_html__('Sidebar Left', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('blog-sidebar-layout', 'equals', array('left_sidebar', 'dual_sidebar')),
    ),
    array(
      'id'        => 'blog-sidebar-right',
      'type'      => 'select',
      'title'     => esc_html__('Sidebar Right', 'magplus'),
      'subtitle'  => esc_html__('Select custom sidebar', 'magplus'),
      'options'   => magplus_get_custom_sidebars_list(),
      'default'   => '',
      'required'  => array('blog-sidebar-layout', 'equals', array('right_sidebar', 'dual_sidebar')),
    ),
    array(
      'id'=>'post-style',
      'type' => 'select',
      'title' => esc_html__('Post Style', 'magplus'),
      'subtitle' => esc_html__('Select post style.', 'magplus'),
      'options' => array(
        'default'                    => esc_html__('Default','magplus'),
        'default-title-left-aligned' => esc_html__('Post Title Left','magplus'),
        'default-alt'                => esc_html__('No Hero','magplus'),
        'alternative'                => esc_html__('Big Hero','magplus'),
        'alternative-title-middle'   => esc_html__('Box Hero','magplus'),
        'alternative-big-one'        => esc_html__('Title Below Hero','magplus'),
        'alternative-cover'          => esc_html__('Hero Alternative','magplus'),
      ),
      'default' => 'default',
    ),
    array(
      'id'=>'post-date-format',
      'type' => 'select',
      'title' => esc_html__('Post Date Format', 'magplus'),
      'options' => array(
        'default'         => esc_html__('Default','magplus'),
        'ago-date-format' => esc_html__('Time Ago','magplus'),
      ),
      'default' => 'default',
    ),
    array(
      'id'       =>'post-featured-image-parallax',
      'type'     => 'switch',
      'title'    => esc_html__('Post Featured Imgae Parallax', 'magplus'),
      'subtitle' => esc_html__('If on, parallax will be enabled.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '0',
      'required' => array('post-style', 'equals', array('alternative', 'alternative-title-middle', 'alternative-cover')),
    ),
    array(
      'id'       => 'post-featured-image-height',
      'type'     => 'text',
      'title'    => esc_html__('Post Featured Image Height', 'magplus'),
      'default'  => '',
      'desc'     => 'Add height (optional)',
      'required' => array('post-style', 'equals', array('alternative', 'alternative-big-one', 'alternative-title-middle', 'alternative-cover')),
    ),
    array(
      'id'=>'post-enable-post-comment',
      'type' => 'switch',
      'title' => esc_html__('Comment', 'magplus'),
      'subtitle'=> esc_html__('If on, post share section will be displayed on a single post page.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'=>'post-enable-post-author',
      'type' => 'switch',
      'title' => esc_html__('Author', 'magplus'),
      'subtitle'=> esc_html__('If on, post share section will be displayed on a single post page.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'=>'post-enable-post-date',
      'type' => 'switch',
      'title' => esc_html__('Date', 'magplus'),
      'subtitle'=> esc_html__('If on, post share section will be displayed on a single post page.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'=>'post-enable-post-category',
      'type' => 'switch',
      'title' => esc_html__('Category', 'magplus'),
      'subtitle'=> esc_html__('If on, post share section will be displayed on a single post page.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'=>'post-enable-post-share',
      'type' => 'switch',
      'title' => esc_html__('Post Share', 'magplus'),
      'subtitle'=> esc_html__('If on, post share section will be displayed on a single post page.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    
    array(
      'id'=>'post-enable-author-description',
      'type' => 'switch',
      'title' => esc_html__('Author Description', 'magplus'),
      'subtitle'=> esc_html__('If on, author description will be displayed on a single post page.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'       => 'post-author-social-icons-category',
      'type'     => 'select',
      'title'    => esc_html__('Author Social Icons Category', 'magplus'),
      'subtitle' => esc_html__('Select desired category', 'magplus'),
      'options'  => magplus_get_terms_assoc('social-site-category'),
      'default'  => '',
      'required' => array('post-enable-author-description', 'equals', array('1')),
    ),
    array(
      'id'=>'post-enable-related-post',
      'type' => 'switch',
      'title' => esc_html__('Related Posts', 'magplus'),
      'subtitle'=> esc_html__('If on, similar posts will be displayed automatically on a single post page.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'=>'post-enable-next-post-popup',
      'type' => 'switch',
      'title' => esc_html__('Next Post Popup', 'magplus'),
      'subtitle'=> esc_html__('If on, next post poup will appear on scroll.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),

    array(
      'id' => 'random-number',
      'type' => 'info',
      'desc' => '<h3 style="color:#303539;font-weight:500;">'.esc_html__('Mobile Configuration', 'magplus').'</h3>'
    ),
    array(
      'id'=>'mobile-post-enable-similar-post',
      'type' => 'switch',
      'title' => esc_html__('Related Posts on Mobile', 'magplus'),
      'subtitle'=> esc_html__('If on, similar posts will be displayed automatically on mobile.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'=>'mobile-post-enable-next-post-popup',
      'type' => 'switch',
      'title' => esc_html__('Next Post Popup on Mobile', 'magplus'),
      'subtitle'=> esc_html__('If on, next post poup will appear on scroll on mobile.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),
    array(
      'id'=>'mobile-post-enable-sticky-video',
      'type' => 'switch',
      'title' => esc_html__('Sticky Video on Mobile', 'magplus'),
      'subtitle'=> esc_html__('If on, sticky video will appear on mobile.', 'magplus'),
      'options' => array(
        '1' => 'On',
        '0' => 'Off',
      ),
      'default' => '1',
    ),

  ), // #fields
);
