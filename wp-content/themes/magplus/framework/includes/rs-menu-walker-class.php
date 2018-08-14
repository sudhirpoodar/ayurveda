<?php
/**
 * Adds custom items to Menus edit screen (nav-menus.php)
 *
 * @package magplus
 */
new RS_Custom_Menu();

class RS_Custom_Menu {

    /**
   * Construct
   */
    public function __construct() {
      add_action( 'wp_update_nav_menu_item', array( $this, 'save_custom_menu_items'), 10, 3 );
      add_filter( 'wp_edit_nav_menu_walker', array( $this, 'nav_menu_edit_walker'), 10, 2 );
      add_filter( 'wp_setup_nav_menu_item', array( $this, 'read_custom_menu_items' ) );

    } // end constructor

  /**
   * Read custom menu itesm
   * @param object $menu_item
   * @return type
   */
    function read_custom_menu_items( $menu_item ) {
      $menu_item->megamenu      = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
      $menu_item->megamenu_page = get_post_meta( $menu_item->ID, '_menu_item_megamenu_page', true );
      $menu_item->font_icon     = get_post_meta( $menu_item->ID, '_menu_item_font_icon', true );
      $menu_item->label_custom  = get_post_meta( $menu_item->ID, '_menu_item_label_custom', true );
      $menu_item->label_color   = get_post_meta( $menu_item->ID, '_menu_item_label_color', true );
      return $menu_item;
    }

  /**
   * Save custom menu items
   * @param int $menu_id
   * @param int $menu_item_db_id
   * @param array $args
   */
    function save_custom_menu_items( $menu_id, $menu_item_db_id, $args ) {

      if (!isset($_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id])) {
        $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id] = '';
      }
      $menu_mega_enabled_value = $_REQUEST['edit-menu-item-megamenu'][$menu_item_db_id];
      update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $menu_mega_enabled_value );

      if (!isset($_REQUEST['edit-menu-item-megamenu_page'][$menu_item_db_id])) {
        $_REQUEST['edit-menu-item-megamenu_page'][$menu_item_db_id] = '';
      }
      $menu_mega_page_enabled_value = $_REQUEST['edit-menu-item-megamenu_page'][$menu_item_db_id];
      update_post_meta( $menu_item_db_id, '_menu_item_megamenu_page', $menu_mega_page_enabled_value );

      if (!isset($_REQUEST['edit-menu-item-font_icon'][$menu_item_db_id])) {
        $_REQUEST['edit-menu-item-font_icon'][$menu_item_db_id] = '';
      }
      $font_icon_value = $_REQUEST['edit-menu-item-font_icon'][$menu_item_db_id];
      update_post_meta( $menu_item_db_id, '_menu_item_font_icon', $font_icon_value );

      if (!isset($_REQUEST['edit-menu-item-label'][$menu_item_db_id])) {
        $_REQUEST['edit-menu-item-label'][$menu_item_db_id] = '';
      }
      $label_custom_value = $_REQUEST['edit-menu-item-label_custom'][$menu_item_db_id];
      update_post_meta( $menu_item_db_id, '_menu_item_label_custom', $label_custom_value );

      if (!isset($_REQUEST['edit-menu-item-label_color'][$menu_item_db_id])) {
        $_REQUEST['edit-menu-item-label_color'][$menu_item_db_id] = '';
      }
      $label_color_value = $_REQUEST['edit-menu-item-label_color'][$menu_item_db_id];
      update_post_meta( $menu_item_db_id, '_menu_item_label_color', $label_color_value );

    }

    /**
   * Return walker name
   * @return string
   */
    function nav_menu_edit_walker() {
        return 'Walker_Nav_Menu_Edit_Custom';
    }
}




