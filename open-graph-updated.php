<?php
if (is_singular()) {
    global $post;

    // Check for a featured image
    if (has_post_thumbnail()) {
        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
        $thumbnail_url = $thumbnail ? $thumbnail[0] : '';
    } else {
        // If there is no featured image, use a default image
        $default_image = 'URL_da_sua_imagem_padrao.jpg'; // Replace with your default image URL
        $thumbnail_url = $default_image;
    }

    $og_tags = array(
        '<meta property="og:title" content="' . get_the_title() . '">',
        '<meta property="og:url" content="' . get_permalink() . '">',
        '<meta property="og:type" content="article">',
        '<meta property="og:description" content="' . get_the_excerpt() . '">',
        '<meta property="og:image" content="' . $thumbnail_url . '">'
    );

    echo implode("\n", $og_tags);
}
?>
