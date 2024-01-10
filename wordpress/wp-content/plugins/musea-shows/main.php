<?php
/*
Plugin Name: Musea Shows
Description: Plugin that adds all post types needed by our theme
Author: Select Themes
Version: 1.0.4
*/

require_once 'load.php';

add_action('after_setup_theme', array(MuseaShows\CPT\PostTypesRegister::getInstance(), 'register'));

if (!function_exists('musea_shows_activation')) {
    /**
     * Triggers when plugin is activated. It calls flush_rewrite_rules
     * and defines musea_elated_action_core_on_activate action
     */
    function musea_shows_activation() {
        do_action('musea_elated_action_shows_on_activate');

        MuseaShows\CPT\PostTypesRegister::getInstance()->register();
        flush_rewrite_rules();
    }

    register_activation_hook(__FILE__, 'musea_shows_activation');
}

if (!function_exists('musea_shows_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function musea_shows_text_domain() {
        load_plugin_textdomain('musea-shows', false, MUSEA_SHOWS_REL_PATH . '/languages');
    }

    add_action('plugins_loaded', 'musea_shows_text_domain');
}

if ( ! function_exists( 'musea_shows_load_assets' ) ) {
    
    function musea_shows_load_assets(){
	
	    $array_deps_js             = array();
	    if ( musea_shows_theme_installed() ) {
		    $array_deps_js[] = 'musea-select-modules';
	    }

        wp_enqueue_style( 'musea-shows-style', plugins_url( '/assets/css/shows.min.css', __FILE__ ) );
        if ( function_exists( 'musea_elated_is_responsive_on' ) && musea_elated_is_responsive_on() ) {
            wp_enqueue_style( 'musea-shows-responsive-style', plugins_url( '/assets/css/shows-responsive.min.css', __FILE__ ) );
        }
	
	    wp_enqueue_script( 'musea-shows-script', plugins_url( '/assets/js/shows.min.js', __FILE__ ), $array_deps_js, false, true );
        
    }

    add_action( 'wp_enqueue_scripts', 'musea_shows_load_assets' );
}


if (!function_exists('musea_shows_version_class')) {
    /**
     * Adds plugins version class to body
     *
     * @param $classes
     *
     * @return array
     */
    function musea_shows_version_class($classes) {
        $classes[] = 'musea-shows-' . MUSEA_SHOWS_VERSION;

        return $classes;
    }

    add_filter('body_class', 'musea_shows_version_class');
}

if (!function_exists('musea_shows_theme_installed')) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function musea_shows_theme_installed() {
        return defined('MUSEA_ELATED_ROOT');
    }
}

if (!function_exists('musea_shows_is_woocommerce_installed')) {
    /**
     * Function that checks if woocommerce is installed
     * @return bool
     */
    function musea_shows_is_woocommerce_installed() {
        return function_exists('is_woocommerce');
    }
}

if (!function_exists('musea_shows_is_revolution_slider_installed')) {
    function musea_shows_is_revolution_slider_installed() {
        return class_exists('RevSliderFront');
    }
}

if (!function_exists('musea_shows_is_wpml_installed')) {
    /**
     * Function that checks if WPML plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function musea_shows_is_wpml_installed() {
        return defined('ICL_SITEPRESS_VERSION');
    }
}

if (!function_exists('musea_shows_is_tickera_installed')) {
    /**
     * Function that checks if TICKERA plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function musea_shows_is_tickera_installed() {
        return class_exists('TC');
    }
}
