<?php

if ( ! function_exists( 'musea_elated_admin_map_init' ) ) {
	function musea_elated_admin_map_init() {
		do_action( 'musea_elated_action_before_options_map' );
		
		foreach ( glob( MUSEA_ELATED_FRAMEWORK_ROOT_DIR . '/admin/options/*/*.php' ) as $module_load ) {
			include_once $module_load;
		}
		
		do_action( 'musea_elated_action_options_map' );
		
		do_action( 'musea_elated_action_after_options_map' );
	}
	
	add_action( 'after_setup_theme', 'musea_elated_admin_map_init', 1 );
}