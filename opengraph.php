<?php // REMOVE THIS LINE

/* USING OPEN GRAPH META TAGS
*
* Copy and paste this script into your theme's header.php within the head tags
*
*/

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
    // If there's no featured image, use a default imagem
    ?>
    <meta property="og:image" content="default_image_URL.jpg"/>
    <?php
}
?>