/**
 * This is a copy of Walker_Nav_Menu_Edit class in core
 *
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu {
  /**
   * @see Walker_Nav_Menu::start_lvl()
   * @since 3.0.0
   *
   * @param string $output Passed by reference.
   */
  function start_lvl( &$output, $depth = 0, $args = array() ) {}

  /**
   * @see Walker_Nav_Menu::end_lvl()
   * @since 3.0.0
   *
   * @param string $output Passed by reference.
   */
  function end_lvl( &$output, $depth = 0, $args = array() ) {}

  /**
   * @see Walker::start_el()
   * @since 3.0.0
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param object $item Menu item data object.
   * @param int $depth Depth of menu item. Used for padding.
   * @param object $args
   */
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $_wp_nav_menu_max_depth;
    $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    ob_start();
    $item_id = esc_attr( $item->ID );
    $removed_args = array(
      'action',
      'customlink-tab',
      'edit-menu-item',
      'menu-item',
      'page-tab',
      '_wpnonce',
    );

    $original_title = '';
    if ( 'taxonomy' == $item->type ) {
      $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
      if ( is_wp_error( $original_title ) )
        $original_title = false;
    } elseif ( 'post_type' == $item->type ) {
      $original_object = get_post( $item->object_id );
      $original_title = $original_object->post_title;
    }

    $classes = array(
      'menu-item menu-item-depth-' . $depth,
      'menu-item-' . esc_attr( $item->object ),
      'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
    );

    $title = $item->title;

    if ( ! empty( $item->_invalid ) ) {
      $classes[] = 'menu-item-invalid';
      /* translators: %s: title of menu item which is invalid */
      $title =  sprintf( __( '%s (Invalid)','magplus' ), $item->title );
    } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
      $classes[] = 'pending';
      /* translators: %s: title of menu item in draft status */
      $title = sprintf( __('%s (Pending)','magplus'), $item->title );
    }

    $title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

    ?>
    <li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo magplus_sanitize_html_classes(implode(' ', $classes )); ?>">
      <dl class="menu-item-bar">
        <dt class="menu-item-handle">
          <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo (0 == $depth ? 'style="display: none;"' : ''); ?>><?php esc_html_e( 'sub item', 'magplus'); ?></span></span>
          <span class="item-controls">
            <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
            <span class="item-order hide-if-js">
              <a href="<?php
                echo wp_nonce_url(
                  add_query_arg(
                    array(
                      'action' => 'move-up-menu-item',
                      'menu-item' => $item_id,
                    ),
                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                  ),
                  'move-menu_item'
                );
              ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up','magplus'); ?>">&#8593;</abbr></a>
              |
              <a href="<?php
                echo wp_nonce_url(
                  add_query_arg(
                    array(
                      'action' => 'move-down-menu-item',
                      'menu-item' => $item_id,
                    ),
                    remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                  ),
                  'move-menu_item'
                );
              ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down','magplus'); ?>">&#8595;</abbr></a>
            </span>
            <a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item','magplus'); ?>" href="<?php
              echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
            ?>"><?php esc_html_e( 'Edit Menu Item','magplus' ); ?></a>
          </span>
        </dt>
      </dl>

      <div class="menu-item-settings" style="overflow:hidden;" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">

        <?php if( 'custom' == $item->type ) : ?>
          <p class="field-url description description-wide">
            <label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
              <?php esc_html_e( 'URL','magplus'); ?><br />
              <input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
            </label>
          </p>
        <?php endif; ?>

        <p class="description description-thin">
          <label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
            <?php esc_html_e( 'Navigation Label','magplus' ); ?><br />
            <input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
          </label>
        </p>

        <p class="description description-thin">
          <label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
            <?php esc_html_e( 'Title Attribute','magplus' ); ?><br />
            <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
          </label>
        </p>


        <p class="field-link-target description">
          <label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
            <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
            <?php esc_html_e( 'Open link in a new window/tab','magplus' ); ?>
          </label>
        </p>

        <p class="field-css-classes description description-thin">
          <label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
            <?php esc_html_e( 'CSS Classes (optional)','magplus' ); ?><br />
            <input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
          </label>
        </p>

        <p class="field-xfn description description-thin">
          <label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
            <?php esc_html_e( 'Link Relationship (XFN)','magplus' ); ?><br />
            <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
          </label>
        </p>

        <p class="field-description description description-wide">
          <label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
            <?php esc_html_e( 'Description','magplus' ); ?><br />
            <textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
            <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.','magplus'); ?></span>
          </label>
        </p>

        <p class="field-move hide-if-no-js description description-wide">
          <label>
            <span><?php esc_html_e( 'Move','magplus' ); ?></span>
            <a href="#" class="menus-move-up"><?php esc_html_e( 'Up one','magplus' ); ?></a>
            <a href="#" class="menus-move-down"><?php esc_html_e( 'Down one','magplus' ); ?></a>
            <a href="#" class="menus-move-left"></a>
            <a href="#" class="menus-move-right"></a>
            <a href="#" class="menus-move-top"><?php esc_html_e( 'To the top','magplus' ); ?></a>
          </label>
        </p>

        <!-- Mega Menu item -->
        <?php
          $value = get_post_meta( $item->ID, '_menu_item_megamenu', true);
        ?>
        <div class="clearboth" style="clear:both;"></div>
        <div class="mega-menu-container">
          <p class="field-link-mega">
            <label for="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>">
              <input type="checkbox" value="enabled" class="mega-menu-chk" id="edit-menu-item-megamenu-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-megamenu[<?php echo esc_attr($item_id); ?>]" <?php echo ("enabled" == $value ? 'checked="checked"' : ''); ?> />
              <?php esc_html_e( 'Create Mega Menu With Post Tabbed', 'magplus' ); ?>
            </label>
          </p>
        </div>
        <!-- /Mega Menu item -->


        <!-- Mega Menu item -->
        <?php
          $value = get_post_meta( $item->ID, '_menu_item_megamenu_page', true);
        ?>

        <label style="color:#ff0000">OR</a></label>

        <div class="clearboth" style="clear:both;"></div>
        <div class="mega-menu-container">
          <p class="field-link-mega">
            <label for="edit-menu-item-megamenu_page-<?php echo esc_attr($item_id); ?>">
              <input type="checkbox" value="enabled" class="mega-menu-chk" id="edit-menu-item-megamenu_page-<?php echo esc_attr($item_id); ?>" name="edit-menu-item-megamenu_page[<?php echo esc_attr($item_id); ?>]" <?php echo ("enabled" == $value ? 'checked="checked"' : ''); ?> />
              <?php esc_html_e( 'Create Mega Menu With Pages', 'magplus' ); ?>

            </label>
          </p>
        </div>
        <!-- /Mega Menu item -->

        <?php $value = get_post_meta( $item->ID, '_menu_item_font_icon', true); ?>
        <div class="clearboth" style="clear:both;"></div>
        <div class="footer-menu-container">
          <p class="field-link-footer description description-wide">
            <label for="edit-menu-item-font_icon-<?php echo esc_attr($item_id); ?>">
              <?php esc_html_e( 'Icon Font Name', 'magplus' ); ?><br />
              <input class="widefat code" type="text" id="edit-menu-item-font_icon-<?php echo esc_attr($item_id); ?>" value="<?php echo esc_attr($value); ?>" name="edit-menu-item-font_icon[<?php echo esc_attr($item_id); ?>]" />
            </label>
            <label>Refer to this <a href="http://material.io/icons/" target="_blank">material.io/icons/</a></label>
          </p>
        </div>

        <?php $value = get_post_meta( $item->ID, '_menu_item_label_custom', true); ?>
        <div class="clearboth" style="clear:both;"></div>
        
        <p class="field-link-footer description description-thin">
          <label for="edit-menu-item-label_custom-<?php echo esc_attr($item_id); ?>">
            <?php esc_html_e( 'Label', 'magplus' ); ?><br />
            <input class="widefat code" type="text" id="edit-menu-item-label_custom-<?php echo esc_attr($item_id); ?>" value="<?php echo esc_attr($value); ?>" name="edit-menu-item-label_custom[<?php echo esc_attr($item_id); ?>]" />
          </label>
          <label>Label as 'hot','new','popular'</label>
        </p>
        

        <?php $value = get_post_meta( $item->ID, '_menu_item_label_color', true); ?>
        
       
        <p class="field-link-footer description description-thin">
          <label for="edit-menu-item-label_color-<?php echo esc_attr($item_id); ?>">
            <?php esc_html_e( 'Label Hex Color', 'magplus' ); ?><br />
            <input class="widefat code" type="text" id="edit-menu-item-label_color-<?php echo esc_attr($item_id); ?>" value="<?php echo esc_attr($value); ?>" name="edit-menu-item-label_color[<?php echo esc_attr($item_id); ?>]" />
          </label>
          <label>e.g #00ff00</label>
        </p>
        

        <div class="menu-item-actions description-wide submitbox">
          <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
            <p class="link-to-original">
              <?php printf( esc_html__('Original: %s','magplus'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
            </p>
          <?php endif; ?>
          <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
          echo wp_nonce_url(
            add_query_arg(
              array(
                'action' => 'delete-menu-item',
                'menu-item' => $item_id,
              ),
              admin_url( 'nav-menus.php' )
            ),
            'delete-menu_item_' . $item_id
          ); ?>"><?php esc_html_e( 'Remove','magplus'); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
            ?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel','magplus'); ?></a>
        </div>

        <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
        <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
        <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
        <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
        <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
        <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
      </div><!-- .menu-item-settings-->
      <ul class="menu-item-transport"></ul>
    <?php
    $output .= ob_get_clean();
  }
}

