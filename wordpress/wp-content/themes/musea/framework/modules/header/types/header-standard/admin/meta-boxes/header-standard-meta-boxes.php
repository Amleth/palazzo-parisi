<?php

if ( ! function_exists( 'musea_elated_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function musea_elated_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'musea_elated_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'musea_elated_header_standard_meta_map' ) ) {
	function musea_elated_header_standard_meta_map( $parent ) {
		$hide_dep_options = musea_elated_get_hide_dep_for_header_standard_meta_boxes();
		
		musea_elated_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'eltdf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'musea' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'musea' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'musea' ),
					'left'   => esc_html__( 'Left', 'musea' ),
					'right'  => esc_html__( 'Right', 'musea' ),
					'center' => esc_html__( 'Center', 'musea' )
				),
				'dependency' => array(
					'hide' => array(
						'eltdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'musea_elated_action_additional_header_area_meta_boxes_map', 'musea_elated_header_standard_meta_map' );
}