<?php // APAGUE ESSAA TAG DE ABERTURA SE USAR NO FUNCTIONS.PHP DO SEU TEMA

// INICIO FUNÇÃO VIDEO POR DIA
function get_youtube_video_urls_by_day() {
    // Array com as URLs dos vídeos do YouTube
    $video_urls = array(
        'domingo' => 'https://www.youtube.com/watch?v=tNfMjI-nkAE',
        'segunda' => 'https://www.youtube.com/watch?v=kU7b9olDWns',
        'terca' => 'https://www.youtube.com/watch?v=wURxzw6d98w',
        'quarta' => 'https://www.youtube.com/embed/gnMDYLrNwFQ',
        'quinta' => 'https://www.youtube.com/watch?v=zHlxDWuBJ-c',
        'sexta' => 'https://youtube.com/watch?v=dC0-nQjOsqo',
        'sabado' => 'https://www.youtube.com/watch?v=KVDKWrsP3es',
    );

    // Obtém o nome do dia da semana em minúsculas (por exemplo: "segunda")
    $day_of_week = strtolower(date('l'));

    // Verifica se o nome do dia da semana está no array de URLs
    if (isset($video_urls[$day_of_week])) {
        return $video_urls[$day_of_week];
    } else {
        // Retorna uma URL padrão caso não haja URL correspondente ao dia da semana
        return 'https://www.youtube.com/embed/gnMDYLrNwFQ?si=GpgStrlqHrV20QqD';
    }
}

function youtube_video_by_day_shortcode() {
    // Obtém a URL do vídeo correspondente ao dia atual
    $video_url = get_youtube_video_urls_by_day();

    // Monta o código HTML para exibir o vídeo do YouTube
    $output = '<div class="youtube-video">';
    $output .= '<iframe width="560" height="315" src="' . $video_url . '" frameborder="0" allowfullscreen></iframe>';
    $output .= '</div>';

    return $output;
}
add_shortcode('youtube_video_by_day', 'youtube_video_by_day_shortcode');

// FIM DA FUNÇÃO DE VIDEOS POR DIA
