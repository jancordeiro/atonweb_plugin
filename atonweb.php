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
            <label><input type="checkbox" name="removed_menus[]" value="posts" <?php checked(in_array('posts', $removed_menus)); ?>> Posts</label><br>
            <label><input type="checkbox" name="removed_menus[]" value="media" <?php checked(in_array('media', $removed_menus)); ?>> Mídia</label><br>
            <label><input type="checkbox" name="removed_menus[]" value="pages" <?php checked(in_array('pages', $removed_menus)); ?>> Páginas</label><br>
            <label><input type="checkbox" name="removed_menus[]" value="comments" <?php checked(in_array('comments', $removed_menus)); ?>> Comentários</label><br>
            <label><input type="checkbox" name="removed_menus[]" value="tools" <?php checked(in_array('tools', $removed_menus)); ?>> Ferramentas</label><br>
            <label><input type="checkbox" name="removed_menus[]" value="settings" <?php checked(in_array('settings', $removed_menus)); ?>> Configurações</label><br>
            <p><input type="submit" class="button-primary" value="Salvar Opções"></p>
        </form>
    </div>
    <?php
}

// ADD SUBMENU PAGE TO SETUP A LOGIN LOGO
function add_login_logo_page() {
    add_submenu_page(
        'aton-web-cms', 					// parent slug
        'Replace Login Logo', 				// page title
        'Replace Login Logo',				// submenu title
        'manage_options', 					// admin rola required to access
        'replace-login-logo',	 			// page slug
        'replace_login_logo_page' 			// callback function
    );
}
add_action('admin_menu', 'add_login_logo_page');

function replace_login_logo_page() {
    if (!current_user_can('manage_options')) {
        wp_die('Você não tem permissão para acessar esta página.');
    }
	
	wp_enqueue_script('jquery');
	
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['myplugin_login_settings_nonce']) && wp_verify_nonce($_POST['myplugin_login_settings_nonce'], 'myplugin_login_settings_nonce')) {
            // Save changes
            update_option('myplugin_login_logo', $_POST['login_logo']);
            update_option('myplugin_login_custom_link', $_POST['custom_link']);
            update_option('myplugin_login_custom_link_url', $_POST['custom_link_url']);
            echo '<div class="notice notice-success"><p>Opções salvas com sucesso!</p></div>';
        }
    }

    // Get current settings
    $login_logo_id = get_option('myplugin_login_logo_id', '');
    $custom_link = get_option('myplugin_login_custom_link', '');
    $custom_link_url = get_option('myplugin_login_custom_link_url', '');

    // Get logo URL if it exists
    $login_logo_url = '';
    if (!empty($login_logo_id)) {
        $login_logo_attachment = wp_get_attachment_image_src($login_logo_id, 'full');
        if ($login_logo_attachment) {
            $login_logo_url = $login_logo_attachment[0];
        }
    }

    // Show settings form
    ?>
    <div class="wrap">
        <h2>Configurações de Login</h2>
        <form method="post">
            <?php wp_nonce_field('myplugin_login_settings_nonce', 'myplugin_login_settings_nonce'); ?>
            <label for="login_logo">Logo de Login:</label><br>
            <?php
            if (!empty($login_logo_id)) {
                echo wp_get_attachment_image($login_logo_id, 'thumbnail');
                echo '<br>';
            }
            ?>
            <input type="hidden" name="login_logo" id="login_logo" value="<?php echo esc_attr($login_logo_id); ?>">
            <button id="upload_logo_button" class="button-secondary">Selecionar Imagem</button>
            <?php if (!empty($login_logo_id)) : ?>
                <button id="remove_logo_button" class="button-secondary">Remover Imagem</button>
            <?php endif; ?>
            <br>
            <label for="custom_link">Texto do Link:</label><br>
            <input type="text" name="custom_link" value="<?php echo esc_attr($custom_link); ?>"><br>
            <label for="custom_link_url">URL do Link:</label><br>
            <input type="text" name="custom_link_url" value="<?php echo esc_attr($custom_link_url); ?>"><br>
            <input type="submit" class="button-primary" value="Salvar Configurações">
        </form>
    </div>

    <script>
    jQuery(document).ready(function($) {
        $('#upload_logo_button').click(function(e) {
            e.preventDefault();
            var mediaUploader = wp.media({
                title: 'Escolha uma Imagem para o Logo',
                button: {
                    text: 'Selecionar'
                },
                multiple: false
            });
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#login_logo').val(attachment.id);
                $('#login_logo').next().html('<img src="' + attachment.url + '" style="max-width: 200px;">');
            });
            mediaUploader.open();
        });

        $('#remove_logo_button').click(function(e) {
            e.preventDefault();
            $('#login_logo').val('');
            $('#login_logo').next().html('');
        });
    });
    </script>
    <?php
}

// Function to replace login logo
function replace_login_logo() {
    $login_logo_id = get_option('myplugin_login_logo', '');
    if (!empty($login_logo_id)) {
        echo '<style type="text/css">
            .login h1 a { background-image: url(' . esc_url($login_logo_id) . ') !important; }
        </style>';
    }
}
add_action('login_enqueue_scripts', 'replace_login_logo');

// Replace WP logo links
function replace_login_links() {
    $custom_link = get_option('myplugin_login_custom_link', '');
    $custom_link_url = get_option('myplugin_login_custom_link_url', '');

    if (!empty($custom_link) && !empty($custom_link_url)) {
        ?>
        <style type="text/css">
            .login #nav a, .login #backtoblog a { display: none; }
        </style>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                var loginBackToLink = document.querySelector('.login #backtoblog');
                if (loginBackToLink) {
                    loginBackToLink.innerHTML = '<a href="<?php echo esc_url($custom_link_url); ?>"><?php echo esc_html($custom_link); ?></a>';
                }
            });
        </script>
        <?php
    }
}
add_action('login_footer', 'replace_login_links');
?>
