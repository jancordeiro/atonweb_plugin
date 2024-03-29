<?php 
/**
 * ATON WEB DEVELOPMENT
 * 
 * Custom filters hooks for Wordpress CMS
 * 
 * Developer: Jan Cordeiro - https://jancordeiro.github.io
 */

// REMOVE THE Lost Your Password
function remove_lost_password_text($text) {
    if ($text == 'Lost your password?') {
        $text = '';
    }
    return $text;
}
add_filter('gettext', 'remove_lost_password_text');

// CHANGE LOGIN URL LINK
function custom_login_url() {
    return home_url();
}
add_filter('login_headerurl', 'custom_login_url', 10);

// Disable Language Dropdown on Login Screen
add_filter( 'login_display_language_dropdown', '__return_false' );

// CUSTOM LOGIN ERROR MESSAGE
function custom_login_errors(){
	return 'Usuário ou senha incorreto. Tente novamente!';
}
add_filter( 'login_errors', 'custom_login_errors' );

// CUSTOM DASH FOOTER TEXT
function custom_admin_footer_text() {
    echo '<center><a href="https://atonweb.xyz" target="_blank" class="button button-primary" style="width: 100%; border-radius: 10px;">Powered by ATON WEB</a></center>';
}
add_filter('admin_footer_text', 'custom_admin_footer_text');

// CUSTOM DASH FOOTER VERSION
function custom_admin_version_text() {
    return '';
}
add_filter('update_footer', 'custom_admin_version_text', 999);

// DISABLE ADMIN SCREEN OPTIONS TAB
function disable_screen_options() {
	if (!current_user_can('administrator')) {
		return false;
	}
}
add_filter('screen_options_show_screen', 'disable_screen_options');

// REMOVES WP TITLE FROM ADMIN PAGES
function remove_admin_title_suffix($admin_title, $title) {
    return $title;
}
add_filter('admin_title', 'remove_admin_title_suffix', 10, 2);

// HIDE FRONT-END ADMIN BAR
function hide_admin_bar_if_non_admin() {
    if (current_user_can('administrator')) {
        return true;
    } else {
		'__return_false';
	}
}
add_filter('show_admin_bar', 'hide_admin_bar_if_non_admin');
