//===========================
  // Admin Cleanup
  //===========================

  // removes admin bar on wordpress home
  // add_filter( 'show_admin_bar', '__return_false' );

  //Replace Howdy
  function replace_howdy($wp_admin_bar) {
   $my_account=$wp_admin_bar->get_node('my-account');
  $newtitle = str_replace('Howdy,', 'Hello,', 'MJM Yachts' );
   $wp_admin_bar->add_node(array(
   'id' => 'my-account',
   'title' => $newtitle,
   )
   );
  }
  add_filter('admin_bar_menu', 'replace_howdy',25);

  // Remove WP logo from admin bar
  add_action( 'wp_before_admin_bar_render', function() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wp-logo');
  }, 7 );

  // Move Yoast to bottom
  function yoasttobottom() {
   return 'low';
  }
  add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

  //===========================
  // Hide Content Editor
  //===========================
  add_action( 'admin_init', 'hide_editor' );
  function hide_editor() {
    // Get the Post ID.
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    if( !isset( $post_id ) ) return;
    // Hide the editor on the page titled 'Home'
    $homepgname = get_the_title($post_id);
    if($homepgname == 'Home'){
      remove_post_type_support('page', 'editor');
    }
    // Standard Internal Template
    $template_file = get_post_meta($post_id, '_wp_page_template', true);
    if($template_file == 'internal.php'){ // the filename of the page template
      remove_post_type_support('page', 'editor');
    }
  }

  //===========================
  // Change admin footer text
  //===========================
  // Right footer text
  function my_footer_version() {
      return 'MJM Yachts';
  }
  add_filter( 'update_footer', 'my_footer_version', 11 );

  // Left footer text
  function wpse_edit_footer() {
   add_filter( 'admin_footer_text', 'wpse_edit_text', 11 );
  }
  function wpse_edit_text($content) {
   return "Built By" . ' <a target="_blank" href="' . 'https://cobblehilldigital.com">' . "Cobble Hill</a>.";
  }
  add_action( 'admin_init', 'wpse_edit_footer' );
