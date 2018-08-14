<?php
/**
 * Before Loop ( page.php )
 *
 * @package magplus
 */
$sidebar_details = magplus_sidebar_position();
$col_class = (is_single() || is_home()) ? 'col-md-8 col-md-offset-2':'col-md-12';
if ($sidebar_details['layout'] == 'left_sidebar'): ?>
  <div class="row">
    <div class="col-md-8 col-md-push-4">

<?php elseif ($sidebar_details['layout'] == 'right_sidebar'): ?>
  <div class="row">
    <div class="col-md-8">

 <!-- dual sidebar-->
<?php elseif ($sidebar_details['layout'] == 'dual_sidebar'): ?>
	<div class="row">
    <div class="col-md-6 col-md-push-3">

<?php else: ?>
  <div class="row">
  	<div class="<?php echo magplus_sanitize_html_classes($col_class);?>">
<?php endif; ?>