/**
 * magplus Menu Widget Walker
 */
class magplus_menu_widget_walker_nav_menu extends Walker_Nav_Menu {

  var $item_data   = array();
  var $item_childs = array();
  public $mobile_menu;

  /**
   * Current item
   * @var object
   */
  private $current_item;

  /**
   * We need to know when menu is multi columns
   * @var boolean
   */
  private $is_multi_columns = false;

  public function __construct($mobile_mega_menu) {
    $this->mobile_menu = $mobile_mega_menu;
  }


  /**
   * Starts the list before the elements are added.
   *
   * @see Walker::start_lvl()
   *
   * @since 3.0.0
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param int    $depth  Depth of menu item. Used for padding.
   * @param array  $args   An array of arguments. @see wp_nav_menu()
   */
  public function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $class = '';

    if ( $this ->current_item->hasChildren && $depth == 0 ) {
      $class .= 'drop-menu ';
    }

    if ( $this->current_item->megamenu_page == 'enabled' && $depth == 0 && $this->mobile_menu == 'enabled' ) {
      $class .= 'tt-mega-wrapper clearfix ';
    }

    if ($this->is_multi_columns == true && $depth == 1 && $this->mobile_menu == 'enabled') {
      $class .= 'tt-mega-list ';
    }

    //echo $depth;

