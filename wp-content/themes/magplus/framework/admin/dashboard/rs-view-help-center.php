<?php
/**
 * View Header
 *
 * @package magplus
 * @since 1.0
 */
require_once 'rs-view-header.php';
?>
<div class="about-wrap rs-admin-wrap">
  <h1><?php echo wp_get_theme()->get('Name'); ?> Help Center</h1>
  <div class="about-text" style="margin-bottom:25px;">
    <p>We do our best to support this theme. Before submitting a support ticket, please watch video tutorials & read documentation. Also, please understand that, we're only humans and we tend to sleep & take holidays sometimes. Please wait patiently until we fix your issue. For new feature request, join our Facebook group: <a href="https://goo.gl/3vjQ5R">https://goo.gl/3vjQ5R</a></p>
  </div>

  <div class="rs-admin-box rs-col-three border-blue">
    <div class="icon-box"><img src="<?php echo get_theme_file_uri('framework/admin/assets/img/dashboard/icons/01.png'); ?>" alt="" /></div>
    <h2>Support forum</h2>
    <p>We offer outstanding support through our forum. To get support first you need to register and open a ticket assign ticket to MagPlus.</p>
    <a class="btn-style-1 btn-blue" href="https://gfxbucket.freshdesk.com/helpdesk/tickets/new" target="_blank">Create Ticket</a>     
  </div>


  <div class="rs-admin-box rs-col-three border-green">
    <div class="icon-box"><img src="<?php echo get_theme_file_uri('framework/admin/assets/img/dashboard/icons/02.png'); ?>" alt="" /></div>    
    <h2>Video Tutorials</h2>
    <p>We believe that the easiest way to learn is watching a video tutorial. We have complete set of 20+ video tutorials in our video library which are hosted online.</p>
    <a class="bbutton btn-style-1 btn-green" href="https://www.youtube.com/playlist?list=PLXrHHgyJRjXPWKqWUrIWGbVDcapMmxGh7" target="_blank">Watch Tutorials</a>     
  </div>

  <div class="rs-admin-box rs-col-three last-box border-red">
    <div class="icon-box"><img src="<?php echo get_theme_file_uri('framework/admin/assets/img/dashboard/icons/03.png'); ?>" alt="" /></div>        
    <h2>Documentation</h2>
    <p>Our online documentation will give you essential information about our theme. This is the best place to start with informative ideas. </p>
    <a class="btn-style-1 btn-red" href="http://themebubble.com/documentation/magplus/" target="_blank">Visit Documentation</a>     
  </div>
</div>
