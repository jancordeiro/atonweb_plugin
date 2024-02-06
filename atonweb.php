<?php
/*
Plugin Name: Aton WEB
Description: A tool kit to customize your WordPress dashboard and login for clients.
Version: 1.1
Author: Jan Cordeiro
Author URI: https://jancordeiro.github.io
*/

// Carregar os arquivos
function load_aton_functions() {
    $plugin_path = plugin_dir_path(__FILE__);
	
	$include_dashboard = get_option('include_dashboard', true);
	$include_filters = get_option('include_filters', true);
    $include_actions = get_option('include_actions', true);
    $include_shortcodes = get_option('include_shortcodes', true);
    $include_functions = get_option('include_functions', true);

    if ($include_dashboard) {
        include_once $plugin_path . 'aton-dashboard.php';
    }
	
	if ($include_filters) {
        include_once $plugin_path . 'aton-filters.php';
    }

    if ($include_actions) {
        include_once $plugin_path . 'aton-actions.php';
    }

    if ($include_shortcodes) {
        include_once $plugin_path . 'aton-shortcodes.php';
    }

    if ($include_functions) {
        include_once $plugin_path . 'aton-functions.php';
    }
}
add_action('init', 'load_aton_functions');

// Cria o menu do plugin no painel
function add_aton_menu() {
    add_menu_page(
        'Aton WEB CMS',
        'Aton WEB Settings',
        'manage_options',
        'aton-web-cms',
        'show_options',
        'dashicons-info',
		80
    );
}

function show_options() {
	// Função para exibir instruções no menu
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	  	  $include_dashboard = isset($_POST['include_dashboard']);
		    $include_filters = isset($_POST['include_filters']);
        $include_actions = isset($_POST['include_actions']);
        $include_shortcodes = isset($_POST['include_shortcodes']);
        $include_functions = isset($_POST['include_functions']);

        // Atualiza as opções do usuário após verificar o estado da caixa de seleção
        update_option('include_dashboard', $include_dashboard);
    		update_option('include_filters', $include_filters);
        update_option('include_actions', $include_actions);
        update_option('include_shortcodes', $include_shortcodes);
        update_option('include_functions', $include_functions);

        echo '<div class="notice notice-success"><p>Opções salvas com sucesso!</p></div>';
    }

    // Obtém as opções atuais do usuário
    $include_dashboard = get_option('include_dashboard', true);
	$include_filters = get_option('include_filters', true);
    $include_actions = get_option('include_actions', true);
    $include_shortcodes = get_option('include_shortcodes', true);
    $include_functions = get_option('include_functions', true);
    ?>
    <div class="wrap">
        <h2>Aton WEB - CMS</h2>
        <form method="post">
            <p>Escolha quais funções deseja incluir:</p>
            <label>
                <input type="checkbox" name="include_dashboard" <?php checked($include_dashboard); ?>>
                Incluir Aton WEB Dashboard
            </label><br>
			
			<label>
                <input type="checkbox" name="include_filters" <?php checked($include_filters); ?>>
                Incluir Ganchos de Filters
            </label><br>

            <label>
                <input type="checkbox" name="include_actions" <?php checked($include_actions); ?>>
                Incluir Ganchos de Actions
            </label><br>

            <label>
                <input type="checkbox" name="include_shortcodes" <?php checked($include_shortcodes); ?>>
                Incluir Ganchos de Shortcodes
            </label><br>

            <label>
                <input type="checkbox" name="include_functions" <?php checked($include_functions); ?>>
                Incluir Todos os Ganchos
            </label><br>

            <p><input type="submit" class="button-primary" value="Salvar Opções"></p>
        </form>
    </div>
    <?php
}
add_action('admin_menu', 'add_aton_menu');

// SUBMENU TO HIDE MENU OPTIONS
function add_submenu_config() {
    add_submenu_page(
		'aton-web-cms',
		'Hide Menus',
		'Hide Menus',
		'manage_options',
		'hide-menus',
		'hide_menus_config'
	);
}
add_action('admin_menu', 'add_submenu_config');

// SHOW CONFIG PAGE TO HIDE MENUS
function hide_menus_config() {
    if (!current_user_can('manage_options')) {
        wp_die('Você não tem permissão para acessar esta página.');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        update_option('removed_menus', $_POST['removed_menus']);
        echo '<div class="notice notice-success"><p>Opções salvas com sucesso!</p></div>';
    }

    $removed_menus = get_option('removed_menus', array());

    ?>
    <div class="wrap">
        <h2>Configurações do Menu</h2>
        <form method="post">
            <p>Selecione os menus que deseja remover:</p>
            <label><input type="checkbox" name="menus_removidos[]" value="posts" <?php checked(in_array('posts', $removed_menus)); ?>> Posts</label><br>
            <label><input type="checkbox" name="menus_removidos[]" value="media" <?php checked(in_array('media', $removed_menus)); ?>> Mídia</label><br>
            <label><input type="checkbox" name="menus_removidos[]" value="pages" <?php checked(in_array('pages', $removed_menus)); ?>> Páginas</label><br>
            <label><input type="checkbox" name="menus_removidos[]" value="comments" <?php checked(in_array('comments', $removed_menus)); ?>> Comentários</label><br>
            <label><input type="checkbox" name="menus_removidos[]" value="tools" <?php checked(in_array('tools', $removed_menus)); ?>> Ferramentas</label><br>
            <label><input type="checkbox" name="menus_removidos[]" value="settings" <?php checked(in_array('settings', $removed_menus)); ?>> Configurações</label><br>
            <p><input type="submit" class="button-primary" value="Salvar Opções"></p>
        </form>
    </div>
    <?php
}
?>
