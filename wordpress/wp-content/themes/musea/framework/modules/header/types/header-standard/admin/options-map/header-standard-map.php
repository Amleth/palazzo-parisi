<?php

if ( ! function_exists( 'musea_elated_get_hide_dep_for_header_standard_options' ) ) {
	function musea_elated_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'musea_elated_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'musea_elated_header_standard_map' ) ) {
	function musea_elated_header_standard_map( $parent ) {
		$hide_dep_options = musea_elated_get_hide_dep_for_header_standard_options();
		
		musea_elated_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'musea' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'musea' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'musea' ),
					'left'   => esc_html__( 'Left', 'musea' ),
					'center' => esc_html__( 'Center', 'musea' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'musea_elated_action_additional_header_menu_area_options_map', 'musea_elated_header_standard_map' );
}