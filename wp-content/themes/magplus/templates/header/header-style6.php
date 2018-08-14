<?php
/**
 * Header Template file
 *
 * @package magplus
 * @since 1.0
 */
?>
<header class="tt-header tt-header-type-3  tt-header-style-link <?php echo magplus_get_opt('page-layout'); ?>">
  <div class="tt-header-wrapper">
    <div class="top-inner clearfix">
      <div class="container">
        <?php magplus_logo('logo', 'tt-logo-1x'); ?>
        <?php magplus_logo('logo-2x', 'tt-logo-2x', true); ?>
        <?php magplus_text_logo(); ?>
        <div class="cmn-toggle-switch"><span></span></div>
        <div class="cmn-mobile-switch"><span></span></div>
        <a class="tt-s-popup-btn"><i class="fa fa-search" aria-hidden="true"></i></a>
      </div>
    </div>
    <div class="toggle-block">
      <div class="toggle-block-container">
        <nav class="main-nav clearfix">
          <?php magplus_main_menu('menu'); ?>
        </nav>

        <?php if(magplus_get_opt('top-header-enable')): ?>
        <div class="top-line clearfix">
          <div class="container">
            <div class="top-line-left">
              <div class="top-line-entry">
                <ul class="top-menu">
                  <?php
                    if (has_nav_menu('top-menu')):
                      wp_nav_menu(array(
                        'theme_location' => 'top-menu',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'depth'          => 1,
                      ));
                    endif;
                  ?>
                </ul>
              </div>
            </div>
            <div class="top-line-right">
              <div class="top-line-entry">
                <ul class="top-social">
                  <?php magplus_social_links('%s', magplus_get_opt('top-social-icons-category')); ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>


      </div>
    </div>
  </div>
</header>
<?php magplus_header_height('lg'); ?>
