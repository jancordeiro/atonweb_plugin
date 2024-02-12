<?php
/*
Plugin Name: Aton WEB
Description: A tool kit to customize your WordPress dashboard and login for clients.
Version: 1.1
Author: Jan Cordeiro
Author URI: https://jancordeiro.github.io
*/

// Load PHP Files
function load_aton_functions() {
    $plugin_path = plugin_dir_path(__FILE__);
	
	include_once $plugin_path . 'aton-functions.php';
}
add_action('init', 'load_aton_functions');

// Add Aton WEB menu
function add_aton_menu() {
    add_menu_page(
        'Aton WEB CMS',
        'Aton WEB CMS',
        'manage_options',
        'aton-web-cms',
        'show_options',
        plugin_dir_URL(__FILE__) . '/images/atonweb.svg',
		80
    );
}

function show_options() {
	// Função para exibir instruções no menu
    ?>
    <div class="wrap">
        <h2>ATON WEB - CMS</h2>
        <p>Plugin de uso exclusivo da agência Aton WEB com as seguintes funcionalidades:</p>
        <ol>
            <li>Personalizar tela de login;</li>
            <li>Esconder ou exibir items do menu;</li>
			<li>Painel com atalhos que facilitam o uso;</li>
			<li>Tutoriais para os clientes Aton WEB;</li>
        </ol><br/>
		<pre>
Aton WEB Plugin
Version: 1.0
Desenvolvedores: Jan Cordeiro.
		</pre>
    </div>
    <?php
}
add_action('admin_menu', 'add_aton_menu');
?>
