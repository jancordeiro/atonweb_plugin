// Incluir esse script no arquivo HEADER.PHP do seu tema do Wordpress
// O script deve estar dentro da tag HEAD

<meta property="og:title" content="<?php echo get_the_title(); ?>"/>
<meta property="og:description" content="<?php echo get_the_excerpt(); ?>"/>
<meta property="og:url" content="<?php echo get_permalink(); ?>"/>
<?php
if (has_post_thumbnail()) {
    $thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
    ?>
    <meta property="og:image" content="<?php echo esc_attr($thumbnail_src[0]); ?>"/>
    <?php
} else {
    // Se não houver imagem destacada, use uma imagem padrão
    ?>
    <meta property="og:image" content="URL_da_sua_imagem_padrao.jpg"/>
    <?php
}
?>
