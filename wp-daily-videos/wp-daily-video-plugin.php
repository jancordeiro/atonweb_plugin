<?php
/*
Plugin Name: WP Daily Video
Description: Exibe vídeos do YouTube de acordo com o dia da semana.
Version: 1.0
Author: Jan Cordeiro
Author URI: https://github.com/jancordeiro
*/

// Função para exibir o vídeo do YouTube correspondente ao dia da semana
function get_youtube_video_url_by_day() {
     // Array com as URLs dos vídeos do YouTube
    $video_urls = array(
        0 => 'https://www.youtube.com/watch?v=MKM90u7pf3U',
        1 => 'https://www.youtube.com/watch?v=E6M-XUW4xYY',
        2 => 'http://www.youtube.com/watch?v=ZIMfB0cHBu8',
        3 => 'https://www.youtube.com/watch?v=Di310WS8zLk',
        4 => 'https://www.youtube.com/watch?v=zZdVwTjUtjg',
        5 => 'https://youtube.com/watch?v=mGgMZpGYiy8',
        6 => 'https://www.youtube.com/watch?v=YDDHHrt6l4w',
    );
	
	// Obtém a data atual do WordPress
    $current_time = strtotime(current_time('mysql'));

    // Obtém o nome do dia da semana em minúsculas (por exemplo: "segunda")
    $day_of_week = date('w', $current_time);

    // Verifica se o nome do dia da semana está no array de URLs
    if (isset($video_urls[$day_of_week])) {
        return $video_urls[$day_of_week];
    } else {
        // Retorna uma URL padrão caso não haja URL correspondente ao dia da semana
        return 'https://www.youtube.com/watch?v=nVqaintvwFg';
	}
}

// Função para exibir o shortcode
function youtube_video_by_day_shortcode() {
    // Obtém a URL do vídeo correspondente ao dia atual
    $video_url = get_youtube_video_urls_by_day();

    // Monta o código HTML para exibir o vídeo do YouTube
    $output = $video_url;
    /*$output = '<div class="youtube-video">';
    $output .= '<iframe width="560" height="315" src="' . $video_url . '" frameborder="0" allowfullscreen></iframe>';
    $output .= '</div>'; */

    return $output;
}
add_shortcode('youtube_video_by_day', 'youtube_video_by_day_shortcode');


// Função para adicionar uma página de configurações ao menu do WordPress
function custom_video_plugin_settings_page() {
    add_options_page(
        'Custom Video Plugin Settings',
        'Custom Video Plugin',
        'manage_options',
        'custom-video-plugin',
        'custom_video_plugin_settings'
    );
}
add_action('admin_menu', 'custom_video_plugin_settings_page');

// Função para exibir a página de configurações
function custom_video_plugin_settings() {
    if (!current_user_can('manage_options')) {
        return;
    }

    if (isset($_GET['settings-updated'])) {
        add_settings_error('custom_video_plugin_messages', 'custom_video_plugin_message', 'Configurações salvas.', 'updated');
    }
    settings_errors('custom_video_plugin_messages');
    ?>
    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('custom_video_plugin');
            do_settings_sections('custom-video-plugin');
            submit_button('Salvar Configurações');
            ?>
        </form>
    </div>
    <?php
}

// Função para registrar as configurações
function custom_video_plugin_settings_init() {
    register_setting('custom_video_plugin', 'custom_video_plugin_settings');
    
    add_settings_section(
        'custom_video_plugin_section',
        'Configurações de Vídeos por Dia',
        '',
        'custom-video-plugin'
    );

    $days = array('domingo', 'segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado');
    foreach ($days as $day) {
        add_settings_field(
            $day,
            ucfirst($day),
            'custom_video_plugin_field_callback',
            'custom-video-plugin',
            'custom_video_plugin_section',
            array('day' => $day)
        );
    }
}
add_action('admin_init', 'custom_video_plugin_settings_init');

// Função para exibir os campos de configuração
function custom_video_plugin_field_callback($args) {
    $options = get_option('custom_video_plugin_settings');
    $day = $args['day'];
    $value = isset($options[$day]) ? $options[$day] : '';

    echo '<input type="text" name="custom_video_plugin_settings[' . $day . ']" value="' . esc_attr($value) . '" />';
}
