<?php
/*
Plugin Name: Musea Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Select Themes
Version: 2.0.3
*/
define('MUSEA_INSTAGRAM_FEED_VERSION', '2.0.3');
define('MUSEA_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('MUSEA_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));
define( 'MUSEA_INSTAGRAM_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'MUSEA_INSTAGRAM_ASSETS_PATH', MUSEA_INSTAGRAM_ABS_PATH . '/assets' );
define( 'MUSEA_INSTAGRAM_ASSETS_URL_PATH', MUSEA_INSTAGRAM_URL_PATH . 'assets' );
define( 'MUSEA_INSTAGRAM_SHORTCODES_PATH', MUSEA_INSTAGRAM_ABS_PATH . '/shortcodes' );
define( 'MUSEA_INSTAGRAM_SHORTCODES_URL_PATH', MUSEA_INSTAGRAM_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'musea_instagram_theme_installed' ) ) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function musea_instagram_theme_installed() {
        return defined( 'MUSEA_ELATED_ROOT' );
    }
}

if ( ! function_exists( 'musea_instagram_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function musea_instagram_feed_text_domain() {
		load_plugin_textdomain( 'musea-instagram-feed', false, MUSEA_INSTAGRAM_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'musea_instagram_feed_text_domain' );
}
