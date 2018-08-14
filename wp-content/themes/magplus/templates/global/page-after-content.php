<?php
/**
 *
 * @package magplus
 */
$sidebar_details = magplus_sidebar_position();
if ($sidebar_details['layout'] == 'right_sidebar'): ?>
  </div>
  <?php get_sidebar('right'); ?>
 </div><!-- .row -->
<?php elseif ($sidebar_details['layout'] == 'left_sidebar'): ?>
  </div>
  <?php get_sidebar('left'); ?>
 </div><!-- .row -->
<?php elseif($sidebar_details['layout'] == 'dual_sidebar'): ?>
  </div>
  <?php get_sidebar('left'); ?>
  <?php get_sidebar('right'); ?>
</div>
<?php else: ?>
	</div>
</div>
<?php endif; ?>
