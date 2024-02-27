<?php

// REPLACE WP MENU ICONS

function replace_wp_menu_icons() {
    echo '<style>
		#adminmenu #menu-dashboard .wp-menu-image img {
            display: none;
        }
		
        #adminmenu #menu-dashboard .wp-menu-image::before {
            content: "";
            background-image: url(' . plugin_dir_url( __FILE__ ) . 'icons/house.svg);
            background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
            display: inline-block;
            width: 20px;
            height: 20px;
			vertical-align: middle;
            margin: 0 5px 0 5px;
        }
		
		#adminmenu #menu-posts .wp-menu-image::before {
            content: "";
            background-image: url(' . plugin_dir_url( __FILE__ ) . 'icons/posts.svg);
            background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
            display: inline-block;
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin: 0 5px 0 5px;
        }

        #adminmenu #menu-media .wp-menu-image::before {
            content: "";
            background-image: url(' . plugin_dir_url( __FILE__ ) . 'icons/files.svg);
            background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
            display: inline-block;
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin: 0 5px 0 5px;
        }
		
		#adminmenu #menu-pages .wp-menu-image::before {
            content: "";
            background-image: url(' . plugin_dir_url( __FILE__ ) . 'icons/pages.svg);
            background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
            display: inline-block;
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin: 0 5px 0 5px;
        }
		
		#adminmenu #menu-comments .wp-menu-image::before {
            content: "";
            background-image: url(' . plugin_dir_url( __FILE__ ) . 'icons/comments.svg);
            background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
            display: inline-block;
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin: 0 5px 0 5px;
        }
		
		#adminmenu #menu-appearance .wp-menu-image::before {
            content: "";
            background-image: url(' . plugin_dir_url( __FILE__ ) . 'icons/appearance.svg);
            background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
            display: inline-block;
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin: 0 5px 0 5px;
        }
		
		#adminmenu #menu-plugins .wp-menu-image::before {
            content: "";
            background-image: url(' . plugin_dir_url( __FILE__ ) . 'icons/plugins.svg);
            background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
            display: inline-block;
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin: 0 5px 0 5px;
        }
		
		#adminmenu #menu-users .wp-menu-image::before {
            content: "";
            background-image: url(' . plugin_dir_url( __FILE__ ) . 'icons/users.svg);
            background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
            display: inline-block;
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin: 0 5px 0 5px;
        }
		
		#adminmenu #menu-tools .wp-menu-image::before {
            content: "";
            background-image: url(' . plugin_dir_url( __FILE__ ) . 'icons/tools.svg);
            background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
            display: inline-block;
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin: 0 5px 0 5px;
        }
		
		#adminmenu #menu-settings .wp-menu-image::before {
            content: "";
            background-image: url(' . plugin_dir_url( __FILE__ ) . 'icons/settings.svg);
            background-size: contain;
			background-repeat: no-repeat;
			background-position: center;
            display: inline-block;
            width: 20px;
            height: 20px;
            vertical-align: middle;
            margin: 0 5px 0 5px;
        }
    </style>';
}
add_action('admin_head', 'replace_wp_menu_icons');
