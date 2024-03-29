<?php
/**
 * ATON WEB DEVELOPMENT
 * 
 * Custom action hooks for Wordpress CMS
 * 
 * Developer: Jan Cordeiro - https://jancordeiro.github.io
 */

// ADD ATON BAR LOGO
function aton_admin_bar_logo($wp_admin_bar) {
    $favicon_url = get_site_icon_url();
    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->add_node(array(
        'id'    => 'aton-logo',
        'title' => '<img src="'. $favicon_url . '" style="max-height:20px;display:block;padding-top:5px;">',
        'href'  => admin_url(),
    ));
}
add_action('admin_bar_menu', 'aton_admin_bar_logo', 11);

// REMOVE DASHBOARD MENUS
function remove_dashboard_menus() {
    if (!current_user_can('administrator') && !current_user_can('editor')) {
		
        remove_submenu_page( 'index.php', 'update-core.php' ); // Updates
	//remove_menu_page('edit.php'); // Posts
	//remove_menu_page('upload.php'); // Media
        //remove_menu_page('edit-comments.php'); // Comments
        //remove_menu_page('edit.php?post_type=page'); // Pages
        remove_menu_page('elementor'); // Elementor
	remove_menu_page( 'edit.php?post_type=elementor_library' ); // Elementor Library
        //remove_menu_page('themes.php'); // Themes
        remove_menu_page('plugins.php'); // Plugins
        //remove_menu_page('users.php'); // Users
        remove_menu_page('tools.php'); // Tools
        remove_menu_page('options-general.php'); // Settings
    }
}
add_action('admin_menu', 'remove_dashboard_menus', 10);

// ADMIN WELCOME NOTICE
function aton_web_greeting(){
	$current_screen = get_current_screen();
	$current_user = wp_get_current_user();
	$user_name = $current_user->display_name;
	$site_name = get_bloginfo('name');
	
	if ($current_screen && $current_screen->id === 'dashboard'){
		?>
		<div class="notice updated is-dismissible">
			<p>Hello, <strong style="font-weight: bold;"><?php echo $user_name; ?></strong>! Manage your website here. 🌐</p>
			<!-- IN PORTUGUESE
			<p>Olá, <strong style="font-weight: bold;"><?php echo $user_name; ?></strong>! Aqui você gerencia seu site. 🌐</p>-->
		</div>
		<?php
	}
}
add_action( 'all_admin_notices', 'aton_web_greeting' );

// DISABLE CONTEXTUAL HELP TABS
function remove_contextual_help() {
    $screen = get_current_screen();
    $screen->remove_help_tabs();
}
add_action('admin_head', 'remove_contextual_help');

// REPLACE HOWDY WORD
function replace_howdy_word($wp_admin_bar) {
    
    $my_account = $wp_admin_bar->get_node('my-account');
    $my_account->title = str_replace('Howdy', 'Hello', $my_account->title);
    $wp_admin_bar->add_node($my_account);
}
add_action('admin_bar_menu', 'replace_howdy_word');

// DISABLE DASHBOARD META-BOX WIDGETS EXCEPT FOR ADMINS
function disable_dashboard_metaboxes() {

    if (!current_user_can('administrator')) {
		
        remove_meta_box('dashboard_right_now', 'dashboard', 'normal');          // At a Glance
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side');          // Quick Draft
        remove_meta_box('dashboard_primary', 'dashboard', 'side');              // WordPress Events and News
        remove_meta_box('dashboard_activity', 'dashboard', 'normal');           // Activity
	remove_meta_box('e-dashboard-overview', 'dashboard', 'normal');         // Elementor News
        remove_action('welcome_panel', 'wp_welcome_panel');			// Welcome Panel
    }
}
add_action('wp_dashboard_setup', 'disable_dashboard_metaboxes');

// ADD OPEN GRAPH TAGS INTO HEAD
function add_open_graph_tags() {
    if (is_single() || is_page()) {
        global $post;

        setup_postdata($post);

        $og_title = get_the_title();
        $og_description = get_the_excerpt();
        $og_url = get_permalink();
        $og_image = get_the_post_thumbnail_url($post, 'full');

        echo '<meta property="og:title" content="' . esc_attr($og_title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($og_description) . '" />' . "\n";
        echo '<meta property="og:type" content="article" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url($og_url) . '" />' . "\n";
        
        if ($og_image) {
            echo '<meta property="og:image" content="' . esc_url($og_image) . '" />' . "\n";
        }
    }
}
add_action('wp_head', 'add_open_graph_tags', 5);
