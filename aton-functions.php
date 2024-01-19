<?php
/**
 * ATON WEB DEVELOPMENT
 * 
 * Load PHP files to custom Wordpress CMS.
 *
 * Developer: Jan Cordeiro
 * URL: https://jancordeiro.github.io
 */

function load_aton_admin_style() {
    wp_enqueue_style('aton_admin_css', get_stylesheet_directory_uri() . '/aton-admin-style.css');
}
add_action('admin_enqueue_scripts', 'load_aton_admin_style');

function load_aton_login_style() {
    wp_enqueue_style('aton-login-css', get_stylesheet_directory_uri() . '/aton-login-style.css', false);
}
add_action('login_enqueue_scripts', 'load_aton_login_style');

include_once 'aton-dashboard.php';
include_once 'aton-actions.php';
include_once 'aton-filters.php';
include_once 'aton-shortcodes.php';
