<?php

if ( ! function_exists( 'musea_shows_include_shortcodes_file' ) ) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     */
    function musea_shows_include_shortcodes_file() {

        do_action( 'musea_shows_action_include_shortcodes_file' );
    }

    add_action( 'init', 'musea_shows_include_shortcodes_file', 6 ); // permission 6 is set to be before vc_before_init hook that has permission 9
}

if ( ! function_exists( 'musea_shows_load_shortcodes' ) ) {
    function musea_shows_load_shortcodes() {
        include_once MUSEA_SHOWS_ABS_PATH . '/lib/shortcode-loader.php';

        MuseaShows\Lib\ShortcodeLoader::getInstance()->load();
    }

    add_action( 'init', 'musea_shows_load_shortcodes', 7 ); // permission 7 is set to be before vc_before_init hook that has permission 9 and after musea_shows_include_shortcodes_file hook
}

if ( ! function_exists( 'musea_shows_add_admin_shortcodes_styles' ) ) {
    /**
     * Function that includes shortcodes shows styles for admin
     */
    function musea_shows_add_admin_shortcodes_styles() {

        //include shortcode styles for Visual Composer
        wp_enqueue_style( 'musea-shows-vc-shortcodes', MUSEA_SHOWS_ASSETS_URL_PATH . '/css/admin/musea-vc-shortcodes.css' );
    }

    add_action( 'musea_elated_action_admin_scripts_init', 'musea_shows_add_admin_shortcodes_styles' );
}

if ( ! function_exists( 'musea_shows_add_admin_shortcodes_custom_styles' ) ) {
    /**
     * Function that print custom vc shortcodes style
     */
    function musea_shows_add_admin_shortcodes_custom_styles() {
        $style                  = apply_filters( 'musea_shows_filter_add_vc_shortcodes_custom_style', $style = '' );
        $shortcodes_icon_styles = array();
        $shortcode_icon_size    = 32;
        $shortcode_position     = 0;

        $shortcodes_icon_class_array = apply_filters( 'musea_shows_filter_add_vc_shortcodes_custom_icon_class', $shortcodes_icon_class_array = array() );
        sort( $shortcodes_icon_class_array );

        if ( ! empty( $shortcodes_icon_class_array ) ) {
            foreach ( $shortcodes_icon_class_array as $shortcode_icon_class ) {
                $mark = $shortcode_position != 0 ? '-' : '';

                $shortcodes_icon_styles[] = '.vc_element-icon.extended-custom-icon-shows' . esc_attr( $shortcode_icon_class ) . ' {
					background-position: ' . $mark . esc_attr( $shortcode_position * $shortcode_icon_size ) . 'px 0;
				}';

                $shortcode_position ++;
            }
        }

        if ( ! empty( $shortcodes_icon_styles ) ) {
            $style .= implode( ' ', $shortcodes_icon_styles );
        }

        if ( ! empty( $style ) ) {
            wp_add_inline_style( 'musea-shows-vc-shortcodes', $style );
        }
    }

    add_action( 'musea_elated_action_admin_scripts_init', 'musea_shows_add_admin_shortcodes_custom_styles' );
}