<?php // REMOVE THIS LINE

/* CUSTOM DASHBOARD WIDGET BOX
*
* Copy and paste this script into your theme's functions.php
*
*/

function my_custom_widgetbox() {
	echo '<p>Olá, seja bem-vindo ao Painel ATON.</p>';
	echo '<p>Acesse <a href="https://atonweb.xyz/" target="_blank">nosso site</a> mais informações e suporte.</p>';
}

function add_my_custom_widgetbox() {
	add_meta_box('id', 'ATON WEB', 'my_custom_widgetbox', 'dashboard', 'side', 'high');
}

add_action('wp_dashboard_setup', 'add_my_custom_widgetbox' );
