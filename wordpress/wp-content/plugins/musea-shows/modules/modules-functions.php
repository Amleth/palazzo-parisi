<?php
if ( ! function_exists( 'musea_shows_include_modules_meta_boxes' ) ) {
	/**
	 * Loads all meta boxes functions for modules by going through all folders that are placed directly in post types folder
	 */
	function musea_shows_include_modules_meta_boxes() {
		if ( musea_shows_theme_installed() ) {
			foreach ( glob( MUSEA_SHOWS_MODULES_PATH . '/*/admin/meta-boxes/*.php' ) as $meta_boxes_map ) {
				include_once $meta_boxes_map;
			}
		}
	}
	
	add_action( 'musea_elated_action_before_meta_boxes_map', 'musea_shows_include_modules_meta_boxes' );
}

if ( ! function_exists( 'musea_shows_include_modules_global_options' ) ) {
	/**
	 * Loads all global otpions functions for modules by going through all folders that are placed directly in post types folder
	 */
	function musea_shows_include_modules_global_options() {
		if ( musea_shows_theme_installed() ) {
			foreach ( glob( MUSEA_SHOWS_MODULES_PATH . '/*/admin/options/*.php' ) as $global_options ) {
				include_once $global_options;
			}
		}
	}
	
	add_action( 'musea_elated_action_before_options_map', 'musea_shows_include_modules_global_options', 1 );
}