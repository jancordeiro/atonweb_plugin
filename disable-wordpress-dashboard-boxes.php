<?php // REMOVE THIS LINE

/*
* Disable Wordpress Admin Dashboard Boxes
* Copy and paste this script into theme's function.php
*/ 

function remove_wordpress_dashboard() {

    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');	// Right Now
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');	// Activities
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');	// Quick Press
    remove_meta_box('dashboard_primary', 'dashboard', 'side');		// Wordpress News

}

add_action('admin_init', 'remove_wordpress_dashboard');
