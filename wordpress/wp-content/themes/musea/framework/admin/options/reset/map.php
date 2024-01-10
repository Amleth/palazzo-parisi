<?php

if ( ! function_exists( 'musea_elated_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function musea_elated_reset_options_map() {
		
		musea_elated_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'musea' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = musea_elated_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'musea' )
			)
		);
		
		musea_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'musea' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'musea' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'musea_elated_action_options_map', 'musea_elated_reset_options_map', musea_elated_set_options_map_position( 'reset' ) );
}