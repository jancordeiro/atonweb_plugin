<?php
/**
 * ATON WEB DEVELOPMENT
 * 
 * Custom shortcodes for Wordpress CMS
 * 
 * Developer: Jan Cordeiro - https://jancordeiro.github.io
 */

// SHORTCODE TO SHOW UPDATED YEAR
function current_year_shortcode() {
    return date('Y');
}
add_shortcode('current_year', 'current_year_shortcode');
