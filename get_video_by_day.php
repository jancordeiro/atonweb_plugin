<?php // APAGUE ESSAA TAG DE ABERTURA SE USAR NO FUNCTIONS.PHP DO SEU TEMA

// INICIO FUNÇÃO VIDEO POR DIA

function get_youtube_video_urls_by_day() {
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

// FIM DA FUNÇÃO DE VIDEOS POR DIA
