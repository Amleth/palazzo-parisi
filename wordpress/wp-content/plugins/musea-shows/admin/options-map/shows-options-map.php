<?php

if ( ! function_exists( 'musea_elated_shows_options_map' ) ) {
	function musea_elated_shows_options_map() {
		
		musea_elated_add_admin_page(
			array(
				'slug'  => '_shows',
				'title' => esc_html__( 'Shows', 'musea-shows' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
	
		do_action('musea_elated_action_shows_plugin_options');
	}
	
	add_action( 'musea_elated_action_options_map', 'musea_elated_shows_options_map', 14 );
}