    if($this->current_item->megamenu == 'enabled') {
      $output .= '';
    } else {
      $output .= "\n$indent<ul class=\"".$class."\">\n";
    }


  }

  /**
   * Start the element output.
   *
   * @see Walker::start_el()
   *
   * @since 3.0.0
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param object $item   Menu item data object.
   * @param int    $depth  Depth of menu item. Used for padding.
   * @param array  $args   An array of arguments. @see wp_nav_menu()
   * @param int    $id     Current item ID.
   */
  public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

    if( ! empty( $this->item_data[$item->menu_item_parent] ) ) { return; }

    //set curret item to use in start_lvl
    $this->current_item = $item;

    //set if multi columns menu is enabled
    if ($item->megamenu == 'enabled' && $depth == 0) {
      $this->is_multi_columns = true;
    } else if ($depth == 0) {
      $this->is_multi_columns = false;
    }

    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;

    if($this->is_multi_columns === true && $depth == 0) {
      $classes[] = 'parent mega ';
    }

    if($this -> is_multi_columns === true && $item->megamenu_page == 'enabled') {
      $classes[] = 'tt-both-mega-enabled ';
    }

    if($item->megamenu_page == 'enabled' && $depth == 0) {
      $classes[] = 'parent mega type-2 ';
    }

    //var_dump($item->menu_item_parent);

    // if($item->menu_item_parent->megamenu_page == 'enabled' && $depth == 1) {
    //   $classes[] = 'tt-mega-content ';
    // }

    $classes[] = ( $item -> hasChildren && $depth == 0 ) ? 'parent':'';

    /**
     * Filter the CSS class(es) applied to a menu item's <li>.
     *
     * @since 3.0.0
     *
     * @see wp_nav_menu()
     *
     * @param array  $classes The CSS classes that are applied to the menu item's <li>.
     * @param object $item    The current menu item.
     * @param array  $args    An array of wp_nav_menu() arguments.
     */
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . magplus_sanitize_html_classes( $class_names ) . '"' : '';

    /**
     * Filter the ID applied to a menu item's <li>.
     *
     * @since 3.0.1
     *
     * @see wp_nav_menu()
     *
     * @param string $menu_id The ID that is applied to the menu item's <li>.
     * @param object $item    The current menu item.
     * @param array  $args    An array of wp_nav_menu() arguments.
     */
    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $class_names .'>';



    if ($item -> hide != 'enabled') {

      $atts = array();
      $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
      $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
      $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
      $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

      /**
       * Filter the HTML attributes applied to a menu item's <a>.
       *
       * @since 3.6.0
       *
       * @see wp_nav_menu()
       *
       * @param array $atts {
       *     The HTML attributes applied to the menu item's <a>, empty strings are ignored.
       *
       *     @type string $title  Title attribute.
       *     @type string $target Target attribute.
       *     @type string $rel    The rel attribute.
       *     @type string $href   The href attribute.
       * }
       * @param object $item The current menu item.
       * @param array  $args An array of wp_nav_menu() arguments.
       */
      $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

      $attributes = '';
      foreach ( $atts as $attr => $value ) {
        if ( ! empty( $value ) ) {
          $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
          $attributes .= ' ' . $attr . '="' . $value . '"';
        }
      }

      $item_output = $args->before;
      $item_output .= '<a'. $attributes .'>';

      $style = (!empty($item->label_color)) ? ' style="background:'.esc_attr($item->label_color).';"':'';

      $item_output .= ($depth == 0 && !empty($item->font_icon)) ? '<i class="material-icons">'.$item->font_icon.'</i>':'';

      /** This filter is documented in wp-includes/post-template.php */
      $navigation_label = '';

      if ($item -> hide_navigation_label != 'enabled') {
        $navigation_label = apply_filters( 'the_title', $item->title, $item->ID );
      }

      $item_output .= $args->link_before . $navigation_label . $args->link_after;
      $item_output .= ($depth == 0 && !empty($item->label_custom)) ? '<p class="tt-label"'.$style.'>'.esc_html($item->label_custom).'</p>':'';
      $item_output .= ($depth == 0 && $item->hasChildren || $this->is_multi_columns == true && $item->hasChildren ) ? '<i class="menu-toggle fa fa-angle-down"></i>':'';
      $item_output .= '</a>';

      //var_dump(      $item_output .= $args->after);

      $item_output .= $args->after;


    } else {
      $item_output = '';
    }

    /**
     * Filter a menu item's starting output.
     *
     * The menu item's starting output only includes $args->before, the opening <a>,
     * the menu item's title, the closing </a>, and $args->after. Currently, there is
     * no filter for modifying the opening and closing <li> for a menu item.
     *
     * @since 3.0.0
     *
     * @see wp_nav_menu()
     *
     * @param string $item_output The menu item's starting HTML output.
     * @param object $item        Menu item data object.
     * @param int    $depth       Depth of menu item. Used for padding.
     * @param array  $args        An array of wp_nav_menu() arguments.
     */
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );


    if($this->current_item->megamenu_page == 'enabled' && $depth == 0) {
      //$output .= '<div class="tt-mega-wrapper clearfix">';
    }


    // here comes the blog part
    if($this->is_multi_columns == true && $depth == 0 && $this->mobile_menu == 'enabled') {
      ob_start();
      magplus_mega_menu_post( $item );
      $output .= ob_get_clean();
    }

  }

  public function end_el( &$output, $item, $depth = 0, $args = array() ) {
    if($this->current_item->megamenu == 'enabled' && $depth == 1) {
      $output .= '';
    } else {
      $output .= '</li>';
    }
  }

  public function end_lvl( &$output, $depth = 0, $args = array() ) {
    if($this->current_item->megamenu == 'enabled' && $this->current_item->hasChildren) {
      $output .= '';
    } else {
      $output .= '</ul>';
    }

    //$output .= ($this->current_item->megamenu_page == 'enabled' && $depth == 0) ? '</div>':'';
  }

  function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {

    $this->item_data[$element->ID] = ( ! empty( $element->megamenu ) ) ? true : false;

    $element->item_childs = ( ! empty( $children_elements[$element->ID] ) ) ? $children_elements[$element->ID] : array();
    
    if( ! empty( $this->item_data[$element->menu_item_parent]) ) {
      $this->item_data[$element->ID] = $this->item_data[$element->menu_item_parent];
    }

    // check, whether there are children for the given ID and append it to the element with a (new) ID
    $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);


    return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
}

