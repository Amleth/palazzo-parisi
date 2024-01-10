<?php

if ( ! function_exists( 'musea_core_include_custom_post_types_files' ) ) {
	/**
	 * Loads all custom post types by going through all folders that are placed directly in post types folder
	 */
	function musea_core_include_custom_post_types_files() {
		if ( musea_core_theme_installed() ) {
			foreach ( glob( MUSEA_CORE_CPT_PATH . '/*/load.php' ) as $cpt ) {
				if ( musea_elated_is_customizer_item_enabled( $cpt, 'musea_performance_disable_cpt_' ) ) {
					include_once $cpt;
				}
			}
		}
	}
	
	add_action( 'after_setup_theme', 'musea_core_include_custom_post_types_files', 1 );
}

if ( ! function_exists( 'musea_core_include_custom_post_types_meta_boxes' ) ) {
	/**
	 * Loads all meta boxes functions for custom post types by going through all folders that are placed directly in post types folder
	 */
	function musea_core_include_custom_post_types_meta_boxes() {
		if ( musea_core_theme_installed() ) {
			foreach ( glob( MUSEA_CORE_CPT_PATH . '/*/admin/meta-boxes/*.php' ) as $option ) {
				$cpt_relative_path = str_replace( MUSEA_CORE_CPT_PATH . '/', '', $option );
				$cpt_name          = substr( $cpt_relative_path, 0, strpos( $cpt_relative_path, '/' ) );
				
				if ( musea_elated_is_customizer_item_enabled( $cpt_name, 'musea_performance_disable_cpt_', true ) ) {
					include_once $option;
				}
			}
		}
	}
	
	add_action( 'musea_elated_action_before_meta_boxes_map', 'musea_core_include_custom_post_types_meta_boxes' );
}

if ( ! function_exists( 'musea_core_include_custom_post_types_global_options' ) ) {
	/**
	 * Loads all global otpions functions for custom post types by going through all folders that are placed directly in post types folder
	 */
	function musea_core_include_custom_post_types_global_options() {
		if ( musea_core_theme_installed() ) {
			foreach ( glob( MUSEA_CORE_CPT_PATH . '/*/admin/options/*.php' ) as $option ) {
				$cpt_relative_path = str_replace( MUSEA_CORE_CPT_PATH . '/', '', $option );
				$cpt_name          = substr( $cpt_relative_path, 0, strpos( $cpt_relative_path, '/' ) );
				
				if ( musea_elated_is_customizer_item_enabled( $cpt_name, 'musea_performance_disable_cpt_', true ) ) {
					include_once $option;
				}
			}
		}
	}
	
	add_action( 'musea_elated_action_before_options_map', 'musea_core_include_custom_post_types_global_options', 1 );
}