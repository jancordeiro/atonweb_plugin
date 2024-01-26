<?php
/**
 * ATON WEB DEVELOPMENT
 * 
 * Custom shortcodes for Wordpress CMS
 * 
 * Developer: Jan Cordeiro - https://jancordeiro.github.io
 */

// SHORTCODE TO SHOW UPDATED YEAR
function current_year_shortcode() {
    return date('Y');
}
add_shortcode('current_year', 'current_year_shortcode');

// SOCIAL SHARE LINKS SHORTCODE
function social_share_shortcode() {
    wp_enqueue_style('dashicons');
	ob_start();
    ?>
	<style>
        .social-share {
            display: flex;
            gap: 10px;
        }
        .social-share a {
            display: flex;
			padding: 10px;
			border-radius: 100%;
            text-decoration: none;
        }
		.facebook {
			color: #fff;
            background-color: #3b5998;
			font-size: 20px;
		}
		.social-share a:hover.facebook {
			color: #3b5998;
            background-color: #fff;
        }
		.twitter {
			color: #fff;
			background-color: #55acee;
			font-size: 20px;
		}
		.social-share a:hover.twitter {
			color: #55acee;
            background-color: #fff;
        }
		.whatsapp {
			color: #fff;
			background-color: #4dc247;
			font-size: 20px;
		}
		.social-share a:hover.whatsapp {
			color: #4dc247;
            background-color: #fff;
        }
    </style>
    <div class="social-share">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="facebook" target="_blank" rel="nofollow">
            <span class="dashicons dashicons-facebook"></span>
        </a>
        <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" class="twitter" target="_blank" rel="nofollow">
            <span class="dashicons dashicons-twitter"></span>
        </a>
        <a href="whatsapp://send?text=<?php the_title(); ?> <?php the_permalink(); ?>" data-action="share/whatsapp/share" class="whatsapp" target="_blank" rel="nofollow">
            <span class="dashicons dashicons-whatsapp"></span>
        </a>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('social_share', 'social_share_shortcode');