if(!function_exists('magplus_mega_menu_post')) {
  function magplus_mega_menu_post( $item ) {
    global $wp_query;

    $tmp_query = $wp_query;
    if($item->hasChildren):
    ?>
    <div class="tt-mega-wrapper clearfix">
      <ul class="tt-mega-list">
      <?php
        foreach( $item->item_childs as $key => $child ) {
          $active_class = ($key == 0) ? ' active':'';
            //var_dump($child);
            echo '<li class="'.$active_class.'"><a href="'.esc_url($child->url).'">'. $child->title .'</a></li>';
        }
      ?>
      </ul>
      <div class="tt-mega-content">
        <?php foreach( $item->item_childs as $key => $child ): $active_class = ($key == 0) ? ' active':''; ?>
        <div class="tt-mega-entry <?php echo $active_class; ?>">
          <div class="row">

            <?php

              $args = array(
                'cat'            => $child->object_id,
                'posts_per_page' => 4,
              );

              $wp_query = new WP_QUERY( $args ); 
              while ($wp_query -> have_posts()) : $wp_query -> the_post(); 
            ?>
              <div <?php post_class('col-sm-3'); ?>> 
                <div class="tt-post type-3">
                  <?php magplus_post_format('magplus-small', 'img-responsive'); ?>
                  <div class="tt-post-info">
                    <?php magplus_blog_title('c-h5'); ?>
                    <?php magplus_blog_author_date(); ?>
                  </div>
                </div>                 
              </div>
            <?php endwhile; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php
  endif;

  wp_reset_query();
  wp_reset_postdata();
  $wp_query = $tmp_query;

  }
}
